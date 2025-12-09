<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI CV Creator - Professional Resume Builder 2026</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Fix horizontal scroll issue */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        
        .container {
            overflow-x: hidden;
        }
        
        /* New CV information section */
        .cv-info-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .info-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-10px);
        }
        
        .info-icon {
            font-size: 40px;
            margin-bottom: 20px;
            color: #ffd700;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .feature-icon {
            color: #2563eb;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <h1><i class="fas fa-robot"></i> AI CV Creator 2026</h1>
            </div>
            <div class="auth-buttons">
                <button id="gmail-verify-btn" class="btn-gmail">
                    <i class="fab fa-google"></i> Gmail Verify
                </button>
                <button id="phone-verify-btn" class="btn-phone">
                    <i class="fas fa-mobile-alt"></i> Phone Verify
                </button>
                <button id="facebook-login" class="btn-facebook">
                    <i class="fab fa-facebook"></i> Facebook
                </button>
                <button id="whatsapp-login" class="btn-whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </button>
                <div class="user-info" id="user-info" style="display: none;">
                    <span id="user-name"></span>
                    <span id="user-status" class="status-badge"></span>
                    <button id="logout-btn">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Create Professional CVs with AI - 2026 Edition</h2>
                <p>Unlimited beautiful CVs with multiple templates and colors. Get hired faster!</p>
                <div class="verification-status">
                    <div class="status-item">
                        <i class="fab fa-google" id="gmail-icon"></i>
                        <span>Gmail Verified</span>
                    </div>
                    <div class="status-item">
                        <i class="fas fa-mobile-alt" id="phone-icon"></i>
                        <span>Phone Verified</span>
                    </div>
                </div>
                <div class="counter">
                    <p>Free CVs created: <span id="free-counter">5</span>/5 remaining</p>
                    <div class="progress-bar">
                        <div class="progress" id="progress"></div>
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <a href="#cv-info" class="btn-success" style="text-decoration: none;">
                        <i class="fas fa-info-circle"></i> Learn About CV Creation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CV Information Section -->
    <section id="cv-info" class="cv-info-section">
        <div class="container">
            <h2>Why Choose AI CV Creator 2026?</h2>
            <p>Create CVs that get noticed by employers and AI recruitment systems</p>
            
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>AI-Powered</h3>
                    <p>Smart templates optimized for Applicant Tracking Systems (ATS)</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>Beautiful Designs</h3>
                    <p>20+ professional templates with color customization</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-file-download"></i>
                    </div>
                    <h3>Multiple Formats</h3>
                    <p>Download as PDF (A4, Legal) or print directly</p>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Secure & Private</h3>
                    <p>Your data is protected with encryption</p>
                </div>
            </div>
            
            <div style="margin-top: 40px;">
                <h3>What Makes a Good CV in 2026?</h3>
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <div>
                            <strong>ATS-Friendly Format</strong>
                            <p>Our CVs are optimized for AI recruitment systems</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <div>
                            <strong>Keyword Optimization</strong>
                            <p>Auto-suggest relevant keywords for your industry</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <div>
                            <strong>Modern Design</strong>
                            <p>Clean, professional layouts that impress recruiters</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <div>
                            <strong>Mobile Responsive</strong>
                            <p>Looks great on all devices</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CV Creation Form -->
    <section class="cv-creator">
        <div class="container">
            <div class="creator-container">
                <div class="form-section">
                    <h3>Personal Information</h3>
                    <form id="cv-form">
                        <div class="form-group">
                            <label for="full-name">Full Name *</label>
                            <input type="text" id="full-name" required placeholder="John Doe">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" required placeholder="john@example.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" placeholder="+8801307082141">
                        </div>
                        
                        <div class="form-group">
                            <label for="photo">Upload Professional Photo</label>
                            <input type="file" id="photo" accept="image/*">
                            <small>Photo will be saved securely and sent to admin email</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="profession">Profession *</label>
                            <input type="text" id="profession" required placeholder="Software Engineer">
                        </div>
                        
                        <div class="form-group">
                            <label for="experience">Work Experience</label>
                            <textarea id="experience" rows="4" placeholder="• 3 years as Full Stack Developer&#10;• Led team of 5 developers&#10;• Improved system performance by 40%"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="education">Education</label>
                            <textarea id="education" rows="4" placeholder="• BSc in Computer Science, University of Dhaka&#10;• GPA: 3.8/4.0&#10;• Graduated: 2023"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="skills">Skills (comma separated)</label>
                            <input type="text" id="skills" placeholder="JavaScript, React, Node.js, MongoDB, Python">
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" id="preview-btn" class="btn-primary">
                                <i class="fas fa-eye"></i> Preview CV
                            </button>
                            <button type="submit" id="generate-btn" class="btn-success">
                                <i class="fas fa-magic"></i> Generate CV with AI
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="preview-section">
                    <h3>CV Preview</h3>
                    <div class="cv-preview" id="cv-preview">
                        <div class="cv-placeholder">
                            <p>Your CV preview will appear here</p>
                            <p>Fill the form and click "Preview CV" to see result</p>
                        </div>
                    </div>
                    
                    <div class="template-options">
                        <h4>Select Template</h4>
                        <div class="templates">
                            <div class="template" data-template="professional">Professional</div>
                            <div class="template" data-template="modern">Modern</div>
                            <div class="template" data-template="creative">Creative</div>
                            <div class="template" data-template="minimal">Minimal</div>
                        </div>
                        
                        <h4>Color Scheme</h4>
                        <div class="colors">
                            <div class="color" data-color="#2563eb" style="background-color: #2563eb;"></div>
                            <div class="color" data-color="#059669" style="background-color: #059669;"></div>
                            <div class="color" data-color="#7c3aed" style="background-color: #7c3aed;"></div>
                            <div class="color" data-color="#dc2626" style="background-color: #dc2626;"></div>
                            <div class="color" data-color="#ea580c" style="background-color: #ea580c;"></div>
                        </div>
                        
                        <div class="preview-actions">
                            <button id="download-a4" class="btn-download" disabled>
                                <i class="fas fa-download"></i> Download A4 (Phone Verify Required)
                            </button>
                            <button id="download-legal" class="btn-download" disabled>
                                <i class="fas fa-download"></i> Download Legal (Phone Verify Required)
                            </button>
                            <button id="print-cv" class="btn-print" disabled>
                                <i class="fas fa-print"></i> Print CV (Phone Verify Required)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification Requirements -->
    <section class="verification-info">
        <div class="container">
            <h2>Verification Requirements - 2026</h2>
            <div class="requirements">
                <div class="requirement">
                    <div class="req-icon">
                        <i class="fab fa-google"></i>
                    </div>
                    <h3>Gmail Verification</h3>
                    <ul>
                        <li>5 Free CVs creation</li>
                        <li>View CV preview instantly</li>
                        <li>Save CV data securely</li>
                        <li><strong>Download/Print requires phone verification</strong></li>
                    </ul>
                    <button class="btn-gmail verify-btn" data-type="gmail">
                        <i class="fab fa-google"></i> Verify Gmail
                    </button>
                </div>
                <div class="requirement">
                    <div class="req-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Phone Verification</h3>
                    <ul>
                        <li>Unlimited CV creation</li>
                        <li>Download A4 & Legal size PDF</li>
                        <li>Print CV directly</li>
                        <li><strong>Full access to all premium features</strong></li>
                    </ul>
                    <button class="btn-phone verify-btn" data-type="phone">
                        <i class="fas fa-mobile-alt"></i> Verify Phone
                    </button>
                </div>
                <div class="requirement premium">
                    <div class="req-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3>Social Connect</h3>
                    <ul>
                        <li>Facebook Connect: +10 extra CVs</li>
                        <li>WhatsApp Connect: +10 extra CVs</li>
                        <li>Both Connected: Unlimited everything</li>
                        <li><strong>Premium features unlocked immediately</strong></li>
                    </ul>
                    <div class="social-buttons">
                        <button class="btn-facebook" id="facebook-connect">
                            <i class="fab fa-facebook"></i> Connect Facebook
                        </button>
                        <button class="btn-whatsapp" id="whatsapp-connect">
                            <i class="fab fa-whatsapp"></i> Connect WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>Contact Admin: <a href="mailto:shiyonghu21@gmail.com">shiyonghu21@gmail.com</a></p>
            <p>All user information and photos are saved to Microsoft Access and sent to admin email</p>
            <p>&copy; 2026 AI CV Creator. All rights reserved. | Version 2.0</p>
            <p><small>Optimized for 2026 job market and AI recruitment systems</small></p>
            <p class="admin-link">
                <a href="admin/admin.php" target="_blank">
                    <i class="fas fa-user-shield"></i> Admin Dashboard
                </a>
                <a href="#cv-info" style="margin-left: 15px;">
                    <i class="fas fa-info-circle"></i> About CV Creation
                </a>
                <a href="#top" id="back-to-top" style="margin-left: 15px;">
                    <i class="fas fa-arrow-up"></i> Back to Top
                </a>
            </p>
        </div>
    </footer>

    <!-- Verification Modals -->
    <div id="gmail-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Gmail Verification 2026</h3>
            <p>Enter your Gmail address to receive verification code</p>
            <div class="form-group">
                <input type="email" id="gmail-input" placeholder="your.email@gmail.com" required>
                <small>You will receive 5 free CV creations after verification</small>
            </div>
            <div class="modal-buttons">
                <button id="send-gmail-otp" class="btn-gmail">
                    <i class="fas fa-paper-plane"></i> Send OTP to Email
                </button>
            </div>
            <div id="otp-section" style="display: none; margin-top: 20px;">
                <div class="form-group">
                    <input type="text" id="gmail-otp" placeholder="Enter 6-digit OTP" maxlength="6" required>
                    <small>Check your email inbox (and spam folder)</small>
                </div>
                <button id="verify-gmail-otp" class="btn-success">
                    <i class="fas fa-check"></i> Verify OTP
                </button>
                <button id="resend-gmail-otp" class="btn-primary" style="margin-left: 10px;">
                    <i class="fas fa-redo"></i> Resend OTP
                </button>
            </div>
        </div>
    </div>

    <div id="phone-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Phone Number Verification 2026</h3>
            <p>Enter your phone number to receive OTP via SMS</p>
            <div class="form-group">
                <input type="tel" id="phone-input" placeholder="+8801307082141" required>
                <small>Format: +880 followed by 10 digits (Bangladeshi number)</small>
            </div>
            <div class="modal-buttons">
                <button id="send-phone-otp" class="btn-phone">
                    <i class="fas fa-sms"></i> Send SMS OTP
                </button>
            </div>
            <div id="phone-otp-section" style="display: none; margin-top: 20px;">
                <div class="form-group">
                    <input type="text" id="phone-otp" placeholder="Enter 4-digit OTP" maxlength="4" required>
                    <small>You should receive SMS within 30 seconds</small>
                </div>
                <button id="verify-phone-otp" class="btn-success">
                    <i class="fas fa-check"></i> Verify OTP
                </button>
                <button id="resend-phone-otp" class="btn-primary" style="margin-left: 10px;">
                    <i class="fas fa-redo"></i> Resend OTP
                </button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="success-modal" class="modal">
        <div class="modal-content" style="text-align: center;">
            <span class="close-modal">&times;</span>
            <div style="font-size: 50px; color: #059669; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 id="success-title">Success!</h3>
            <p id="success-message">Operation completed successfully</p>
            <button class="btn-success" onclick="closeSuccessModal()">Continue</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
