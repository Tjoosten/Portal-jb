<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Lease;

/**
 * Class CalendarController
 * 
 * @package App\Http\Controllers\Lease
 */
class CalendarController extends Controller
{
    /**
     * Creer een nieuwe CalendarController instantie
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initialiseer de globale constructor
        $this->middleware(['auth', 'role:admin|leiding']);
    }

    /**
     * Methode voor het calendar overzicht van de verhuringen. 
     * 
     * @param  Lease $lease De databank model entiteit voor de verhuringen. 
     * @return View
     */
    public function index(Lease $lease): View
    {
        return view('calendar.index', ['leases' => $lease->simplePaginate()]);
    }
}
