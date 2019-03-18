@extends('layouts.app')

@section('content')
    <div class="jumbotron mb-0">
        <div class="container-fluid text-center">
            <h2 class="display-4 pb-2">Privacy beleid</h2>
            <p class="lead">
                <span class="font-weight-bold">Laatst aangepast:</span> 17/03/2019
            </p>
        </div>
    </div>

    <div class="py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9"> {{-- Information section --}}
                    <div class="card border-0 shadow-sm card-body">
                        <p class="card-text lead">
                            {{ config('app.name') }} hecht waarde aan uw privacy.
                        </p>

                        <p class="card-text">In geval de gebruiker van de website om persoonlijke informatie gevraagd wordt.</p>

                        <p class="card-text">
                            De verantwoordelijkheid voor de verwerking ({{ config('app.name') }}) respecteert de Belgische wetgeving van 8 december 2012 
                            met betrekking tot de bescherming van het priveleven in de verwerking van de persoonlijke gegevens. De door u meegedeelde persoonsgegegevens. 
                            De door u meegedeelde persoonsgegegevens zullen gebruikt worden voor de volgende doeleinden. Ons verhuur beheer en de nodige facturatie errond.
                        </p>

                        <p class="card-text">
                        </p>
                    </div>
                </div> {{-- /// End information section --}}

                <div class="col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('disclaimer.terms') }}" class="{{ active('disclaimer.terms') }} list-group-item-action list-group-item">
                                Algemene voorwaarden
                            </a>

                            <a href="{{ route('disclaimer.privacy') }}" class="{{ active('disclaimer.privacy') }} list-group-item-action list-group-item">
                                Privacy beleid
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection