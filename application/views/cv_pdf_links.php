<!DOCTYPE html>
<html>
<head>
    <title>Download Your CVs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <h3>Your CVs are ready!</h3>
    <ul class="list-group mt-4">
        <?php foreach ($pdfs as $label => $url): ?>
            <li class="list-group-item">
                <?= $label ?> —
                <a href="<?= $url ?>" target="_blank" class="btn btn-sm btn-primary">Download</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
