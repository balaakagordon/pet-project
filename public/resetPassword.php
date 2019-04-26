<?php

if(!isset($_SESSION))
{
    session_start();
}

require "authlogic.php";

include "header.php";
?>

    <body>
        <h1>Reset Password</h1>
        <p><span class="error"><?php echo "" ?></span></p>
        <form method="POST" action="/registration.php">
            <div class="control">
                <label for="email" class="">New Password</label>
                <input type="password" class="" name="password" placeholder="Password" required>
                <span class="error">* <?php echo $errorArray['password']; ?></span>
            </div>
            <div class="control">
                <label for="email" class="">Confirm Password</label>
                <input type="password" class="" name="confpassword" placeholder="Password" required>
                <span class="error">* <?php echo $errorArray['confpassword']; ?></span>
            </div>
            <div class="control">
                <button type="submit">Register</button>
            </div>
        </form>
    </body>
</html>