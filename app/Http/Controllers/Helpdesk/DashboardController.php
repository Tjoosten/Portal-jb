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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return View
     */
    public function huurder(): View
    {
        $this->authorize('view-huurder-dashboard', Helpdesk::class);
        $categories = ['Vraag' => 'Vraag', 'Opmerking' => 'Opmerking'];

        return view('helpdesk.dashboards.huurder', compact('categories'));
    }
}
