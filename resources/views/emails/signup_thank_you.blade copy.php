<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Signing Up</title>
</head>
<body>
    <h1>Thank You for Signing Up, {{ $user->name }}!</h1>
    <p>Your bank details have been successfully saved. Here are your details:</p>

    <table border="1" cellpadding="10" cellspacing="0">
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
        <tr>
            <th>Nick Name</th>
            <td>{{ $user->nick_name }}</td>
        </tr>
    </table>

    <p>Thank you for trusting us!</p>
</body>
</html>
