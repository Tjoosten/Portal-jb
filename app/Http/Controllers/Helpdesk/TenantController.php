<?php

namespace App\Http\Controllers\Helpdesk;

use App\Models\Helpdesk;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TenantController
 * ----
 * Method voor de specifieke helpdesk controllers die nodig zijn voor gebruiker die de huurder permissie bezit.
 *
 * @package App\Http\Controllers\Helpdesk
 */
class TenantController extends Controller
{
    /**
     * TenantController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(); // Initialiseer de globale controller
        $this->middleware(['auth', 'role:huurder']);
    }

    /**
     * Method voor het weergeven van de vragen die de aangemelde gebruiker heeft.
     *
     * @param  Helpdesk $tickets  De databank entiteit van de helpdesk tickets.
     * @param  Request  $request  De request informatie instantie.
     * @return View
     */
    public function index(Helpdesk $tickets, Request $request): View
    {
        $user = $this->auth->user();
        $tickets = $tickets->getTicketsByType($request->filter)->whereCreatedBy($user->id)->simplePaginate();

        return view('helpdesk.tenant.overview', compact('tickets'));
    }
}
