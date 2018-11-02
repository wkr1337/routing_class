
<!-- The Modal login -->
<div id="modal-login-div" class="modal">
  <span onclick="document.getElementById('modal-login-div').style.display='none'" 
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <form class="modal-content animate" action="<?= PROOT ?>register/login" method="post">
    <div class="login-image-container">
      <img src="./public/img/man.png" alt="Avatar" class="avatar">
    </div>

    <div class="container-login">
      <label for="userNameLogin"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="passwordLogin"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit" name="loginButton">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container-login" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('modal-login-div').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>