<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" />
<title>User Registration</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
  body {
    background: #5a6772;
    font-family: 'Roboto', sans-serif;
    color: #fff;
  }
  .signup-form {
    max-width: 420px;
    margin: 50px auto;
    background: #2a3548;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }
  .signup-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #408ed7ff;
    font-weight: 700;
  }
  .hint-text {
    text-align: center;
    margin-bottom: 25px;
    color: #bbb;
  }
  .form-control {
    border-radius: 6px;
    height: 42px;
    font-size: 14px;
  }
  .btn-submit {
    background: #408ed7ff;
    color: #2a3548;
    font-weight: 700;
    border-radius: 6px;
    height: 42px;
    transition: background 0.3s ease;
  }
  .btn-submit:hover {
    background: #2f6aa1ff;
    color: #1a2233;
  }
  .form-group > .row > .col {
    padding-left: 5px;
    padding-right: 5px;
  }
  .error-message, .success-message {
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 14px;
    text-align: center;
  }
  .error-message {
    background: #ff4c4c;
    color: white;
  }
  .success-message {
    background: #4CAF50;
    color: white;
  }
  .text-center a {
    color: #408ed7ff;
    text-decoration: underline;
  }
  .text-center a:hover {
    text-decoration: none;
  }
</style>
</head>
<body>
  <div class="signup-form">
    <h2>Register</h2>
    <p class="hint-text">Create your account. It's free and only takes a minute.</p>

    <?php echo form_open('Signup', ['name' => 'userregistration', 'autocomplete' => 'off']); ?>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="success-message"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="error-message"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="form-group">
      <div class="row">
        <div class="col-6">
          <?php echo form_input([
            'name' => 'firstname',
            'class' => 'form-control',
            'value' => set_value('firstname'),
            'placeholder' => 'First Name',
            'type' => 'text'
          ]); ?>
          <?php echo form_error('firstname', "<div style='color:#ff4c4c; font-size:13px'>", "</div>"); ?>
        </div>
        <div class="col-6">
          <?php echo form_input([
            'name' => 'lastname',
            'class' => 'form-control',
            'value' => set_value('lastname'),
            'placeholder' => 'Last Name',
            'type' => 'text'
          ]); ?>
          <?php echo form_error('lastname', "<div style='color:#ff4c4c; font-size:13px'>", "</div>"); ?>
        </div>
      </div>
    </div>

    <div class="form-group">
      <?php echo form_input([
        'name' => 'emailid',
        'class' => 'form-control',
        'value' => set_value('emailid'),
        'placeholder' => 'Email Address',
        'type' => 'email'
      ]); ?>
      <?php echo form_error('emailid', "<div style='color:#ff4c4c; font-size:13px'>", "</div>"); ?>
    </div>

    <div class="form-group">
      <?php echo form_password([
        'name' => 'password',
        'class' => 'form-control',
        'value' => set_value('password'),
        'placeholder' => 'Password'
      ]); ?>
      <?php echo form_error('password', "<div style='color:#ff4c4c; font-size:13px'>", "</div>"); ?>
    </div>

    <div class="form-group">
      <?php echo form_password([
        'name' => 'confirmpassword',
        'class' => 'form-control',
        'value' => set_value('confirmpassword'),
        'placeholder' => 'Confirm Password'
      ]); ?>
      <?php echo form_error('confirmpassword', "<div style='color:#ff4c4c; font-size:13px'>", "</div>"); ?>
    </div>

    <div class="form-group">
      <?php echo form_submit(['name' => 'insert', 'value' => 'Register', 'class' => 'btn btn-submit btn-block']); ?>
    </div>

    <?php echo form_close(); ?>

    <div class="text-center">Already have an account? <a href="<?= site_url('Signin'); ?>">Sign in</a></div>
  </div>
</body>
</html>
