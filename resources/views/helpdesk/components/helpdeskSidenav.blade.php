<div class="card shadow-sm mb-3">
    <div class="card-header text-secondary">
        <i class="fe fe-list mr-2"></i> Opties
    </div>

    <div class="list-group list-group-flush">
        <a href="{{ route('helpdesk.index.huurder') }}" class="list-group-item list-group-item-action {{ active('helpdesk.index.huurder') }}">
            <i class="fe fe-plus mr-2"></i> Ik heb een vraag
        </a>

        <a href="{{ route('helpdesk.overview.user') }}"
           class="{{ active('helpdesk.overview.user') }} list-group-item d-flex justify-content-between align-items-center list-group-item-action"
        >
            <span class="float-left"><i class="fe fe-list mr-2"></i> Mijn vragen</span>
            <span class="badge badge-primary badge-pill">
                {{ Auth::user()->questions()->count() }}
            </span>
        </a>
    </div>
</div>