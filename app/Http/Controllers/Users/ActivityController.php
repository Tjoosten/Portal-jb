<?php

namespace App\Http\Controllers\Users;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\View\View;

/**
 * Class ActivityController 
 * 
 * @package App\Http\Controllers\
 */
class ActivityController extends Controller
{
    /**
     *  Creer een nieuwe ActivityController 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initialiseer de globale constructor
        $this->middleware(['role:admin,webmaster']);
    }

    /**
     * Methode voor het weergeven van gelogde activiteiten voor de gegeven gebruikers entiteit. 
     * 
     * @param  User $user De gegeven gebruikers entiteit uit de databank.
     * @return View
     */
    public function show(User $user): View
    {
        $logs = Activity::causedBy($user)->latest()->simplePaginate(10);
        $title = "Gelogde activiteiten voor {$user->name}";

        return view('users.activity', compact('user', 'logs', 'title'));
    }
}
