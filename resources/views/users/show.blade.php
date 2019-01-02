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
            <div class="card card-bosy shadow-sm py-3 mb-3">
            </div>
        </div> {{-- /// End content --}}
    </div>
@endsection