<div class="table-responsive">
    <table class="table table-sm @if(count($leases) > 0) table-hover @endif mb-1">
        <thead>
            <tr>
                <th scope="col" class="border-top-0">#</th>
                <th scope="col" class="border-top-0">Periode</th>
                <th scope="col" class="border-top-0">Status</th>
                <th scope="col" class="border-top-0">Groep/Persoon</th>
                <th scope="col" class="border-top-0">Aantal personen</th>
                <th scope="col" class="border-top-0">&nbsp;</th> {{-- Col specified for the functions --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($leases as $lease) {{-- Loop trough the leases --}}
                <tr>
                    <td><strong>#{{ $lease->id }}</strong></td>
                    <td>{{ $lease->periode }}</td>
                    <td> {{-- Status indicatie --}}
                        @switch ($lease->status)
                            @case('bevestigd')  <span class="badge badge-success">Bevestigd</span>          @break
                            @case('optie')      <span class="badge badge-secondary">Optie</span>            @break
                            @default            <span class="badge badge-warning">Nieuwe aanvraag</span>
                        @endswitch
                    </td> {{-- /// End status indicatie --}}
                    <td>{{ $lease->tenant->name }}</td>
                    <td>{{ $lease->aantal_personen }} personen</td>

                    <td> {{-- Option columns --}}
                        <span class="float-right">
                            <a href="{{ route('calendar.show', $lease) }}" class="text-decoration-none text-secondary  mr-2">
                                <i class="fe fe-eye"></i>
                            </a>

                            <a href="" class="text-decoration-none text-success mr-1">
                                <i class="fe fe-check"></i>
                            </a>

                            <a href="" class="text-decoration-none text-danger mr-2">
                                <i class="fe fe-x-circle"></i>
                            </a>

                            <a href="{{ route('calendar.delete', $lease) }}" class="text-decoration-none text-danger">
                                <i class="fe fe-trash-2 mr-1"></i>
                            </a>
                        </span>
                    </td> {{-- /// Option column --}}
                </tr>
            @empty {{-- There are no leases found in the application --}}
            @endforelse {{-- /// END lease loop --}}
        </tbody>
    </table>
</div>

{{ $leases->links() }} {{-- Pagination view instance --}}