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
            <div class="card-header-lease card-header">
                @include ('calendar.components.show-navigation', ['lease' => $lease])
            </div>
            <div class="card-body">
                @include('flash::message') {{-- Flash session view partial --}}

                <div class="table-responsive">
                    <table class="table table-sm @if (count($notes) > 0) table-hover @endif mb-1">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">Datum</th>
                                <th class="border-top-0" scope="col">Auteur</th>
                                <th class="border-top-0" scope="col">Titel</th>
                                <th class="border-top-0" scope="col">&nbsp;</th> {{-- Kolom alleen voor de functies --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notes as $note) {{-- Loop trough the lease notes --}}
                                <tr>
                                    <td>{{ $note->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $note->auteur->name }}</td>
                                    <td>{{ $note->titel }}</td>

                                    <td> {{-- Options --}}
                                        <span class="float-right">
                                            <a href="" class="text-decoration-none text-secondary mr-3">
                                                <i class="fe fe-eye"></i>
                                            </a>

                                            <a href="" class="text-decoration-none @if (auth()->user()->cannot('update', $note)) disabled @endif text-secondary mr-1">
                                                <i class="fe fe-edit"></i>
                                            </a>

                                            <a href="" class="text-decoration-none @if (auth()->user()->cannot('delete', $note)) disabled @endif text-danger">
                                                <i class="fe fe-x-circle"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @empty {{-- There are no notes found for the lease --}}
                                <tr>
                                    <td colspan="6">
                                       <span class="text-secondary">Er zijn geen notities voor de verhuring aan {{ $lease->tenant->name }}</span>
                                    </td>
                                </tr>
                            @endforelse {{-- /// END notes loop --}}
                        </tbody>
                    </table>
                </div>

                {{ $notes->links() }} {{-- Pagination view instance --}}
            </div>
        </div>
    </div>
@endsection