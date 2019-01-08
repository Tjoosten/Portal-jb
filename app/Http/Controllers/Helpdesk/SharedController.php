<?php

namespace App\Http\Controllers\Helpdesk;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Helpdesk\CreateValidator;
use App\Models\Helpdesk;
use Illuminate\View\View;

/**
 * Class SharedController 
 * ---- 
 * Gedeelde controller tussen administrators de huurders. 
 * Hier komen de methodes die gedeeld worden door beide permissie rollen. 
 * 
 * @package App\Http\Controllers\Helpdesk
 */
class SharedController extends Controller
{
    /**
     * SharedController constructor 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de globale constructor in de controller. 
        $this->middleware(['auth']);
    }

    /**
     * Methode voor het opslaan van een ticket in de helpdesk. 
     * --- 
     * Authorizatie van de request gebeurd in de form request class 
     * 
     * @param  CreateValidator $input De form request class dat verantwoordelijk is voor de validatie
     * @return RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        $user = $this->auth->user(); 
        $question = new Helpdesk($input->all());

        if ($ticket = $user->questions()->save($question)) { // Helpdesk ticket is success vol aangemaakt
            if ($user->hasRole('admin')) { // User is administrator dus log is nodig. 
                $ticket->logActivity('Heeft een helpdesk ticket aangemaakt', 'Helpdesk');
            }
        }

        return redirect()->route('helpdesk.ticket.show', $ticket);
    }

    /**
     * Methode voor het sluiten van een helpdesk ticket in de applicatie. 
     *
     * @param  Helpdesk $ticket De database entiteit van het database ticket. 
     * @param  string   $status De nieuwe status voor het gegeven status ticket. 
     * @return RedirectResponse
     */
    public function status(Helpdesk $ticket, string $status): RedirectResponse
    {
        $this->authorize('close-ticket', $ticket);
         
        if ($status === 'sluiten' && $ticket->update(['is_open' => false, 'closed_at' => now()])) {
            $ticket->close();
        } 
        
        if ($status === 'heropen' && $ticket->update(['is_open' => true, 'closed_at' => null])) {
            $ticket->reopen();
        }

        return redirect()->route('helpdesk.ticket.show', $ticket);
    }

    /**
     * Methode voor de weergave van een ticket. 
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * 
     * @param  Helpdesk $ticket De databank entity van een helpdesk ticket. 
     * @return View 
     */
    public function show(Helpdesk $ticket): View 
    {
        $this->authorize('view-ticket', $ticket);
        $comments = $ticket->comments()->latest()->take(4)->get();

        return view('helpdesk.shared.show', compact('ticket', 'comments'));
    }
}
