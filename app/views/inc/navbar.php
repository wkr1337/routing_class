<nav class="navBar" id="navBarId">
        <ul><?php $locationArray = explode('/', htmlspecialchars($_SERVER['PHP_SELF']));
        if(end($locationArray) == 'index.php'): ?>
            <li class="li-hideable"><a href="javascript:scrollToDiv('.header-container')">Home</a></li>
            <li class="li-hideable"><a href="javascript:scrollToDiv('.wrapper')">Projects</a></li>
            <li class="li-hideable"><a href="javascript:scrollToDiv('.wrapper2')">Skills</a></li>
            <li class="li-hideable"><a href="javascript:scrollToDiv('.wrapper3')">Contact</a></li>


            
        <?php endif ?>

        <?php if(end($locationArray) != 'index.php'): ?>
        <li class="li-hideable"><a href="<?= PROOT ?>">Home</a></li>
            <li class="li-hideable"><a href="<?= PROOT ?>">Projects</a></li>
            <li class="li-hideable"><a href="<?= PROOT ?>">Skills</a></li>
            <li class="li-hideable"><a href="<?= PROOT ?>">Contact</a></li>
        <?php endif ?>
            <li class="li-hideable">
                    <form action="<?= PROOT ?>posts/show" method="post">
                        <input id="show-posts-button" type="submit" name="showPostsButton" value="Show posts" />
                    </form>
                </li>

            <!-- Chech if user is logged in -->
            <?php if (!$_SESSION['logged_in']): ?>
            <li class="li-hideable"><a onclick="document.getElementById('modal-register-div').style.display='block'">Register</a></li>
            <li class="li-hideable"><a onclick="document.getElementById('modal-login-div').style.display='block'">Login</a></li>
            <?php endif ?>
            <?php if ($_SESSION['logged_in']): ?>
                <li class="li-hideable">
                    <form action="<?=PROOT ?>posts/create" method="post">

                        <input id="create-post-button" type="submit" name="createPostButton" value="Create post" />
                    </form>
                </li>

                <li class="li-hideable" id="li-logout">
                    <form action="<?=PROOT?>register/logout" method="post">
                        <input id="logout-button" type="submit" name="logoutButton" value="Logout" />
                    </form></li>



                
            <?php endif ?>
            <li><a href="javascript:void(0);" style="font-size:15px;" class="nav-icon" onclick="changeNavigationBar()">&#9776;</a></li>
    </nav>