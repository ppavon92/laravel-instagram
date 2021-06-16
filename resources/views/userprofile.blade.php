@include('head')
@include('header')
        <main>
            <section class="cuerpo">
                <div class="blq-avatar">
                    @if($user->avatar)
                    <img class="avatar" src="{{asset('storage/avatars/' . $user->avatar)}}" alt="User avatar">
                    @else
                    <img class="avatar" src="https://cdn.vox-cdn.com/thumbor/N6-QGX2FaDUgPW3-RRqoM3dfpkQ=/1400x1050/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/19979927/jomi_avatar_nickleodeon_ringer.jpg" alt="Avatar">
                    @endif
                </div>
                <div class="blq-contenido">
                    <div class="perfil">
                        <h2>{{ $user->username }}</h2>
                        <span><a class="btn" href="{{ url('edituser') }}">Edit my profile</a></span>
                    </div>
                    <div class="datos">
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </section>
            <section class="img">
                <div class="blq-contenido-img">
                    @foreach ($user->images()->get() as $image)
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
                                <a class="btn-delete" href="/photo/delete/{{$image -> id}}"><span>Borrar imagen</span><i class="fas fa-trash"></i></a>
                                <p class="photo-subtitle">Comments:</p>
                                    @foreach ($image->comments()->get() as $comment)
                                        <ul class="blq-comment">
                                            <li class="comment">
                                                <p>{{$comment->content}}</p>
                                                <a class="btn-delete" href="/deletecomment/{{$comment -> id}}"><i class="fas fa-trash"></i></a>
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
                    @endforeach
                </div>
            </section>
        </main>
@include('footer')
