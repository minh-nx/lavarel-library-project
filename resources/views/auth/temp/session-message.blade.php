@if(session('success'))
    <span><i>Success: {{ session('success') }}</i></span>
@elseif(session('warning'))
    <span><i>Warning: {{ session('warning') }}</i></span>
@elseif(session('error'))
    <span><i>Error: {{ session('error') }}</i></span>
@endif