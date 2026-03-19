

<?php $__env->startSection('title', 'Admin – Kaijus'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-tornado me-2"></i>Kaijus
        </h1>
        <a href="<?php echo e(route('admin.kaijus.create')); ?>" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Kaiju
        </a>
    </div>

    <?php if($kaijus->isEmpty()): ?>
        <p class="text-secondary text-center py-5">No kaijus yet.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark-ku align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $kaijus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kaiju): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="border-color:#3a3a3a">
                    <td>
                        <?php if($kaiju->image): ?>
                            <img src="<?php echo e(Storage::url($kaiju->image)); ?>"
                                 width="60" height="40"
                                 style="object-fit:cover; border-radius:4px"
                                 alt="<?php echo e($kaiju->name); ?>">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center rounded"
                                 style="width:60px;height:40px;background:#111">
                                <i class="bi bi-tornado text-secondary"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="fw-bold"><?php echo e($kaiju->name); ?></td>
                    <td class="text-secondary"><?php echo e($kaiju->slug); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('wiki.show', $kaiju->slug)); ?>" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?php echo e(route('admin.kaijus.edit', $kaiju)); ?>"
                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.kaijus.destroy', $kaiju)); ?>"
                              class="d-inline"
                              onsubmit="return confirm('Delete <?php echo e(addslashes($kaiju->name)); ?>?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/kaiju/index.blade.php ENDPATH**/ ?>