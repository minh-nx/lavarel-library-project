@error($name)
    <span>
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@enderror