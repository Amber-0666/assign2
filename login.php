<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <link rel="website icon" type="png" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>

<body  class="login-body">
    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-upper">
            <h1>Welcome Back</h1>
            <p class="subtitle">Log in to access your rewards and keep the good sips going.</p>
        </div>
    </header>

    <main>
        <div class="login-image">
            <img src="styles/images/login.png" alt="login-image" class="login-image">
        </div>

        <div class="content-container-login">
            <div class="form-container-login">
                <h2>LOGIN</h2>
                <form id="login-form" action="login_process.php" method="post">
                    <div class="form-login-col">
                        <label for="login-ID">Login ID*</label>
                        <input type="text" id="login-ID" name="register-ID" required 
                            placeholder="Enter your Login ID"
                            pattern="[A-Za-z]{1,10}" 
                            title="Alphabetical characters only, max 10 characters"
                            maxlength="10">
                    </div>
                    <div class="form-login-col">
                        <label for="login-Password">Password*</label>
                        <input type="text" id="login-Password" name="login-Password" required 
                            placeholder="Enter your Password"
                            pattern="[A-Za-z]{1,25}" 
                            title="Alphabetical characters only, max 25 characters"
                            maxlength="25">
                    </div>

                <div class="form-login-options">
                    <label class="remember-me">
                      <input type="checkbox" name="remember" />
                      Remember Me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <div class="login-register-link">
                    <p>Don't have an account?</p>
                    <a href="registration.html" class="register-button">Register</a>
                </div>
                
                <div class="form-login-footer">
                    <button type="reset" class="reset-login-btn">Reset</button>
                    <button type="submit" class="submit-login-btn">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>

</body>
    
</html>