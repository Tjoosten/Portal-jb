<?php

namespace App\Http\Controllers\Lokalen;

use Illuminate\Http\{RedirectResponse, Request};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Lokalen;
use App\User;
use App\Http\Requests\Lokalen\InformationValidator;

/**
 * Class IndexController 
 * 
 * @package App\Http\Controllers\Lokalen
 */
class IndexController extends Controller
{
    /**
     * Create new IndexController instance. 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initiate the global constructor
        $this->middleware(['auth', 'role:admin,leiding', 'forbid-banned-user']);
    }

    /**
     * Methode voor de index weergave van de lokalen. 
     * 
     * @param  Lokalen $lokalen Database model voor de lokalen tabel. 
     * @return View
     */
    public function index(Lokalen $lokalen): View
    {
        return view('lokalen.index', ['lokalen' => $lokalen->simplePaginate()]);
    }

    /**
     * Methode voor de creatie weergave van een lokaal. 
     * 
     * @return View 
     */
    public function create(): View 
    {
        $admins = User::role(['leiding', 'admin'])->orderBy('name', 'asc')->pluck('name', 'id');
        $capacityTypes  = ['Slaapplekken' => 'Slaapplekken', 'Personen' => 'Personen']; // Capacity types. 

        return view('lokalen.create', compact('admins', 'capacityTypes'));
    }

    /**
     * Methode voor het opslaan van een nieuw lokaal in de database. 
     * 
     * @param  InformationValidator $input De form request class dat de validatie op zich neemt. 
     * @return RedirectResponse
     */
    public function store(InformationValidator $input): RedirectResponse 
    {
        if ($nieuwLokaal = new Lokalen($input->all())) {
            if ($input->has('verantwoordelijke')) {
                $nieuwLokaal->responsible()->associate($input->verantwoordelijke)->save();
            }

            $this->flashMessage->success("Het lokaal met de naam <strong>{$nieuwLokaal->name}</strong> is toegevoegd in de applicatie.");
        }

        return redirect()->route('lokalen.index');
    }

    /**
     * Method vo)or de weergave van de pagina voor het wijzigen van gegevens. 
     * 
     * @todo Opbouwen van de weergave
     * 
     * @param  Lokalen $lokaal De databank entiteit van het lokaal. 
     * @return View
     */
    public function edit(Lokalen $lokaal): View 
    {
        $admins = User::role(['leiding', 'admin'])->select(['id', 'name'])->get();
        $capacityTypes  = ['Slaapplekken' => 'Slaapplekken', 'Personen' => 'Personen']; // Capacity types.

        return view('lokalen.edit', compact('lokaal', 'admins', 'capacityTypes'));
    }

    /**
     * Methode voor het aanpassen van een lokaal in de databank opslag.
     *
     * @param  InformationValidator $input   De form request instantie dat de validatie verzorgd.
     * @param  Lokalen              $lokaal  De databank entiteit van het gegeven lokaal.
     * @return RedirectResponse
     */
    public function update(InformationValidator $input, Lokalen $lokaal): RedirectResponse
    {
        if ($lokaal->update($input->except('verantwoordelijke'))) {
            if ($input->has('verantwoordelijke')) {
                $lokaal->responsible()->associate($input->verantwoordelijke)->save();
            }

            $this->flashMessage->success("De gegevens van het lokaal zijn aangepast.");
        }

        return redirect()->route('lokalen.edit', $lokaal);
    }

    /**
     * Methode voor het verwijderen van een lokaal in het systeem.
     *
     * @throws \Exception
     *
     * @param  Lokalen $lokaal De databank entity van het lokaal.
     * @return RedirectResponse
     */
    public function destroy(Lokalen $lokaal): RedirectResponse
    {
        if ($lokaal->delete()) {
            $flashText = "Het lokaal <strong>{$lokaal->name}</strong> + de werkpunten ervan zijn verwijderd.";
            $this->flashMessage->success($flashText)->important();
        }

        return redirect()->route('lokalen.index');
    }
}
