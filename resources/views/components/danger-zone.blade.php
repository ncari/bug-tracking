<div class="p-3 bg-light">
    <h2>Settings</h2>
    <form action="{{$formUrl}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm">Delete {{ $name }}</button>
    </form>
</div>