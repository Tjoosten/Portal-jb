<?php

namespace App\Http\Controllers\Lease\Tenants;

use App\User;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

/**
 * Class TenantController 
 * 
 * @package App\Http\Controllers\Lease
 */
class IndexController extends Controller
{
    /**
     * Create een nieuwe IndexController instantie 
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
     * @param  User $tenant De gebruikers entiteit van de user. 
     * @return View 
     */
    public function show(User $tenant): View
    {
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Methode voor het verwijderen van een huurder in de applicatie. 
     * 
     * @param  Request $request De instantie dat alle data omtrent de request bijhoud. 
     * @param  User    $tenant  De gebruikers entiteit van de huurder. 
     * @return View|RedirectResponse
     */
    public function destroy(Request $request, User $tenant)
    {
        // 
    }
}
