<?php

namespace App\Http\Controllers\Users;

use Gate;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Mpociot\Reanimate\ReanimateModels;
use Spatie\Permission\Models\Role;
use App\User;
use App\Notifications\Users\CreatedMail;
use App\Http\Requests\Users\CreateValidator;
use App\Http\Requests\Users\Settings\InformationValidator;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Users
 */
class AdminController extends Controller
{
    use ReanimateModels;

    /**
     * AdminController constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initiate the global constructor
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
    }

    /**
     * Method for getting and displaying all the administrators for the application.
     *
     * @param  Request  $request Request instance that holds all the request data and information.
     * @param  User     $users   The database model for the users table.
     * @return View
     */
    public function index(Request $request, User $users): View
    {
        $baseQuery = $users->role(['leiding', 'admin']);

        switch ($request->filter) {
            case 'deleted': $baseQuery->onlyTrashed(); break;
        }

        return view('users.index', ['users' => $baseQuery->simplePaginate()]);
    }

    /**
     * Method for deleting admin users in the application.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @param  Request $request The form request instance that holds all the request information.
     * @param  User $admin The resource entity form the given administrator.
     * @return View|RedirectResponse
     */
    public function destroy(Request $request, User $admin)
    {
        if ($request->isMethod('GET')) {
            $viewPath = (Gate::allows('same-user', $admin)) ? 'users.settings.delete' : 'users.delete';
            return view($viewPath, compact('admin'));
        }

        // Method is a DELETE request so move on with the logic.
        $this->validate($request, ['confirmation' => 'required']);
        $admin->deleteUserAccount($request);

        return redirect()->route('admins.index');
    }

    /**
     * Methode voor het zoeken van een leider of administrator in de applicatie.
     *
     * @param  Request $input De instantie dat alle form data bewaard.
     * @return View
     */
    public function search(Request $input): View
    {
        $users = User::role(['admin', 'leiding'])
            ->where('email', 'LIKE', "%{$input->term}%")
            ->orWhere('name', 'LIKE', "%{$input->term}%")
            ->orWhere('telephone_number', 'like', "%{$input->term}%")
            ->simplePaginate();

        return view('users.index', compact('users'));
    }

    /**
     * Methode voor het creeren van nieuwe leiding of administrators in de applicatie.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::whereNotIn('name', ['huurder'])->get(['name']);
        return view('users.create', compact('roles'));
    }

    /**
     * Methode voor het opslaan van een nieuwe administrator in de applicatie.
     *
     * @see \App\App\Observers\UserObserver::created() - voor het aanmaken van de basis facturatie gegevens.
     *
     * @param  CreateValidator $inputDe form request class dat verantwoordelijk is voor de validatie.
     * @return RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        // Geen authorizatie check nodig omdat dit gebeurd in de form request class en controller constructor.
        // Indien gebruiker geen permissies heeft zal dit resulteren in een HTTP 403 code.

        if ($user = User::create($input->all())) {
            $user->assignRole($input->role); // Koppel de gebruikersrol aan de gebruiker.
            $this->auth->user()->logActivity("Heeft een login aangemaakt voor {$user->name} geannuleerd in de applicatie.", 'Admins & Leiding');

            $password = str_random(15);

            if ($user->update(['password' => $password])) { // Het wachtwoord voor de nieuwe gebruiker is aangepast in de databank.
                $when = now()->addMinute();
                $user->notify((new CreatedMail($password))->delay($when));
            }
        }

        return redirect()->route('admins.index');
    }

    /**
     * Methode voor het weergaven van de gebruiker in de applicatie.
     *
     * @param  User $user De databank entiteit van de gegeven gebruiker.
     * @return View
     */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /**
     * Methode voor het aanpassen van de admin/leiding/webmaster in de applicatie. 
     * 
     * @param  InformationValidator $input  The form request class that handles all the validation logic.
     * @param  User                 $user   The resource entity from the given user
     * @return RedirectResponse
     */
    public function update(InformationValidator $input, User $user): RedirectResponse
    {
        if ($user->update($input->all())) {
            $this->flashMessage->success("De gegevens van {$user->name} zijn aangepast in de applicatie")->important();
            $this->auth->user()->logActivity("Heeft de gegevens van de gebruiker {$user->name} aangepast in de applicatie.");
        }

        return redirect()->route('admins.show', $user);
    }

    /**
     * Undo the delete for the user in the application.
     *
     * @throws \Exception instance of ModelNotFoundException when no valid user entity is found.
     *
     * @param  int $admin The unique resource entity identifier from the admin.
     * @return RedirectResponse
     */
    public function undoDeleteRoute(int $admin): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($admin);
        $user->logActivity("Heeft de verwijdering van {$user->name} geannuleerd in de applicatie.", 'Admins & Leiding');

        $this->flashMessage->info("De verwijdering van {$user->name} is ongedaan gemaakt in de applicatie.");
        return $this->restoreModel($user->id, new User(), 'admins.index');
    }
}
