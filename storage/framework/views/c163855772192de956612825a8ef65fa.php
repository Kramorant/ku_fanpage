

<?php $__env->startSection('title', $post->title . ' – Blog'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('blog.index')); ?>">Blog</a></li>
            <li class="breadcrumb-item active"><?php echo e($post->title); ?></li>
        </ol>
    </nav>

    <article class="mb-5">
        <?php if($post->image): ?>
        <img src="<?php echo e(Storage::url($post->image)); ?>"
             class="img-fluid rounded-3 w-100 mb-4"
             style="max-height:420px; object-fit:cover"
             alt="<?php echo e($post->title); ?>">
        <?php endif; ?>

        <h1 class="fw-bold mb-2" style="color:var(--ku-accent)"><?php echo e($post->title); ?></h1>
        <small class="text-secondary">
            <i class="bi bi-clock me-1"></i><?php echo e($post->created_at->format('F j, Y')); ?>

        </small>

        <hr style="border-color:#3a3a3a">

        <div class="blog-content text-secondary" style="line-height:1.9; font-size:1.05rem">
            <?php echo $post->content; ?>

        </div>

        
        <?php if($embedUrl = $post->getEmbedUrl()): ?>
        <div class="mt-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-play-circle-fill me-2"></i>Video / Doc
            </h5>
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden"
                 style="max-width:720px; border:1px solid #3a3a3a">
                <iframe src="<?php echo e($embedUrl); ?>"
                        title="Embedded video"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
        <?php endif; ?>
    </article>

    <?php echo $__env->make('components.comment-section', [
        'comments' => $post->comments,
        'postType' => 'blog',
        'postId'   => $post->id,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.blog-content img  { max-width: 100%; border-radius: 6px; }
.blog-content h2,
.blog-content h3   { color: var(--ku-accent); margin-top: 1.5rem; }
.blog-content a    { color: var(--ku-accent); }
.blog-content blockquote {
    border-left: 3px solid var(--ku-accent);
    padding-left: 1rem;
    color: #aaa;
    font-style: italic;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/blog/show.blade.php ENDPATH**/ ?>