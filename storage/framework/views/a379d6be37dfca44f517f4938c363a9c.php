

<?php $__env->startSection('title', 'Admin – Blog Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-newspaper me-2"></i>Blog Posts
        </h1>
        <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>New Post
        </a>
    </div>

    <?php if($posts->isEmpty()): ?>
        <p class="text-secondary text-center py-5">No blog posts yet.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Title</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="border-color:#3a3a3a">
                    <td class="fw-bold"><?php echo e($post->title); ?></td>
                    <td class="text-secondary"><?php echo e($post->created_at->format('M j, Y')); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('blog.show', $post)); ?>" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?php echo e(route('admin.blog.edit', $post)); ?>"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.blog.destroy', $post)); ?>"
                              class="d-inline"
                              onsubmit="return confirm('Delete this post?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/blog/index.blade.php ENDPATH**/ ?>