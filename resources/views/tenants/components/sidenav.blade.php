<div class="mb-3 list-group shadow-sm">
    <a href="#" class="list-group-item list-group-item-action disabled">
        <i class="fe fe-list mr-2"></i> Gegevens
    </a>

    <a href="{{ route('tenants.show', $tenant) }}" class="list-group-item list-group-item-action {{ active('tenants.show') }}">
        <i class="fe fe-info mr-2"></i> Algemene gegevens
    </a>

    <a href="{{ route('tenants.billing', $tenant) }}" class="list-group-item list-group-item-action {{ active('tenants.billing') }}">
        <i class="fe fe-info mr-2"></i> Facturatie gegevens
    </a>
</div>

<div class="mb-3 list-group shadow-sm">
    <a href="#" class="list-group-item list-group-item-action disabled">
        <i class="fe fe-list mr-2"></i> Account opties
    </a>

    @if (is_null($tenant->password)) {{-- Login functie voor de huurder is niet actief --}}
        <a href="" class="list-group-item list-group-item-action">
            <i class="fe fe-user-plus mr-2"></i> Activeer login
        </a>
    @else {{-- Gebruiker kan inloggen --}}
        @if ($tenant->isNotBanned()) {{-- Huurder login is actief --}}
            <a href="" class="list-group-item list-group-item-action">
                <i class="fe fe-lock mr-2"></i> Login blokkeren
            </a>
        @endif
    @endif

    <a href="" class="list-group-item list-group-item-action">
        <i class="fe fe-mail mr-2"></i> E-mail huurder
    </a>
</div>