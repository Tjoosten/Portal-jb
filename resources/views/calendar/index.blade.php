@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>
        <div class="page-subtitle">Overzicht</div>

        <div class="page-options d-flex">
            <a href="{{ route('calendar.create') }}" class="btn tw-rounded btn-sgv-green mr-2">
                <i class="fe fe-plus"></i>
            </a>

            <form method="GET" action="" class="w-100">
                <input type="text" class="form-control" @input('term') placeholder="Zoek verhuring">
            </form>
        </div>
    </div>
    </div>

    <div class="card card-body shadow-sm mb-3 py-3">
        <table class="table table-sm @if(count($leases) > 0) table-hover @endif mb-1">
            <thead>
                <tr>
                    <th scope="col" class="border-top-0">#</th>
                    <th scope="col" class="border-top-0">Periode</th>
                    <th scope="col" class="border-top-0">Status</th>
                    <th scope="col" class="border-top-0">Groep/Persoon</th>
                    <th scope="col" class="border-top-0">&nbsp;</th> {{-- Col specified for the functions --}}
                </tr>
            </thead>
        </table>
    </div>
@endsection