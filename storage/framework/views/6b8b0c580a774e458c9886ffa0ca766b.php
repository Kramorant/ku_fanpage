

<?php $__env->startSection('title', 'Blog'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-newspaper me-2"></i>Blog
    </h1>

    <?php if($posts->isEmpty()): ?>
        <p class="text-secondary text-center py-5">No blog posts yet.</p>
    <?php else: ?>
    <div class="row g-4">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
            <a href="<?php echo e(route('blog.show', $post)); ?>" class="text-decoration-none">
                <div class="card-ku h-100 rounded-3 overflow-hidden"
                     style="transition:.2s"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='var(--ku-accent)'"
                     onmouseout="this.style.transform='none';this.style.borderColor='var(--ku-border)'">

                    <?php if($post->image): ?>
                        <img src="<?php echo e(Storage::url($post->image)); ?>"
                             class="w-100" style="height:180px; object-fit:cover" alt="<?php echo e($post->title); ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center"
                             style="height:140px; background:#111">
                            <i class="bi bi-file-text" style="font-size:3rem; color:var(--ku-border)"></i>
                        </div>
                    <?php endif; ?>

                    <div class="p-3">
                        <small class="text-secondary">
                            <i class="bi bi-clock me-1"></i><?php echo e($post->created_at->format('M j, Y')); ?>

                        </small>
                        <h5 class="fw-bold mt-1 mb-0" style="color:var(--ku-accent)"><?php echo e($post->title); ?></h5>
                        <p class="text-secondary small mt-1 mb-0" style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;">
                            <?php echo e(strip_tags($post->content)); ?>

                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/blog/index.blade.php ENDPATH**/ ?>