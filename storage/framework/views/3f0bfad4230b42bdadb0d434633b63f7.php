

<?php $__env->startSection('title', 'Add Kaiju'); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="max-width:900px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="<?php echo e(route('admin.kaijus.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Add New Kaiju</h1>
    </div>

    <form method="POST" action="<?php echo e(route('admin.kaijus.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">Basic Info</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-secondary">Name *</label>
                    <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('name')); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Slug *</label>
                    <input type="text" name="slug" class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           value="<?php echo e(old('slug')); ?>" required placeholder="godzilla">
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Description</label>
                    <textarea name="description" rows="4" class="form-control"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
        </div>

        
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-heart-fill me-2"></i>Health &amp; Regen
            </h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label text-secondary">Health Min</label>
                    <input type="number" step="0.01" name="health_min" class="form-control"
                           value="<?php echo e(old('health_min', 0)); ?>" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Health Max</label>
                    <input type="number" step="0.01" name="health_max" class="form-control"
                           value="<?php echo e(old('health_max', 0)); ?>" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Regen Min (%)</label>
                    <input type="number" step="0.01" name="regen_min" class="form-control"
                           value="<?php echo e(old('regen_min', 0)); ?>" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-secondary">Regen Max (%)</label>
                    <input type="number" step="0.01" name="regen_max" class="form-control"
                           value="<?php echo e(old('regen_max', 0)); ?>" placeholder="0.00">
                </div>
            </div>
        </div>

        
        <div class="card-ku p-4 rounded-3 mb-4" id="attacksSection">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0" style="color:var(--ku-accent)">
                    <i class="bi bi-lightning-fill me-2"></i>Attacks
                </h5>
                <button type="button" class="btn btn-ku btn-sm" onclick="addAttackRow()">
                    <i class="bi bi-plus-lg me-1"></i>Add Attack
                </button>
            </div>
            <div id="attackRows"></div>
            <p id="noAttacksMsg" class="text-secondary fst-italic mb-0">
                No attacks yet. Click "Add Attack" to add one.
            </p>
        </div>

        
        <div class="card-ku p-4 rounded-3 mb-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-wind me-2"></i>Movement Speeds
            </h5>
            <?php $__currentLoopData = [
                ['key' => 'walking',   'label' => 'Walking'],
                ['key' => 'sprinting', 'label' => 'Sprinting'],
                ['key' => 'swimming',  'label' => 'Swimming'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row g-2 mb-2">
                <div class="col-md-2 d-flex align-items-end pb-1">
                    <span class="text-secondary"><?php echo e($sp['label']); ?></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Min (u/s)</label>
                    <input type="number" step="0.01" name="speed[<?php echo e($sp['key']); ?>_min]"
                           class="form-control" value="<?php echo e(old("speed.{$sp['key']}_min", 0)); ?>" placeholder="0.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Max (u/s)</label>
                    <input type="number" step="0.01" name="speed[<?php echo e($sp['key']); ?>_max]"
                           class="form-control" value="<?php echo e(old("speed.{$sp['key']}_max", 0)); ?>" placeholder="0.00">
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row g-2 mb-2">
                <div class="col-md-2 d-flex align-items-end pb-1">
                    <span class="text-secondary">Flying <small class="text-muted">(optional)</small></span>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Min (u/s)</label>
                    <input type="number" step="0.01" name="speed[flying_min]"
                           class="form-control" value="<?php echo e(old('speed.flying_min')); ?>" placeholder="Leave blank if can't fly">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary small">Max (u/s)</label>
                    <input type="number" step="0.01" name="speed[flying_max]"
                           class="form-control" value="<?php echo e(old('speed.flying_max')); ?>" placeholder="Leave blank if can't fly">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-ku fw-bold px-4">
            <i class="bi bi-plus-lg me-1"></i>Create Kaiju
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Auto-generate slug from name
    document.querySelector('[name="name"]').addEventListener('input', function() {
        const slugField = document.querySelector('[name="slug"]');
        if (!slugField.dataset.touched) {
            slugField.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });
    document.querySelector('[name="slug"]').addEventListener('input', function() {
        this.dataset.touched = '1';
    });

    let attackIndex = 0;

    function addAttackRow() {
        document.getElementById('noAttacksMsg').style.display = 'none';
        const idx = attackIndex++;
        const row = document.createElement('div');
        row.className = 'row g-2 mb-3 align-items-end p-2 rounded-2';
        row.style.cssText = 'background:#252525; border:1px solid #3a3a3a';
        row.innerHTML = `
            <div class="col-md-3">
                <label class="form-label text-secondary small">Attack Name</label>
                <input type="text" name="attacks[${idx}][name]" class="form-control" required>
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">DMG Min</label>
                <input type="number" step="0.01" name="attacks[${idx}][damage_min]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">DMG Max</label>
                <input type="number" step="0.01" name="attacks[${idx}][damage_max]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">Cooldown (s)</label>
                <input type="number" step="0.01" name="attacks[${idx}][cooldown]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-1">
                <label class="form-label text-secondary small">Charge</label>
                <input type="number" step="0.01" name="attacks[${idx}][charge_cost]" class="form-control" placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label class="form-label text-secondary small">Description</label>
                <input type="text" name="attacks[${idx}][description]" class="form-control">
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.row').remove(); checkEmpty();" title="Remove">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        document.getElementById('attackRows').appendChild(row);
    }

    function checkEmpty() {
        const rows = document.getElementById('attackRows').querySelectorAll('.row');
        document.getElementById('noAttacksMsg').style.display = rows.length === 0 ? '' : 'none';
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/admin/kaiju/create.blade.php ENDPATH**/ ?>