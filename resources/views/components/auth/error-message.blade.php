<span>
    @error($name)
    @php
        dd($errors);
    @endphp
        <small style="visibility:visible;">{{ $message }}</small>
    @else
        <small></small>
    @enderror
</span>
