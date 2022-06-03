@error($name)
    <span>
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@else
    <span>
        <small></small>
    </span>
@enderror