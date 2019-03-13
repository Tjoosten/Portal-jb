<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
