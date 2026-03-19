

<?php $__env->startSection('title', 'Manage Carousel'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-images me-2"></i>Carousel Images
    </h1>

    
    <div class="card-ku p-4 rounded-3 mb-5">
        <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">Upload New Image</h5>
        <form method="POST" action="<?php echo e(route('admin.carousel.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-secondary">Image *</label>
                    <input type="file" name="image_path" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary">Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="Optional caption">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-secondary">Order</label>
                    <input type="number" name="order" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-ku w-100 fw-bold">
                        <i class="bi bi-upload"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    
    <?php if($images->isEmpty()): ?>
        <p class="text-secondary text-center py-5">No carousel images uploaded yet.</p>
    <?php else: ?>
    <div class="row g-4">
        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 col-lg-3">
            <div class="card-ku rounded-3 overflow-hidden <?php echo e($img->active ? 'border-warning' : ''); ?>">
                <div class="position-relative">
                    <img src="<?php echo e(Storage::url($img->image_path)); ?>"
                         class="w-100" style="height:150px; object-fit:cover"
                         alt="Carousel image <?php echo e($img->id); ?>">
                    <?php if($img->active): ?>
                    <span class="badge position-absolute top-0 end-0 m-2"
                          style="background:var(--ku-accent); color:#111">Active</span>
                    <?php endif; ?>
                </div>

                <div class="p-3">
                    <?php if($img->caption): ?>
                        <p class="text-secondary small mb-2"><?php echo e($img->caption); ?></p>
                    <?php endif; ?>

                    
                    <form method="POST" action="<?php echo e(route('admin.carousel.update', $img)); ?>"
                          class="mb-2">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <div class="d-flex gap-2 mb-2">
                            <input type="number" name="order" class="form-control form-control-sm"
                                   value="<?php echo e($img->order); ?>" min="0" style="width:70px">
                            <div class="form-check form-switch d-flex align-items-center ms-1">
                                <input class="form-check-input" type="checkbox"
                                       name="active" value="1" role="switch"
                                       id="activeToggle<?php echo e($img->id); ?>"
                                       <?php echo e($img->active ? 'checked' : ''); ?>>
                                <label class="form-check-label text-secondary ms-2"
                                       for="activeToggle<?php echo e($img->id); ?>">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                            <i class="bi bi-floppy me-1"></i>Update
                        </button>
                    </form>

                    
                    <form method="POST" action="<?php echo e(route('admin.carousel.destroy', $img)); ?>"
                          onsubmit="return confirm('Delete this image?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/carousel/index.blade.php ENDPATH**/ ?>