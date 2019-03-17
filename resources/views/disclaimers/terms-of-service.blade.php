@extends('layouts.app')

@section('content')
    <div class="jumbotron mb-0">
        <div class="container-fluid text-center">
            <h2 class="display-4 pb-2">Algemene gebruikersvoorwaarden</h2>
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
                        <p class="card-text">
                            Deze website is eigendom van {{ config('app.name') }}. Door de toegang en gebruik van deze website 
                            verklaart u zich uitdrukkelijk akkoord met de volgende algemene voorwaarden.
                        </p>

                        <h4 class="text-sgv-brown">Intellectuele eigendomsrechten</h4>

                        <p class="card-text">
                            De inhoud van deze website met inbegrip van de merken, logo's, tekeneningen, data, product of bedrijfsnamen, teksten, 
                            beelden e.d zijn beschermd door intellectuele rechten en behoren toe aan {{ config('app.name') }} of rechthoudende derden.
                        </p>
                    </div>
                </div> {{-- /// End information section --}}
            </div>
        </div>
    </div>
@endsection