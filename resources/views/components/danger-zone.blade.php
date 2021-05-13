<div class="p-3 bg-light mt-5">
    <h2>Settings</h2>
    {{ $slot }}
    <form action="{{$formUrl}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">Delete {{ $name }}</button>
    </form>
</div>