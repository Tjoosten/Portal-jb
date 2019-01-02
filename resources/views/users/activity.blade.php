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
            <div class="card card-body shadow-sm py-3 mb-3">
                <h6 class="border-bottom border-gray pb-1 mb-3">{{ $title }}</h6>

                @if ($logs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-top-0">Bericht</th>
                                    <th scope="col" class="border-top-0">Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log) {{-- Loop door de geregistereerde gebruikers handelingen --}}
                                    <tr>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach {{-- Sluit de loop af voor de logs --}}
                            </tbody>
                        </table>
                    </div>
                @else {{-- User has no logs --}}
                    <div class="alert alert-icon alert-info" role="alert">
                        <i class="fe fe-info mr-2" aria-hidden="true"></i>
                        {{ $user->name }} heeft nog geen acties ondernomen in de applicatie.
                    </div>
                @endif

                {{ $logs->render() }} {{-- Pagination view instance --}}
            </div>
        </div> {{-- /// End content --}}
    </div>
@endsection