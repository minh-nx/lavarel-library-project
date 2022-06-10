<x-layouts.default-layout title="Verify email">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    </x-slot>

    <x-slot:content id="home">
        {{-- Body zone: Edit every body part here --}}
        <div class="page-body">
            <div class="middle-confirm-box">
                <img class="email-image" src="{{ asset('img/email-picture.jpg') }}" alt="email-image">
                <div>
                    <h2>Email confirmation</h2>
                    <p class="confirmation-content"> 
                        We have sent an email to your email address. Please click on the link provided to active your account. 
                        If you didn't receive the email. We will gladly send you another.
                    </p>
                    <hr>
                    <h4 class = "resend-email">
                        <form method="post" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit">
                                RESEND VERIFICATION EMAIL
                            </button>
                        </form>
                    </h4>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.default-layout>