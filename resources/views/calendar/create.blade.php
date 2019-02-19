@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalendar</h1>
        <div class="page-subtitle">Verhuring toevoegen</div>

        <div class="page-options d-flex">
            <a href="" class="btn tw-rounded btn-sgv-green">
                <i class="fe fe-list mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <form action="" method="POST" class="card card-body shadow-sm mb-3 py-3">
        @csrf {{-- Form field protection --}}

        <h6 class="border-bottom border-gray pb-1 mb-3">Verhuring gegevens</h6>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="start">Start datum <span class="text-danger">*</span></label>
                <input type="date" @input('start_datum') class="form-control @error('start_datum', 'is-invalid')" id="start">
                @error('start_datum')
            </div>

            <div class="form-group col-6">
                <label for="eind">Eind datum <span class="text-danger">*</span></label>
                <input type="date" @input('eind_datum') class="form-control @error('eind_datum', 'is-invalid')" id="eind">
                @error('eind_datum')
            </div>

            <div class="form-group col-6 mb-4">
                <label for="personen">Aantal personen <span class="text-danger">*</span></label>
                <input placeholder="Aantal personen aanwezig" type="text" @input('aantal_personen') class="form-control @error('aantal_personen', 'is-invalid')" id="personen">
                @error('personen')
            </div>

            <div class="form-group col-6 mb-4">
                <label for="status">Status verhuring <span class="text-danger">*</span></label>

                <select @input('status'), class="custom-select @error('status', 'is-invalid')">
                    <option value="">-- Verhurings status --</option>
                    @options($statusses, 'status')
                </select>

                @error('status') {{-- Validation error view partial --}}
            </div>
        </div>

        <h6 class="border-bottom border-gray pb-1 mb-3">Huurder gegevens</h6>

        <div class="form-row">
            <div class="form-group col-4">
                <label for="voornaam">Voornaam <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('voornaam', 'is-invalid')" @input('voornaam') placeholder="Huurder voornaam">
                @error('voornaam')
            </div>

            <div class="form-group col-4">
                <label for="achternaam">Achternaam <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('achternaam', 'is-invalid')" @input('achternaam') placeholder="Huurder achternaam">
                @error('achternaam')
            </div>

            <div class="form-group col-4">
                <label for="email">Email adres <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email', 'is-invalid')" placeholder="Huurder email adres" @input('email')>
                @error('email')
            </div>
        </div>

        <hr class="mt-0">

        <div class="form-row">
            <div class="form-group mb-0 col-6">
                <button type="submit" class="btn btn-success">Invoegen</button>
                <button type="reset" class="btn btn-light">Annuleren</button>
            </div>
        </div>
    </form>
@endsection