<?php $__env->startSection('page_title'); ?>
<?php echo e(__('user.edit.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    #output {
        height: 300px;
        width: 300px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('deal.update', $user->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title"><?php echo e(__('user.index.title')); ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('user.index.title')); ?></a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="<?php echo e(route('users.edit', $user->id)); ?>"><?php echo e(__('user.edit.title')); ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="create-btn pull-right">
                        <button type="submit" class="btn custom-create-btn"><?php echo e(__('default.form.update-button')); ?></button>
                    </div>
                </div>
            </div>
        </div><!-- /card finish -->
    </div><!-- /Page Header -->

    <div class="card-body">

        <div class="row">



            <div class="row">


                <div class="col-md-6 ">
                    <div class="form-group">
                        <label for="deal_number" class="required"><?php echo e(__('default.form.deal_number')); ?>:</label>
                        <input type="text" name="deal_number" id="deal_number" class="form-control <?php $__errorArgs = ['deal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required="required" value="<?php echo e($user->deal_number); ?>" readonly>
                        <?php $__errorArgs = ['deal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select_customer" class="required"><?php echo e(__('default.form.select_customer')); ?></label>

                        <select name="select_customer" id="select_customer" class="select2">
                            <option value="">Select Customer</option>
                            <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($customer->id); ?>" <?php echo e($user->select_customer == $customer->id ? 'selected' : ''); ?>>
                                <?php echo e($customer->company_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>



                        <?php $__errorArgs = ['select_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select_anchor" class="required"><?php echo e(__('default.form.select_anchor')); ?></label>
                        <select name="select_anchor" id="select_anchor" class="select2">
                            <option value="">Select Anchor</option>
                            <!-- Dynamically populated via AJAX -->
                            <?php if($anchors): ?>
                            <?php $__currentLoopData = $anchors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anchor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($anchor->id); ?>" <?php echo e($user->select_anchor == $anchor->id ? 'selected' : ''); ?>>
                                <?php echo e($anchor->company_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>

                        <?php $__errorArgs = ['select_anchor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>









                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_number" class="required"><?php echo e(__('default.form.invoice_number')); ?>:</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control <?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required="required" value="<?php echo e($user->invoice_number); ?>">

                        <?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>




                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_name" class="required"><?php echo e(__('default.form.deal_name')); ?>:</label>
                        <input type="text" name="deal_name" id="deal_name" class="form-control <?php $__errorArgs = ['deal_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('deal_name')); ?>">
                        <?php $__errorArgs = ['deal_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_value" class="required"><?php echo e(__('default.form.invoice_value')); ?>:</label>
                        <input type="number" name="invoice_value" id="invoice_value" class="form-control <?php $__errorArgs = ['invoice_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly required="required" value="<?php echo e($user->invoice_value); ?>">
                        <?php $__errorArgs = ['invoice_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="min_investment_amount" class="required"><?php echo e(__('default.form.min_investment_amount')); ?>:</label>
                        <input type="number" name="min_investment_amount" id="min_investment_amount" class="form-control <?php $__errorArgs = ['min_investment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('min_investment_amount')); ?>">
                        <?php $__errorArgs = ['min_investment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_expiry_date" class="required"><?php echo e(__('default.form.deal_expiry_date')); ?>:</label>
                        <input type="date" name="deal_expiry_date" id="deal_expiry_date" class="form-control <?php $__errorArgs = ['deal_expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('deal_expiry_date')); ?>">
                        <?php $__errorArgs = ['deal_expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_date" class="required"><?php echo e(__('default.form.invoice_date')); ?>:</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required="required" value="<?php echo e($user->formatted_invoice_date_input); ?>" readonly>
                        <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-3">
    <div class="form-group">
        <label for="deal_due_date_days" class="required"><?php echo e(__('default.form.deal_due_date_days')); ?>:</label>
        <input 
            type="number" 
            name="deal_due_date_days" 
            id="deal_due_date_days" 
            class="form-control <?php $__errorArgs = ['deal_due_date_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            value="<?php echo e($user->deal_due_date_days); ?>"
            min="1" 
            max="8" 
            step="1"
            oninput="validity.valid||(value=''); calculateExpiryDate();" 
        >
        <?php $__errorArgs = ['deal_due_date_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="deal_due_date" class="required"><?php echo e(__('default.form.deal_due_date')); ?>:</label>
                        <input type="date" name="deal_due_date" id="deal_due_date" class="form-control <?php $__errorArgs = ['deal_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly required="required" value="<?php echo e($user->formatted_deal_due_date_input); ?>" >
                        <?php $__errorArgs = ['deal_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="invoice_due_date" class="required"><?php echo e(__('default.form.invoice_due_date')); ?>:</label>
                        <input type="date" name="invoice_due_date" id="invoice_due_date" class="form-control <?php $__errorArgs = ['invoice_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->formatted_invoice_due_date_input); ?>">
                        <?php $__errorArgs = ['invoice_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="deal_buffer_days" class="required"><?php echo e(__('default.form.deal_buffer_days')); ?>:</label>
                        <input type="number" name="deal_buffer_days" id="deal_buffer_days" class="form-control <?php $__errorArgs = ['deal_buffer_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  value="<?php echo e($user->deal_buffer_days); ?>">
                        <?php $__errorArgs = ['deal_buffer_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_period" class="required"><?php echo e(__('default.form.deal_period')); ?></label>
                        <!-- <select name="deal_period" id="deal_period" class="select2">
                            <?php $__currentLoopData = $deal_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->value); ?>" <?php echo e($user->deal_period == $role->value ? 'selected' : ''); ?>><?php echo e($role->value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select> -->
                        <input type="number" name="deal_period" id="deal_period" class="form-control <?php $__errorArgs = ['deal_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required="required" value="<?php echo e($user->deal_period); ?>" min="30" max="180" readonly>

                        <input type="hidden" value="<?php echo e($user->deal_period_pending); ?>"  name="deal_period_pending" id="deal_period_pending" >

                        <?php $__errorArgs = ['deal_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="yield_returns" class="required"><?php echo e(__('default.form.yield_returns')); ?>:</label>
                        <input type="number" name="yield_returns" id="yield_returns" class="form-control <?php $__errorArgs = ['yield_returns'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" readonly required="required" value="<?php echo e($user->yield_returns); ?>">
                        <?php $__errorArgs = ['yield_returns'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deal_live_date"><?php echo e(__('default.form.deal_live_date')); ?>:</label>
                        <input type="datetime-local" name="deal_live_date" id="deal_live_date" class="form-control <?php $__errorArgs = ['deal_live_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->deal_live_date1); ?>">
                        <?php $__errorArgs = ['deal_live_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="maturity_amount"><?php echo e(__('default.form.maturity_amount')); ?>:</label>
                        <input type="number" id="maturity_amount" name="maturity_amount" class="form-control" readonly value="<?php echo e($user->yield_returns_amount); ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="repayment_amount"><?php echo e(__('default.form.repayment_amount')); ?>:</label>
                        <input type="number" id="repayment_amount" name="repayment_amount" class="form-control" readonly value="<?php echo e($user->maturity_amount_roundup); ?>">
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="rumbble_score" class="required"><?php echo e(__('default.form.rumbble_score')); ?>:</label>
                        <input type="number" name="rumbble_score" id="rumbble_score" class="form-control <?php $__errorArgs = ['rumbble_score'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('rumbble_score')); ?>">
                        <?php $__errorArgs = ['rumbble_score'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6 hidden" hidden>
                    <div class="form-group">
                        <label for="assign_crm" class="required"><?php echo e(__('default.form.assign_crm')); ?></label>
                        <select name="assign_crm" id="assign_crm" class="select2">
                            <?php $__currentLoopData = $crm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <?php $__errorArgs = ['assign_crm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="upload_invoice" class=""><?php echo e(__('default.form.upload_invoice')); ?>:</label>
                        <input type="file" name="upload_invoice1" id="upload_invoice" class="form-control <?php $__errorArgs = ['upload_invoice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['upload_invoice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <?php if($user->upload_invoice): ?>
                        <a href="<?php echo e(asset('storage/' . $user->upload_invoice)); ?>" target="_blank">View</a>
                        <?php else: ?>

                        <?php endif; ?>
                    </div>
                </div>



            </div>



        </div> <!-- row-end -->

    </div> <!-- card-body-end -->
</form>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>

<script>
function calculateExpiryDate() {
    const daysInput = document.getElementById('deal_due_date_days').value; // Get the number of days
    const days = parseInt(daysInput);

    if (!isNaN(days) && days > 0) {
        // Get today's date
        const today = new Date();

        // Add the number of days to today's date
        const expiryDate = new Date(today);
        expiryDate.setDate(today.getDate() + days);

        // Format the date to 'YYYY-MM-DD' format for the input field
        const formattedDate = expiryDate.toISOString().split('T')[0];

        // Set the calculated expiry date to the deal_due_date input field
        document.getElementById('deal_due_date').value = formattedDate;
    } else {
        // If the number of days is not valid, clear the expiry date
        document.getElementById('deal_due_date').value = '';
    }
}
</script>


<script>
    function calculateAmounts() {
        const invoiceValue = parseFloat(document.getElementById('invoice_value').value) || 0;
        const dealPeriod = parseFloat(document.getElementById('deal_period').value) || 0;
        const yieldReturns = parseFloat(document.getElementById('yield_returns').value) || 0;

        // Calculate interest
        const interest = (invoiceValue * yieldReturns * dealPeriod) / 36500;

        // Calculate maturity amount (principal + interest)
        const maturityAmount = invoiceValue + interest;

        // Calculate repayment amount (maturity amount - 10% of interest)
        const repaymentAmount = maturityAmount - (interest * 0.1);

        document.getElementById('maturity_amount').value = maturityAmount.toFixed(2);
        document.getElementById('repayment_amount').value = repaymentAmount.toFixed(2);
    }

    function calculateAmounts1() {
        const invoiceValue = parseFloat(document.getElementById('invoice_value').value) || 0;
        const dealPeriod = parseFloat(document.getElementById('deal_period_pending').value) || 0;
        const yieldReturns = parseFloat(document.getElementById('yield_returns').value) || 0;

        // Calculate interest
        const interest = (invoiceValue * yieldReturns * dealPeriod) / 36500;

        // Calculate maturity amount (principal + interest)
        const maturityAmount = invoiceValue + interest;

        // Calculate repayment amount (maturity amount - 10% of interest)
        const repaymentAmount = maturityAmount - (interest * 0.1);

        document.getElementById('maturity_amount').value = maturityAmount.toFixed(2);
        document.getElementById('repayment_amount').value = repaymentAmount.toFixed(2);
    }
    // Attach event listeners to the input fields
    document.getElementById('invoice_value').addEventListener('input', calculateAmounts);
    document.getElementById('deal_period').addEventListener('input', calculateAmounts);
    document.getElementById('yield_returns').addEventListener('input', calculateAmounts);
    //document.getElementById('yield_returns').addEventListener('input', calculateAmounts);
</script>
<script>
    $(document).ready(function() {
        calculateAmounts1();
        $('#select_customer').on('change', function() {
            var customerId = $(this).val();

            // Clear previous anchor options
            $('#select_anchor').empty();

            if (customerId) {
                var routeUrl = "<?php echo e(route('anchor.getAnchors', ':customerId')); ?>";
                routeUrl = routeUrl.replace(':customerId', customerId);

                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    success: function(data) {
                        $('#select_anchor').append('<option value="">Select Anchor</option>');
                        $.each(data, function(key, value) {
                            $('#select_anchor').append('<option value="' + value.id + '">' + value.company_name + '</option>');
                        });

                        // Optionally, if there's a previously selected anchor, re-select it.
                        var selectedAnchorId = "<?php echo e($user->select_anchor); ?>";
                        if (selectedAnchorId) {
                            $('#select_anchor').val(selectedAnchorId).trigger('change');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#select_anchor').append('<option value="">Select Anchor</option>');
            }
        });

        // Trigger change on load if customer is already selected
        if ($('#select_customer').val()) {
            $('#select_customer').trigger('change');
        }
    });
</script>

<script>
    var loadFileImageFront = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();
            inputId = 'image1';
            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });
    });

    // input
    let inputId = '';
    let output = 'output';

    // set file link
    function fmSetLink($url) {
        document.getElementById(inputId).value = $url;
        document.getElementById(output).src = $url;
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\deal\edit.blade.php ENDPATH**/ ?>