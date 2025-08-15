<!DOCTYPE html>
<html>
<head>
    <title>Your CVs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container">
        <h3 class="mb-4">Your CVs are ready!</h3>
        <ul class="list-group">
            <?php foreach ($pdfs as $label => $url): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($label) ?>
                    <div>
                        <a href="<?= htmlspecialchars($url) ?>" target="_blank" class="btn btn-sm btn-primary me-2">View</a>
                        <a href="<?= htmlspecialchars($url) ?>" download class="btn btn-sm btn-success">Download</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
