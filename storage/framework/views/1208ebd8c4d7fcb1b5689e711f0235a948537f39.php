<?php if(count($breadcrumbs)): ?>

    <ol class="breadcrumb">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($breadcrumb->url && !$loop->last): ?>
                <li><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
            <?php else: ?>
                <li class="active"><?php echo e($breadcrumb->title); ?></li>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>

<?php endif; ?>
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\vendor\davejamesmiller\laravel-breadcrumbs\views\bootstrap3.blade.php ENDPATH**/ ?>