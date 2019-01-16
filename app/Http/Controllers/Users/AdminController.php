<?php

namespace App\Http\Controllers\Users;

use Gate;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Mpociot\Reanimate\ReanimateModels;
use Spatie\Permission\Models\Role;
use App\User;
use App\Http\Requests\Users\CreateValidator;

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
        $this->middleware(['auth', 'role:admin']);
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
     * @param  Request $request  The form request instance that holds all the request information. 
     * @param  User    $admin    The resource entity form the given administrator.  
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
     * @todo Register en embed de routering. 
     * 
     * @param  CreateValidator $inputDe form request class dat verantwoordelijk is voor de validatie.
     * @return RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        // Geen authorizatie check nodig omdat dit gebeurd in de form request class. 
        // Indien gebruiker geen permissies heeft zal dit resulteren in een HTTP 403 code. 

        if ($user = new User($input->except('role'))) {
            $user->assignRole($input->role);        // Koppel de gebruikersrol aan de gebruiker. 
            $user->fireModelEvent('create-admin', false);  // Model observer voor registreren van het wachtwoord en de notificatie. 
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
