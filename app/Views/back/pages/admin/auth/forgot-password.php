<?php $this->extend('back/layout/auth-layout') ?>

<?php $this->section('content') ?>
<div class="login-box bg-white box-shadow border-radius-10">
  <div class="login-title">
    <h2 class="text-center text-primary">Forgot Password</h2>
  </div>
  <h6 class="mb-20">
    Enter your email address to reset your password
  </h6>
  <form id="forgot-pass-form">
    <div class="input-group custom">
      <input type="text" class="form-control form-control-lg form-field" placeholder="Email" name="email" id="email">
      <div class="input-group-append custom">
        <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
      </div>
    </div>
    <div class="d-block text-danger errors" style="font-size: 14px; font-weight: 500;" id="email_error"></div>
    <div class="row align-items-center">
      <div class="col-5">
        <div class="input-group mb-0">
          <button class="btn btn-primary btn-lg btn-block" type="submit" id="submit-btn">Submit</button>
        </div>
      </div>
      <div class="col-2">
        <div class="font-16 weight-600 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">
          OR
        </div>
      </div>
      <div class="col-5">
        <div class="input-group mb-0">
          <a class="btn btn-outline-primary btn-lg btn-block" href="<?= route_to('admin.login') ?>"
            id="login-link">Login</a>
        </div>
      </div>
    </div>
  </form>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script') ?>
<script>
$(document).ready(function() {
  $('#forgot-pass-form').on('submit', function(e) {
    e.preventDefault();

    let form = new FormData(this);

    $.ajax({
      type: "POST",
      url: "<?= route_to('admin.forgot-password-handler') ?>",
      data: form,
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('#submit-btn').attr('disabled', true);
        $('#login-link').attr('disabled', true);
      },
      complete: function() {
        $('#submit-btn').attr('disabled', false);
        $('#login-link').attr('disabled', false);
      },
      success: function(res) {
        $('.alert-div').html('');
        $('.errors').text('');
        $('.errors').css({
          "margin-top": "unset",
          "margin-bottom": "unset"
        });
        $('.form-field').removeClass('border-danger');

        if (res.status === 'success') {
          // window.location.href = '<?= route_to('admin.home') ?>';
        } else if (res.status === 'error') {
          for (const [field, errorMessage] of Object.entries(res.message)) {
            $(`#${field}_error`).css({
              "margin-top": "-25px",
              "margin-bottom": "15px"
            });
            $(`#${field}_error`).text(`${errorMessage}`);
            $(`#${field}`).addClass('border-danger');
          }
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: 'Something went wrong.',
            iconColor: '#1b00ff',
            confirmButtonColor: '#1b00ff',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            color: '#000',
            background: '#fff',
          });
        }
      }
    })
  })
})
</script>
<?php $this->endSection() ?>