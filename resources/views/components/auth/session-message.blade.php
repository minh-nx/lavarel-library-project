<span>
    @if(session()->has('error') || session()->has('warning') || session()->has('success'))
        @if(session('error'))
            <small style="visibility:visible; color:red">{{ session('error') }}</small>
        @elseif(session()->has('warning'))
            <small style="visibility:visible; color:yellow">{{ session('warning') }}</small>
        @elseif(session()->has('success'))
            <small style="visibility:visible; color:green">{{ session('success') }}</small>
        @endif
    @endif
</span>