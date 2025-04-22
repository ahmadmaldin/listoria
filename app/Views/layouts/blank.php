<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Link ke CSS Sneat atau custom style yang kamu mau -->
    <link href="<?= base_url('assets/css/sneat.min.css') ?>" rel="stylesheet">
</head>

<body>
    <?= $this->renderSection('content') ?>
</body>

</html>
