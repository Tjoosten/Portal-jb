@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>
        <div class="page-subtitle">Verwijder een verhuring</div>

        <div class="page-options d-flex">
            <a href="{{ route('calendar.index') }}" class="btn tw-rounded btn-sgv-green">
                <i class="fe fe-list mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-3"> {{-- Sidebar --}}

        </div> {{-- /// END sidebar --}}

        <div class="col-md-9">
            <form action="{{ route('calendar.delete', $lease) }}" method="POST" class="card card-body mb-3 py-3">
                @csrf               {{-- Form field protection --}}
                @method ('DELETE')  {{-- HTTP method spoofing --}}

                <h6 class="border-bottom broder-gray pb-1 mb-3">Verhuring verwijderen</h6>

                <p class="card-text mb-0">
                    U staat op het punt om een verhuring te verwijderen in de applicatie. Indien u verder gaat met de verwijdering.
                    Vergeet dan niet de huurder op de hoogte te stellen dat de verhuring is afgewezen en daardoor niet meer doorgaat.
                </p>

                <hr class="mt-3 mb-3">

                <div class="form-row">
                    <div class="form-group mb-0 col-12">
                        <button type="submit" class="btn btn-danger"><i class="fe fe-trash-2 mr-1"></i> Verwijderen</button>
                        <a href="{{ route('calendar.index') }}" class="btn btn-light">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection