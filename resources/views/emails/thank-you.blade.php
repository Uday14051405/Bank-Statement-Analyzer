<h1>Thank You for Contacting Us</h1>
<p>Dear {{ $contact->business_name }},</p>
<p>Thank you for reaching out. We have received your message and will get back to you shortly.</p>
<p><strong>Your Details:</strong></p>
<ul>
    <li><strong>Contact Number:</strong> {{ $contact->contact_number }}</li>
    <li><strong>Email:</strong> {{ $contact->email }}</li>
    <li><strong>No. of Bank Statements:</strong> {{ $contact->bank_statements_count }}</li>
</ul>
<p>Best regards,</p>
<p>Your Company Name</p>
