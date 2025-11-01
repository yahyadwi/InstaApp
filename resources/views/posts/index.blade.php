@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="card post-card">
                <div class="card-header bg-white d-flex align-items-center">
                    <img src="/storage/{{ $post->user->avatar }}" class="rounded-circle me-2" width="40" height="40">
                    <a href="/profile/{{ $post->user->username }}" class="text-decoration-none text-dark">
                        <strong>{{ $post->user->username }}</strong>
                    </a>
                </div>

                <img src="/storage/{{ $post->image }}" class="card-img-top" alt="Post image">

                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-heart{{ $post->isLikedBy(Auth::id()) ? '-fill liked' : '' }} like-btn"
                            data-post-id="{{ $post->id }}"></i>
                        <span class="likes-count">{{ $post->likes->count() }}</span> likes
                    </div>

                    @if($post->caption)
                        <p class="card-text">
                            <strong>{{ $post->user->username }}</strong> {{ $post->caption }}
                        </p>
                    @endif

                    <div class="comments-section">
                        @foreach($post->comments->take(2) as $comment)
                            <p class="mb-1">
                                <strong>{{ $comment->user->username }}</strong> {{ $comment->content }}
                            </p>
                        @endforeach

                        @if($post->comments->count() > 2)
                            <a href="/posts/{{ $post->id }}" class="text-muted">
                                View all {{ $post->comments->count() }} comments
                            </a>
                        @endif
                    </div>

                    <form class="comment-form mt-2" data-post-id="{{ $post->id }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Add a comment...">
                            <button class="btn btn-primary" type="submit">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        // Like functionality
        $('.like-btn').click(function () {
            const postId = $(this).data('post-id');
            const likeBtn = $(this);

            $.post(`/posts/${postId}/like`, {
                _token: '{{ csrf_token() }}'
            })
                .done(function (data) {
                    if (data.liked) {
                        likeBtn.removeClass('bi-heart').addClass('bi-heart-fill liked');
                    } else {
                        likeBtn.removeClass('bi-heart-fill liked').addClass('bi-heart');
                    }
                    likeBtn.siblings('.likes-count').text(data.likes_count);
                });
        });

        // Comment functionality
        $('.comment-form').submit(function (e) {
            e.preventDefault();
            const form = $(this);
            const postId = form.data('post-id');
            const input = form.find('input');
            const content = input.val();

            if (content.trim() === '') return;

            $.post(`/posts/${postId}/comment`, {
                content: content,
                _token: '{{ csrf_token() }}'
            })
                .done(function (data) {
                    const commentHtml = `<p class="mb-1"><strong>${data.user.username}</strong> ${data.comment.content}</p>`;
                    form.siblings('.comments-section').append(commentHtml);
                    input.val('');
                });
        });
    </script>
@endpush