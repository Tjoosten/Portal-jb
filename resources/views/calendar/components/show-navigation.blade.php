<ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
        <a class="nav-link {{ active('calendar.show') }}" href="{{ route('calendar.show', $lease) }}">Verhuring gegevens</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link {{ active('calendar.notes*') }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Notities <span class="fe fe-chevron-down ml-1"></span>
        </a>
        <div class="dropdown-menu border-top-0">
            <a class="dropdown-item" href="{{ route('calendar.notes', $lease) }}">Overzicht</a>
            <a class="dropdown-item" href="{{ route('calendar.notes.create', $lease) }}">Nieuwe notitie</a>
        </div>
    </li>

    @if (auth()->user()->hasRole('admin'))
        <li class="nav-item">
            <a class="nav-link {{ active('lease.billing') }}" href="{{ route('lease.billing', $lease) }}}">
                Facturatie gegevens
            </a>
        </li>
    @endif

    @if (auth()->user()->hasAnyRole(['admin', 'webmaster']))
        <li class="nav-item">
            <a class="nav-link" href="">
                Audit
            </a>
        </li>
    @endif
</ul>