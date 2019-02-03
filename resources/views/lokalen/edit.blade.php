@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">{{ ucfirst($lokaal->name) }}</h1>

        <div class="page-subtitle">
            Wijzig gegevens
        </div>

        <div class="page-options d-flex">
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('lokalen.delete', $lokaal) }}" class="shadow-sm mr-1 btn btn-danger">
                    <i class="fe fe-trash-2 mr-1"></i> Verwijder
                </a>
            @endif

            <a href="{{ route('lokalen.index') }}" class="shadow-sm btn btn-sgv-green">
                <i class="fe fe-list mr-1"></i> Overzicht
            </a>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-3"> {{-- Sidenav --}}
            @include ('lokalen.components.sidenav', ['lokaal' => $lokaal])
        </div> {{-- /// END sidenav --}}

        <div class="col-md-9"> {{-- Content --}}
            <form method="POST" action="{{ route('lokalen.update', $lokaal) }}" class="card card-body shadow-sm mb-3 py-3">
                @csrf {{-- Form field protection --}}
                @form($lokaal) {{-- Bind lokaal data to the form --}}
                @method('PATCH') {{-- HTTP method spoofing --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">Lokaal gegevens wijzigen</h6>

                @include ('flash::message') {{-- Flash session view partial --}}

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="inputName">Naam <span class="text-danger"></span></label>
                        <input type="text" class="form-control @error('name', 'is-invalid')" id="inputName" placeholder="Naam van het lokaal" @input('name')>
                        @error('name')
                    </div>

                    <div class="form-group col-6">
                        <label for="verantwoordelijke">Verantwoordelijke <span class="text-danger">*</span></label>
                        
                        <select id="verantwoordelijke" @input('verantwoordelijke') class="custom-select @error('verantwoordelijke', 'is-invalid')">
                            @if (! old('verantwoordelijke') || ! $lokaal->verantwoordelijke)) {{-- Geen verantwoordelijke geselecteerd --}}
                                <option value="">Geen verantwoordelijke</option>
                            @endif

                            @foreach ($admins as $admin) {{-- loop through the admin --}}
                                <option value="{{ $admin->id }}" @if($admin->id === $lokaal->verantwoordelijke) selected @endif>
                                    {{ ucfirst($admin->name) }}
                                </option>
                            @endforeach
                        </select>

                        @error('verantwoordelijke')
                    </div>

                    <div class="form-group col-12">
                        <label for="capacity">Capaciteit van het lokaal <span class="text-danger">*</span></label>

                        <div class="form-row">
                            <div class="col-6">
                                <input  id="capacity" @input('capacity') class="form-control @error('capacity', 'is-invalid')" id="capacity" placeholder="Aantal personen">
                                @error('capacity')
                            </div>

                            <div class="col-6">
                                <select id="capacity" @input('capacity_type') class="custom-select @error('capacity_type', 'is-invalid')">
                                @options($capacityTypes, 'capacity_type')
                                </select>

                                @error('capacity_type')
                            </div>
                        </div>
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