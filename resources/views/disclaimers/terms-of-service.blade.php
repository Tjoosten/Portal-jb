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

                        <h4 class="text-sgv-brown">Beperking van aansprakelijkheid</h4>

                        <p class="card-text">
                            De informatie op de website is van algemene aard. Deze informatie is niet
                            aangepast aan persoonlijke of specifieke omstandigheden. En kan dus niet als
                            een persoonlijk, professioneel of juridisch advies van de gebruiker worden beschouwd.
                        </p>

                        <p class="card-text">
                            {{ config('app.name') }} levert grote inspanningen opdat de ter beschikking gestelde informatie volledig, juist, nauwkeurig en bijgewerkt zou zijn.
                            Ondanks deze inspanningen kunnen onjuistheden zich voordoen in de ter beschikking gestelde informatie. Indien de verstrekte informatie onjuistheden zou
                            bevatten of indien bepaalde informatie op of via de site informatie op of via de site onbeschikbaar zou zijn, zal
                            {{ config('app.name') }} de grootst mogelijke inspanning leveren om dit zo snel mogelijk recht te zetten.
                            {{ config('app.name') }} kan evenwel niet aansprakelijk worden gesteld voor rechtstreekse of onrechtstreekse schade die ontstaat uit het gebruik van de
                            informatie op deze site. Indien u onjuistheden zou vaststellen in de informatie die via de site ter beschikking wordt gesteld,
                            kan u de beheerder van de site contacteren.
                        </p>

                        <p class="card-text">
                            De inhoud van de site (links inbegrepen) kan ten alle tijde zonder aankondiging of kennisgeving aangepast, gewijzigd of aangevuld worden.
                            {{ config('app.name') }} geeft geen garanties voor de goede werking van de website en kan op geen enkele wijze aansprakelijk gehouden worden voor een
                            slechte werking of tijdelijke (on) beschikbaarheid van de website of voor enige vorm van schade, rechtstreekse of onrechtstreekse, die zou voortvloeien uit
                            de toegang tot of het gebruik van de website.
                        </p>

                        <p class="card-text">
                            {{ config('app.name') }}kan in geen geval tegenover wie dan ook, op directe of indirecte, bijzondere of andere wijze aansprakelijk worden gesteld voor schade te wijten aan
                            het gebruik van deze websute of van een andere, inzonderheid als gevolg van links of hyperlinks, met inbegrip, zonder beperking, van alle verliezen,
                            werkonderbrekingen, beschadiging van programma's of andere gegevens op het computersysteem, van apparatuur, programmatuur of andere van de gebdruiker.
                        </p>

                        <p class="card-text">
                            De website kan hyperlinks bevatten naar websites of pagina's van derden, of daar rechtstreeks naar verwijzen. Het plaatsen van links naar deze websites of
                            pagina's impliceert op geen enkele wije een impliciete goedkeuring van de inhoud ervan. {{ config('app.name') }} verklaart uitdrukkelijk dat zij geen zeggenschap
                            heeft over de inhoud of andere kenmerken van deze websites of pagina's en kan in geen geval aansprakelijk gehouden worden voor de inhoud of de kenmerken ervan
                            of voor enige andere vorm van schade door het gebruik ervan.
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