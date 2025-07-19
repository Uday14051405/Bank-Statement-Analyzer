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
            <p>This is to confirm that we have received your payment. Please find below the details of your transaction for future reference:</p>

            <div class="table-title">Customer Details</div>
            <table class="table">
            <tr>
                    <th>Deal Number</th>
                    <td>{{ $deal->deal_number ?? '' }}</td>
                </tr>
                <tr>
                    <th>Purchase Date</th>
                    <td>{{ isset($payment_data->purchase_date) ? \Carbon\Carbon::parse($payment_data->purchase_date)->format('M d, Y h:i A') : '' }}</td>
                </tr>
                <tr>
                    <th>Investor Name</th>
                    <td>{{ $payment_data->investor_name ?? '' }}</td>
                </tr>
                <!-- <tr>
                    <th>Customer ID</th>
                    <td>{{ $payment_data->purchase_date ?? '' }}</td>
                </tr> -->
                <tr>
                    <th>Investor Email</th>
                    <td>{{ $payment_data->investor_email ?? '' }}</td>
                </tr>
                <tr>
                    <th>Investor Contact Number</th>
                    <td>{{ $payment_data->investor_mobile ?? '' }}</td>
                </tr>
                <tr>
                    <th>Investor PAN Card</th>
                    <td>{{ $payment_data->investor_pan_number ?? '' }}</td>
                </tr>
                <!-- <tr>
                    <th>Aadhar Card</th>
                    <td>{{ $payment_data->purchase_date ?? '' }}</td>
                </tr> -->
                <!-- <tr>
                    <th>Address</th>
                    <td>{{ $payment_data->purchase_date ?? '' }}</td>
                </tr> -->
            </table>

            <div class="table-title">Transaction Summary</div>
            <table class="table">
                <tr>
                    <th>Transaction ID</th>
                    <td>{{ $payment_data->payments_id ?? '' }}</td>
                </tr>
                <tr>
                    <th>Receipt No</th>
                    <td>{{ $payment_data->receipt_number ?? '' }}</td>
                </tr>

                <tr>
                    <th>Customer Name</th>
                    <td>{{ $deal->customer->company_name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Customer Email</th>
                    <td>{{ $deal->customer->email ?? '' }}</td>
                </tr>
                <tr>
                    <th>Amount Invested (RS)</th>
                    <td>{{ $payment_data->amount ?? '' }}</td>
                </tr>
                <tr>
                    <th>Rate of Interest (%)</th>
                    <td>{{ $deal->yield_returns ?? '' }}</td>
                </tr>
                <tr>
                    <th>Tenure</th>
                    <td>{{ $payment_data->deal_period ?? '' }} Days</td>
                </tr>
                <tr>
                    <th>Maturity Amount (RS)</th>
                    <td>{{ $payment_data->maturity_amount ?? '' }}</td>
                </tr>
                <tr>
                    <th>Repayment Date</th>
                    <td>{{ isset($payment_data->repayment_date) ? \Carbon\Carbon::parse($payment_data->repayment_date)->format('M d, Y') : '' }}</td>
                </tr>
            </table>

            <p>Kindly get in touch with us in case you need any clarifications. Assuring you of our best services at all times.</p>

            <p>Regards,<br>Team Rumbble<br>Phone #: 022-22813137/8<br>Email: info@rumbble.co</p>


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
