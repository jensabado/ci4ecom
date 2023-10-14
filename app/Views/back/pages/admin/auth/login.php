<?php $this->extend('back/layout/auth-layout') ?>

<?php $this->section('content') ?>
<div class="login-box bg-white box-shadow border-radius-10">
  <div class="login-title">
    <h2 class="text-center text-primary">Admin Login</h2>
  </div>
  <form id="login-form">
    <div class="alert-div"></div>
    <div class="input-group custom">
      <input type="text" class="form-control form-control-lg form-field" placeholder="Username" name="login_id"
        id="login_id" />
      <div class="input-group-append custom">
        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
      </div>
    </div>
    <div class="d-block text-danger errors" style="font-size: 14px; font-weight: 500;" id="login_id_error"></div>
    <div class="input-group custom">
      <input type="password" class="form-control form-control-lg form-field" placeholder="**********" name="password"
        id="password" />
      <div class="input-group-append custom">
        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
      </div>
    </div>
    <div class="d-block text-danger errors" style="font-size: 14px; font-weight: 500;" id="password_error"></div>
    <div class="row pb-30">
      <div class="col-6">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="remember" />
          <label class="custom-control-label" for="remember">Remember</label>
        </div>
      </div>
      <div class="col-6">
        <div class="forgot-password">
          <a href="<?= route_to('admin.forgot-password') ?>">Forgot Password</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="input-group mb-0">
          <button class="btn btn-primary btn-lg btn-block" type="submit" id="submit_btn">Sign In</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php $this->endSection(); ?>
<?php $this->section('script') ?>
<script>
$(document).ready(function() {
  $('#login-form').on('submit', function(e) {
    e.preventDefault();

    let form = new FormData(this);

    $.ajax({
      type: 'POST',
      url: '<?= route_to('admin.login-handler'); ?>',
      data: form,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function() {
        $('submit_btn').attr('disabled', true);
      },
      complete: function() {
        $('submit_btn').attr('disabled', false);
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
          window.location.href = '<?= route_to('admin.home') ?>';
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
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    })
  })
})
</script>
<?php $this->endSection(); ?>