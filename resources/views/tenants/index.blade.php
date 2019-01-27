@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Huurders</h1>

        <div class="page-subtitle">
            @switch (request()->get('filter'))
                @case ('risico')
                @default {{-- Request heeft geen filter parameter --}}
                    Alle geregistreerde huurders
            @endswitch
        </div>

         <div class="page-options d-flex">
            <a href="" class="btn btn-sgv-green shadow-sm mr-2">
                <i class="fe fe-user-plus"></i>
            </a>

            <form method="GET" action="" class="w-100">
                <input type="text" class="form-control" @input('term') placeholder="Zoek huurder">
            </form>
        </div>
    </div>
    </div>

    <div class="card card-body shadow-sm mb-3 py-3">
        @include ('flash::message') {{-- Flash session view partial --}}

        <div class="table-responsive">
            <table class="table table-sm @if (count($tenants) > 0) table-hover @endif mb-1">
                <thead>
                    <tr>
                        <th scope="col" class="border-top-0">#</th>
                        <th scope="col" class="border-top-0">Naam</th>
                        <th scope="col" class="border-top-0">Login status</th>
                        <td scope="col" class="border-top-0">Email</th>
                        <th scope="col" class="border-top-0">Tel. nr</th>
                        <th scope="col" class="border-top-0">&nbsp;</th> {{-- Column for the functions --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant) {{-- Loop through the tenants --}}
                        <tr>
                            <td><strong>#{{ $tenant->id }}</strong></td>
                            <td>{{ $tenant->name }}</td>

                            <td> {{-- Status indicator --}}
                                @if (is_null($tenant->password)) {{-- Login for tenant is not activated --}}
                                    <span class="badge badge-danger">Niet geregistreerd</span>
                                @else {{-- tenant login is activated --}}
                                    @if ($tenant->isBanned()) {{-- Login for tenant is disabled by an admin --}}
                                        <span class="badge badge-warning">Non actief</span> 
                                    @else {{-- Tenant login is activated --}}
                                        <span class="badge badge-success">Actief</span>
                                    @endif
                                @endif
                            </td> {{-- /// END status indicator --}}
                        
                            <td><a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></td>
                            <td>{{ $tenant->telephone_number }}</td>

                            <td> {{-- Options --}}
                                <span class="float-right">
                                    <a href="{{ route('tenants.show', $tenant) }}" class="text-secondary no-underline mr-1">
                                        <i class="fe fe-eye"></i>
                                    </a>
                                    
                                    @if ($tenant->isBanned()) {{-- Huurder login is non-actief --}}
                                        <a href="{{ route('tenants.status', $tenant) }}" class="text-success no-underline mr-1">
                                            <i class="fe fe-unlock">
                                        </a>
                                    @else {{-- Huurder login is actief --}}
                                        <a href="{{ route('logins.lock', $tenant) }}" class="text-danger no-underline mr-1">
                                            <i class="fe fe-lock"></i>
                                        </a>
                                    @endif

                                    <a href="{{ route('tenants.destroy', $tenant) }}" class="text-danger no-underline mr-1">
                                        <i class="fe fe-x-circle"></i>
                                    </a>
                                </span> 
                            </td> {{-- /// END options --}}
                        </tr>
                    @endforeach {{-- /// END loop --}}
                </tbody>
            </table>
        <div>
    </div>
@endsection