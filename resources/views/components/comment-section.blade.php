{{--
    Comment Section Component
    ──────────────────────────
    Props:
      $comments  – Collection of Comment models (with user relation loaded)
      $postType  – 'kaiju' | 'event' | 'blog'
      $postId    – integer
--}}

<div class="ku-comments mt-4">
    <h5 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-chat-dots-fill me-2"></i>
        Comments <span class="text-secondary fs-6">({{ $comments->count() }})</span>
    </h5>

    {{-- Post new comment --}}
    @auth
    <form method="POST" action="{{ route('comments.store') }}" class="mb-4">
        @csrf
        <input type="hidden" name="post_type" value="{{ $postType }}">
        <input type="hidden" name="post_id"   value="{{ $postId }}">
        <div class="mb-2">
            <textarea name="content" rows="3"
                      class="form-control"
                      style="background:#252525; border-color:#3a3a3a; color:#e0e0e0; resize:vertical"
                      placeholder="Share your thoughts…" required maxlength="2000"></textarea>
        </div>
        <button type="submit" class="btn btn-ku btn-sm">
            <i class="bi bi-send-fill me-1"></i>Post Comment
        </button>
    </form>
    @else
    <div class="alert" style="background:#252525; border:1px solid #3a3a3a; color:#aaa" role="alert">
        <a href="{{ route('login') }}" style="color:var(--ku-accent)">Log in</a>
        or <a href="{{ route('register') }}" style="color:var(--ku-accent)">register</a>
        to leave a comment.
    </div>
    @endauth

    {{-- Comment list --}}
    @forelse($comments as $comment)
    <div class="comment-item mb-3 p-3 rounded-2" style="background:#232323; border:1px solid #3a3a3a">
        <div class="d-flex justify-content-between align-items-start mb-1">
            <div>
                <span class="fw-bold" style="color:var(--ku-accent)">
                    <i class="bi bi-person-fill me-1"></i>{{ $comment->user->name }}
                </span>
                <span class="text-secondary ms-2" style="font-size:.8rem">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>

            @auth
            @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
            <form method="POST" action="{{ route('comments.destroy', $comment) }}"
                  onsubmit="return confirm('Delete this comment?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2"
                        style="font-size:.75rem">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            @endif
            @endauth
        </div>

        <p class="mb-0 text-secondary" style="white-space:pre-line">{{ $comment->content }}</p>
    </div>
    @empty
    <p class="text-secondary fst-italic text-center py-3">
        No comments yet. Be the first!
    </p>
    @endforelse
</div>
