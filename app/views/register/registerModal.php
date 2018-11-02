<!-- REGISTER SECTION -->
<div id="modal-register-div" class="modal-register">
  <span onclick="document.getElementById('modal-register-div').style.display='none'" class="close
  " title="Close Modal">&times;</span>
  <form class="modal-register-content animate" action="<?=PROOT?>register/register" method="post">
    <div class="container-login">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p><br>
      <label for="email"><b>Username</b></label>
      <input type="text" placeholder="Enter username" name="username" required>

      <label for="email"><b>Email</b></label>
      <input id="emailRegister" type="text" placeholder="Enter Email" name="email" onkeyup="validate();" required>
      <span id="validateResultMessage" class="validateResultMessage"></span><br>

      <label for="password_1"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password_1" id ="password_1" onkeyup="checkPassword(); return false;" required>

      <label for="password_2"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="password_2" id ="password_2" onkeyup="checkPassword(); return false;" required>
      <span id="confirmMessage" class="confirmMessage"></span><br>
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('modal-register-div').style.display='none'" class="cancelbtn-register">Cancel</button>
        <button type="submit" class="signupbtn" name="registerButton">Sign Up</button>
      </div>
    </div>
  </form>
</div>
