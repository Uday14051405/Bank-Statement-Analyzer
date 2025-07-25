<?php if(count($breadcrumbs)): ?>

    <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($loop->last): ?>
                    <li class="current"><span class="show-for-sr">Current:</span> <?php echo e($breadcrumb->title); ?></li>
                <?php elseif($breadcrumb->url): ?>
                    <li><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
                <?php else: ?>
                    <li class="disabled"><?php echo e($breadcrumb->title); ?></li>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>

<?php endif; ?>
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\vendor\davejamesmiller\laravel-breadcrumbs\views\foundation6.blade.php ENDPATH**/ ?>