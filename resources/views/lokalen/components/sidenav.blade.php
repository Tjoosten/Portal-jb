<div class="mb-3 list-group shadow-sm">
    <a href="#" class="list-group-item disabled">
        <i class="fe fe-list mr-2"></i> Menu
    </a>

    <a href="{{ route('lokalen.edit', $lokaal) }}" class="list-group-item list-group-item-action {{ active('lokalen.edit') }}">
        <i class="fe fe-edit-2 mr-2"></i> Wijzig gegevens
    </a>
</div>