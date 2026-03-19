

<?php $__env->startSection('title', 'Home – Kaiju Universe Fan Wiki'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">

    
    <?php if($carouselImages->isNotEmpty()): ?>
    <div id="heroCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php $__currentLoopData = $carouselImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo e($i); ?>"
                    class="<?php echo e($i === 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($i + 1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="carousel-inner">
            <?php $__currentLoopData = $carouselImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($i === 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(Storage::url($img->image_path)); ?>"
                     class="d-block w-100"
                     style="height:520px; object-fit:cover; filter:brightness(.75)"
                     alt="<?php echo e($img->caption ?? 'Kaiju'); ?>">
                <?php if($img->caption): ?>
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="fw-bold" style="text-shadow:0 2px 6px #000"><?php echo e($img->caption); ?></h2>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <?php else: ?>
    
    <div class="text-center py-5 mb-5" style="background: linear-gradient(135deg,#111 0%,#1a1a2e 100%);">
        <h1 style="color:var(--ku-accent); font-size:3rem; font-weight:900; letter-spacing:2px;">
            <i class="bi bi-tornado me-2"></i>Kaiju Universe
        </h1>
        <p class="lead text-secondary">The ultimate fan wiki for Kaiju Universe</p>
    </div>
    <?php endif; ?>

    
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3" style="color:var(--ku-accent)">Welcome to the KU Fan Wiki</h2>
                <p class="lead text-secondary">
                    Your community-driven resource for all things Kaiju Universe.
                    Explore kaiju stats, game events, and the latest news.
                </p>
            </div>
        </div>

        
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <a href="<?php echo e(route('wiki.index')); ?>" class="text-decoration-none">
                    <div class="card-ku p-4 text-center h-100 rounded-3
                                border-0 position-relative overflow-hidden"
                         style="transition:.2s; cursor:pointer"
                         onmouseover="this.style.borderColor='var(--ku-accent)';this.style.transform='translateY(-4px)'"
                         onmouseout="this.style.borderColor='var(--ku-border)';this.style.transform='none'">
                        <div style="font-size:3rem; color:var(--ku-accent)">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <h4 class="mt-3 fw-bold" style="color:var(--ku-text)">Wiki</h4>
                        <p class="text-secondary mb-0">Browse kaiju stats, attacks, speeds & more.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('events.index')); ?>" class="text-decoration-none">
                    <div class="card-ku p-4 text-center h-100 rounded-3
                                border-0 position-relative overflow-hidden"
                         style="transition:.2s; cursor:pointer"
                         onmouseover="this.style.borderColor='var(--ku-accent)';this.style.transform='translateY(-4px)'"
                         onmouseout="this.style.borderColor='var(--ku-border)';this.style.transform='none'">
                        <div style="font-size:3rem; color:var(--ku-accent)">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h4 class="mt-3 fw-bold" style="color:var(--ku-text)">Events</h4>
                        <p class="text-secondary mb-0">Stay up to date with in-game events and updates.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('blog.index')); ?>" class="text-decoration-none">
                    <div class="card-ku p-4 text-center h-100 rounded-3
                                border-0 position-relative overflow-hidden"
                         style="transition:.2s; cursor:pointer"
                         onmouseover="this.style.borderColor='var(--ku-accent)';this.style.transform='translateY(-4px)'"
                         onmouseout="this.style.borderColor='var(--ku-border)';this.style.transform='none'">
                        <div style="font-size:3rem; color:var(--ku-accent)">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <h4 class="mt-3 fw-bold" style="color:var(--ku-text)">Blog</h4>
                        <p class="text-secondary mb-0">Articles, guides, and community content.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ku_fanpage\resources\views/home/index.blade.php ENDPATH**/ ?>