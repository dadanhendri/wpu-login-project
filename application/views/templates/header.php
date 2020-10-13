<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/all.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css'; ?>">
    <script src="<?php echo base_url() . 'assets/js/jquery-3.4.1.min.js'; ?>"></script>
    <title><?= $title ?></title>
</head>

<body>
    <!-- awal navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url() . 'assets/img/logo_small.png' ?>" alt="logo brand" title="Memurni Store">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-uppercase mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Designer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>

                <a class="nav-link text-white" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    My Cart (<span>12</span>)</a>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->