<?php

require "authlogic.php";

// $responseMessage = 'test message';

?>

    <body>
        <form class="auth-form" method="POST" action="/">
            <h1><u>User Login</u></h1>
            <p class="auth-form-message"><span><?php echo $responseMessage ?></span></p>
            <div class="control">
                <label for="email">Email</label>
                <input type="text" class="form-input" name="email" placeholder="Enter your email" required>
                <span class="error"> <?php echo $errorArray['email']; ?></span>
            </div>
            <div class="control">
                <label for="email" class="form-label">Password</label>
                <input type="password" class="form-input" name="password" placeholder="Enter your password" required>
                <span class="error"> <?php echo $errorArray['password']; ?></span>
            </div>
            <div class="auth-submit">
                <input name="auth" type="hidden" value="login">
                <button type="submit">Login</button>
            </div>
            <div class="form-options">
                <a href="registration">Don't have an account?</a>
            </div>
        </form>
    </body>
</html>