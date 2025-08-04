<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - CVMaking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }

    .hero {
      background: linear-gradient(145deg, #0d3b66, #6610f2);
      color: white;
      padding: 100px 20px 70px;
      text-align: center;
    }

    .hero h1 {
      font-size: 2.8rem;
      font-weight: 700;
    }

    .section {
      padding: 60px 20px;
    }

    .icon-box {
      background: white;
      border-radius: 15px;
      padding: 30px;
      transition: 0.3s;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .icon-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .icon-box i {
      font-size: 40px;
      color: #0d6efd;
      margin-bottom: 15px;
    }

    .btn-primary {
      background: #0d6efd;
      border: none;
      font-weight: 500;
      /* padding: 12px 30px; */
    }

    .footer {
      background: #fff;
      /* padding: 40px 0 20px; */
      /* text-align: center; */
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.04);
    }

    .footer a {
      margin: 0 10px;
      color: #6c757d;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <?php $user = $this->session->userdata('user_name'); ?>

<nav class="navbar navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">CVMaking</a>
  <div>
    <a href="<?= base_url('Welcome') ?>" class="btn btn-outline-secondary btn-sm me-2">Home</a>
    <a href="<?= base_url('Cvform') ?>" class="btn btn-outline-secondary btn-sm me-2">Create CV</a>
    <a href="<?= base_url('Aboutus') ?>" class="btn btn-outline-primary btn-sm me-2">About Us</a>

    <?php if ($user): ?>
      <span class="btn btn-outline-success btn-sm me-2"><?= $user ?></span>
      <a href="<?= base_url('Logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
    <?php else: ?>
      <a href="<?= base_url('Signin') ?>" class="btn btn-outline-secondary btn-sm me-2">Sign In</a>
      <a href="<?= base_url('Signup') ?>" class="btn btn-outline-secondary btn-sm">Sign Up</a>
    <?php endif; ?>
  </div>
</nav>


  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>About CVMaking</h1>
      <p class="lead">Helping job seekers build professional resumes that win interviews.</p>
    </div>
  </section>

  <!-- Our Story -->
  <section class="section text-center">
    <div class="container">
      <h2 class="mb-4">Our Story</h2>
      <p class="text-muted col-lg-8 mx-auto">
        CVMaking was created to simplify the resume-building process. We understand how stressful job applications can be, so we designed a platform that’s easy to use, quick, and impactful. Whether you're a fresh graduate or a seasoned pro, our tool helps you stand out.
      </p>
    </div>
  </section>

  <!-- Free CV Templates Section -->
  <section class="section bg-light text-center">
    <div class="container">
      <h2 class="mb-4">Free CV Templates</h2>
      <p class="text-muted col-lg-8 mx-auto">
        Discover dozens of modern and professional CV templates — all at no cost. Our templates are crafted by design experts, tailored to different industries and roles. You can easily edit, preview, and download your resume in minutes without technical hassle.
      </p>

      <div class="row mt-5 g-4">
        <div class="col-md-4">
          <div class="icon-box">
            <i class="bi bi-easel"></i>
            <h5 class="mt-3">Easy to Use</h5>
            <p>Step-by-step builder. No design or tech skills needed.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box">
            <i class="bi bi-cloud-download"></i>
            <h5 class="mt-3">Free Download</h5>
            <p>Download your resume instantly in high-quality PDF format.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="icon-box">
            <i class="bi bi-layout-text-sidebar-reverse"></i>
            <h5 class="mt-3">Multiple Templates</h5>
            <p>Pick from classic, modern, and creative layouts tailored to any field.</p>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <a href="<?= base_url('Cvform') ?>" class="btn btn-primary btn-lg">Start Building Your CV</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="container">
      <p class="fw-bold">CVMaking</p>
      <p class="text-muted">Build professional resumes with ease using our customizable CV templates.</p>
      <div class="mb-3">
        <a href="<?= base_url('Welcome') ?>">Home</a>
        <a href="<?= base_url('Cvform') ?>">Create CV</a>
        <a href="<?= base_url('Aboutus') ?>">About Us</a>
        <a href="<?= base_url('Signin') ?>">Sign In</a>
        <a href="<?= base_url('Signup') ?>">Sign Up</a>
      </div>
      <small class="text-muted">© <?= date('Y') ?> CVMaking. All rights reserved.</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
