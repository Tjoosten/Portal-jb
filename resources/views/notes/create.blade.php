@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>

        <div class="page-subtitle">
            Notitie toevoegen voor de verhuur van {{ $lease->tenant->name }}
        </div>

        <div class="page-options d-flex">
            <a href="{{ route('calendar.index') }}" class="btn tw-rounded btn-sgv-green">
                <i class="fe mr-1 fe-calendar"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="pb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header-lease card-header">
                @include ('calendar.components.show-navigation', ['lease' => $lease])
            </div>
            <form method="POST" action="{{ route('calendar.notes.store', $lease) }}" class="card-body">
                @csrf {{-- form field protection --}}

                <div class="form-row">
                    <div class="form-group col-7">
                        <label for="inputTitel">Titel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('titel', 'is-invalid')" placeholder="Titel van de notitie" @input('titel')>
                        @error('titel')
                    </div>

                    <div class="form-group col-12">
                        <label for="inputBeschrijving">Beschrijving <span class="text-danger">*</span></label>
                        <textarea id="inputBeschrijving" @input('beschrijving') rows="5" class="form-control @error('beschrijving', 'is-invalid')" placeholder="Extra informatie omtrent de notitie">{{ old('beschrijving') }}</textarea>
                        @error('beschrijving')
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group mb-0 col-6">
                        <button type="submit" class="btn btn-success">Opslaan</button>
                        <button type="reset" class="btn btn-light">Annuleren</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection