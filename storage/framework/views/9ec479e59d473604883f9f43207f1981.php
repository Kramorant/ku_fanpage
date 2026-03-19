

<?php $__env->startSection('title', 'Kaiju Wiki'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex align-items-center mb-4 gap-3">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-book-half me-2"></i>Kaiju Wiki
        </h1>
        <span class="badge bg-secondary"><?php echo e($kaijus->count()); ?> entries</span>
    </div>

    <?php if($kaijus->isEmpty()): ?>
        <div class="text-center py-5 text-secondary">
            <i class="bi bi-exclamation-circle" style="font-size:3rem"></i>
            <p class="mt-3 fs-5">No kaiju entries yet. Check back soon!</p>
        </div>
    <?php else: ?>
    <div class="row g-4">
        <?php $__currentLoopData = $kaijus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kaiju): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <a href="<?php echo e(route('wiki.show', $kaiju->slug)); ?>" class="text-decoration-none">
                <div class="card-ku h-100 rounded-3 overflow-hidden"
                     style="transition:.2s"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='var(--ku-accent)'"
                     onmouseout="this.style.transform='none';this.style.borderColor='var(--ku-border)'">

                    <?php if($kaiju->image): ?>
                        <img src="<?php echo e(Storage::url($kaiju->image)); ?>"
                             class="w-100" style="height:180px; object-fit:cover" alt="<?php echo e($kaiju->name); ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center"
                             style="height:180px; background:#111">
                            <i class="bi bi-tornado" style="font-size:4rem; color:var(--ku-border)"></i>
                        </div>
                    <?php endif; ?>

                    <div class="p-3">
                        <h5 class="fw-bold mb-0" style="color:var(--ku-accent)"><?php echo e($kaiju->name); ?></h5>
                        <?php if($kaiju->description): ?>
                        <p class="text-secondary small mt-1 mb-0" style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;">
                            <?php echo e($kaiju->description); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/wiki/index.blade.php ENDPATH**/ ?>