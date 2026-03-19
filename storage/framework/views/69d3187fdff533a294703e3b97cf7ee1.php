

<div class="ku-comments mt-4">
    <h5 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-chat-dots-fill me-2"></i>
        Comments <span class="text-secondary fs-6">(<?php echo e($comments->count()); ?>)</span>
    </h5>

    
    <?php if(auth()->guard()->check()): ?>
    <form method="POST" action="<?php echo e(route('comments.store')); ?>" class="mb-4">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="post_type" value="<?php echo e($postType); ?>">
        <input type="hidden" name="post_id"   value="<?php echo e($postId); ?>">
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
    <?php else: ?>
    <div class="alert" style="background:#252525; border:1px solid #3a3a3a; color:#aaa" role="alert">
        <a href="<?php echo e(route('login')); ?>" style="color:var(--ku-accent)">Log in</a>
        or <a href="<?php echo e(route('register')); ?>" style="color:var(--ku-accent)">register</a>
        to leave a comment.
    </div>
    <?php endif; ?>

    
    <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="comment-item mb-3 p-3 rounded-2" style="background:#232323; border:1px solid #3a3a3a">
        <div class="d-flex justify-content-between align-items-start mb-1">
            <div>
                <span class="fw-bold" style="color:var(--ku-accent)">
                    <i class="bi bi-person-fill me-1"></i><?php echo e($comment->user->name); ?>

                </span>
                <span class="text-secondary ms-2" style="font-size:.8rem">
                    <?php echo e($comment->created_at->diffForHumans()); ?>

                </span>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->id() === $comment->user_id || auth()->user()->isAdmin()): ?>
            <form method="POST" action="<?php echo e(route('comments.destroy', $comment)); ?>"
                  onsubmit="return confirm('Delete this comment?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2"
                        style="font-size:.75rem">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <p class="mb-0 text-secondary" style="white-space:pre-line"><?php echo e($comment->content); ?></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-secondary fst-italic text-center py-3">
        No comments yet. Be the first!
    </p>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/components/comment-section.blade.php ENDPATH**/ ?>