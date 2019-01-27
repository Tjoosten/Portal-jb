<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;

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
        return view('tenants.lock', compact('user'));
    }

    /**
     * Methode om (tijdelijk) een gebruiker te blokkeren in het systeem.
     *
     * @param  Request  $request    De instantie dat alle request data benaderbaar maakt.
     * @param  User     $user       De databank entiteit van de opgegeven gebruiker.
     * @return RedirectResponse
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        // 1) Match de gebruiker zijn wachtwoord tegen de gegeven confirmatie input (wachtwoord)
        //    Indien het wachtwoord en de confirmatie met elkaar matchen kan met verder gaan tot de ban. 
        // 2) Registreer een permanente ban in de applicatie. Deze is alleen op te heven door een admin.
        if ($user->validateRequest($request->confirmation) && $user->ban(['expired_at' => null])) {

            // Indien de gegeven gebruiker niet dezelfde is dan de aangemelde gebruiker moet de actie gelogd worden.
            if (! auth()->user()->is($user)) {
                $user->logActivity("Heeft de login van {$user->name} geblokkeerd in de applicatie.");
            }
        }
    }

    /**
     * Methode voor het (tijdelijk) blokkeren van een gebruiker in de applicatie.
     *
     * @todo Register route
     * @todo Build up the application view.
     * @todo Implement undo method.
     *
     * @param  Request $request     De instantie dat verantwoordelijk is voor de request informatie.
     * @param  User    $user        De databank entiteit van de opgegeven gebruiker.
     * @return View|RedirectResponse
     */
    public function delete(Request $request, User $user)
    {
        if ($request->isMethod('GET')) {

        }
    }
}
