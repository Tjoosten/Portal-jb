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
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Methode voor het weergeven van het blokkade formulier in de applicatie.
     *
     * @todo Register route
     * @todo Build up the application views.
     *
     * @param  User $user   De databank entiteit van de opgegeven gebruiker.
     * @return View
     */
    public function create(User $user): View
    {
        // Indien de gegeven gebruiker een leiding en of administrator is.
        // Geef dan de beheers console weer voor leiding of administrator accounts.
        if ($user->hasAnyRole(['leiding', 'admin'])) {
            return view('', compact('user'));
        }

        // De gebruiker is een huurder.
        return view('tenants.lock', compact('user'));
    }

    /**
     * Methode om (tijdelijk) een gebruiker te blokkeren in het systeem.
     * ---
     * Methode word gedeeld door het huurders paneel en gebruikers paneel
     *
     * @todo Register route
     * @todo Build up the application views.
     *
     * @param  User $user           De databank entiteit van de opgegeven gebruiker.
     * @return RedirectResponse
     */
    public function store(User $user): RedirectResponse
    {

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
