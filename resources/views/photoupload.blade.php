@include('head')
@include('header')
        <main>
            <h1>Want to upload a new photo?</h1>
            <section class="cuerpo modificar">
                <form action="/photoupload" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description">
                    <label for="image">Select your photo</label>
                    <input type="file" name="image" id="image" accept="image/png, image/jpeg">
                    <button type="submit" class="btn">Upload</button>
                    <input type="reset" value="Reset to default">
                </form>
            </section>
        </main>
@include('footer')
