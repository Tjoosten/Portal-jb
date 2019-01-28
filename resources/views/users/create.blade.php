@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Administrators & leiding</h1>

        <div class="page-subtitle">Gebruiker toevoegen</div>

        </div>
    </div>

    <form action="{{ route('admins.store') }}" method="POST" class="card col-md-12 card-body shadow-sm py-3 mb-3">
        <h6 class="border-bottom border-gray pb-1 mb-3">Gebruiker toevoegen.</h6>
        @csrf {{-- Form filed protection --}}

        <div class="form-row">
            <div class="form-group col-6">
                <label for="inputName">Naam van de gebruiker <span class="text-danger">*</span></label>
                <input id="inputName" type="text" class="form-control @error('name', 'is-invalid')" placeholder="Naam van van de gebruiker" @input('name')>
                @error('name')
            </div>

            <div class="form-group col-6">
                <label for="inputEmail">Email adres van de gebruiker <span class="text-danger">*</span></label>
                <input id="inputEmail" type="email" class="form-control @error('email', 'is-invalid')" placeholder="Email adres van de gebruiker" @input('email')>
                @error('email')
            </div>

            <div class="form-group col-6">
                <label for="inputTel">Tel. nummer van de gebruiker</label>
                <input id="inputTel" type="text" class="form-control" placeholder="Telefoon nummer van de gebruiker" @input('telephone_number')>
                @error('telephone_number')
            </div>

            <div class="form-group col-6">
                <label for="inputRole">Gebruikers rol voor de gebruiker <span class="text-danger">*</span></label>

                <select class="custom-select @error('role', 'is-invalid')" @input('role')>
                    <option value="">-- Selecteer de gebruikersrol --</option>

                    @foreach ($roles as $role) {{-- LOOP door de gebruikers rollen --}}
                        <option value="{{ $role->name }}" @if ($role->name === old('role')) selected @endif>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach {{-- /// END loop --}}
                </select>

                @error('role') {{-- Validatie foutmelding view --}}
            </div>
        </div>

        <hr class="mt-0">

        <div class="form-row">
            <div class="form-group mb-0 col-6">
                <button type="submit" class="btn btn-success">Aanmaken</button>
                <button type="reset" class="btn btn-light">Reset</button>
            </div>
        </div>
    </form>
@endsection
