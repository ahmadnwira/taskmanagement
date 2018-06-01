<form class="form-inline" action="{{route('boards.share', $board->id)}}" method="POST">
    @csrf
    <div class="input-group">
        <label for="username" class="text-light">username</label>
        <input type="text" id="username" name="username" placeholder="share with..">
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Share</button>
</form>