<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Team</title>
    <link rel="icon" type="image/png" href="styles/images/websitelogo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <header class="joinus-header">
        <div class="joinus-header-content">
            <h1>Join Our Coffee Community</h1>
            <p class="joinus-subtitle">Be part of our passionate team and start your journey in the world of specialty coffee</p>
        </div>
    </header>

    <main>
        <div class="joinus-content-container">
            <div class="joinus-image-left"> 
                <img src="styles/images/brew1.PNG" alt="Coffee preparation">
            </div>

            <div class="joinus-form-container">
                <h2>Application Form</h2>
                
                <form id="join-form" action="joinus_process.php" method="post" enctype="multipart/form-data">
                    <div class="joinus-form-group">
                        <div class="joinus-form-row">
                            <div class="joinus-form-col">
                                <label for="first-name" class="joinus-label">First Name*</label>
                                <input type="text" id="first-name" name="first-name" class="joinus-input" required 
                                       placeholder="Enter your first name"
                                       pattern="[A-Za-z]{1,25}" 
                                       title="Alphabetical characters only, max 25 characters"
                                       maxlength="25">
                            </div>
                            <div class="joinus-form-col">
                                <label for="last-name" class="joinus-label">Last Name*</label>
                                <input type="text" id="last-name" name="last-name" class="joinus-input" required 
                                       placeholder="Enter your last name"
                                       pattern="[A-Za-z]{1,25}"
                                       title="Alphabetical characters only, max 25 characters"
                                       maxlength="25">
                            </div>
                        </div>

                        <div class="joinus-form-row">
                            <div class="joinus-form-col">
                                <label for="email" class="joinus-label">Email Address*</label>
                                <input type="email" id="email" name="email" class="joinus-input" required 
                                       placeholder="your.email@example.com">
                            </div>
                            <div class="joinus-form-col">
                                <label for="phone" class="joinus-label">Phone Number*</label>
                                <input type="tel" id="phone" name="phone" class="joinus-input" required 
                                       placeholder="0123456789"
                                       pattern="[0-9]{10,10}"
                                       title="10 digit phone number"
                                       maxlength="10">
                            </div>
                        </div>

                        <fieldset class="joinus-fieldset">
                            <legend class="joinus-legend">Address Information</legend>
                            <div class="joinus-form-row">
                                <div class="joinus-form-col">
                                    <label for="street" class="joinus-label">Street Address*</label>
                                    <input type="text" id="street" name="street" class="joinus-input" required 
                                           placeholder="123 Coffee Street"
                                           maxlength="40">
                                </div>
                            </div>
                            <div class="joinus-form-row">
                                <div class="joinus-form-col">
                                    <label for="city" class="joinus-label">City/Town*</label>
                                    <input type="text" id="city" name="city" class="joinus-input" required 
                                           placeholder="Kuala Lumpur"
                                           maxlength="20">
                                </div>
                                <div class="joinus-form-col">
                                    <label for="state" class="joinus-label">State*</label>
                                    <select id="state" name="state" class="joinus-select" required>
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
                            <div class="joinus-form-row">
                                <div class="joinus-form-col">
                                    <label for="postcode" class="joinus-label">Postcode*</label>
                                    <input type="text" id="postcode" name="postcode" class="joinus-input" required 
                                           placeholder="50000"
                                           pattern="[0-9]{5}"
                                           title="Exactly 5 digits"
                                           maxlength="5">
                                </div>
                            </div>
                        </fieldset>

                        <div class="joinus-form-row">
                            <div class="joinus-form-col">
                                <label for="cv" class="joinus-label">Upload CV (PDF only)*</label>
                                <div class="joinus-file-upload-wrapper">
                                    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                    <span class="joinus-file-upload-btn">Choose File</span>
                                    <span class="joinus-file-name">No file chosen</span>
                                </div>
                            </div>
                            <div class="joinus-form-col">
                                <label for="photo" class="joinus-label">Upload Photo (Max 200KB)</label>
                                <div class="joinus-file-upload-wrapper">
                                    <input type="file" id="photo" name="photo" accept="image/*">
                                    <span class="joinus-file-upload-btn">Choose File</span>
                                    <span class="joinus-file-name">No file chosen</span>
                                </div>
                            </div>
                        </div>

                        <div class="joinus-form-footer">
                            <div class="joinus-form-buttons">
                                <button type="reset" class="joinus-reset-btn">
                                    Reset Form
                                </button>
                                <button type="submit" class="joinus-submit-btn">
                                    Submit Application
                                </button>
                            </div>
                            <p class="joinus-form-note">* Required fields. We respect your privacy and will never share your information with third parties.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
                this.nextElementSibling.nextElementSibling.textContent = fileName;
                
                // For photo upload, check file size
                if (this.id === 'photo' && this.files[0]) {
                    const fileSize = this.files[0].size / 1024; // in KB
                    if (fileSize > 200) {
                        alert('Photo size must be less than 200KB');
                        this.value = '';
                        this.nextElementSibling.nextElementSibling.textContent = 'No file chosen';
                    }
                }
            });
        });
    </script>
    
    <?php include 'footer.php'; ?>
    
</body>
</html>
