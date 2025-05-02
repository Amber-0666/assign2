<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
    <link rel="icon" type="image/png" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <header class="enquiry-header">
        <div class="enquiry-header-content">
            <h1>Customer Enquiry</h1>
            <p class="enquiry-subtitle">We're here to help with any questions about our products, services, or activities</p>
        </div>
    </header>

    <main>
        <div class="enquiry-content-container">
            <div class="enquiry-form-container enquiry-form">
                <h2>Enquiry Form</h2>
                
                <form id="enquiry-form">
                    <div class="enquiry-form-group">
                        <div class="enquiry-form-row">
                            <div class="enquiry-form-col">
                                <label for="first-name">First Name*</label>
                                <input type="text" id="first-name" name="first-name" required 
                                       placeholder="Enter your first name"
                                       pattern="[A-Za-z]{1,25}" 
                                       title="Alphabetical characters only, max 25 characters"
                                       maxlength="25">
                            </div>
                            <div class="enquiry-form-col">
                                <label for="last-name">Last Name*</label>
                                <input type="text" id="last-name" name="last-name" required 
                                       placeholder="Enter your last name"
                                       pattern="[A-Za-z]{1,25}"
                                       title="Alphabetical characters only, max 25 characters"
                                       maxlength="25">
                            </div>
                        </div>

                        <div class="enquiry-form-row">
                            <div class="enquiry-form-col">
                                <label for="email">Email Address*</label>
                                <input type="email" id="email" name="email" required 
                                       placeholder="your.email@example.com">
                            </div>
                            <div class="enquiry-form-col">
                                <label for="phone">Phone Number*</label>
                                <input type="tel" id="phone" name="phone" required 
                                       placeholder="0123456789"
                                       pattern="[0-9]{10,10}"
                                       title="10 digit phone number"
                                       maxlength="10">
                            </div>
                        </div>

                        <fieldset class="enquiry-fieldset">
                            <legend>Address Information</legend>
                            <div class="enquiry-form-row">
                                <div class="enquiry-form-col">
                                    <label for="street">Street Address*</label>
                                    <input type="text" id="street" name="street" required 
                                           placeholder="123 Coffee Street"
                                           maxlength="40">
                                </div>
                            </div>
                            <div class="enquiry-form-row">
                                <div class="enquiry-form-col">
                                    <label for="city">City/Town*</label>
                                    <input type="text" id="city" name="city" required 
                                           placeholder="Kuala Lumpur"
                                           maxlength="20">
                                </div>
                                <div class="enquiry-form-col">
                                    <label for="state">State*</label>
                                    <select id="state" name="state" required>
                                        <option value="">Select State</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Penang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        <option value="Labuan">Labuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="enquiry-form-row">
                                <div class="enquiry-form-col">
                                    <label for="postcode">Postcode*</label>
                                    <input type="text" id="postcode" name="postcode" required 
                                           placeholder="50000"
                                           pattern="[0-9]{5}"
                                           title="Exactly 5 digits"
                                           maxlength="5">
                                </div>
                            </div>
                        </fieldset>

                        <div class="enquiry-form-row">
                            <div class="enquiry-form-col">
                                <label for="enquiry-type">Enquiry Type*</label>
                                <select id="enquiry-type" name="enquiry-type" required>
                                    <option value="">Select Enquiry Type</option>
                                    <option value="Membership">Membership</option>
                                    <option value="Products">Products</option>
                                    <option value="Pop-up Market activities">Pop-up Market activities</option>
                                </select>
                            </div>
                        </div>

                        <div class="enquiry-form-row">
                            <div class="enquiry-form-col">
                                <label for="message">Your Message*</label>
                                <textarea id="message" name="message" required 
                                          placeholder="Please provide details about your enquiry"
                                          rows="5"></textarea>
                            </div>
                        </div>

                        <div class="enquiry-form-footer">
                            <button type="reset" class="enquiry-reset-btn">
                                Reset Form
                            </button>
                            <button type="submit" class="enquiry-submit-btn">
                                Submit Enquiry
                            </button>
                            <p class="enquiry-form-note">* Required fields. We'll respond to your enquiry within 2 business days.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
