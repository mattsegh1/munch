<!--  When a user submits a request to reset their password, they will receive an e-mail with a link
      that points to the getReset method (typically routed at /password/reset) of the PasswordController.
      This is the view for this e-mail
      The view will receive the $token variable which contains the password reset token to match the user
      to the password reset request. -->

Click here to reset your password: {{ url('password/reset/'.$token) }}