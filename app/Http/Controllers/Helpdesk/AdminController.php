<?php

namespace App\Http\Controllers\Helpdesk;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Helpdesk;

/**
 * Class AdminController 
 * ---- 
 * Controller voor de adminstrator functies van de helpdesk. 
 * 
 * @package App\Http\Controllers\Helpdesk 
 */
class AdminController extends Controller
{
    /**
     * Creatie AdminController instantie. 
     * 
     * @return void 
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de globale constructor.
        $this->middleware(['auth', 'can:assign-ticket,ticket', 'forbid-banned-user'])->only(['assign']); 
    }

    /**
     * Methode om de aangemelde leider, leidster of administrator toe te wijzen aan het ticket. 
     * 
     * @todo Implementatie notitie voor de creator voor het ticket. 
     * 
     * @param  Helpdesk $ticket De databan entiteit van het helpdesk ticket.
     * @return RedirectResponse
     */
    public function assign(Helpdesk $ticket): RedirectResponse 
    {
        if ($ticket->assignee()->associate($this->auth->user())->save()) {
            $ticket->logActivity("Volgt nu het ticket #{$ticket->id} op.", 'Helpdesk');
        }

        return redirect()->route('helpdesk.ticket.show', $ticket);
    }
}
