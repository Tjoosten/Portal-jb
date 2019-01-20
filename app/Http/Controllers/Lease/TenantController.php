<?php

namespace App\Http\Controllers\Lease;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

/**
 * Class TenantController 
 * 
 * @package App\Http\Controllers\Lease
 */
class TenantController extends Controller
{
    /**
     * Create een nieuwe TentantController instantie 
     * 
     * @return void 
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de globale constructor
        $this->middleware(['auth', 'role:admin|leiding', 'forbid-banned-user']);
    }

    /**
     * Methode voor de weergave van gebruikers in de applicatie die de huurder permissie bezitten. 
     * 
     * @param  User $tenants De databank model voor de gebruikers. 
     * @return View 
     */
    public function index(User $tenants): View
    {
        return view('tenants.index', ['tenants' => $tenants->role('huurder')->simplePaginate()]);
    }

    /**
     * Methode voor het weergeven van de data omtrent de huurder. 
     * 
     * @todo Build up the application view. 
     * @todo Register route
     * 
     * @param  User $tenant De gebruikers entiteit van de user. 
     * @return View 
     */
    public function show(User $tenant): View
    {
        return view('tenants.show', compact('tenant'));
    }

    /**
     * @todo docblock 
     * @todo implement route
     * @todo implement controller logic 
     * @todo Implement delete confirmation view.
     */
    public function destroy(User $tenant): RedirectResponse
    {

    }
}
