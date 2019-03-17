@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuring</h1>

        <div class="page-subtitle">
            Facturatie data
        </div>

        <div class="page-options d-flex">
            <a href="{{ route('calendar.show', $lease) }}" class="btn btn-sgv-green">
                <i class="fe fe-calendar mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="pb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header-lease card-header">
                @include('calendar.components.show-navigation', ['lease' => $lease])
            </div>

            <form action="{{ route('lease.billing.update', $lease) }}" method="POST" class="card-body">
                @csrf {{-- Form field protection --}}
                @method('PATCH') {{-- HTTP method spoofing --}}
                @form($lease->tenant->billingInformation) {{-- Bind data to the form --}}

                <div class="alert alert-danger border-0" role="alert">
                    <span class="badge badge-danger shadow-sm mr-2"><i class="fe fe-alert-triangle mr-1"></i>Opgepast</span>
                    Deze gegevens zijn gekoppeld aan de huurder. Indien deze gegevens worden aangepast zal dat als ook
                    effect hebben op de huurder.
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="inputVoornaam">Voornaam <span class="text-danger">*</span></label>
                        <input id="inputVoornaam" type="text" class="form-control @error('voornaam', 'is-invalid')" placeholder="Voornaam" @input('voornaam')>
                        @error('voornaam')
                    </div>

                    <div class="form-group col-6">
                        <label for="inputAchternaam">Achternaam <span class="text-danger">*</span></label>
                        <input id="inputAchternaam" type="text" class="form-control @error('achternaam', 'is-invalid')" placeholder="Achternaam" @input('achternaam')>
                        @error('achternaam')
                    </div>
                
                    <div class="form-group col-6">
                        <label for="inputEmail">Email adres <span class="text-danger">*</span></label>
                        <input id="inputEmail" type="email" class="form-control @error('email', 'is-invalid')" placeholder="Email adres" @input('email')>
                        @error('email')
                    </div>

                    <div class="form-group col-6">
                        <label for="inputEntiteit">Groep/Persoon <span class="text-danger">*</span></label>
                        <input type="text" id="inputEntiteit" class="form-control @error('groepsnaam', 'is-invalid')" placeholder="Groep/Persoon" @input('groepsnaam')>
                        @error('groepsnaam')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group col-12">
                        <label id="inputAdres">Adres + Huis nr. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('adres', 'is-invalid')" id="inputAdres" placeholder="Adres + huis nr." @input('adres')>
                        @error('adres')
                    </div>

                    <div class="form-group col-4">
                        <label for="inputPostcode">Postcode <span class="text-danger">*</span></label>
                        <input type="text" id="inputPostcode" class="form-control @error('postcode', 'is-invalid')" placeholder="Postcode" @input('postcode')>
                        @error('postcode')
                    </div>

                    <div class="form-group col-4">
                        <label for="inputCity">Stad <span class="text-danger">*</span></label>
                        <input type="text" id="inputCity" class="form-control @error('stad', 'is-invalid')" @input('stad') placeholder="Stad">
                        @error('stad')
                    </div>

                    <div class="form-group col-4">
                        <label for="inputLand">Land <span class="text-danger">*</span></label>
                        <input type="text" id="inputLand" class="form-control @error('land', 'is-invalid')" placeholder="Land" @input('land')>
                        @error('land')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="inputExtraInfo">Extra informatie specifiek voor de verhuur</label>
                        <textarea class="form-control @error('extra_informatie', 'is-invalid')" @input('extra_informatie') rows="3">{{ $lease->billing->extra_informatie ?? old('extra_informatie') }}</textarea>
                        @error('extra_informatie')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group mb-0 col-6">
                        <button type="submit" class="btn btn-success">Aanpassen</button>
                        <button type="reset" class="btn btn-light">Annuleren</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection