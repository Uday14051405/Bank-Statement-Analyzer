@php
$setting = \App\Models\Setting::find(1);
@endphp
<!DOCTYPE html>
<html>

<head>

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

            <h1>Dispute Raised for Bank Account</h1>

            <p>Hello Team,</p>

            <p>I am writing to report that, despite system confirmation of a successful transaction, I have not received the credited amount of ₹1 into my account.
            kindly request that you investigate this matter and provide an update.</p>

            <h2>Investor Details</h2>
            <ul>
                <li><strong>Investor Name:</strong> {{ $user->name ?? '' }}</li>
                <li><strong>Investor ID:</strong> {{ $user->name ?? '' }}</li>
                <li><strong>Investor Email:</strong> {{ $user->email ?? '' }}</li>
            </ul>

            <h2>Bank Details</h2>
            <ul>
                <li><strong>Bank Name:</strong> {{ $bankdata->bank_name ?? '' }}</li>
                <li><strong>Account Number:</strong> {{ $bankdata->account_number ?? '' }}</li>
                <li><strong>IFSC Code:</strong> {{ $bankdata->ifsc_code ?? '' }}</li>
                <li><strong>Reference ID:</strong> {{ $bankdata->reference_id ?? '' }}</li>
                <li><strong>Transaction ID:</strong> {{ $bankdata->decentro_txn_id ?? '' }}</li>
            </ul>

            <p>Please take necessary action.</p>

        </div>
    </div>
</body>
</html>