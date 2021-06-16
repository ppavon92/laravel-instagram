<body>
    <header>
        <nav>
            <ul>
            <!-- Si No es invitado, o sea, está logueado, vale con Auth::check() -->
                @if (!Auth::guest())
                    <li><a href="/home">Home</a></li>
                    <!-- <li><a href="/home"><img src="/img/trfi-b.png" alt="The real fake Instagram"/></a></li> -->
                    <!-- ARREGLAR LO DE LA FOTO -->
                    <li><a href="/photoupload">Upload photo</a></li>
                    <li><a href="{{ url('user',Auth::user()->username) }}">{{Auth::user()->username}}</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></a></li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @endif
            </ul>
        </nav>
    </header>
