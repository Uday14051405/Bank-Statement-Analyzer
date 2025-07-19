<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span></span>
                </li>

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

                <!-- CMS -->
                <!-- <?php if(auth()->user()->can('cmspage-list') || auth()->user()->can('cmscategory-list')): ?>
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="file-text"></i>
                            <span class="hide-menu"><?php echo e(__('sidebar.cms')); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cmscategory-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('cmscategories.index')); ?>" title="<?php echo e(__('sidebar.category')); ?>" class="sidebar-link <?php echo e((request()->is('admin/cmscategories*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.category')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cmspage-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('cmspages.index')); ?>" title="<?php echo e(__('sidebar.cms-pages')); ?>" class="sidebar-link <?php echo e((request()->is('admin/cmspage*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.cms-pages')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?> -->
                <!-- /CMS -->

                <!-- Users -->
                <?php if(auth()->user()->can('customer-list') ): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
            <li class="<?php echo e((request()->is('admin/user*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('users.index')); ?>" title="<?php echo e(__('sidebar.user')); ?>" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span><?php echo e(__('sidebar.user')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('anchor-list')): ?>
            <li class="<?php echo e((request()->is('admin/anchor*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('anchor.index')); ?>" title="<?php echo e(__('sidebar.anchor')); ?>" class="sidebar-link">
                    <i data-feather="anchor"></i>
                    <span><?php echo e(__('sidebar.anchor')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-list')): ?>
            <li class="<?php echo e((request()->is('admin/customer/index')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('customer.index')); ?>" title="<?php echo e(__('sidebar.customer')); ?>" class="sidebar-link">
                    <i data-feather="user-check"></i>
                    <span><?php echo e(__('sidebar.customer')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-event')): ?>
            <li class="<?php echo e((request()->is('admin/customer/event_list')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('customer.event_list')); ?>" title="<?php echo e(__('sidebar.customer')); ?>" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Event List</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-contact-us')): ?>
            <li class="<?php echo e((request()->is('admin/customer/contact_us')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('customer.contact_us')); ?>" title="<?php echo e(__('sidebar.customer')); ?>" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Contact Us</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-list')): ?>
            <li class="<?php echo e((request()->is('admin/deal*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('deal.index')); ?>" title="<?php echo e(__('sidebar.deal')); ?>" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span><?php echo e(__('sidebar.deal')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('investor-list')): ?>
            <li class="<?php echo e((request()->is('admin/investor*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('investor.index')); ?>" title="<?php echo e(__('sidebar.investor')); ?>" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span><?php echo e(__('sidebar.investor')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
            <li class="<?php echo e((request()->is('admin/roles*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('roles.index')); ?>" title="<?php echo e(__('sidebar.roles')); ?>" class="sidebar-link">
                    <i data-feather="shield"></i>
                    <span><?php echo e(__('sidebar.roles')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-list')): ?>
            <li class="<?php echo e((request()->is('admin/permissions*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('permissions.index')); ?>" title="<?php echo e(__('sidebar.permissions')); ?>" class="sidebar-link">
                    <i data-feather="lock"></i>
                    <span><?php echo e(__('sidebar.permissions')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-activity')): ?>
            <li class="<?php echo e((request()->is('admin/setting/useractivity*')) ? 'active' : ''); ?>">
                <a href="/admin/user-activity" title="<?php echo e(__('sidebar.user-activity')); ?>" class="sidebar-link">
                    <i data-feather="activity"></i>
                    <span><?php echo e(__('sidebar.user-activity')); ?></span>
                </a>
            </li>
        <?php endif; ?> -->
    <?php endif; ?>

                <!-- /Users -->

   <!-- Settings -->
   <?php if(auth()->user()->can('reports-mis') || auth()->user()->can('reports-view_mis_details') ): ?>
                    <li class="submenu " >
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings"></i>
                            <span class="hide-menu"><?php echo e(__('sidebar.reports')); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reports-mis')): ?>
                                <li>
                                    <a href="<?php echo e(route('reports.mis')); ?>" title="<?php echo e(__('sidebar.mis')); ?>" class="sidebar-link <?php echo e((request()->is('admin/mis*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.mis')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                          

                         

                           
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- /Settings -->
                

                <!-- Settings -->
                <?php if(auth()->user()->can('file-manager') || auth()->user()->can('currency-list') || auth()->user()->can('websetting-edit') || auth()->user()->can('log-view')): ?>
                    <li class="submenu " >
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings"></i>
                            <span class="hide-menu"><?php echo e(__('sidebar.settings')); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency-list')): ?>
                                <li>
                                    <a href="<?php echo e(route('currencies.index')); ?>" title="<?php echo e(__('sidebar.currencies')); ?>" class="sidebar-link <?php echo e((request()->is('admin/currencies*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.currency')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('websetting-edit')): ?>
                                <li>
                                    <a href="<?php echo e(route('website-setting.edit')); ?>" title="<?php echo e(__('sidebar.website-setting')); ?>" class="sidebar-link <?php echo e((request()->is('admin/setting/website-setting*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.website-setting')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('file-manager')): ?>
                                <li>
                                    <a href="<?php echo e(route('filemanager.index')); ?>" title="<?php echo e(__('sidebar.file-manager')); ?>" class="sidebar-link <?php echo e((request()->is('admin/setting/file-manager*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.file-manager')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('log-view')): ?>
                                <li>
                                    <a href="/admin/log-reader" title="<?php echo e(__('sidebar.read-logs')); ?>" class="sidebar-link <?php echo e((request()->is('admin/setting/log*')) ? 'active' : ''); ?>">
                                        <span class="hide-menu"><?php echo e(__('sidebar.read-logs')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- /Settings -->

            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\layouts\sidebar.blade.php ENDPATH**/ ?>