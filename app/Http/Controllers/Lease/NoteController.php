<?php

namespace App\Http\Controllers\Lease;

use App\Http\Requests\Calendar\NoteValidator;
use App\Models\NoteLease;
use Illuminate\Http\RedirectResponse;
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
        $this->middleware(['auth', 'role:admin|webmaster', 'forbid-banned-user']);
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
     * Method voor het opslaan van een notitie van een verhuring.
     *
     * @param  NoteValidator    $input De form request class dat verantwoordelijk is voor de validatie.
     * @param  Lease            $lease De gegeven databank entiteit van de verhuring
     * @return RedirectResponse
     */
    public function store(NoteValidator $input, Lease $lease): RedirectResponse
    {
        $user = $this->auth->user();
        $note = new NoteLease($input->all());

        if ($lease->notes()->save($note)) {
            $note->auteur()->associate($user)->save(); // Attacheer de auth gebruiker als notitie auteur.
            $user->logActivity("Heeft een notitie aangemaakt voor de verhuring aan {$lease->tenant->name}");
            $this->flashMessage->success("De notitie is toegevoegd voor de verhuring aan {$lease->tenant->name}")->important();
        }

        return redirect()->route('calendar.notes', $lease);
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
