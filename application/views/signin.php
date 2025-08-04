<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>User Signin</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
  body {
    background: #5a6772;
    font-family: 'Roboto', sans-serif;
    color: #fff;
  }
  .signin-form {
    width: 380px;
    margin: 60px auto;
    padding: 40px 30px;
    background: #2a3548;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
  }
  .signin-form h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    color: #fff;
  }
  .hint-text {
    text-align: center;
    margin-bottom: 30px;
    color: #bbb;
  }
  .form-control {
    border-radius: 6px;
    height: 42px;
    font-size: 14px;
  }
  .btn-submit {
    background: #408ed7ff;
    color: #fff;
    font-weight: 700;
    border-radius: 6px;
    height: 42px;
    transition: background 0.3s ease;
  }
  .btn-submit:hover {
    background: #2e689fff;
    color: #fff;
  }
  .error-message {
    background: #ff4c4c;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 14px;
    text-align: center;
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
  <div class="signin-form">
    <h2>Sign In</h2>
    <p class="hint-text">Sign in to start your session</p>

    <?php echo form_open('Signin', ['name' => 'userregistration', 'autocomplete' => 'off']); ?>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="error-message"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <div class="form-group">
        <?php echo form_input([
          'name' => 'emailid',
          'class' => 'form-control',
          'value' => set_value('emailid'),
          'placeholder' => 'Enter your Email id',
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
        <?php echo form_submit(['name' => 'insert', 'value' => 'Sign In', 'class' => 'btn btn-submit btn-block']); ?>
      </div>

    <?php echo form_close(); ?>

    <div class="text-center">Not Registered Yet? <a href="<?= site_url('Signup'); ?>">Sign up here</a></div>
  </div>
</body>
</html>
