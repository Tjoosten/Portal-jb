@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Login beheer</h1>
        <div class="page-subtitle">Blokkering van een login</div>

        <div class="page-options d-flex">
            <a href="{{ url()->previous() }}" class="btn btn-sgv-green shadow-sm mr-2">
                <i class="fe fe-rotate-ccw mr-1"></i> Annuleer
            </a>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-3"> {{-- Sidebar --}}
            @include ('tenants.components.sidenav', ['tenant' => $user])
        </div> {{-- /// END sidebar --}}

        <div class="col-md-9"> {{-- Page content --}}
            <form method="POST" action="{{ route('logins.lock.store', $user) }}" class="card card-body shadow-sm mb-3 py-3">
                <h6 class="border-bottom border-gray pb-1 mb-3">
                    De activatie van een gebruikers account
                </h6>

                @csrf {{-- Form field protection --}}
                @include ('flash::message') {{-- Flash session view partial --}}

                <p class="card-text text-danger">
                    <i class="fe fe-alert-triangle mr-1"></i> Bij het blokkeren van <strong>{{ $user->name }}</strong>
                    zal hij/zij niet meer kunnen inloggen in de applicatie van {{ config('app.name') }}.
                </p>

                <p class="card-text">
                    Vandaar dat wij jouw wachtwoord vragen als bevestiging voor de operatie. Pas als u een correct wachtwoord
                    ingeeft zal de blokkering van kracht zijn.
                </p>

                <hr>

                <h5 class="card-title mb-3 mt-2">Bevestigings formulier</h5>

                <div class="form-row">
                    <div class="form-group col-md-4" style="margin-bottom: 0.5rem;">
                        <input type="password" name="confirmation" value="" id="inputEmail4" placeholder="Uw wachtwoord ter controle" class="form-control @error('confirmation', 'is-invalid')">
                        @error('confirmation')
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="rounded btn btn-danger"><i class="fe fe-lock mr-1"></i> Bevestig</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light rounded">Annuleer</a>
                    </div>
                </div>
            </form>
        </div> {{-- /// END page content --}}
    </div>
@endsection