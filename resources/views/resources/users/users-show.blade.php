<x-layouts.default-layout title="Profile" id="userForm" selected="User">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/userForm.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Raleway"
        />
    </x-slot>
  
    <x-slot:content>
        <div class="displayinfo">
            <h3>Display Info</h3>
        </div>
        <div class="annouce">
            <span>Your profile card will visible to all members of this site</span>
        </div>
            <div class="form">
                <div class="tab">
                    <span>Display Name: </span>
                    <p>
                        <b>{{ $user->username }}</b>
                    </p>
                </div>
                <div class="tab">
                    <span>ID: </span>
                    <p>
                        <b>{{ $user->id }}</b>
                    </p>
                </div>
            </div>
            <hr>
            <div class="displayinfo">
                <h3>Account</h3>
            </div>
            <div class="annouce">
                <span>Update & Edit the information you share with the community</span>
            </div>
            <div>        
                <h5>
                    Email: <br/>
                    {{ $user->email }}
                </h5>
            </div>
    
            <div class="tab">
                <span>First Name: </span>
                <p>
                    <b>{{ $user->firstname }}</b>
                </p>
            </div>
            <div class="tab">
                <span>Last Name: </span>
                <p>
                    <b>{{ $user->lastname }}</b>
                </p>
            </div>
            {{-- 
            <div class="tab">
                <span>Password: </span>
                <p>
                    <input
                        type="password"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;"
                        oninput="this.className = ''"
                        name="password"
                        readonly
                    />
                </p>
            </div>
            --}}
            <div style="overflow: auto">
                <div style="float: right">
                    <a href="{{ route('users.edit', ['user' => $user]) }}"><button class="btn update">Edit Info</button></a>
                    <a href="{{ route('users.books.borrows.index', ['user' => $user]) }}"><button class="btn history">History</button></a>
                </div>
            </div>
        </div>
    </x-slot>
  </x-layouts.default-layout>