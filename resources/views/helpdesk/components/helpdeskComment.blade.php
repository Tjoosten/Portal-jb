<div class="card @if (! $loop->last) mb-3 @endif shadow-sm">
    <div class="card-header py-2">
        {{ $comment->commentator->name }}

        @if (Auth::user()->can('destroy', $comment))
            <a href="" class="float-right btn btn-xs btn-outline-danger ml-2">
                verwijder
            </a>
        @endif

        @if (Auth::user()->can('edit', $comment))
            <a href="" class="float-right btn btn-xs btn-outline-secondary">
                Wijzig
            </a>
        @endif
    </div>
    <div class="card-body py-2">
        <p class="card-text">{{ $comment->comment }}</p>
    </div>
</div>