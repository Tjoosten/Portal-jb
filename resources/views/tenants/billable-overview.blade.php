@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Huurders</h1>

        <div class="page-subtitle">
            {{ $user->name }}
        </div>

        <div class="page-options d-flex">
            <a href="" class="btn btn-sgv-green shadow-sm mr-2">
                <i class="fe fe-list mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-3"> {{-- Sidenav --}}
            @include ('tenants.components.sidenav', ['tenant' => $user])
        </div> {{-- /// END sidenav --}} 

        <div class="col-9"> {{-- Content --}}
            <form class="card card-body shadow-sm mb-3 py-3">
                @method('PATCH')    {{-- HTTP method spoofing --}}
                @form($billable)    {{-- Bind the billable data from the account to the view --}}

                @include ('flash::message') {{-- Flash session view partial --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">Facturatie gegevens</h6>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="inputFirstName">Voornaam <span class="text-danger">*</span></label>
                        <input type="text" id="inputFirstName" placeholder="Voornaam" class="form-control @error('voornaam', 'is-invalid')" @input('voornaam')>
                        @error('voornaam')
                    </div>

                    <div class="form-group col-6">
                        <label for="inputLastName">Achternaam <span class="text-danger">*</span></label>
                        <input type="text" id="inputLastName" placeholder="achternaam" class="form-control @error('achternaam', 'is-invalid')" @input('lastname')>
                        @error('achternaam')
                    </div>

                    <div class="form-group col-6">
                        <label for="inputEmail">E-mail adres <span class="text-danger">*</span></label>
                        <input type="email" id="inputEmail" placeholder="E-mail adres" class="form-control @error('email', 'is-invalid')" @input('email')>
                        @error('email') 
                    </div>

                    <div class="form-group col-6">
                        <label for="inputGroep">Groepsnaam</label>
                        <input type="text" id="inputGroep" placeholder="Groepsnaam" class="form-control @error('groepsnaam', 'is-invalid')" @input('groepsnaam') placeholder="Naam van zijn/haar groep">
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
                    </div>

                    <div class="form-group col-4">
                        <label for="inputCity">Stad <span class="text-danger">*</span></label>
                    </div>

                    <div class="form-group col-4">
                        <label for="inputLand">Land <span class="text-danger">*</span></label>
                        <input type="text" id="inputLand" class="form-control @error('land', 'is-invalid')" placeholder="Land" @input('land')>
                        @error('land')
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
        </div> {{-- /// END content --}} 
    </div>
@endsection