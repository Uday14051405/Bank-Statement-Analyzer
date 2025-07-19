<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span></span>
                </li>

                <!-- Dashboard -->
                <!-- <li class="<?php echo e((request()->is('admin/dashboard*')) ? 'active' : ''); ?>">
                    <a class="sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            <?php echo e(__('sidebar.dashboard')); ?>

                        </span>
                    </a>
                </li> -->
                <!-- /Dashboard -->
 <!-- Dashboard -->
 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
 <li class="<?php echo e((request()->is('admin/dashboard*')) ? 'active' : ''); ?>">
                    <a class="sidebar-link" href="<?php echo e(route('dashboard')); ?>" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            <?php echo e(__('sidebar.dashboard')); ?>

                        </span>
                    </a>
                </li>
                <?php endif; ?>   
                <!-- /Dashboard -->



                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-list')): ?>
                <li class="<?php echo e((request()->is('admin/deal/index')) ? 'active' : ''); ?>">
                    <a class="sidebar-link" href="<?php echo e(route('deal.index')); ?>" aria-expanded="false">
                        <i data-feather="credit-card"></i>
                        <span>
                            <?php echo e(__('sidebar.deal')); ?>

                        </span>
                    </a>
                </li>
                            <?php endif; ?>      
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-invested-list')): ?>    
                <li class="<?php echo e((request()->is('admin/deal/*invested*')) ? 'active' : ''); ?>">
                    <a class="sidebar-link" href="<?php echo e(route('deal.index_invested')); ?>" aria-expanded="false">
                        <i data-feather="credit-card"></i>
                        <span>
                            <?php echo e(__('sidebar.deal_invested')); ?>

                        </span>
                    </a>
                </li>
                    <?php endif; ?>      
                                       
                <!-- Users -->
                <?php if(auth()->user()->can('user-list') || auth()->user()->can('role-list') || auth()->user()->can('permission-list') || auth()->user()->can('user-activity')): ?>
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="users"></i>
                            <span class="hide-menu"><?php echo e(__('sidebar.user')); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('users.index')); ?>" title="<?php echo e(__('sidebar.user')); ?>" class="sidebar-link <?php echo e((request()->is('admin/user*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.user')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('anchor-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('anchor.index')); ?>" title="<?php echo e(__('sidebar.anchor')); ?>" class="sidebar-link <?php echo e((request()->is('admin/anchor*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.anchor')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('customer.index')); ?>" title="<?php echo e(__('sidebar.customer')); ?>" class="sidebar-link <?php echo e((request()->is('admin/customer*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.customer')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('deal.index')); ?>" title="<?php echo e(__('sidebar.deal')); ?>" class="sidebar-link <?php echo e((request()->is('admin/deal*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.deal')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-invested-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('deal.index_invested')); ?>" title="<?php echo e(__('sidebar.deal_invested')); ?>" class="sidebar-link <?php echo e((request()->is('admin/deal/index_invested*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.deal_invested')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('roles.index')); ?>" title="<?php echo e(__('sidebar.roles')); ?>" class="sidebar-link <?php echo e((request()->is('admin/roles*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.roles')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('permissions.index')); ?>" title="<?php echo e(__('sidebar.permissions')); ?>" class="sidebar-link <?php echo e((request()->is('admin/permissions*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.permission')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-activity')): ?>
                                <li>
                                    <a href="/admin/user-activity" title="<?php echo e(__('sidebar.user-activity')); ?>" class="sidebar-link <?php echo e((request()->is('admin/setting/useractivity*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.user-activity')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?> -->
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- /Users -->


                


            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\layouts\sidebar_other.blade.php ENDPATH**/ ?>