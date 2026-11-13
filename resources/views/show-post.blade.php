<x-layout :title="$post->title">
    <article class="post-view">
        <a href="/" class="post-view__back">&larr; Back to Feed</a>

        <div class="post-view__card">
            <header class="post-view__header">
                <h1 class="post-view__title">{{ $post->title }}</h1>
                <p class="post-view__meta">
                    Written by <strong>{{ $post->user->name }}</strong>
                    &bull; Published {{ $post->created_at->format('F j, Y \a\t g:i A') }}
                </p>
            </header>

            <div class="post-view__body">{{ $post->body }}</div>

            @if (auth()->id() === $post->user_id)
                <footer class="post-view__actions">
                    <a href="/edit-post/{{ $post->id }}" class="btn btn--secondary btn--sm">Edit Post</a>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn--danger btn--sm">Delete Post</button>
                    </form>
                </footer>
            @endif
        </div>
    </article>
</x-layout>
