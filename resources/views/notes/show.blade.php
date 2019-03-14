@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>

        <div class="page-subtitle">
            {{ $note->titel }}
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
                @include ('calendar.components.show-navigation', ['lease' => $note->verhuring])
            </div>

            <div class="card-body">
                <h6 class="border-bottom border-gray pb-1 mb-1">[notitie]: {{ $note->titel }}</h6>

                <small class="pb-3 text-secondary">Aangemaakt door {{ $note->auteur->name }} op {{ $note->created_at->format('d/m/Y') }} </small>
                <p class="mt-2 pb-0 card-text">{{ $note->beschrijving }}</p>

                <hr class="mt-0">

                <a href="{{ route('calendar.notes', $note->verhuring) }}" class="text-decoration-none card-link text-secondary">
                    <i class="fe fe-chevrons-left mr-1"></i> Notitie overzicht
                </a>

                <span class="float-right">
                    @if (auth()->user()->can('update', $note))
                        <a href="{{ route('calendar.notes.edit', $note)  }}" class="text-decoration-none card-link text-secondary">
                            <i class="fe fe-edit mr-1"></i> Wijzig notitie
                        </a>
                    @endif

                    @if (auth()->user()->can('delete', $note))
                         <a href="{{ route('calendar.notes.delete', $note) }}" class="text-decoration-none card-link text-danger">
                             <i class="fe fe-x-circle mr-1"></i> Verwijder notitie
                         </a>
                    @endif
                </span>
            </div>
        </div>
    </div>
@endsection