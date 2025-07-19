<?php
$setting = \App\Models\Setting::find(1);
?>

<!DOCTYPE html>
<html>

<head>
    <!-- <title>Acknowledgement of Your Online Payment</title> -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .email-container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header img {
            max-width: 150px;
        }

        .email-body {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }

        .email-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .email-footer p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table-title {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Email Header with Logo -->
        <div class="email-header">

            <?php if(empty($setting->website_logo_light)): ?>
            <img src="<?php echo e(asset('/assets/admin/img/logo-def.jpg')); ?>" style="width: 120px;background-color: white; ">
            <?php else: ?>
            <img src="<?php echo e($setting->website_logo_dark); ?>" style="width: 120px;">
            <?php endif; ?>
        </div>
        <!-- Email Body -->
        <div class="email-body">
            <p>Dear <?php echo e($user->name); ?>,</p>
            <p>Thank you for choosing Rumbble - India's leading Receivable Sales & Purchase Trading Activity platform.</p>
            <p>Your account has been created successfully.. Please find below the details of your signup for future reference:</p>
            <p>Please find attached a copy of our Agreement, Terms and Cndition  agreed by you on <?php echo e($user->created_at); ?> IST as part of your sign up process.</p>

            <div class="table-title">Customer Details</div>
            <table class="table">

                <tr>
                    <th>Customer Name</th>
                    <td><?php echo e($user->name); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($user->email); ?></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><?php echo e($user->mobile); ?></td>
                </tr>
                <tr>
                    <th>PAN Card</th>
                    <td><?php echo e($user->pan_number); ?></td>
                </tr>
                
                <tr>
                    <th>Account Holder Name</th>
                    <td><?php echo e($user->account_holder_name); ?></td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td><?php echo e($user->account_number); ?></td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td><?php echo e($user->ifsc_code); ?></td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td><?php echo e($user->bank_name); ?></td>
                </tr>
                <tr>
                    <th>Credit Card No</th>
                    <td><?php echo e($user->credit_card_no); ?></td>
                </tr>
                <tr>
                    <th>Credit Card Bank Name</th>
                    <td><?php echo e($user->credit_bank_name); ?></td>
                </tr>
            </table>

          

            <p>Regards,<br>Team Rumbble<br>Phone #: 022-22813137/8<br>Email: info@rumbble.co</p>

           
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\emails\signup_thank_you.blade.php ENDPATH**/ ?>