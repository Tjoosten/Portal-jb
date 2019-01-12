<?php

namespace App\Http\Controllers\Helpdesk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Helpdesk;

/**
 * Class DashboardController 
 * 
 * @package App\Http\Controllers\Helpdesk
 */
class DashboardController extends Controller
{
    /**
     * Nieuwe controller constructor die als extensie die van de globale constructor. 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de glable controller constructor. 
        $this->middleware(['auth']);
    }

    /**
     * Methode voor het weergeven van de helpdesk index pagina. (huurder)
     *
     * @param  Request  $request    Class voor the request data dat is gebonden aan de controller.
     * @param  Helpdesk $ticket     Database model class voor de helpdesk tickets. 
     * @return View
     */
    public function huurder(Request $request, Helpdesk $tickets): View
    {
        $categories = ['Vraag' => 'Vraag', 'Opmerking' => 'Opmerking'];

        if ($this->auth->user()->hasRole(['leiding', 'admin', 'webmaster'])) {
            // Administrators, Leiding en de webmaster hebben toegang nodig tot het admin dashboard. 
            // Dit panel heeft meer functies en opties. Alsook een oplijsting van de ticket in de applicatie. 
            $tickets = $tickets->getTicketsByType($request->filter)->simplePaginate();
            return view('helpdesk.dashboards.admin', compact('categories', 'tickets'));
        }

        // De gebruiker is een gewone huurder. Dus val terug op het standaard helpdesk dashboard. 
        return view('helpdesk.dashboards.huurder', compact('categories'));
    }
}
