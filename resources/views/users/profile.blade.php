@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="/storage/{{ $user->avatar }}" class="rounded-circle" width="150" height="150">
            </div>

            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="me-4">{{ $user->username }}</h2>

                    @if(Auth::id() !== $user->id)
                        <button class="btn btn-primary follow-btn" data-user-id="{{ $user->id }}">
                            {{ Auth::user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                        </button>
                    @endif
                </div>

                <div class="d-flex mb-3">
                    <div class="me-4">
                        <strong>{{ $user->posts->count() }}</strong> posts
                    </div>
                    <div class="me-4">
                        <strong class="followers-count">{{ $user->followers->count() }}</strong> followers
                    </div>
                    <div>
                        <strong>{{ $user->following->count() }}</strong> following
                    </div>
                </div>

                <div>
                    <strong>{{ $user->name }}</strong>
                    @if($user->bio)
                        <p>{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            @foreach($user->posts as $post)
                <div class="col-md-4 mb-4">
                    <a href="/posts/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" class="img-fluid" alt="Post">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.follow-btn').click(function () {
            const userId = $(this).data('user-id');
            const btn = $(this);

            $.post(`/users/${userId}/follow`, {
                _token: '{{ csrf_token() }}'
            })
                .done(function (data) {
                    if (data.following) {
                        btn.text('Unfollow');
                    } else {
                        btn.text('Follow');
                    }
                    $('.followers-count').text(data.followers_count);
                });
        });
    </script>
@endpush