<!-- resources/views/error.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .error-title {
            font-size: 72px;
            font-weight: 700;
            color: #dc3545;
        }
        .error-message {
            font-size: 24px;
            margin: 20px 0;
        }
        .error-actions {
            margin-top: 30px;
        }
        .error-actions a {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-title">Oops! Something went wrong.</div>
        <div class="error-message">We're experiencing technical difficulties. Please try again later.</div>
        <div class="error-actions">
            <a href="<?php echo e(url('/')); ?>" class="btn btn-primary">Go to Home</a>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Go Back</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\admin\error.blade.php ENDPATH**/ ?>