<p>Dear <?= $mail_data['admin_data']['name'] ?></p>
<p>
  We are received a request to reset password for CI4Ecom account associated with <i><?= $mail_data['admin_data']['email'] ?></i>
  <br>
  You can reset your password by clicking the button below:
  <br><br>
  <a href="<?= $mail_data['actionLink'] ?>" style="padding: 10px 20px; background: #1b00ff !important; text-decoration: none; color: #fff;" target="_blank">Reset Password</a>
  <br><br>
  <b>NB:</b>This link will still valid within 15 minutes.
  <br><br>
  If you did not request for password reset, please ignore this email.
  <br><br>
  <strong>- CI4Ecom</strong>
</p>