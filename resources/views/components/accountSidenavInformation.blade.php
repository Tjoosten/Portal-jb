<div class="list-group shadow-sm">
    <a href="#" class="list-group-item list-group-item-action disabled">
        <i class="fe fe-list mr-2"></i> Menu
    </a>

    <a href="{{ route('admins.show', $user) }}" class="list-group-item list-group-item-action {{ active('admins.show') }}">
        <i class="fe fe-info mr-2"></i> Informatie overzicht
    </a>

    <a href="{{ route('activity.user', $user) }}" class="list-group-item list-group-item-action {{ active('activity.user') }}">
        <i class="fe fe-activity mr-2"></i> Activiteiten historiek
    </a>
</div>