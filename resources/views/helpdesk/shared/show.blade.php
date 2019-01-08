@extends ('layouts.app')

@section('content')
<div class="page-header">
        <h1 class="page-title">Helpdesk ticket </h1>

        <div class="page-subtitle">Aangemaakt door {{ $ticket->creator->name }}</div>

            <div class="page-options d-flex">
            <div class="btn-toolbar" role="toolbar" aria-label="Ticket opties">
                <div class="btn-group mr-2" role="group" aria-label="Wijzig knop">
                    @if (Auth::user()->can('edit', $ticket))
                        <a href="" class="btn shadow-sm btn-ticket-option">
                            <i class="fe mr-1 fe-edit"></i> Wijzig
                        </a>
                    @elseif (Auth::user()->can('assign-ticket', $ticket))
                        <a href="{{ route('helpdesk.ticket.assign', $ticket) }}" class="btn shadow-sm btn-ticket-option">
                            <i class="fe fe-check"></i> Opvolgen
                        </a>
                    @endif

                    @if (Auth::user()->can('close-ticket', $ticket) && $ticket->is_open) 
                        <a href="{{ route('helpdesk.ticket.status', ['ticket' => $ticket, 'status' => 'sluiten']) }}" role="group" aria-label="Sluit knop" class="btn shadow-sm btn-ticket-option">
                            <i class="fe mr-1 fe-x-circle"></i> Sluiten
                        </a> 
                    @endif 

                    @if (! $ticket->is_open && Auth::user()->can('close-ticket', $ticket))
                        <a href="{{ route('helpdesk.ticket.status', ['ticket' => $ticket, 'status' => 'heropen']) }}" role="group" aria-label="Sluit knop" class="btn shadow-sm btn-ticket-option">
                            <i class="fe mr-1 fe-rotate-ccw"></i> Heropen
                        </a> 
                    @endif
                </div>

                <div class="btn-group" role="group" aria-label="Wijzig knop">
                    <a href="" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-list"></i> Mijn vragen
                    </a>
                    <a href="{{ route('helpdesk.index.huurder') }}" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-plus"></i> Nieuw ticket
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card card-body mb-2 py-3 shadow-sm">
                <h6 class="border-bottom border-gray pb-1 mb-2"> {{ ucfirst($ticket->titel) }}</h6>
                
                @if (! $ticket->is_open)
                    <small class="mb-2 text-danger">
                        {{ $ticket->closer->name }} heeft dit ticket gesloten op {{ $ticket->closed_at->format('d M, Y') }}
                    </small>
                @endif

                {!! $ticket->beschrijving !!}
            </div>

            @foreach ($comments as $comment)
                @if ($loop->first)
                    <hr class="mt-2 mb-2">
                @endif

                <helpdesk-comment :comment="$comment" :loop="$loop"></helpdesk-comment>
            @endforeach

            <hr class="mt-2 mb-2">

            <form action="{{ route('helpdesk.comment', $ticket) }}" method="POST">
                @csrf {{-- Form field protection --}}
                <div class="form-group">
                    <textarea rows="4" @input('comment') class="form-control @error('comment', 'is-invalid') shadow-sm" placeholder="Reageer op dit ticket">{{ old('comment') }}</textarea>
                    @error('comment')
                </div>

                <div class="form-group">
                    <button class="btn shadow-sm btn-success">
                        <i class="fe fe-message-square"></i> Reageer
                    </button>
                </div>
            </form>
        </div>

        <div class="col-4">
            <div class="card card-body mb-3 py-3 shadow-sm">
                <h6 class="border-bottom border-gray pb-1 mb-2"> 
                    <span class="float-right">Ticket informatie</span> 
                </h6>

                <table class="table mb-0 table-borderless table-sm">
                    <thead>
                        <tr>
                            <td class="float-left"><strong>Ticket ID</strong></td>
                            <td class="float-right"><code>#{{ $ticket->id }}</code></td>
                        </tr>
                        <tr>
                            <td class="float-left"><strong>Status</strong></td>
                            <td class="float-right">
                                @if ($ticket->is_open)
                                    <span class="text-success">Open</span>
                                @else {{-- The ticket is open --}}
                                    <span class="text-danger">Gesloten</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="float-left"><strong>Opvolging door:</strong></td>
                            <td class="float-right">
                                {!! $ticket->assignee->name !!}
                            </td>
                        </tr>
                        <tr>
                            <td class="float-left"><strong>Type</strong></td>
                            <td class="float-right">{{ $ticket->categorie }}</td>
                        </tr>
                        <tr>
                            <td class="float-left"><strong>Creatie datum</strong></td>
                            <td class="float-right">{{ $ticket->created_at->diffForHumans() }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection