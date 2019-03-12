@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>

        <div class="page-subtitle">
            Informatie overzicht
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
            <div class="card-header-lease">
                @include ('calendar.components.show-navigation', ['lease' => $lease])
            </div>
            <form method="POST" action="" class="card-body">
                @csrf {{-- Form field protection --}}
                @form($lease) {{-- Band data to the form --}}
                @include ('flash::message') {{-- Flash session view partial --}}


                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="start">Start datum <span class="text-danger">*</span></label>
                        <input @if ($cantEdit) readonly @endif type="date" value="{{ $lease->start_datum->format('Y-m-d') }}" name="start_datum" class="form-control @error('start_datum', 'is-invalid')" id="start">
                        @error('start_datum')
                    </div>

                    <div class="form-group col-6">
                        <label for="eind">Eind datum <span class="text-danger">*</span></label>
                        <input @if ($cantEdit) readonly @endif type="date" name="eind_datum" class="form-control @error('eind_datum', 'is-invalid')" value="{{ $lease->eind_datum->format('Y-m-d') }}" id="eind">
                        @error('eind_datum')
                    </div>

                    <div class="form-group col-6 mb-4">
                        <label for="personen">Aantal personen <span class="text-danger">*</span></label>
                        <input @if ($cantEdit) readonly @endif placeholder="Aantal personen aanwezig" type="text" @input('aantal_personen') class="form-control @error('aantal_personen', 'is-invalid')" id="personen">
                        @error('personen')
                    </div>

                    <div class="form-group col-6 mb-4">
                        <label for="status">Status verhuring <span class="text-danger">*</span></label>

                        <select @if ($cantEdit) disabled @endif @input('status'), class="custom-select @error('status', 'is-invalid')">
                        <option value="">-- Verhurings status --</option>
                        @options($statusses, 'status')
                        </select>

                        @error('status') {{-- Validation error view partial --}}
                    </div>
                </div>

                @if ($canViewTenant)
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        Huurder gegevens
                        <a href="{{ route('tenants.show', $lease->tenant)  }}" class="small text-secondary text-decoration-none float-right">
                            <i class="fe ml-1 fe-user"></i> Bekijk profiel
                        </a>
                    </h6>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="voornaam">Naam <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $lease->tenant->name }}" readonly placeholder="Huurder voornaam">
                        </div>

                        <div class="form-group col-6">
                            <label for="email">Email adres <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Huurder email adres" readonly value="{{ $lease->tenant->email }}">
                        </div>
                    </div>
                @endif

                @if (! $cantEdit)
                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group mb-0 col-6">
                            <button type="submit" class="btn btn-success">Aanpassen</button>
                            <button type="reset" class="btn btn-light">Annuleren</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection