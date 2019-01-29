@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Login beheer</h1>
        <div class="page-subtitle">Deblokkeren van een login</div>

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
        </div> {{-- /// Sidebar --}}

        <div class="col-md-9"> {{-- content --}}
            <form method="POST" action="" class="card card-body shadow-sm mb-3 py-3">
                @csrf               {{-- Form field protection --}}
                @method ('DELETE')  {{-- HTTP method spoofing --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">
                    Blokkering opheffen van een login
                </h6>

                @include ('flash::message') {{-- Flash session view partial --}}

                <p class="card-text text-info">
                    <i class="fe fe-alert-triangle mr-1"></i> U staat op het punt om de de blokkade van <strong>{{ $user->name }}</strong>
                    op te heffen. Hierdoor heeft hij/zij weer volledige toegang tot de applicatie en zijn functionaliteiten.
                </p>

                <hr>
            </form>
        </div> {{-- /// END content --}}
    </div>
@endsection