<?php if(count($breadcrumbs)): ?>

    <ol class="breadcrumb">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($breadcrumb->url && !$loop->last): ?>
                <li class="breadcrumb-item"><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item active"><?php echo e($breadcrumb->title); ?></li>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>

<?php endif; ?>
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\vendor\davejamesmiller\laravel-breadcrumbs\views\bootstrap4.blade.php ENDPATH**/ ?>