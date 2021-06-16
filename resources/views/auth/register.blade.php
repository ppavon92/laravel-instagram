@include('head')
@include('header')
        <main>
            <h1>Hi there! Welcome to The real fake Instagram</h1>
            <section class="cuerpo registro">
                <form method="POST" action="{{ route('register') }}" >
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit" class="btn">Register</button>
                    <input type="reset" value="Reset to default">
                    <a class="btn-txt" href="{{ route('login') }}">Already have an account? Go to login!</a>
                </form>
                 <!-- Error handle
                @if($errors->any())
                <div class="row collapse">
                    <ul class="alert-box warning radius">
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
            </section>
        </main>
@include('footer')
