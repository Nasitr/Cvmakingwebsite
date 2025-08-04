<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .hero {
            padding: 80px 0;
            /* background: #ffffff; */
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #0d3b66;
        }

        .hero p {
            font-size: 1.1rem;
            color: #555;
        }

        .hero img {
            max-width: 100%;
            border-radius: 15px;
        }

        .templates-section {
            background: #0d3b66;
            color: white;
            padding: 60px 0;
        }

        .templates-section h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .template-img {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .template-img:hover {
            transform: scale(1.05);
        }

        .features-section {
            padding: 60px 20px;
            background-color: #f0f2f5;
        }

        .feature-card {
            background: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .cta-section {
            background: #e0ecff;
            padding: 50px 20px;
            text-align: center;
        }

        .trust-section {
            padding: 30px 0;
            background: #ffffff;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php $user = $this->session->userdata('user_name'); ?>

<nav class="navbar navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">CVMaking</a>
  <div>
    <a href="<?= base_url('Welcome') ?>" class="btn btn-outline-primary btn-sm me-2">Home</a>
    <a href="<?= base_url('Cvform') ?>" class="btn btn-outline-secondary btn-sm me-2">Create CV</a>
    <a href="<?= base_url('Aboutus') ?>" class="btn btn-outline-secondary btn-sm me-2">About Us</a>

    <?php if (!empty($username)): ?>
  <span class="btn btn-outline-success btn-sm me-2"><?= htmlspecialchars($username) ?></span>
  <a href="<?= base_url('Logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
<?php else: ?>
  <a href="<?= base_url('Signin') ?>" class="btn btn-outline-secondary btn-sm me-2">Sign In</a>
  <a href="<?= base_url('Signup') ?>" class="btn btn-outline-secondary btn-sm">Sign Up</a>
<?php endif; ?>

  </div>
</nav>


    <!-- Hero Section -->
    <section class="hero container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>The CV that gets the job... done</h1>
                <p>Build a new CV or improve your existing one with step-by-step expert guidance.</p>
                <a href="<?= base_url('Cvform') ?>" class="btn btn-success mt-3">Create your CV</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="assets/images/2151998069.jpg" alt="CV builder preview">
            </div>
        </div>
    </section>

    <!-- Templates Section -->
    <section class="templates-section text-center">
        <div class="container">
            <h2>Templates to win recruiters over</h2>
            <p>Choose from 40+ professional CV templates</p>
            <div class="row mt-4 justify-content-center g-3">
                <div class="col-6 col-md-3">
                    <img class="template-img img-fluid" src="assets/images/1.jpg" alt="Template 1">
                </div>
                <div class="col-6 col-md-3">
                    <img class="template-img img-fluid" src="assets/images/5.jpg" alt="Template 2">
                </div>
                <div class="col-6 col-md-3">
                    <img class="template-img img-fluid" src="assets/images/3.jpg" alt="Template 3">
                </div>
                <div class="col-6 col-md-3">
                    <img class="template-img img-fluid" src="assets/images/4.jpg" alt="Template 4">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section text-center">
        <div class="container">
            <h3 class="mb-5 text-primary">Easiest and most feature-packed CV builder</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card feature-card p-4">
                        <h5>Why Choose us?</h5>
                        <p class="text-muted">We’ve designed our CV builder to be intuitive, fast, and packed with everything you need.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card p-4">
                        <h5>Build Smarter</h5>
                        <p class="text-muted">Our tools take the guesswork out of CV writing with guided steps, tips, and polished templates.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card p-4">
                        <h5>Your Career Deserves</h5>
                        <p class="text-muted">With professional layouts you can create a job-winning CV in minutes.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card feature-card p-4">
                        <h5>Multiple template</h5>
                        <p class="text-muted">Choose from a range of simple and professional CV templates to suit any job or industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action -->
    <section class="cta-section">
        <h4 class="mb-4">A jobseeker in your area just selected this CV template</h4>
        <a href="<?= base_url('Cvform') ?>" class="btn btn-primary">Select your own</a>
    </section>

    <!-- Trust Section -->
    <footer class="bg-white text-center text-lg-start shadow-sm mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 mb-3 mb-lg-0 text-start">
                <h6 class="text-uppercase fw-bold">CVMaking</h6>
                <p class="text-muted mb-0">Build professional resumes with ease using our customizable CV templates.</p>
            </div>
            <div class="col-lg-6 text-end">
                <a href="<?= base_url('Welcome') ?>" class="text-muted me-3">Home</a>
                <a href="<?= base_url('Cvform') ?>" class="text-muted me-3">Create CV</a>
                <a href="<?= base_url('Aboutus') ?>" class="text-muted me-3">About Us</a>
                <a href="<?= base_url('Signin') ?>" class="text-muted me-3">Sign In</a>
                <a href="<?= base_url('Signup') ?>" class="text-muted">Sign Up</a>
            </div>
        </div>
    </div>
    <div class="bg-light text-center py-2">
        <small class="text-muted">© <?= date('Y') ?> CVMaking. All rights reserved.</small>
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
