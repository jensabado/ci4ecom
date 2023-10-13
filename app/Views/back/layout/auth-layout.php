<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('back/vendors/images/apple-touch-icon.png') ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('back/vendors/images/favicon-32x32.png') ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('back/vendors/images/favicon-16x16.png') ?>" />
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('back/vendors/styles/core.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('back/vendors/styles/icon-font.min.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('back/vendors/styles/style.css') ?>" />
  <title><?= isset($pageTitle) ? $pageTitle : 'CI4 Ecommerce' ?></title>
</head>

<body class="login-page">
  <div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="brand-logo">
        <a href="login.html">
          <img src="<?= base_url('back/vendors/images/deskapp-logo.svg') ?>" alt="" />
        </a>
      </div>
      <div class="login-menu">
        <ul>
          <li><a href="register.html">Register</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
          <img src="<?= base_url('back/vendors/images/login-page-img.png') ?>" alt="" />
        </div>
        <div class="col-md-6 col-lg-5">
          <?php $this->renderSection('content') ?>
        </div>
      </div>
    </div>
  </div>
  <!-- js -->
  <script src="<?= base_url('back/vendors/scripts/jquery-3.7.1.min.js') ?>"></script>
  <script src="<?= base_url('back/vendors/scripts/core.js') ?>"></script>
  <script src="<?= base_url('back/vendors/scripts/script.min.js') ?>"></script>
  <script src="<?= base_url('back/vendors/scripts/process.js') ?>"></script>
  <script src="<?= base_url('back/vendors/scripts/layout-settings.js') ?>"></script>
  <script src="<?= base_url('back/vendors/scripts/sweetalert2@11.js') ?>"></script>

  <?php $this->renderSection('script') ?>
</body>

</html>