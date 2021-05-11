<div>
    @if($n == 0)
        <div class="alert alert-primary" role="alert">
            There are no {{ $name }}.
        </div>
    @else
        {{ $slot }}
    @endif
</div>