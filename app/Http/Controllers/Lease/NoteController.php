<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Lease;

/**
 * Class NoteController 
 * 
 * @package App\Http\Controllers\Lease
 */
class NoteController extends Controller
{
    /**
     * New NoteController instance
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de globale constructor voor de controllers.
        $this->middleware(['auth', 'role:admin|leiding|webmaster', 'forbid-banned-user']);
    }

    /**
     * Weergave voor de creatie van een notitie. 
     * 
     * @return View
     */
    public function create(Lease $lease): View 
    {
        return view('notes.create', compact('lease'));
    }

    /**
     * Weergave van de notities voor een specifieke verhuur. 
     * 
     * @return View 
     */
    public function show(Lease $lease): View 
    {
        $notes = $lease->notes()->simplePaginate();
        return view('notes.lease', compact('notes', 'lease'));
    }
}
