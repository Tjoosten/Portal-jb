<?php

namespace App\Http\Controllers\Lease;

use App\Http\Requests\Tenants\BillableValidator;
use App\Models\Lease;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class BillingController
 *
 * @package App\Http\Controllers\Lease
 */
class BillingController extends Controller
{
    /**
     * BillingController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initialiseer de globale constructor voor de controllers.
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
    }

    /**
     * Methode voor het overzicht van de facturatie data
     *
     * @param  Lease $lease De databvank entiteit van de verhuring.
     * @return View
     */
    public function index(Lease $lease): View
    {
        // $lease->tenant->billingInformation geeft toegang de de facturatie data van de huurder.
        $viewData = ['billing' => $lease->tenant->billingInformation, 'lease' => $lease];
        return view('calendar.billing', $viewData);
    }

    /**
     * Methode voor het aanpassen van de huurder zijn facturatie data in de applicatie. 
     * 
     * @todo Implementatie routering (backend & view)
     * 
     * @param  BillableValidator $input
     * @param  Lease             $lease
     * @return RedirectResponse
     */
    public function update(BillableValidator $input, Lease $lease): RedirectResponse
    {
        // Confirmatie dat de facturatie data van de huurder is aangepast.
        if ($lease->tenant->update($input->except('extra_informatie'))) {
            $leaseBillingInfo = BillableInfoLease::update(['extra_informatie' => $input->extra_informatie]);
            
            // 1) 
            // 2) 
            if (! $lease->hasExtraBillingInfo() && $leaseBillingInfo) {
                $lease->billingInformation()->assocaiate($leaseBillingInfo)->save();        
            }
        }

        return redirect()->route('lease.billing ', $lease);
    }
}
