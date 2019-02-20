@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Huurders</h1>

        <div class="page-subtitle">
            {{ $tenant->name }}
        </div>

        <div class="page-options d-flex">
            @if (is_null($tenant->password)) {{-- Gebruiker heeft geen login in de applicatie --}}
                <a href="" class="btn btn-white shadow-sm mr-1">
                    <i class="fe mr-1 fe-user-plus"></i> Login aanmaken
                </a>
            @else
                <a href="" class="btn btn-danger shadow-sm mr-1">
                    <i class="fe mr-1 fe-x-circle"></i> Verwijder login
                </a>
            @endif

            <a href="" class="btn btn-sgv-green shadow-sm mr-2">
                <i class="fe fe-list mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-3"> {{-- Sidenav --}}
            @include ('tenants.components.sidenav', ['tenant' => $tenant])
        </div> {{-- /// END sidenav --}} 

        <div class="col-9"> {{-- Content --}}
            <form class="card card-body shadow-sm mb-3 py-3">
                @form ($tenant) {{-- Bind tenant information to the form --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">Account gegevens</h6>

                <div class="form-row"> {{-- Tenant data --}}
                    <div class="form-group col-6">
                        <label for="inputName">Naam</label>
                        <input class="form-control" id="inputName" type="text" value="{{ $tenant->name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputEmail">E-mail adres</label>
                        <input class="form-control" id="inputEmail" type="text" value="{{ $tenant->email }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="inputTelNumber">Telefoon nummer</label>
                        <input class="form-control" id="inputTelNumber" type="text" value="{{ $tenant->telephone_number }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="statusLogin">Login status</label>

                        @if (is_null($tenant->password))
                            <input type="text" readonly class="form-control" readonly id="staticEmail" value="Huurder heeft geen login op het platform">
                        @else 
                            <input type="text" readonly class="form-control" readonly id="staticEmail" value="Huurder heeft een login op het platform">
                        @endif
                    </div>
                </div> {{-- /// End tenant data --}}
            </form>
        </div> {{-- /// END content --}}
    </div>
@endsection