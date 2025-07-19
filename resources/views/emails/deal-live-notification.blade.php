@php
$setting = \App\Models\Setting::find(1);
@endphp
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
   
<style>
    .custom-button {
    padding: .90rem .6rem !important;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
    color: #fff;
    background-color: #4e73df;
    border-color: #4e73df;
}

    .custom-button:hover {
        background-color: #4e73df; /* Darker shade on hover */
        transform: translateY(-3px); /* Slight lift on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .custom-button:active {
        transform: translateY(-1px); /* Slight press effect */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

</head>

<body>
    <div class="email-container">
        <!-- Email Header with Logo -->
        <div class="email-header">
            @if(empty($setting->website_logo_light))
            <img src="{{asset('/assets/admin/img/logo-def.jpg')}}" style="width: 120px;background-color: white;">
            @else
            <img src="{{$setting->website_logo_dark}}" style="width: 120px;">
            @endif
        </div>

        <!-- Email Body -->
        <div class="email-body">
            <p>Dear {{ $investor->name }},</p>
            <p>We are thrilled to inform you that a new investment opportunity is now live on <a href="https://rumbble.co" target="_blank">rumbble.co</a>! As you are our valued investors, you can access this deal at {{ $amountsDeal['formatted_deal_live_date'] ?? '' }} on your active dashboard.</p>
           

            <!-- Customer Details -->
            <div class="table-title">Deal Details:</div>
            <table class="table">
                <tr>
                    <th>Deal Number</th>
                    <td>{{ $deal->deal_number ?? '' }}</td>
                </tr>
                <tr>
                        <th>Investment Amount</th>
                        <td>₹ {{ $deal->invoice_value }}</td>
                    </tr>
                <!-- <tr>
                        <th>Anchor Name</th>
                        <td>{{ $deal->anchor->company_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Deal Date</th>
                        <td>{{ $deal->invoice_date }}</td>
                    </tr>
                   
                    <tr>
                        <th>Invoice</th>
                        <td>
                            @if($deal->upload_invoice)
                            <a href="{{ asset('storage/' . $deal->upload_invoice) }}" target="_blank">View</a>
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th>Invoice Number</th>
                        <td>{{ $deal->invoice_number }} </td>
                    </tr>
                    -->

                    <tr>
                        <th>Expected Returns:</th>
                        <td>₹ {{ $amountsDeal['repayment_amount'] ?? '' }} (excluding TDS)</td>
                    </tr>


                    <tr>
                        <th>Deal Expiry Date</th>
                        <td>{{ $deal->deal_due_date }}</td>
                    </tr>


<!--                     
                    <tr>
                        <th>Yield Returns</th>
                        <td>{{ $deal->yield_returns }} %</td>
                    </tr>
                   
                    <tr>
                        <th>Investment Period (In Days)</th>
                        <td>{{ $deal->deal_period ?? '' }} </td>
                    </tr>
                    <tr>
                        <th>Maturity Amount</th>
                        <td>{{ $amountsDeal['maturity_amount'] ?? '' }} </td>
                    </tr>
                    
                    <tr>
                        <th>Repayment Amount</th>
                        <td>{{ $amountsDeal['repayment_amount'] ?? '' }} </td>
                    </tr>
                    <tr>
                        <th>Repayment Date</th>
                        <td>{{ $amountsDeal['formatted_repayment_date'] ?? '' }} </td>
                    </tr> -->

               
            </table>

<p>To view all the details and invest in this opportunity, simply log in to your <a href="https://rumbble.co/signin" target="_blank">rumbble.co</a> account and head over to your Active Dashboard.</p><br>
<center>


<a href="{{ url('/admin/deal/view_deal/' . $deal->id) }}" style="padding: 0.75rem 0.6rem !important; font-size: 0.875rem; line-height: 1.5; border-radius: 0.2rem; color: #fff; background-color: #4e73df; border: 1px solid #4e73df; text-decoration: none;">View Deal Now</a>


</center>
<br>
            <!-- Contact Information -->
            <p>We recommend acting quickly, as these deals tend to close fast due to high demand!</p>
            <p>Should you have any questions or need assistance, feel free to reach out to our support team.
            </p>
            <p>Thank you for being a part of the rumbble.co investment community. We look forward to your continued success with us!"</p>

            <p>Regards,<br>Team Rumbble<br>Phone #: 022-22813137/8<br>Email: info@rumbble.co</p>

            <!-- Email Footer -->
            <!-- <div class="email-footer">
                <p>*Premature withdrawals are subject to the following conditions:</p>
                <p>1) Premature withdrawals requested before 30 days from the date of investment will be subject to 2.5% deduction on the invested amount.</p>
                <p>2) Premature withdrawals requested in the range of 31 to 60 days will be subject to 2% deduction on the invested amount.</p>
                <p>3) Premature withdrawals requested in the range of 61 to 90 days will be subject to 1.5% deduction on the invested amount.</p>
                <p>4) Premature withdrawals requested within 91 days or under maturity days will be subject to 1% deduction on the invested amount.</p>
            </div> -->
        </div>
    </div>
</body>

</html>
