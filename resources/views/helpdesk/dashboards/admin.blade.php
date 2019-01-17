@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Helpdesk</h1>
        <div class="page-subtitle">Alle vragen en of opmerking omtrent het domein of verhuur</div>

        <div class="page-options d-flex">
            <a href="{{-- route('helpdesk.create.admin') --}}" class="btn tw-rounded btn-sgv-green mr-2">
                <i class="fe fe-plus-circle"></i>
            </a>

            <div class="btn-group">
                <button type="button" class="btn btn-sgv-green dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fe mr-1 fe-filter"></i> Filter
                </button>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">Alle tickets</a>
                    <a class="dropdown-item" href="">Open tickets</a>
                    <a class="dropdown-item" href="">Gesloten tickets</a>
                </div>
            </div>

            <form method="GET" action="{{ route('admins.search') }}" class="w-100 ml-2">
                <input type="text" class="form-control" @input('term') placeholder="Zoek ticket">
            </form>
        </div>
    </div>
    </div>

    <div class="card card-body shadow-sm mb-3 py-3">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="table-responsive">
            <table class="table table-sm @if (count($tickets) > 0) table-hover @endif mb-1">
                <thead>
                    <th scope="col" class="border-top-0">#</th>
                    <th scope="col" class="border-top-0">Status</th>
                    <th scope="col" class="border-top-0">Geopend door</th>
                    <th scope="col" class="border-top-0">Title</th>
                    <th scope="col" class="border-top-0"></th> {{-- Col voor de functies alleen --}}
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket) {{-- Loop door de support tickets --}}
                        <tr>
                            <td><strong>#{{ $ticket->id }}</strong></td>
                            <td> {{-- Status indicator --}}
                                @if ($ticket->is_open) {{-- Ticket is indicated as open --}}
                                    <span class="badge badge-success">Open</span>
                                @else {{-- Ticket is indicated as closed --}}
                                    <span class="badge badge-danger">Gesloten</span>
                                @endif
                            </td> {{-- Status indicator --}}
                            <td>{{ $ticket->creator->name }}</td>
                            <td>{{ $ticket->titel }}</td>

                            <td> {{-- Options  --}}
                                <span class="float-right">
                                    <a href="{{ route('helpdesk.ticket.show', $ticket) }}" class="text-secondary no-underline mr-1">
                                        <i class="fe fe-eye"></i>
                                    </a>
                                    <a href="" class="text-danger mr-1 no-underline"> {{-- ticket sluiten  --}}
                                        <i class="fe fe-x-circle"></i>
                                    </a>
                                </span>
                            </td> {{-- /// Options --}}
                        </tr>
                    @empty {{-- Er zijn geen helpdesk tickets gevonden --}}

                    @endforelse {{-- END ticket loop --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection