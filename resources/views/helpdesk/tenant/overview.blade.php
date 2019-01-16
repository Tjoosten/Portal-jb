@extends ('layouts.app') 

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Helpdesk</h1>
        
        <div class="page-subtitle">Mijn open vragen</div>

        <div class="page-options d-flex">
            <a href="{{ route('helpdesk.index.huurder') }}" class="btn btn-sgv-green mr-2">
                <i class="fe fe-plus-circle"></i>
            </a>

            <div class="btn-group">
                <button type="button" class="btn tw-rounded btn-sgv-green dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fe mr-1 fe-filter"></i> Filter
                </button>
                            
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('helpdesk.overview.user') }}">Alle tickets</a>
                    <a class="dropdown-item" href="{{ route('helpdesk.overview.user', ['filter' => 'open']) }}">Open tickets</a>
                    <a class="dropdown-item" href="{{ route('helpdesk.overview.user', ['filter' => 'gesloten']) }}">Gesloten tickets</a>
                </div>
            </div>

            <form method="GET" action="" class="w-100 ml-2">
                <input type="text" class="form-control" placeholder="Zoek ticket">
            </form>
        </div>

        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <helpdesk-sidenav></helpdesk-sidenav>
        </div>

        <div class="col-9">
            <div class="card card-body mb-3 py-2 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-sm @if (count($tickets) > 0) table-hover @endif mt-0">
                        <thead>
                            <tr>
                                <th class="border-top-0" scope="col">#</th>
                                <th class="border-top-0" scope="col">Status</th>
                                <th class="border-top-0" scope="col">Titel</th>
                                <th class="border-top-0" scope="col">&nbsp;</th> {{-- Col for the functions only --}} 
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td class="font-weight-bold"><code>#{{ $ticket->id }}</code></td>
                                    <td>
                                        @if ($ticket->is_open)
                                            <span class="badge badge-success">
                                                <i class="mr-1 fe fe-circle"></i> Open
                                            </span>
                                        @else 
                                            <span class="badge badge-danger">
                                                <i class="mr-1 fe fe-check-circle"></i> Gesloten
                                            </span>
                                        @endif
                                    </td>
                                    <td></i>{{ ucfirst($ticket->titel) }}</td>

                                    <td> {{-- Options --}}
                                        <span class="float-right">
                                            <a href="{{ route('helpdesk.ticket.show', $ticket) }}" class="mr-2 no-underline text-secondary">
                                                <small><i class="mr-1 fe fe-eye"></i>Bekijk</small>
                                            </a>
                                            <a href="{{ route('helpdesk.ticket.status', ['ticket' => $ticket, 'status' => 'sluiten']) }}" class="no-underline text-danger">
                                                <small><i class="mr-1 fe fe-check-circle"></i> Sluit ticket</small>
                                            </a>
                                        </span>
                                    </td> {{-- /// Options --}}
                                </tr>
                            @empty {{-- User has no open tickets --}}
                            @endforelse 
                        </tbody>
                    </table> 
                </div>

                {{ $tickets->links() }} {{-- Pagination view instance --}}
            </div>
        </div>
    </div>
@endsection