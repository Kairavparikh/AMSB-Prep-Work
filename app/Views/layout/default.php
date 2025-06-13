<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f8fa;
        }
        .main-content {
            width: 100vw;
            min-height: 100vh;
            padding: 32px 32px 0 32px;
            background: #fff;
            border-radius: 0;
            box-shadow: none;
        }
        h1, h2, h3, h4 {
            font-weight: 700;
        }
        .btn-primary {
            background: #6366f1;
            border: none;
        }
        .btn-primary:hover {
            background: #4f46e5;
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 