@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Administrators & leiding</h1>

        <div class="page-subtitle">
            Informatie omtrent {{ $user->name }}
        </div>

            <div class="page-options d-flex">
                <a href="{{ route('admins.index') }}" class="btn tw-rounded btn-sgv-green">
                    <i class="fe fe-users"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3"> {{-- Sidenav --}}
            <account-sidenav-information :user="$user"></account-sidenav-information>
        </div> {{-- /// END sidenav --}}

        <div class="col-9"> {{-- Content --}}
            <form method="POST" action="{{ route('admins.update', $user) }}" class="card card-body shadow-sm py-3 mb-3">
                <h6 class="border-bottom border-gray pb-1 mb-3">Account informatie</h6>
                @include('flash::message') {{-- Flash session view partial --}}

                @csrf               {{-- Form field protection --}}
                @method('PATCH')    {{-- HTTP method spoofind --}}
                @form($user)        {{-- Bind the user data to the form --}}

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="inputNaam">Naam <span class="text-danger">*</span></label>
                        <input type="text" id="inputNaam" class="form-control @error('name', 'is-invalid')" @input('name') placeholder="Voornaam + Achternaam">
                        @error('name')
                    </div>

                    <div class="form-group col-6">
                        <label for="inputTelNr">Tel. nummer</label>
                        <input type="text" id="inputTelNr" @input('telephone_number') class="form-control @error('telephone_number', 'is-invalid')" placeholder="GSM of vast lijn">
                        @error('telephone_number')
                    </div>

                    <div class="form-group col-12">
                        <label for="inputEmail">Email adres <span class="text-danger">*</span></label>
                        <input type="email" id="inputEmail" @input('email') class="form-control @error('email', 'is-invalid')" placeholder="Email adres">
                        @error('email')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group mb-0 col-6">
                        <button type="submit" class="btn btn-success">Wijzigen</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </div>
                </div>
            </form>
        </div> {{-- /// End content --}}
    </div>
@endsection