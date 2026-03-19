

<?php $__env->startSection('title', 'New Blog Post'); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="max-width:860px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?php echo e(route('admin.blog.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">New Blog Post</h1>
    </div>

    <form method="POST" action="<?php echo e(route('admin.blog.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="card-ku p-4 rounded-3 mb-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-secondary">Title *</label>
                    <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('title')); ?>" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Featured Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Video URL (YouTube)</label>
                    <input type="url" name="video_url" class="form-control <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('video_url')); ?>" placeholder="https://youtube.com/watch?v=...">
                    <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Content *</label>
                    <textarea id="tinymce-content" name="content"
                              class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              rows="12"><?php echo e(old('content')); ?></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-ku fw-bold px-4">
            <i class="bi bi-plus-lg me-1"></i>Publish Post
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="https://cdn.tiny.cloud/1/wvqz9t3knu1xumbz1ay0dwrplu5hc6paet69xo1h1the13y1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#tinymce-content',
    skin: 'oxide-dark',
    content_css: 'dark',
    plugins: 'lists link image code table media',
    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image media | table | code',
    height: 420,
    promotion: false,
    branding: false,
    setup: function(editor) {
        editor.on('change', function() {
            editor.save();
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/blog/create.blade.php ENDPATH**/ ?>