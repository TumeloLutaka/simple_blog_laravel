<x-layout title="Profile">
    <div class="profile">
        <!-- Column 1: Create Post & My Posts -->
        <div class="profile__posts-col">
            <section class="profile__card">
                <div>
                    <h2 class="profile__title">Create a New Post</h2>
                    <p class="profile__subtitle">Share an article or note with the community.</p>
                </div>

                <form action="/create-post" method="POST" class="form">
                    @csrf
                    <div class="form__group">
                        <label for="title" class="form__label">Title</label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ old('title') }}"
                            placeholder="Give your post a clear title"
                            class="form__input"
                            required
                        >
                    </div>

                    <div class="form__group">
                        <label for="body" class="form__label">Content</label>
                        <textarea
                            id="body"
                            name="body"
                            placeholder="Write your post content here..."
                            class="form__textarea"
                            required
                        >{{ old('body') }}</textarea>
                    </div>

                    <div class="form__actions">
                        <button type="submit" class="btn btn--primary">Publish Post</button>
                    </div>
                </form>
            </section>

            <section class="feed">
                <div class="feed__header">
                    <h2 class="feed__title">My Posts ({{ $posts->count() }})</h2>
                </div>

                @if ($posts->isEmpty())
                    <div class="feed__empty">
                        <p>You haven't published any posts yet.</p>
                    </div>
                @else
                    <div class="feed__list">
                        @foreach ($posts as $post)
                            <article class="post-card">
                                <div class="post-card__header">
                                    <h3 class="post-card__title">
                                        <a href="/posts/{{ $post->id }}" class="post-card__title-link">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <div class="post-card__meta">
                                        <span class="post-card__date">
                                            Published {{ $post->created_at->format('M j, Y') }}
                                        </span>
                                    </div>
                                </div>

                                <p class="post-card__excerpt">{{ \Illuminate\Support\Str::limit($post->body, 180) }}</p>

                                <div class="post-card__footer">
                                    <a href="/posts/{{ $post->id }}" class="post-card__read-more">
                                        Read full post &rarr;
                                    </a>

                                    <div class="post-card__actions">
                                        <a href="/edit-post/{{ $post->id }}" class="btn btn--secondary btn--sm">Edit</a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>

        <!-- Column 2: User Details & Delete Account -->
        <aside class="profile__details-col">
            <section class="profile__card">
                <div>
                    <h2 class="profile__title">Profile Details</h2>
                    <p class="profile__subtitle">Your account summary.</p>
                </div>

                <dl class="profile__info-list">
                    <div class="profile__info-item">
                        <dt class="profile__info-label">Username</dt>
                        <dd class="profile__info-value">{{ $user->name }}</dd>
                    </div>

                    <div class="profile__info-item">
                        <dt class="profile__info-label">Email Address</dt>
                        <dd class="profile__info-value">{{ $user->email }}</dd>
                    </div>

                    <div class="profile__info-item">
                        <dt class="profile__info-label">Member Since</dt>
                        <dd class="profile__info-value">{{ $user->created_at->format('F j, Y') }}</dd>
                    </div>

                    <div class="profile__info-item">
                        <dt class="profile__info-label">Total Posts</dt>
                        <dd class="profile__info-value">{{ $posts->count() }}</dd>
                    </div>
                </dl>
            </section>

            <section class="profile__card profile__card--danger">
                <div>
                    <h2 class="profile__title">Delete Account</h2>
                    <p class="profile__danger-text">
                        Permanently remove this user account and all of its published posts.
                    </p>
                </div>

                <form
                    action="/profile"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this user account and all of its posts?');"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn--danger btn--block">Delete User</button>
                </form>
            </section>
        </aside>
    </div>
</x-layout>
