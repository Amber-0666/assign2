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
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.html"><img src="styles/images/logo.png" alt="styles/images/logo.png"></a>
        </div>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span>
                <span></span>
                <span></span>
            </label>
            
        <ul class="nav-menu">
            <li class="nav-dropdown">
                <a href="#" class="nav-dropbtn">PRODUCTS</a>
                <div class="nav-dropdown-content">
                    <a href="product1.html">Basic Brew</a>
                    <a href="product2.html">Artisan Brew</a>
                    <a href="product3.html">Non-Coffee</a>
                    <a href="product4.html">Hot Beverages</a>
                </div>
            </li>

            <li class="nav-dropdown">
                <a href="#" class="nav-dropbtn">ACTIVITIES</a>
                <div class="nav-dropdown-content">
                    <a href="coming_soon.html">Coming Soon</a>
                    <a href="current.html">Current Activities</a>
                    <a href="past_activities.html">Past Activities</a>
                </div>
            </li>

            <li ><a href="joinus.html">JOIN US</a></li>                
            <li><a href="enquiry.html">ENQUIRY FORM</a></li>
            <li><a href="registration.html">MEMBERSHIP REGISTRATION</a></li>
            <li><a href="login.html" class="active">LOGIN</a></li>  
       </ul>
    </nav>

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
            </div>
        </div>
    </main>
    
    <footer class="footer">
        <div class="footer_container">
            <div class="footer_row">
                <div class="footer_logo">
                    <a href="index.html"><img src="styles/images/logo.png" alt="styles/images/logo.png"></a>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">TEAM</h4>
                    <ul class="footer_ul">
                        <li><a href="Chua_profile.html">Chua Yong Kang</a></li>
                        <li><a href="Roxas_profile.html">Roxas Teo Xuan Hao</a></li>
                        <li><a href="Michelle_profile.html">Michelle Tan Mei Xuan</a></li>
                        <li><a href="Amberlyn_profile.html">Amberlyn Lim Xi En</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">PRODUCTS</h4>
                    <ul class="footer_ul">
                        <li><a href="product1.html">Basic Brew</a></li>
                        <li><a href="product2.html">Artisan Brew</a></li>
                        <li><a href="product3.html">Non-Coffee</a></li>
                        <li><a href="product4.html">Hot Beverages</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">ACTIVITIES</h4>
                    <ul class="footer_ul">
                        <li><a href="coming_soon.html">Coming Soon</a></li>
                        <li><a href="current.html">Current Activities</a></li>
                        <li><a href="past_activities.html">Past Activities</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <div class="footer-quick-links-1">
                        <h4 class="footer-h4"><a href="joinus.html">JOIN US</a></h4>
                        <h4 class="footer-h4"><a href="enquiry.html">ENQUIRY FORM</a></h4>
                        <h4 class="footer-h4"><a href="registration.html">MEMBERSHIP REGISTRATION</a></h4>
                        <h4 class="footer-h4"><a href="login.html">LOGIN</a></h4>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="footer-quick-links-1">
                    <h4 class="footer-h4"><a href="acknowledgement.html">ACKNOWLEDGEMENT</a></h4>
                    <h4 class="footer-h4"><a href="enhancement.html">ENHANCEMENT</a></h4>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">FOLLOW US</h4>
                    <div class="footer-social-links">
                        <a href="https://www.facebook.com/share/18M9JEQBPr/"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/brewngo.coffee/"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-h4">CONTACT US FOR ORDER!</h4>
                    <div class="footer-whatsapp">
                        <a href="https://api.whatsapp.com/send?phone=601116531886&text=Hello%2C%20I%20want%20to%20pre-order%20%F0%9F%98%84%0ADate%3A%20%0A%0A1.%20Order%3A%20%0A-%20%0A-%0A%0A2.%20Pick-up%2FDelivery%0APick-up%20Point%20%F0%9F%9B%8D%EF%B8%8F%20%0A%5B%20%5D%20Old%20KPJ%20Hospital%20(opposite%20stutong%20market)%0A%0ADelivery%20%F0%9F%9A%99%20%0A%5B%20%5D%20Jalan%20Song%0A%5B%20%5D%20BDC%20%0A%5B%20%5D%20101%20%0A%5B%20%5D%20Tabuan%20Area%20%0A%5B%20%5D%20Swinburne%20%0A%0A3.%20Time%20%E2%8F%B0%20%0A%5B%20%5D%2011.30am%20%0A%5B%20%5D%2012.30pm%20%0A%5B%20%5D%201.30pm%20%0A%5B%20%5D%202.30pm%20%0A%5B%20%5D%203.30pm%20%0A%5B%20%5D%204pm%20(last%20order)"><i class='bx bx-mobile'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
    
</html>
    
            

