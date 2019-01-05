<?php

namespace App\Http\Controllers\Helpdesk;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Helpdesk\CreateValidator;
use App\Models\Helpdesk;

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
     * @see \App\Observers\HelpdeskObserver::class Voor de registratie van de data relaties. 
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
}
