<?php

namespace App\Http\Controllers\Lease\Tenants;

use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Billing;

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
        $this->middleware(['auth', 'role:admin|leiding']);
    }

    /**
     * Method voor de weergave van de facturatie data v/d gebruiker. 
     * 
     * @param  User $user De data entiteit van de gebruiker in de applicatie. 
     * @return View
     */
    public function index(User $user): View 
    {
        return view('tenants.billable-overview', [
            'user' => $user, 'billable' => $user->billingInformation
        ]);
    }

    public function store(?Billing $billable): RedirectResponse
    {
        // 
        //
        if ($billable->isFilledIn(false)) {
            $billable->storeData($input->all());
        } 
        
        // Geen facturatie data voor de gebruiker gevonden. Dus slaag alle data op in de database. 
        // En attacheer deze aan de gebruikers data van de aangemelde gebruiker.    
        else {
           $billable->updateData($input->all());        
        }

        return 
    }
}
