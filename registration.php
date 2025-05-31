<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0" />
    <link rel="website icon" type="png" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Membership registration</title>
</head>

<body  class="register-body">
    <?php include 'navbar.php'; ?>

    <header>
        <div class="header-upper">
            <h1>Be our Member</h1>
            <p class="subtitle">Become a member. Get perks. Love your drinks more.</p>
        </div>
    </header>

    <main>
        <div class="register-image">
            <img src="styles/images/register.png" alt="register-image" class="register-image">
        </div>

        <div class="content-container-register">
            <div class="form-container-register">
                <h2>MEMBER REGISTRATION</h2>

                <form id="register-form" method="POST" action="membership_process.php">
                    <div class="form-register-group">
                        <div class="form-register-row">
                            <div class="form-register-col">
                                <label for="register-first-name">First Name*</label>
                                <input type="text" id="register-first-name" name="register-first-name" required 
                                    placeholder="Enter your first name"
                                    pattern="[A-Za-z]{1,25}" 
                                    title="Alphabetical characters only, max 25 characters"
                                    maxlength="25">
                            </div>
                            <div class="form-register-col">
                                <label for="register-last-name">Last Name*</label>
                                <input type="text" id="register-last-name" name="register-last-name" required 
                                    placeholder="Enter your last name"
                                    pattern="[A-Za-z]{1,25}"
                                    title="Alphabetical characters only, max 25 characters"
                                    maxlength="25">
                            </div>
                        </div>

                        <div class="form-reister-row">
                            <div class="form-register-col">
                                <label for="register-email">Email Address*</label>
                                <input type="email" id="register-email" name="register-email" required 
                                       placeholder="your.email@example.com">
                            </div>
                            <div class="form-register-col">
                                <label for="register-ID">Login ID*</label>
                                <input type="text" id="register-ID" name="register-ID" required 
                                    placeholder="Enter your Login ID"
                                    pattern="[A-Za-z]{1,10}" 
                                    title="Alphabetical characters only, max 10 characters"
                                    maxlength="10">
                            </div>
                            <div class="form-register-col">
                                <label for="register-Password">Password*</label>
                                <input type="text" id="register-Password" name="register-Password" required 
                                    placeholder="Enter your Password"
                                    pattern="[A-Za-z]{1,25}" 
                                    title="Alphabetical characters only, max 25 characters"
                                    maxlength="25">
                            </div>
                        </div>

                        <div class="register-login-link">
                            <p>Already have an account?</p>
                            <a href="login.html" class="login-button">Login</a>
                        </div>

                        <div class="form-register-footer">
                            <button type="reset" class="reset-register-btn">Reset</button>
                            <button type="submit" class="submit-register-btn">Submit</button>
                        </div>

                        <p class="form-register-note">* Join our community by filling out the form below and start enjoying member-only rewards.</p>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>