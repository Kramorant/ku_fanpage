

<?php $__env->startSection('title', 'Admin – Events'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-calendar-event me-2"></i>Events
        </h1>
        <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Event
        </a>
    </div>

    <?php if($events->isEmpty()): ?>
        <p class="text-secondary text-center py-5">No events yet.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="border-color:#3a3a3a">
                    <td class="fw-bold"><?php echo e($event->title); ?></td>
                    <td class="text-secondary"><?php echo e($event->event_date->format('M j, Y H:i')); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('events.show', $event)); ?>" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?php echo e(route('admin.events.edit', $event)); ?>"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>"
                              class="d-inline"
                              onsubmit="return confirm('Delete this event?')">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/events/index.blade.php ENDPATH**/ ?>