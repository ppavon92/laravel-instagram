@include('head')
@include('header')


<main>
    <section class="img">
        <div class="blq-contenido-img">
            @foreach ($images as $image)
                <div class="blq-img">
                        <div>
                            <img class="photo" src="{{asset('storage/images/' . $image->image_path)}}">
                            <div class="desc-like">
                                <p class="photo-subtitle">Description:</p>
                                    <div class="likes">
                                        <p class="n-likes">{{$image->nlikes($image->id)}}</p>
                                        <!-- Si el like pertenece al usuario -->
                                        @if ($user->liked($image->id))
                                            <a class="btn-like" href="/dislike/{{$image -> id}}"><i class="fas fa-heart"></i></a>
                                        <!-- Si No existen likes en la bd o el like q existe No pertenece al usuario -->
                                        @else
                                            <a class="btn-like" href="/like/{{$image -> id}}"><i class="far fa-heart"></i></a>
                                        @endif
                                    </div>
                            </div>
                            <p class="description">{{$image->description}}</p>
                            <p class="photo-subtitle">Comments:</p>
                                @foreach ($image->comments()->get() as $comment)
                                    <ul class="blq-comment">
                                        <li class="comment">
                                            <p>{{$comment->content}}</p>
                                            @if ($user->hascomment($comment->id))
                                                <a class="btn-delete" href="/deletecomment/{{$comment -> id}}"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </li>
                                    </ul>
                                @endforeach
                                <div class="form-comment">
                                    <form action="/addcomment/{{$image -> id}}" method="post">
                                        @csrf
                                        <input type="text" name="comment" id="comment" placeholder="Any comments?">
                                        <button type="submit" class="btn">Post</button>
                                    </form>
                                </div>
                        </div>
                    </div>
            </div>
            @endforeach
    </section>
</main>

@include('footer')
