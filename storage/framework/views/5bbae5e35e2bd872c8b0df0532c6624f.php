

<?php $__env->startSection('title', $event->title . ' – Events'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('events.index')); ?>">Events</a></li>
            <li class="breadcrumb-item active"><?php echo e($event->title); ?></li>
        </ol>
    </nav>

    <div class="row g-4 mb-5">
        <?php if($event->image): ?>
        <div class="col-md-5">
            <img src="<?php echo e(Storage::url($event->image)); ?>"
                 class="img-fluid rounded-3 w-100"
                 style="max-height:360px; object-fit:cover"
                 alt="<?php echo e($event->title); ?>">
        </div>
        <?php endif; ?>
        <div class="<?php echo e($event->image ? 'col-md-7' : 'col-12'); ?>">
            <div class="mb-2">
                <span class="badge" style="background:var(--ku-accent); color:#111; font-size:.9rem">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?php echo e($event->event_date->format('F j, Y – H:i')); ?>

                </span>
            </div>
            <h1 class="fw-bold" style="color:var(--ku-accent)"><?php echo e($event->title); ?></h1>
            <div class="text-secondary mt-3" style="line-height:1.8">
                <?php echo nl2br(e($event->description)); ?>

            </div>
        </div>
    </div>

    <?php echo $__env->make('components.comment-section', [
        'comments' => $event->comments,
        'postType' => 'event',
        'postId'   => $event->id,
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/events/show.blade.php ENDPATH**/ ?>