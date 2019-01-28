<?php

namespace App\Http\Controllers\Lease\Tenants;

use App\Http\Requests\Tenants\BillableValidator;
use App\User;
use Illuminate\Http\{Request, Response, RedirectResponse};
use Illuminate\View\View;
use App\Http\Controllers\Controller;

/**
 * Class BillableController
 *
 * @package App\Http\Controllers\Lease\Tenants
 */
class BillableController extends Controller
{
    /**
     * BillableController Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initialiseer de globale constructor voor de controller.
        $this->middleware(['auth', 'role:admin|leiding', 'forbid-banned-user']);
    }

    /**
     * Method voor de weergave van de facturatie data v/d gebruiker.
     *
     * @param  User $user De data entiteit van de gebruiker in de applicatie.
     * @return View
     */
    public function index(User $user): View
    {
        if ($user->hasRole('huurder')) {
            $viewData = ['user' => $user, 'billable' => $user->billingInformation];
            return view('tenants.billable-overview', $viewData);
        }

        // De gegeven gebruikers entiteit is geen huurder. Dus is de facturatie data niet nodig.
        // Aangezien administrators en leiding de verhuur onderling kunnen regelen met de verantwoordelijke of VZW.
        abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Methode voor het aanpassen van de facturatie data van de huurder.
     *
     * @param  BillableValidator $input The form validation class dat verantwoordelijk is voor de validatie.
     * @param  User              $user  De databank entiteit van de huurder in de applicatie.
     * @return RedirectResponse
     */
    public function store(BillableValidator $input, User $user): RedirectResponse
    {
        $information = $user->billingInformation->update($input->all());

        // Check of de gegeven gebruiker een huurder is. En dat alle facturatie data is aangepast door
        // de ->billingInformation(); relatie.
        if ($user->hasRole('huurder') && $information) {

            // Indien de gegeven gebruiker niet de zelfde is dan de aangemelde gebruiker.
            // Moet deze actie gelogd worden in het systeem.
            if (! $this->auth->user()->is($user)) {
                $user->billingInformation->logActivity("Heeft de facturatie gegevens voor {$user->name} aangepast", 'Facturatie');
            }

            return redirect()->route('tenants.billing', $user);
        }

        // Kan de facturatie niet aanpassen dus herleid de aangemelde gebruiker terug naar de facturatie gegevens weergave.
        return redirect()->route('tenants.billing', $user);
    }
}
