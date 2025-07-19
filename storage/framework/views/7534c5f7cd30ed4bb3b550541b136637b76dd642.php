<?php $__env->startSection('page_title'); ?>
<?php echo e(__('user.profile.title')); ?> - <?php echo e(Auth::user()->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    #output {
        height: 100px;
        width: 100px;
    }
    .custom-edit-btn {
    padding: .15rem .5rem .10rem .5rem !important;
    
}

</style>

<style>
      .modal-content {
        max-height: 90vh;
    overflow-y: auto;
  
}


.modal-content {
 /*   -ms-overflow-style: none; 
    scrollbar-width: none;   */
}

.modal-content::-webkit-scrollbar {
    width: 8px; /* Adjust width as needed */
}

.modal-content::-webkit-scrollbar-track {
    background: #f1f1f1; /* Track color */
}

.modal-content::-webkit-scrollbar-thumb {
    background: #888; /* Scrollbar color */
    border-radius: 10px; /* Rounded corners */
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #555; /* Scrollbar color on hover */
}

         .modal .close {
            color: #333;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

         .modal .close:hover,
        .modal .close:focus {
            color: #000;
            text-decoration: none;
        }

        #firstLoginModal1 .modal h4 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        #firstLoginModal1 .modal p {
            margin-bottom: 25px;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        #firstLoginModal1 .modal-buttons {
            margin-top: 1px;
        }

        #firstLoginModal1 .modal-buttons button {
            margin: 0 15px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #firstLoginModal1 .modal-buttons .btn-primary {
            background-color: #28a745;
            color: #fff;
        }

        #firstLoginModal1 .modal-buttons .btn-primary:hover {
            background-color: #218838;
        }

        #firstLoginModal1 .modal-buttons .btn-secondary {
            background-color: #dc3545;
            color: #fff;
        }

        #firstLoginModal1 .modal-buttons .btn-secondary:hover {
            background-color: #c82333;
        }

        .icon {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 0px;
        }
    </style>



<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('profile.update', $user->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="card-header">
        <div class="row justify-content-between align-content-between">
            <div class="col-nd-6">
                <h2 class="card-title">
                    <i data-feather="user" style="position: relative; top: -3px;"></i> <?php echo e(Auth::user()->name); ?>

                </h2>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <button type="button" class="btn custom-create-btn" data-toggle="modal" data-target="#bankDetailsModalAdd">
                Add Bank Details
            </button>
            <!-- <button type="button" class="btn custom-create-btn" data-toggle="modal" data-target="#bankDetailsModalCreditAdd">
                Add Card Details
            </button> -->
                    <button type="submit" class="btn custom-create-btn ">
                        <?php echo e(__('default.form.update-button')); ?>

                    </button>

                  
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-md-12">


                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <?php echo e($user->name); ?>, Personal Information
                                </h5>
                            </div>




                            <div class="card-body">

                                <div class="form-group hidden" hidden>
                                    <label for="name" class="required"><?php echo e(__('default.form.name')); ?>:</label>
                                    <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  value="<?php echo e($user->name); ?>">

                                    <?php $__errorArgs = ['name'];
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

                                <div class="form-group">
                                    <label for="gst" class="required"><?php echo e(__('default.form.pan_name')); ?>:</label>
                                    <input type="text" name="pan_name" id="pan_name" class="form-control <?php $__errorArgs = ['pan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->name); ?>" required="required" readonly>

                                    <?php $__errorArgs = ['pan_name'];
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
                                <div class="form-group">
                                    <label for="pan_number" class="required"><?php echo e(__('default.form.pan_number')); ?>:</label>
                                    <input type="text" name="pan_number" id="pan_number" class="form-control <?php $__errorArgs = ['pan_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->pan_number); ?>" required="required" readonly>

                                    <?php $__errorArgs = ['pan_number'];
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

                                <div class="form-group">
                                    <label for="mobile"><?php echo e(__("default.form.mobile")); ?>:</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->mobile); ?>">

                                    <?php $__errorArgs = ['mobile'];
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
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <h5 class="card-header">
                                Authentication
                            </h5>

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="email"><?php echo e(__("default.form.email")); ?>:</label>
                                    <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($user->email); ?>" disabled>

                                    <?php $__errorArgs = ['email'];
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

                                <div class="form-group">
                                    <label for="password"><?php echo e(__("default.form.password")); ?>:</label>
                                    <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                    <?php $__errorArgs = ['password'];
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

                                <div class="form-group">
                                    <label for="password-confirm"><?php echo e(__("default.form.password-confirm")); ?>:</label>
                                    <input type="password" name="confirm-password" id="password-confirm" class="form-control <?php $__errorArgs = ['password-confirm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                    <?php $__errorArgs = ['confirm-password'];
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
                        </div>
                    </div>


                    <div class="col-md-4 ">
                        <div class="card">
                            <div class="input-group mb-1">
                                <?php if(!empty($user->image)): ?>
                                <img src="<?php echo e(asset($user->image)); ?>" alt="User Image" id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='<?php echo e(asset('assets/admin/img/default-user.png')); ?>';">
                                <?php else: ?>
                                <img src="<?php echo e(asset('assets/admin/img/default-user.png')); ?>" alt="User Image" id="output" class="img-thumbnail rounded mx-auto d-block mb-3">
                                <?php endif; ?>

                                <input type="hidden" id="image1" class="form-control" name="image1" value="<?php echo e($user->image ?? ''); ?>">

                                <div class="input-group-append" style="width: 100%;">
                                    <label class="btn btn-secondary btn-md btn-block">
                                        <i data-feather="image" class="feather-icon"></i>
                                        Change User's Image
                                        <input type="file" accept="image/*" style="display: none;" id="button-image" onchange="previewImage(event)" name="image">
                                    </label>
                                </div>
                            </div>

                        </div> <!-- card-end -->
                    </div> <!-- col-md-4-end -->



                    <div class="col-md-4 hidden" hidden>
                        <div class="card">
                            <h5 class="card-header">
                                Role & Permission
                            </h5>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="roles" class="required"><?php echo e(__('default.form.role')); ?></label>
                                    <select name="roles[]" id="roles" class="select2" multiple="multiple">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->name); ?>" <?php echo e($user->hasRole($role->name) ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <?php $__errorArgs = ['roles'];
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
                        </div>
                    </div>
                </div>

            </div> <!-- col-md-12-end -->
        </div> <!-- row-end -->
    </div> <!-- card-end -->
</form>

<div class="card">
        <div class="card-header">
        <div style="display: flex; align-items: center;">
    <h5 style="margin-right: 10px;">Bank Details</h5>
    <button type="button" id="createButton" class="btn custom-create-btn" data-toggle="modal" data-target="#bankDetailsModalAdd">
        <i class="fe fe-plus"></i>
    </button>
</div>

        </div>
        <div class="card-body">
            <table class="table mt-0">
                <thead>
                    <tr>
                       
                        <th>Bank Name</th>
                        <th>IFSC Code</th>
                        <th>Account Number</th>
                        <th>Cheque/Passbook</th>
                        <th>Verified Status</th>
                        <th>Default Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bankDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      
                        <td><?php echo e($detail->bank_name); ?></td>
                        <td><?php echo e($detail->ifsc_code); ?></td>
                        <td><?php echo e($detail->account_number); ?></td>
                      
                        <td>
                       
						<?php if($detail->cheque_passbook): ?>
    <a href="<?php echo e(asset('storage/' . $detail->cheque_passbook)); ?>" target="_blank">View</a>
<?php else: ?>
    
<?php endif; ?>
</td>
<td>
<?php if($detail->status != 'Verified'): ?>
                    <button class="btn btn-primary" onclick="showVerificationModal(<?php echo e($detail->id); ?>)">Click to Verify</button>
                    <?php else: ?>
                    <span style="color:green;font-weight:700"><?php echo e($detail->status); ?></span>
                    <?php endif; ?></td>
<td>
    <?php
        $current_status = ($detail->status_default == 1) ? 'checked' : '';
    ?>
    
    <input type="checkbox" id="status_<?php echo e($detail->id); ?>" class="check" onclick="changeUserStatus(event.target, <?php echo e($detail->id); ?>, '<?php echo e($detail->status); ?>');" <?php echo e($current_status); ?>>
    <label for="status_<?php echo e($detail->id); ?>" class="checktoggle">checkbox</label>
</td>



                        <td>
                        <div style="display: flex; align-items: center;">
    <!-- Edit Button with Icon -->
    <!-- <button class="custom-edit-btn" id="editBtn" data-toggle="modal" data-target="#bankDetailsModal" data-id="<?php echo e($detail->id); ?>">
        <i class="fe fe-pencil"></i>
    </button> -->
    
    <!-- Delete Button with Icon -->
    <form action="<?php echo e(route('bank_details.destroy', $detail->id)); ?>" method="POST" style="display: inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="custom-delete-btn remove-user">
            <i class="fe fe-trash"></i>
        </button>
    </form>
</div>

                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    </div>

    <div class="card hidden" hidden>
        <div class="card-header">
        <div style="display: flex; align-items: center;">
    <h5 style="margin-right: 10px;">Credit Card Details</h5>
    <button type="button" id="createButton" class="btn custom-create-btn" data-toggle="modal" data-target="#bankDetailsModalCreditAdd">
        <i class="fe fe-plus"></i>
    </button>
</div>

        </div>
        <div class="card-body">
            <table class="table mt-0">
                <thead>
                    <tr>
                    <th>Bank Name</th>
                        <th>Credit Card No</th>
                        <th>Credit Card Issuer Name</th>
                      
                      
                    
                        <th>Nick Name</th>
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $creditDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($detail->bank_name_credit); ?></td>
                        <td><?php echo e($detail->credit_card_no); ?></td>
                        <td><?php echo e($detail->credit_bank_name); ?></td>
                        <td><?php echo e($detail->nick_name); ?></td>
                       
                        <td>
                        <div style="display: flex; align-items: center;">
    <!-- Edit Button with Icon -->
    <button class="custom-edit-btn" id="editBtnCredit" data-toggle="modal" data-target="#bankDetailsModalCredit" data-id="<?php echo e($detail->id); ?>">
        <i class="fe fe-pencil"></i>
    </button>
    
    <!-- Delete Button with Icon -->
    <form action="<?php echo e(route('credit_details.destroy', $detail->id)); ?>" method="POST" style="display: inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="custom-delete-btn remove-user">
            <i class="fe fe-trash"></i>
        </button>
    </form>
</div>

                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    </div>




<!-- Single Modal -->

<div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModal" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body" style="text-align:center">
            <div class="icon">
            <img src="<?php echo e(asset('static/media/media.jpg')); ?>" alt="Rupee Icon" />
            </div>
            <h2>Congratulations!</h2>
        <p>
            ₹1 has been successfully credited to your account.
            Please check your bank balance and click the
            "Confirm" button to confirm your account.
        </p>

        <div class="modal-buttons">
                <button id="confirmBtn" class="btn btn-primary">Confirm</button>
                <button id="notReceivedBtn" class="btn btn-secondary">Not Received</button>
            </div>
      

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="verificationModalAdd" tabindex="-1" role="dialog" aria-labelledby="verificationModalAdd" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body" style="text-align:center">
            <div class="icon">
            <img src="<?php echo e(asset('static/media/media.jpg')); ?>" alt="Rupee Icon" />
            </div>
            <h2>Congratulations!</h2>
        <p>
            ₹1 has been successfully credited to your account.
            Please check your bank balance and click the
            "Confirm" button to confirm your account.
        </p>

        <div class="modal-buttons">
                <button id="confirmBtnAdd" class="btn btn-primary">Confirm</button>
                <button id="notReceivedBtnAdd" class="btn btn-secondary">Not Received</button>
            </div>
      

            </div>
        </div>
    </div>
</div>






<!-- Modal HTML -->
<div class="modal fade" id="bankDetailsModal" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalLabel">Edit Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000 !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bankDetailsFormEdit" action="<?php echo e(route('bank_details.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="existing_cheque_passbook" id="existing_cheque_passbook">
                    <input type="hidden" name="existing_bank_id" id="existing_bank_id">
                    <input type="hidden" name="modal_type" value="edit">
                    <div class="form-group hidden" hidden>
                        <label for="credit_card_no">Credit Card No:</label>
                        <input type="text" name="credit_card_no_edit" id="credit_card_no_edit" class="form-control"   value="<?php echo e(old('credit_card_no_edit')); ?>">
                        <?php $__errorArgs = ['credit_card_no_edit'];
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

                    <div class="form-group hidden" hidden>
                        <label for="credit_bank_name">Credit Card Bank Name:</label>
                        <input type="text" name="credit_bank_name_edit" id="credit_bank_name_edit" class="form-control"   value="<?php echo e(old('credit_bank_name_edit')); ?>">
                        <?php $__errorArgs = ['credit_bank_name_edit'];
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

                    <div class="form-group hidden" hidden>
                        <label for="account_holder_name">Account Holder Name:</label>
                        <input type="text" name="account_holder_name_edit" id="account_holder_name_edit" class="form-control"   value="<?php echo e(old('account_holder_name_edit')); ?>">
                        <?php $__errorArgs = ['account_holder_name_edit'];
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

                    <div class="form-group " >
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name_edit" id="bank_name_edit" class="form-control" required  value="<?php echo e(old('bank_name_edit')); ?>">
                        <?php $__errorArgs = ['bank_name_edit'];
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

                    <div class="form-group">
                        <label for="ifsc_code">IFSC Code:</label>
                        <input type="text" name="ifsc_code_edit" id="ifsc_code_edit" class="form-control" required  value="<?php echo e(old('ifsc_code_edit')); ?>">
                        <?php $__errorArgs = ['ifsc_code_edit'];
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

                    <div class="form-group">
                        <label for="account_number">Account Number:</label>
                        <input type="text" name="account_number_edit" id="account_number_edit" class="form-control" required  value="<?php echo e(old('account_number_edit')); ?>">
                        <?php $__errorArgs = ['account_number_edit'];
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

                    <div class="form-group hidden" hidden>
                        <label for="nick_name">Nick Name:</label>
                        <input type="text" name="nick_name_edit" id="nick_name_edit" class="form-control"   value="<?php echo e(old('nick_name_edit')); ?>">
                        <?php $__errorArgs = ['nick_name_edit'];
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

                    <div class="form-group" >
                        <label for="cheque_passbook">Cheque/Passbook:</label>
                        <input type="file" name="cheque_passbook_edit" id="cheque_passbook_edit" class="form-control" >
                        <div id="chequepassstatus">
                        <a id="cheque_pass_view" href="" target="_blank" alt="Cheque / Passbook Upload" >View</a></div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bankDetailsModalCredit" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalLabel">Edit Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000 !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bankDetailsFormEditCredit" action="<?php echo e(route('credit_details.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="existing_cheque_passbook_credit" id="existing_cheque_passbook_credit">
                    <input type="hidden" name="existing_bank_id_credit" id="existing_bank_id_credit">
                    <input type="hidden" name="modal_type_credit" value="edit">

                                        <div class="form-group">
                        <label for="bank_id_credit">Select Bank:</label>
                        <select name="bank_id_credit" id="bank_id_credit" class="form-control" required>
                         
                            <?php $__currentLoopData = $bankDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($bankDetail->id); ?>"><?php echo e($bankDetail->bank_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger" id="bank_id_creditError"></span>
                                               
                        <?php $__errorArgs = ['bank_id_credit'];
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

                  
                    <div class="form-group">
                        <label for="credit_card_no">Credit Card No:</label>
                        <input type="text" name="credit_card_no_edit_credit" id="credit_card_no_edit_credit" class="form-control" required  value="<?php echo e(old('credit_card_no_edit_credit')); ?>">
                        <?php $__errorArgs = ['credit_card_no_edit_credit'];
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

                    <div class="form-group">
                        <label for="credit_bank_name">Credit Card Issuer Name:</label>
                        <input type="text" name="credit_bank_name_edit_credit" id="credit_bank_name_edit_credit" class="form-control" required  value="<?php echo e(old('credit_bank_name_edit_credit')); ?>">
                        <?php $__errorArgs = ['credit_bank_name_edit_credit'];
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

                    <div class="form-group">
                        <label for="nick_name">Nick Name:</label>
                        <input type="text" name="nick_name_edit_credit_credit" id="nick_name_edit_credit" class="form-control" required  value="<?php echo e(old('nick_name_edit_credit_credit')); ?>">
                        <?php $__errorArgs = ['nick_name_edit_credit_credit'];
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

                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bankDetailsModalAdd" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalLabel">Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000 !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bankDetailsFormAdd" action="<?php echo e(route('bank_details.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="existing_cheque_passbook" id="existing_cheque_passbook">
                    <input type="hidden" name="modal_type" value="add">
                    <div class="form-group hidden" hidden>
                        <label for="credit_card_no">Credit Card No:</label>
                        <input type="text" name="credit_card_no" id="credit_card_no" class="form-control"    value="<?php echo e(old('credit_card_no')); ?>">
                        <?php $__errorArgs = ['credit_card_no'];
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

                    <div class="form-group hidden" hidden>
                        <label for="credit_bank_name">Credit Card Bank Name:</label>
                        <input type="text" name="credit_bank_name" id="credit_bank_name" class="form-control"  value="<?php echo e(old('credit_bank_name')); ?>">
                        <?php $__errorArgs = ['credit_bank_name'];
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

                    <div class="form-group hidden" hidden>
                        <label for="account_holder_name">Account Holder Name:</label>
                        <input type="text" name="account_holder_name" id="account_holder_name" class="form-control"   value="<?php echo e(old('account_holder_name')); ?>">
                        <?php $__errorArgs = ['account_holder_name'];
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

                    <div class="form-group">
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control" required  value="<?php echo e(old('bank_name')); ?>">
                        <span id="bank_nameError" class="text-danger"></span>
                        <?php $__errorArgs = ['bank_nameError'];
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

                    <div class="form-group">
                        <label for="ifsc_code">IFSC Code:</label>
                        <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" required  value="<?php echo e(old('ifsc_code')); ?>">
                        <span id="ifsc_codeError" class="text-danger"></span>
                        <?php $__errorArgs = ['ifsc_code'];
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

                    <div class="form-group">
                        <label for="account_number">Account Number:</label>
                        <input type="text" name="account_number" id="account_number" class="form-control" required  value="<?php echo e(old('account_number')); ?>">
                        <span id="account_numberError" class="text-danger"></span>
                        <?php $__errorArgs = ['account_number'];
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

                    <div class="form-group hidden" hidden>
                        <label for="nick_name">Nick Name:</label>
                        <input type="text" name="nick_name" id="nick_name" class="form-control"   value="<?php echo e(old('nick_name')); ?>">
                        <?php $__errorArgs = ['nick_name'];
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

                    <div class="form-group" >
                        <label for="cheque_passbook">Cheque/Passbook:</label>
                        <input type="file" name="cheque_passbook" id="cheque_passbook" class="form-control" >
                       
                    </div>
                    <div class="form-group" style="margin-bottom:0.75rem !important">
                        <span class="text-danger" id="messageError"></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bankDetailsModalCreditAdd" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalLabel">Credit Card Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000 !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bankDetailsFormCreditAdd" action="<?php echo e(route('credit_details.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="existing_cheque_passbook" id="existing_cheque_passbook">
                    <input type="hidden" name="modal_type_credit" value="add">

                    <div class="form-group">
    <label for="bank_id">Select Bank:</label>
    <select name="bank_id" id="bank_id" class="form-control" required>
        <option value="" disabled selected>Select a bank</option>
        <?php $__currentLoopData = $bankDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($bankDetail->id); ?>"><?php echo e($bankDetail->bank_name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger" id="bank_idError"></span>
    <?php $__errorArgs = ['bank_id'];
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

                    <div class="form-group">
                        <label for="credit_card_no">Credit Card No:</label>
                        <input type="text" name="credit_card_no" id="credit_card_no" class="form-control" required  value="<?php echo e(old('credit_card_no')); ?>">
                        <span class="text-danger" id="credit_card_noError"></span>
                        <?php $__errorArgs = ['credit_card_no'];
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

                    <div class="form-group">
                        <label for="credit_bank_name">Credit Card Issuer Name:</label>
                        <input type="text" name="credit_bank_name" id="credit_bank_name" class="form-control" required  value="<?php echo e(old('credit_bank_name')); ?>">
                        <span class="text-danger" id="credit_bank_nameError"></span>
                        <?php $__errorArgs = ['credit_bank_name'];
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

                    <div class="form-group hidden" hidden>
                        <label for="account_holder_name">Account Holder Name:</label>
                        <input type="text" name="account_holder_name" id="account_holder_name" class="form-control"   value="<?php echo e(old('account_holder_name')); ?>">
                        <span class="text-danger" id="account_holder_nameError"></span>
                        <?php $__errorArgs = ['account_holder_name'];
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

                    <div class="form-group hidden" hidden>
                        <label for="bank_name">Linked Bank Name:</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control"   value="<?php echo e(old('bank_name')); ?>">
                        <?php $__errorArgs = ['bank_name'];
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

                    <div class="form-group hidden" hidden>
                        <label for="ifsc_code">IFSC Code:</label>
                        <input type="text" name="ifsc_code" id="ifsc_code_card" class="form-control"  value="<?php echo e(old('ifsc_code')); ?>">
                       
                    </div>

                    <div class="form-group hidden" hidden>
                        <label for="account_number">Account Number:</label>
                        <input type="text" name="account_number" id="account_number" class="form-control"   value="<?php echo e(old('account_number')); ?>">
                        <?php $__errorArgs = ['account_number'];
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

                    <div class="form-group">
                        <label for="nick_name">Nick Name:</label>
                        <input type="text" name="nick_name" id="nick_name" class="form-control" required  value="<?php echo e(old('nick_name')); ?>">
                        <span class="text-danger" id="nick_nameError"></span>
                        <?php $__errorArgs = ['nick_name'];
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

                    <div class="form-group hidden" hidden>
                        <label for="cheque_passbook">Cheque/Passbook:</label>
                        <input type="file" name="cheque_passbook" id="cheque_passbook" class="form-control" >
                    </div>

                   
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="firstLoginModal1" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body" style="text-align:center">
            <div class="icon">
                <i class="fe fe-check-circle"></i>
            </div>
            <h4>Bank details successfully added!!</h4>
            
            <p>Do you want to add more Banks?</p>
            <div class="modal-buttons">
                <button id="yesButton" class="btn btn-primary">Yes</button>
                <button id="noButton" class="btn btn-secondary">No</button>
            </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="firstLoginModal12" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body" style="text-align:center">
            <div class="icon">
                <i class="fe fe-check-circle"></i>
            </div>
            <h4>Card details successfully added!!</h4>
            
            <p>Do you want to add more cards?</p>
            <div class="modal-buttons">
                <button id="yesButtonCredit" class="btn btn-primary">Yes</button>
                <button id="noButtonCredit" class="btn btn-secondary">No</button>
            </div>


            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
 <!-- <div class="modal fade" id="bankDetailsModal" tabindex="-1" role="dialog" aria-labelledby="bankDetailsModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false"> -->
 
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>

<script>
    let currentId = null;
    var firstmodal = new bootstrap.Modal(document.getElementById('verificationModal'), { 
                backdrop: 'static',
                keyboard: false
            });


    function showVerificationModal(id) {
        currentId = id;
        //document.getElementById('verificationModal').style.display = 'block';

       

            firstmodal.show();
    }

    function closeModal() {
        var firstmodal = new bootstrap.Modal(document.getElementById('verificationModal'), { 
                backdrop: 'static',
                keyboard: false
            });

            firstmodal.hide();
        //document.getElementById('verificationModal').style.display = 'none';
    }

    document.getElementById('confirmBtn').addEventListener('click', function (event) {
        submitAction(event, 'confirm');
    });

    document.getElementById('notReceivedBtn').addEventListener('click', function (event) {
        //alert('Hello');
        firstmodal.hide();
        //submitAction(event, 'not_received');
    });

    function submitAction(event, action) {
        event.preventDefault();

        if (action === 'confirm') {
            let url = `<?php echo e(route('bank_details.verify', ':id')); ?>`.replace(':id', currentId);
            // Call the API only for 'confirm' action
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ action: action })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Bank details successfully verified!');
                    location.reload();  // Refresh the page to update status
                } else {
                    alert('An error occurred. Please try again.');
                }
            })
            .catch(error => console.error('Error:', error));
        } else if (action === 'not_received') {
            // Just close the modal for 'not_received' action
            closeModal();
        }
    }
</script>

<script>
    $(document).ready(function () {
    $('#bankDetailsFormCreditAdd').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Create a FormData object for file upload

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // The form's action URL
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Redirect to the profile page with the bank_status parameter
                window.location.href = response.redirect_url;
            },
            error: function (xhr) {
                // Clear previous error messages
                $('.text-danger').text('');

                if (xhr.status === 422) {
                  
                    // Validation failed, loop through the errors
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        var fieldId = field.replace('.', '_');
                        $('#' + fieldId + 'Error').text(messages[0]); // Display the first error message
                    });
                } else {
                    // Handle other errors (e.g., server errors)
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
});

    </script>

<script type="text/javascript">
    function changeUserStatus(_this, id, status_bank) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        let _token = $('meta[name="csrf-token"]').attr('content');
        //alert(status);
        // Check if status is being set to 0 (unchecking the checkbox)
        if (status == 0) {
            // Display an error and revert the checkbox to checked
            toastr.error("You must select a default bank.");
            $(_this).prop('checked', true); // Re-check the checkbox
            return; // Stop further execution
        }

        if (status == 1 && status_bank != 'Verified') {
            // Display an error and revert the checkbox to checked
            toastr.error("You must first verify the bank details and then set one as the default.");
            $(_this).prop('checked', false); // Re-check the checkbox
            return; // Stop further execution
        }



        // If status = 1 (checked), make the API call
        $.ajax({
            url: `<?php echo e(route('bank_status_update')); ?>`,
            type: 'GET',
            data: {
                _token: _token,
                id: id,
                status: status
            },
            success: function(result) {
                // Show success message
                toastr.success(result.message);

                // Automatically uncheck all other checkboxes (banks) to ensure only one is default
                $('input.check').not(_this).prop('checked', false);

                // Optionally, you can add a visual effect or delay here to highlight the newly selected bank
            },
            error: function(xhr) {
                // Handle any errors from the API
                toastr.error("An error occurred while updating the status.");
            }
        });
    }
</script>




<script>
    $(document).ready(function () {
    $('#bankDetailsFormAdd').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Create a FormData object for file upload

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // The form's action URL
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success
                $('#bankDetailsModalAdd').modal('hide'); // Close the modal
                //location.reload(); // Reload the page or redirect as needed
                //window.location.href = response.redirect_url;
                var currentIdAdd = response.bankdetails_id;

                $('#bankDetailsModalAdd').modal('hide');

// Open the verification modal
$('#verificationModalAdd').modal('show');

    let urladd = `<?php echo e(route('bank_details.verify', ':id')); ?>`.replace(':id', currentIdAdd);
    // Handle confirmation click inside the second modal
        $('#confirmBtnAdd').on('click', function () {
        // Make the confirm API call
        $.ajax({
            type: 'POST',
            url: urladd,
            headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            data: {
                // Pass required data, e.g., account_id or bank_id
            },
            success: function (confirmResponse) {
                if (confirmResponse.success) {
                    // Show success message or next modal if needed
                    alert('Bank details successfully verified!');
                    window.location.href = response.redirect_url;
                } else {
                    // Show error modal or message
                    alert('Verification Failed!');
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX error
                alert('An error occurred. Please try again.');
            }
        });
    });

    // Handle 'Not Received' button click
    $('#notReceivedBtnAdd').on('click', function () {
        // Show modal or handle action for 'Not Received'
        //$('#notReceivedModal').modal('show');
        window.location.href = response.redirect_url;
    });








            },
            error: function (xhr) {
                // Clear previous error messages
                $('.text-danger').text('');

                if (xhr.status === 422) {
                    messageError = xhr.responseJSON.message;
                    alert(messageError);
                    $('#messageError').text(messageError);
                    // Validation failed, loop through the errors
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        var fieldId = field.replace('.', '_');
                        $('#' + fieldId + 'Error').text(messages[0]); // Display the first error message
                    });
                } else {
                    // Handle other errors (e.g., server errors)
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
});

</script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var isFirstLogin = <?php echo e($bank_status == 1 ? 'true' : 'false'); ?>;
            var isFirstCardLogin = <?php echo e($bank_status == 7 ? 'true' : 'false'); ?>;
       
        if (isFirstLogin) {
            var firstmodal = new bootstrap.Modal(document.getElementById('firstLoginModal1'), { 
                backdrop: 'static',
                keyboard: false
            });

            var secondModal = new bootstrap.Modal(document.getElementById('bankDetailsModalAdd'), { 
                backdrop: 'static',
                keyboard: false
            });

            var yesButton = document.getElementById('yesButton');
            var noButton = document.getElementById('noButton');
            
            firstmodal.show();
            
            yesButton.onclick = function() {
               // firstModal.hide();\\\
               var modal = document.getElementById('firstLoginModal1');

                $(modal).modal('hide');
                firstmodal.hide();
                secondModal.show();
                //var button = document.getElementById('createButton');
        
        // Simulate a button click
        button.click();
            }
            
            noButton.onclick = function() {
                window.location.href = '<?php echo e(route('profile')); ?>';
            }
                // Disable closing the modal by clicking outside the content
                window.onclick = function(event) {
                    if (event.target == firstmodal) {
                        event.stopPropagation(); // Prevent closing if backdrop is clicked
                    }
                }
                
                // Disable closing the modal with the keyboard
                document.onkeydown = function(event) {
                    if (event.key === 'Escape') {
                        event.preventDefault(); // Prevent the default action of Escape key
                    }
                }
            }
           else if (isFirstCardLogin) {
            var firstmodal = new bootstrap.Modal(document.getElementById('firstLoginModal12'), { 
                backdrop: 'static',
                keyboard: false
            });

            var secondModal = new bootstrap.Modal(document.getElementById('bankDetailsModalCreditAdd'), { 
                backdrop: 'static',
                keyboard: false
            });

            var yesButton = document.getElementById('yesButtonCredit');
            var noButton = document.getElementById('noButtonCredit');
            
            firstmodal.show();
            
            yesButton.onclick = function() {
               // firstModal.hide();\\\
               var modal = document.getElementById('firstLoginModal1');

                $(modal).modal('hide');
                firstmodal.hide();
                secondModal.show();
                //var button = document.getElementById('createButton');
        
        // Simulate a button click
        button.click();
            }
            
            noButton.onclick = function() {
                window.location.href = '<?php echo e(route('profile')); ?>';
            }
                // Disable closing the modal by clicking outside the content
                window.onclick = function(event) {
                    if (event.target == firstmodal) {
                        event.stopPropagation(); // Prevent closing if backdrop is clicked
                    }
                }
                
                // Disable closing the modal with the keyboard
                document.onkeydown = function(event) {
                    if (event.key === 'Escape') {
                        event.preventDefault(); // Prevent the default action of Escape key
                    }
                }
            }
            else{
                var isFirstLoginpopup = <?php echo e($bank_status == 3 ? 'true' : 'false'); ?>;
            //alert(isFirstLogin);
            if (isFirstLoginpopup) {
                // Get the modal
                var secondModalp = new bootstrap.Modal(document.getElementById('bankDetailsModalAdd'), { 
                backdrop: 'static',
                keyboard: false
            });
            secondModalp.show();
            }
        }
        });
    </script>

<script>
    var storageBaseUrl = '<?php echo e(asset("storage/")); ?>';
    document.addEventListener('DOMContentLoaded', function () {
        // Check if there are any validation errors for the add form and open the add modal
        <?php if($errors->hasBag('default') && old('modal_type') == 'add'): ?>
            $('#bankDetailsModalAdd').modal('show');
        <?php endif; ?>

        <?php if($errors->hasBag('default') && old('modal_type_credit') == 'add'): ?>
            $('#bankDetailsModalCreditAdd').modal('show');
        <?php endif; ?>

        // Check if there are any validation errors for the edit form and open the edit modal
        <?php if($errors->hasBag('default') && old('modal_type') == 'edit'): ?>
            $('#bankDetailsModal').modal('show');
        <?php endif; ?>

        <?php if($errors->hasBag('default') && old('modal_type_credit') == 'edit'): ?>
            $('#bankDetailsModalCredit').modal('show');
        <?php endif; ?>
    });
</script>
<script>
   $(document).ready(function() {
    $(document).on('click', '#editBtn', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '<?php echo e(route("bank_details.edit", ":id")); ?>'.replace(':id', userId),
                    type: 'GET',
                    success: function(data) {
                        $('#credit_card_no_edit').val(data.credit_card_no || '');
                    $('#credit_bank_name_edit').val(data.credit_bank_name || '');
                    $('#account_holder_name_edit').val(data.account_holder_name || '');
                    $('#bank_name_edit').val(data.bank_name || '');
                    $('#ifsc_code_edit').val(data.ifsc_code || '');
                    $('#account_number_edit').val(data.account_number || '');
                    $('#nick_name_edit').val(data.nick_name || '');
                    $('#existing_cheque_passbook_edit').val(data.cheque_passbook || '');
                    if (!data.cheque_passbook) {
                // Hide the chequepassstatus div if cheque_passbook is blank or null
                $('#chequepassstatus').hide();
            } else {
                // Set the href and show the div if cheque_passbook is not blank
                $('#cheque_pass_view').attr('href', storageBaseUrl + "/" + data.cheque_passbook);
                $('#chequepassstatus').show();
            }
                    //$('#cheque_pass_view').attr('href', storageBaseUrl +"/"+data.cheque_passbook);
                    $('#existing_bank_id').val(data.id || '');
                    },
                    error: function() {
                        alert('Failed to fetch user details.');
                    }
                });
            });

            $(document).on('click', '#editBtnCredit', function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: '<?php echo e(route("credit_details.edit", ":id")); ?>'.replace(':id', userId),
                    type: 'GET',
                    success: function(data) {
                    $('#credit_card_no_edit_credit').val(data.credit_card_no || '');
                    $('#credit_bank_name_edit_credit').val(data.credit_bank_name || '');
                    $('#account_holder_name_edit_credit').val(data.account_holder_name || '');
                    $('#bank_name_edit_credit').val(data.bank_name || '');
                    $('#ifsc_code_edit_credit').val(data.ifsc_code || '');
                    $('#account_number_edit_credit').val(data.account_number || '');
                    $('#nick_name_edit_credit').val(data.nick_name || '');
                    var bankId = data.bank_id || ''; // Get the bank_id from your data object
                    $('#bank_id_credit').val(bankId).trigger('change');


                    $('#existing_cheque_passbook_edit_credit').val(data.cheque_passbook || '');
                    
                    //$('#cheque_pass_view').attr('href', storageBaseUrl +"/"+data.cheque_passbook);
                    $('#existing_bank_id_credit').val(data.id || '');
                    },
                    error: function() {
                        alert('Failed to fetch user details.');
                    }
                });
            });
});

</script>

<script>
    // Function to preview selected image
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        // Set the hidden input field value to the selected image name or URL
        var imageInput = document.getElementById('image1');
        imageInput.value = event.target.files[0].name; // Update to capture the image name or adjust as needed
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ifscCodeInput = document.getElementById('ifsc_code');
        var panCardInput = document.getElementById('pan_number');

        if (ifscCodeInput) {
            ifscCodeInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }

        if (panCardInput) {
            panCardInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\users\profileedit.blade.php ENDPATH**/ ?>