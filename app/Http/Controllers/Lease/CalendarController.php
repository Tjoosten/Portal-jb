<?php

namespace App\Http\Controllers\Lease;

use App\Http\Requests\Calendar\CreateValidator;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
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
        $this->middleware(['auth', 'role:admin|leiding', 'forbid-banned-user']);
    }

    /**
     * Methode voor het calendar overzicht van de verhuringen. 
     * 
     * @param  Lease $lease De databank model entiteit voor de verhuringen. 
     * @return View
     */
    public function index(Lease $lease): View
    {
        return view('calendar.index', ['leases' => $lease->orderBy('start_datum', 'ASC')->simplePaginate()]);
    }

    /**
     * Method for displaying the create view for an new lease.
     *
     * @return View
     */
    public function create(): View
    {
        $statusses = (new Lease)->getLeaseStatusses();
        return view('calendar.create', compact('statusses'));
    }

    /**
     * Method for creating the lease in the calendar.
     *
     * @param  CreateValidator $input The form request class that handles the validation.
     * @return RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        if ($lease = Lease::create($input->all())) {
            $lease->logActivity("Heeft een verhuring toegevoegd in de applicatie.");

            try {
                $tenant = User::whereEmail($input->email)->firstOrFail();
            }

            catch (ModelNotFoundException $exception) {
                $input->merge(['name' => "{$input->voornaam} {$input->achternaam}"]);
                $tenant = User::create($input->all())->assignRole('huurder');
            }

            $lease->tenant()->associate($tenant)->save();
        }

        return redirect()->route('calendar.index');
    }
}
