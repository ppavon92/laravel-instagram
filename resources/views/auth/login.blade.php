@include('head')
@include('header')
        <main>
            <h1>Hi there! Wait... You again?</h1>
            <section class="cuerpo registro">
                <form method="POST" action="{{ route('login') }}" >
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit" class="btn">Go!</button>
                    <input type="reset" value="Reset to default">
                    <a class="btn-txt" href="{{ route('register') }}">Don't have an account? Register now!</a>
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
