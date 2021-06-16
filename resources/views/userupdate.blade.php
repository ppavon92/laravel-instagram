@include('head')
@include('header')
        <main>
            <h1>Want to change something?</h1>
            <span>Maybe your name? You should</span>
            <span>Just kidding, your name is cool hehe</span>
            <section class="cuerpo modificar">
                <form action="/edituser" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <label for="avatar">Profile pic</label>
                    <input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg">
                    <button type="submit" class="btn">Change</button>
                    <input type="reset" value="Reset to default">
                </form>
            </section>
        </main>
@include('footer')
