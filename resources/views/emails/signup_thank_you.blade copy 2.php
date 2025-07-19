@php
    $setting = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Acknowledgement of Your Online Payment</title>
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
        .table th, .table td {
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
            
        @if(empty($setting->website_logo_light))
			<img src="{{asset('/assets/admin/img/logo-def.jpg')}}" style="width: 120px;background-color: white; ">
		@else
			<img src="{{$setting->website_logo_dark}}" style="width: 120px;">
		@endif
        </div>
        <!-- Email Body -->
        <div class="email-body">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for choosing Rumbble - India's leading Receivable Sales & Purchase Trading Activity platform.</p>
            <p>Your account has been created successfully.. Please find below the details of your signup for future reference:</p>

            <div class="table-title">Customer Details</div>
            <table class="table">
                
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Customer ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{ $user->mobile }}</td>
                </tr>
                <tr>
                    <th>PAN Card</th>
                    <td>{{ $user->pan_card }}</td>
                </tr>
                <tr>
                    <th>Aadhar Card</th>
                    <td>{{ $user->aadhar_card }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <!-- Additional Fields -->
                <tr>
                    <th>Account Holder Name</th>
                    <td>{{ $user->account_holder_name }}</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>{{ $user->account_number }}</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>{{ $user->ifsc_code }}</td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td>{{ $user->bank_name }}</td>
                </tr>
                <tr>
                    <th>Credit Card No</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Credit Bank Name</th>
                    <td>{{ $user->credit_bank_name }}</td>
                </tr>
            </table>

            <div class="table-title">Transaction Summary</div>
            <table class="table">
                <tr>
                    <th>Transaction ID</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Receipt No</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Vendor ID</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Enterprise Name</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Amount Invested (RS)</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Rate of Interest (%)</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Tenure</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Maturity Amount (RS)</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
                <tr>
                    <th>Repayment Date</th>
                    <td>{{ $user->credit_card_no }}</td>
                </tr>
            </table>

            <p>Kindly get in touch with us in case you need any clarifications. Assuring you of our best services at all times.</p>

            <p>Regards,<br>Team Rumbble<br>Toll Free #: 1800-258-4488<br>Email: info@rumbble.com</p>

            <div class="email-footer">
                <p>*Premature withdrawals are subject to the following conditions:</p>
                <p>1) Premature withdrawals requested before 30 days from the date of investment will be subject to 2.5% deduction on the invested amount.</p>
                <p>2) Premature withdrawals requested in the range of 31 to 60 days will be subject to 2% deduction on the invested amount.</p>
                <p>3) Premature withdrawals requested in the range of 61 to 90 days will be subject to 1.5% deduction on the invested amount.</p>
                <p>4) Premature withdrawals requested in the range of 91 under maturity days will be subject to 1% deduction on the invested amount.</p>
            </div>
        </div>
    </div>
</body>
</html>
