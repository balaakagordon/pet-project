<?php

require "authlogic.php";


?>
    <body>
        <form class="auth-form" method="POST" action="/registration.php">
            <h1><u>Registration</u></h1>
            <p class="auth-form-message"><span><?php echo $responseMessage ?></span></p>
            <div class="control">
                <label for="email">First Name</label>
                <input type="text" class="form-input" name="fname" placeholder="First Name" required>
                <span class="error"><?php echo $errorArray['fname']; ?></span>
            </div>
            <div class="control">
                <label for="email">Last Name</label>
                <input type="text" class="form-input" name="lname" placeholder="Last Name" required>
                <span class="error"><?php echo $errorArray['lname']; ?></span>
            </div>
            <div class="control">
                <label for="email">Email</label>
                <input type="text" class="form-input" name="email" placeholder="Email" required>
                <span class="error"><?php echo $errorArray['email']; ?></span>
            </div>
            <div class="control">
                <label for="email">Password</label>
                <input type="password" class="form-input" name="password" placeholder="Password" required>
                <span class="error"><?php echo $errorArray['password']; ?></span>
            </div>
            <div class="control">
                <label for="email">Confirm Password</label>
                <input type="password" class="form-input" name="confpassword" placeholder="Password" required>
                <span class="error"><?php echo $errorArray['confpassword']; ?></span>
            </div>
            <div class="auth-submit">
                <input name="auth" type="hidden" value="registration">
                <button type="submit">Register</button>
            </div>
            <div class="form-options">
                <a href="login">Already have an account?</a>
            </div>
        </form>
    </body>
</html>