

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex align-items-center gap-3 mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-shield-fill me-2"></i>Admin Dashboard
        </h1>
    </div>

    
    <div class="row g-4 mb-5">
        <?php $__currentLoopData = [
            ['label' => 'Kaijus',    'count' => $kaijuCount,    'icon' => 'bi-tornado',        'route' => 'admin.kaijus.index'],
            ['label' => 'Events',    'count' => $eventCount,    'icon' => 'bi-calendar-event',  'route' => 'admin.events.index'],
            ['label' => 'Blog Posts','count' => $blogCount,     'icon' => 'bi-newspaper',       'route' => 'admin.blog.index'],
            ['label' => 'Carousel',  'count' => $carouselCount, 'icon' => 'bi-images',          'route' => 'admin.carousel.index'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-xl-3">
            <a href="<?php echo e(route($card['route'])); ?>" class="text-decoration-none">
                <div class="card-ku p-4 rounded-3 d-flex align-items-center gap-3"
                     style="transition:.2s"
                     onmouseover="this.style.borderColor='var(--ku-accent)'"
                     onmouseout="this.style.borderColor='var(--ku-border)'">
                    <div style="font-size:2.2rem; color:var(--ku-accent)">
                        <i class="bi <?php echo e($card['icon']); ?>"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-2 lh-1" style="color:var(--ku-accent)">
                            <?php echo e($card['count']); ?>

                        </div>
                        <div class="text-secondary"><?php echo e($card['label']); ?></div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="row g-3">
        <div class="col-auto">
            <a href="<?php echo e(route('admin.kaijus.create')); ?>" class="btn btn-ku">
                <i class="bi bi-plus-lg me-1"></i>Add Kaiju
            </a>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-ku">
                <i class="bi bi-plus-lg me-1"></i>Add Event
            </a>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-ku">
                <i class="bi bi-plus-lg me-1"></i>Add Blog Post
            </a>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route('admin.carousel.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-images me-1"></i>Manage Carousel
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>