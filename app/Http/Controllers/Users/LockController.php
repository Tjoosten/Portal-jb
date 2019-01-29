<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

/**
 * Class LockController
 *
 * @package App\Http\Controllers\Users
 */
class LockController extends Controller
{
    /**
     * LockController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initialiseer de globale constructor
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
    }

    /**
     * Methode voor het weergeven van het blokkade formulier in de applicatie.
     *
     * @param  User $user   De databank entiteit van de opgegeven gebruiker.
     * @return View
     */
    public function create(User $user): View
    {
        return view('auth.lock', compact('user'));
    }

    /**
     * Methode om (tijdelijk) een gebruiker te blokkeren in het systeem.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @param  Request $request De instantie dat alle request data benaderbaar maakt.
     * @param  User $user De databank entiteit van de opgegeven gebruiker.
     * @return RedirectResponse
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, ['confirmation' => ['required', 'string', 'max:191']]);

        if (Hash::check($request->confirmation, $this->auth->user()->getAuthPassword()) && $user->ban(['expired_at' => null])) {
            if (! auth()->user()->is($user)) {
                $user->logActivity("Heeft de login van {$user->name} geblokkeerd in de applicatie.");
            }

            $this->flashMessage->success("De account van {$user->name} is met success geblokkeerd.")->important();
        }

        return redirect()->route('home');
    }

    /**
     * Methode voor het (tijdelijk) blokkeren van een gebruiker in de applicatie.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     *
     * @param  Request $request De instantie dat verantwoordelijk is voor de request informatie.
     * @param  User    $user    De databank entiteit van de opgegeven gebruiker.
     * @return View|RedirectResponse
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('remove-lock', $user);

        if ($request->isMethod('GET')) {
            return view('auth.unlock', compact('user'));
        }

        // Gegeven method is van het PATCH type dus ga over tot de effectieve deblokkering 
        $this->validate($request, ['confirmation' => ['required', 'string', 'max:191']]); 
        $user->removeUserLock($request->confirmation); // Registreer de gebruiker als actief in het systeem.

        return redirect()->route('home');
    }
}
