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
            <div class="card-header">
                @include ('calendar.components.show-navigation', ['lease' => $lease])
            </div>
            <form method="POST" action="" class="card-body">

            </form>
        </div>
    </div>
@endsection