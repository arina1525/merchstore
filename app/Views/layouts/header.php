<!DOCTYPE html>
<html>
<head>
    <title>MerchStore</title>
    <link rel="icon"
      type="image/svg+xml"
      href="<?= base_url('assets/images/logo.svg') ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/paper@0.12.17/dist/paper-full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/svg-path-bounding-box@1.0.4/index.min.js"></script>
    <script src="https://unpkg.com/konva@9/konva.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/products.css') ?>">
</head>

<body class="d-flex flex-column min-vh-100">

<?= view('layouts/navbar') ?>

<main class="flex-grow-1">
