@extends ('layouts.app')

@section('content')
<div class="page-header">
        <h1 class="page-title">Helpdesk ticket </h1>

        <div class="page-subtitle">Aangemaakt door {{ $ticket->creator->name }}</div>

            <div class="page-options d-flex">
            <div class="btn-toolbar" role="toolbar" aria-label="Ticket opties">
                <div class="btn-group mr-2" role="group" aria-label="Wijzig knop">
                    <a href="" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-edit"></i> Wijzig
                    </a>
                    <a href="" role="group" aria-label="Sluit knop" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-x-circle"></i> Sluit ticket
                    </a>
                </div>

                <div class="btn-group" role="group" aria-label="Wijzig knop">
                    <a href="" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-list"></i> Mijn vragen
                    </a>
                    <a href="" class="btn shadow-sm btn-ticket-option">
                        <i class="fe mr-1 fe-plus"></i> Nieuw ticket
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="card card-body mb-3 py-3 shadow-sm">
                <h6 class="border-bottom border-gray pb-1 mb-3"> {{ ucfirst($ticket->titel) }}</h6>
            </div>
        </div>

        <div class="col-3">
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
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection