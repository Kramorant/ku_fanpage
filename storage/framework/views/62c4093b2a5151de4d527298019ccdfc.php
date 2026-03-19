

<?php $__env->startSection('title', $kaiju->name . ' – KU Wiki'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('wiki.index')); ?>">Wiki</a></li>
            <li class="breadcrumb-item active"><?php echo e($kaiju->name); ?></li>
        </ol>
    </nav>

    
    <div class="row align-items-start g-4 mb-5">
        <div class="col-md-4">
            <?php if($kaiju->image): ?>
                <img src="<?php echo e(Storage::url($kaiju->image)); ?>"
                     class="img-fluid rounded-3 w-100"
                     style="max-height:360px; object-fit:cover"
                     alt="<?php echo e($kaiju->name); ?>">
            <?php else: ?>
                <div class="d-flex align-items-center justify-content-center rounded-3"
                     style="height:300px; background:#111">
                    <i class="bi bi-tornado" style="font-size:6rem; color:var(--ku-border)"></i>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <h1 class="fw-bold" style="color:var(--ku-accent)"><?php echo e($kaiju->name); ?></h1>
            <?php if($kaiju->description): ?>
                <p class="lead text-secondary"><?php echo e($kaiju->description); ?></p>
            <?php endif; ?>
        </div>
    </div>

    
    <?php echo $__env->make('components.kaiju-stats', ['kaiju' => $kaiju], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="mt-5">
        <?php echo $__env->make('components.comment-section', [
            'comments'  => $kaiju->comments,
            'postType'  => 'kaiju',
            'postId'    => $kaiju->id,
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/wiki/show.blade.php ENDPATH**/ ?>