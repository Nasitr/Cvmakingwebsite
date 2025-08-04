<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background-color: #f5f7fa;
    font-family: 'Segoe UI', sans-serif;
  }

  .cv-form-card {
    background: #fff;
    padding: 40px 30px;
    margin-top: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    max-width: 900px;
  }

  .section-heading {
    font-size: 1.3rem;
    color: #004085;
    margin-bottom: 20px;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 5px;
  }

  .form-label {
    font-weight: 500;
    margin-bottom: 6px;
  }

  .form-control {
    border-radius: 8px;
  }

  .form-section {
    margin-bottom: 30px;
  }

  .btn-primary {
    background-color: #004085;
    border: none;
    font-weight: bold;
    padding: 12px;
    border-radius: 10px;
    transition: background 0.3s;
  }

  .btn-primary:hover {
    background-color: #002f5e;
  }
</style>
  <!-- #region -->

<?php $user = $this->session->userdata('user_name'); ?>

<nav class="navbar navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">CVMaking</a>
  <div>
    <a href="<?= base_url('Welcome') ?>" class="btn btn-outline-secondary btn-sm me-2">Home</a>
    <a href="<?= base_url('Cvform') ?>" class="btn btn-outline-primary btn-sm me-2">Create CV</a>
    <a href="<?= base_url('Aboutus') ?>" class="btn btn-outline-secondary btn-sm me-2">About Us</a>

    <?php if ($user): ?>
      <span class="btn btn-outline-success btn-sm me-2"><?= $user ?></span>
      <a href="<?= base_url('Logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
    <?php else: ?>
      <a href="<?= base_url('Signin') ?>" class="btn btn-outline-secondary btn-sm me-2">Sign In</a>
      <a href="<?= base_url('Signup') ?>" class="btn btn-outline-secondary btn-sm">Sign Up</a>
    <?php endif; ?>
  </div>
</nav>

  <div class="container">
  <form class="cv-form-card mx-auto" action="<?= base_url('Cvform/submit') ?>" method="POST" enctype="multipart/form-data">
    <h3 class="text-center mb-4 text-primary">🌟 CV Builder Form</h3>

    <!-- Personal Information -->
    <div class="form-section">
      <div class="section-heading">👤 Personal Information</div>

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="full_name" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Designation</label>
          <input type="text" class="form-control" name="designation" placeholder="e.g., Software Developer" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input type="tel" class="form-control" name="phone" required>
        </div>
        <div class="col-12">
          <label class="form-label">Address</label>
          <textarea class="form-control" name="address" rows="2" required></textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Profile Image</label>
          <input type="file" class="form-control" name="profile_image" accept="image/*">
        </div>
        <div class="col-12">
          <label class="form-label">Career Objective</label>
          <textarea class="form-control" name="objective" rows="3" required></textarea>
        </div>
      </div>
    </div>

    <!-- Education -->
    <div class="form-section">
      <div class="section-heading">🎓 Education</div>
      <?php for ($i = 0; $i < 2; $i++) : ?>
      <div class="row g-3 mb-3">
        <div class="col-md-4">
          <input type="text" name="education[<?= $i ?>][institute]" class="form-control" placeholder="School / University">
        </div>
        <div class="col-md-4">
          <input type="text" name="education[<?= $i ?>][year]" class="form-control" placeholder="Year (e.g., 2020)">
        </div>
        <div class="col-md-4">
          <input type="text" name="education[<?= $i ?>][course]" class="form-control" placeholder="Course Name">
        </div>
      </div>
      <?php endfor; ?>
    </div>

    <!-- Work Experience -->
    <div class="form-section">
      <div class="section-heading">💼 Work Experience</div>
      <?php for ($i = 0; $i < 2; $i++) : ?>
      <div class="row g-3 mb-3">
        <div class="col-md-3">
          <input type="text" name="work_experience[<?= $i ?>][company]" class="form-control" placeholder="Company Name">
        </div>
        <div class="col-md-3">
          <input type="date" name="work_experience[<?= $i ?>][start_date]" class="form-control">
        </div>
        <div class="col-md-3">
          <input type="date" name="work_experience[<?= $i ?>][end_date]" class="form-control">
          <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="work_experience[<?= $i ?>][present]" value="1">
            <label class="form-check-label">Present</label>
          </div>
        </div>
        <div class="col-md-3">
          <input type="text" name="work_experience[<?= $i ?>][job_title]" class="form-control" placeholder="Job Title">
        </div>
      </div>
      <?php endfor; ?>
    </div>

    <!-- Skills -->
    <div class="form-section">
      <div class="section-heading">🛠 Skills</div>
      <input type="text" class="form-control" name="skills" placeholder="e.g., HTML, CSS, JavaScript">
    </div>

    <!-- Certifications -->
    <div class="form-section">
      <div class="section-heading">📜 Certifications</div>
      <div class="row g-2">
        <?php for ($i = 0; $i < 4; $i++) : ?>
          <div class="col-md-3">
            <input type="text" class="form-control" name="certifications[<?= $i ?>]" placeholder="Certification <?= $i + 1 ?>">
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Languages -->
    <div class="form-section">
      <div class="section-heading">🌍 Languages Known</div>
      <div class="row g-2">
        <?php for ($i = 0; $i < 4; $i++) : ?>
          <div class="col-md-3">
            <input type="text" class="form-control" name="languages[<?= $i ?>]" placeholder="Language <?= $i + 1 ?>">
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Hobbies -->
    <div class="form-section">
      <div class="section-heading">🎯 Hobbies</div>
      <div class="row g-2">
        <?php for ($i = 0; $i < 4; $i++) : ?>
          <div class="col-md-3">
            <input type="text" class="form-control" name="hobbies[<?= $i ?>]" placeholder="Hobby <?= $i + 1 ?>">
          </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Submit -->
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary w-100">🚀 Submit & Generate CV</button>
    </div>
  </form>
</div>
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
