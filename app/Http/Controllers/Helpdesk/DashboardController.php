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
     * @return View
     */
    public function huurder(): View
    {
        $this->authorize('view-huurder-dashboard', Helpdesk::class);
        return view('helpdesk.dashboards.huurder');
    }
}
