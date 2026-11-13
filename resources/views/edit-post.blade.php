<x-layout title="Edit Post">
    <section class="post-view">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/' }}" class="post-view__back">
            &larr; Back
        </a>

        <div class="post-view__card">
            <header class="post-view__header">
                <h1 class="post-view__title">Edit Post</h1>
                <p class="post-view__meta">Update the title or body of your post below.</p>
            </header>

            <form action="/edit-post/{{ $post->id }}" method="POST" class="form">
                @csrf
                @method('PUT')

                <div class="form__group">
                    <label for="title" class="form__label">Post Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title', $post->title) }}"
                        class="form__input"
                        required
                    >
                </div>

                <div class="form__group">
                    <label for="body" class="form__label">Post Body</label>
                    <textarea
                        id="body"
                        name="body"
                        class="form__textarea"
                        required
                    >{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="form__actions">
                    <button type="submit" class="btn btn--primary">Save Changes</button>
                    <a href="/posts/{{ $post->id }}" class="btn btn--secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</x-layout>
