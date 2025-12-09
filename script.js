// Global variables - Updated 2026
let cvCount = 0;
let maxFreeCVs = 5;
let userData = {
    isLoggedIn: false,
    gmailVerified: false,
    phoneVerified: false,
    facebookConnected: false,
    whatsappConnected: false,
    cvsCreated: 0,
    name: '',
    email: '',
    phone: ''
};
let currentTemplate = 'professional';
let currentColor = '#2563eb';
let gmailVerificationOTP = '';
let phoneVerificationOTP = '';

// DOM Elements
const cvForm = document.getElementById('cv-form');
const previewBtn = document.getElementById('preview-btn');
const generateBtn = document.getElementById('generate-btn');
const gmailVerifyBtn = document.getElementById('gmail-verify-btn');
const phoneVerifyBtn = document.getElementById('phone-verify-btn');
const facebookLoginBtn = document.getElementById('facebook-login');
const whatsappLoginBtn = document.getElementById('whatsapp-login');
const facebookConnectBtn = document.getElementById('facebook-connect');
const whatsappConnectBtn = document.getElementById('whatsapp-connect');
const downloadA4Btn = document.getElementById('download-a4');
const downloadLegalBtn = document.getElementById('download-legal');
const printBtn = document.getElementById('print-cv');
const freeCounter = document.getElementById('free-counter');
const progressBar = document.getElementById('progress');
const userInfo = document.getElementById('user-info');
const userName = document.getElementById('user-name');
const userStatus = document.getElementById('user-status');
const gmailModal = document.getElementById('gmail-modal');
const phoneModal = document.getElementById('phone-modal');
const successModal = document.getElementById('success-modal');
const closeModal = document.querySelectorAll('.close-modal');
const gmailIcon = document.getElementById('gmail-icon');
const phoneIcon = document.getElementById('phone-icon');
const backToTopBtn = document.getElementById('back-to-top');

// Initialize - Updated 2026
document.addEventListener('DOMContentLoaded', function() {
    loadUserData();
    updateUI();
    setupEventListeners();
    setupTemplateSelection();
    setupColorSelection();
    fixHorizontalScroll();
    
    // Back to top button
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});

function fixHorizontalScroll() {
    // Fix horizontal scroll issues
    document.querySelectorAll('*').forEach(el => {
        const style = window.getComputedStyle(el);
        if (style.overflowX === 'scroll' || el.scrollWidth > el.clientWidth) {
            el.style.overflowX = 'hidden';
        }
    });
}

function setupEventListeners() {
    // CV Form Submission
    cvForm.addEventListener('submit', function(e) {
        e.preventDefault();
        generateCV();
    });
    
    // Preview Button
    previewBtn.addEventListener('click', previewCV);
    
    // Verification Buttons
    gmailVerifyBtn.addEventListener('click', () => showModal('gmail'));
    phoneVerifyBtn.addEventListener('click', () => showModal('phone'));
    
    // Modal buttons with improved OTP handling
    document.getElementById('send-gmail-otp').addEventListener('click', sendGmailOTP);
    document.getElementById('verify-gmail-otp').addEventListener('click', verifyGmailOTP);
    document.getElementById('resend-gmail-otp').addEventListener('click', sendGmailOTP);
    document.getElementById('send-phone-otp').addEventListener('click', sendPhoneOTP);
    document.getElementById('verify-phone-otp').addEventListener('click', verifyPhoneOTP);
    document.getElementById('resend-phone-otp').addEventListener('click', sendPhoneOTP);
    
    // Social Login Buttons - Fixed for 2026
    facebookLoginBtn.addEventListener('click', connectFacebook);
    whatsappLoginBtn.addEventListener('click', connectWhatsApp);
    if (facebookConnectBtn) {
        facebookConnectBtn.addEventListener('click', connectFacebook);
    }
    if (whatsappConnectBtn) {
        whatsappConnectBtn.addEventListener('click', connectWhatsApp);
    }
    
    // Download and Print Buttons
    downloadA4Btn.addEventListener('click', () => downloadCV('A4'));
    downloadLegalBtn.addEventListener('click', () => downloadCV('legal'));
    printBtn.addEventListener('click', printCV);
    
    // Close modals
    closeModal.forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.style.display = 'none';
            });
        });
    });
    
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal')) {
            e.target.style.display = 'none';
        }
    });
    
    // Verify buttons in requirements section
    document.querySelectorAll('.verify-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            showModal(type);
        });
    });
    
    // Logout button
    document.getElementById('logout-btn')?.addEventListener('click', logout);
    
    // Prevent form submission on Enter in OTP fields
    document.getElementById('gmail-otp')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            verifyGmailOTP();
        }
    });
    
    document.getElementById('phone-otp')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            verifyPhoneOTP();
        }
    });
    
    // AI Bot link fix (remove any broken links)
    document.querySelectorAll('a[href="#"], a[href=""]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'index.html';
        });
    });
}

function setupTemplateSelection() {
    const templates = document.querySelectorAll('.template');
    templates.forEach(template => {
        template.addEventListener('click', function() {
            templates.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentTemplate = this.dataset.template;
            previewCV();
        });
    });
    
    if (templates.length > 0) {
        templates[0].classList.add('active');
    }
}

function setupColorSelection() {
    const colors = document.querySelectorAll('.color');
    colors.forEach(color => {
        color.addEventListener('click', function() {
            colors.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            currentColor = this.dataset.color;
            previewCV();
        });
    });
    
    if (colors.length > 0) {
        colors[0].classList.add('active');
    }
}

function showModal(type) {
    document.querySelectorAll('.modal').forEach(modal => {
        modal.style.display = 'none';
    });
    
    if (type === 'gmail') {
        gmailModal.style.display = 'flex';
        document.getElementById('otp-section').style.display = 'none';
        document.getElementById('gmail-input').value = userData.email || '';
        document.getElementById('gmail-input').focus();
    } else if (type === 'phone') {
        phoneModal.style.display = 'flex';
        document.getElementById('phone-otp-section').style.display = 'none';
        document.getElementById('phone-input').value = userData.phone || '';
        document.getElementById('phone-input').focus();
    }
}

function closeSuccessModal() {
    successModal.style.display = 'none';
}

function showSuccess(title, message) {
    document.getElementById('success-title').textContent = title;
    document.getElementById('success-message').textContent = message;
    successModal.style.display = 'flex';
}

// Load user data from localStorage
function loadUserData() {
    const savedData = localStorage.getItem('cvUserData');
    if (savedData) {
        try {
            userData = JSON.parse(savedData);
            cvCount = userData.cvsCreated || 0;
        } catch (e) {
            console.error('Error loading user data:', e);
            resetUserData();
        }
    }
}

// Save user data to localStorage
function saveUserData() {
    userData.cvsCreated = cvCount;
    localStorage.setItem('cvUserData', JSON.stringify(userData));
    
    // Also send to server
    sendUserInfoToServer();
}

// Reset user data if corrupted
function resetUserData() {
    userData = {
        isLoggedIn: false,
        gmailVerified: false,
        phoneVerified: false,
        facebookConnected: false,
        whatsappConnected: false,
        cvsCreated: 0,
        name: '',
        email: '',
        phone: ''
    };
    saveUserData();
}

// Update UI based on user state - Improved 2026
function updateUI() {
    const remaining = maxFreeCVs - cvCount;
    freeCounter.textContent = remaining > 0 ? remaining : 0;
    progressBar.style.width = maxFreeCVs === Infinity ? '0%' : `${(cvCount / maxFreeCVs) * 100}%`;
    
    // Update verification icons
    if (userData.gmailVerified) {
        gmailIcon.parentElement.classList.add('verified');
        gmailIcon.style.color = '#10b981';
    } else {
        gmailIcon.parentElement.classList.remove('verified');
        gmailIcon.style.color = 'white';
    }
    
    if (userData.phoneVerified) {
        phoneIcon.parentElement.classList.add('verified');
        phoneIcon.style.color = '#10b981';
    } else {
        phoneIcon.parentElement.classList.remove('verified');
        phoneIcon.style.color = 'white';
    }
    
    // Enable/disable download buttons based on phone verification
    const isPhoneVerified = userData.phoneVerified;
    downloadA4Btn.disabled = !isPhoneVerified;
    downloadLegalBtn.disabled = !isPhoneVerified;
    printBtn.disabled = !isPhoneVerified;
    
    if (isPhoneVerified) {
        downloadA4Btn.innerHTML = '<i class="fas fa-download"></i> Download A4 PDF';
        downloadLegalBtn.innerHTML = '<i class="fas fa-download"></i> Download Legal PDF';
        printBtn.innerHTML = '<i class="fas fa-print"></i> Print CV';
    } else {
        downloadA4Btn.innerHTML = '<i class="fas fa-download"></i> Download A4 (Phone Verify Required)';
        downloadLegalBtn.innerHTML = '<i class="fas fa-download"></i> Download Legal (Phone Verify Required)';
        printBtn.innerHTML = '<i class="fas fa-print"></i> Print CV (Phone Verify Required)';
    }
    
    // Show user info if logged in
    const isLoggedIn = userData.isLoggedIn || userData.gmailVerified || userData.phoneVerified;
    if (isLoggedIn) {
        userInfo.style.display = 'flex';
        userName.textContent = userData.name || userData.email || userData.phone || 'User';
        
        let status = [];
        if (userData.gmailVerified) status.push('Gmail Verified');
        if (userData.phoneVerified) status.push('Phone Verified');
        if (userData.facebookConnected) status.push('Facebook');
        if (userData.whatsappConnected) status.push('WhatsApp');
        
        userStatus.textContent = status.join(' | ') || 'Not Verified';
        userStatus.className = 'status-badge ' + (status.length > 0 ? 'status-verified' : 'status-pending');
    } else {
        userInfo.style.display = 'none';
    }
    
    // Update CV allowance - Fixed calculation for 2026
    updateCVAllowance();
}

function updateCVAllowance() {
    if (userData.facebookConnected && userData.whatsappConnected) {
        maxFreeCVs = Infinity;
        freeCounter.textContent = 'Unlimited';
        progressBar.style.width = '0%';
    } else if (userData.facebookConnected || userData.whatsappConnected) {
        maxFreeCVs = 15; // 5 free + 10 from social
    } else if (userData.gmailVerified) {
        maxFreeCVs = 5;
    } else {
        maxFreeCVs = 0;
    }
}

// Gmail Verification Functions - Improved OTP system
function sendGmailOTP() {
    const gmail = document.getElementById('gmail-input').value.trim();
    
    if (!gmail || !gmail.includes('@gmail.com')) {
        showSuccess('Error', 'Please enter a valid Gmail address ending with @gmail.com');
        return;
    }
    
    // Generate 6-digit OTP
    gmailVerificationOTP = Math.floor(100000 + Math.random() * 900000).toString();
    
    // Show OTP section
    document.getElementById('otp-section').style.display = 'block';
    userData.email = gmail;
    
    // For demo - show OTP in alert
    // In production, this would be sent via email API
    alert(`DEMO: OTP sent to ${gmail}: ${gmailVerificationOTP}\n\nIn production, this would be sent via email.`);
    
    // Focus on OTP input
    setTimeout(() => {
        document.getElementById('gmail-otp').focus();
    }, 100);
    
    // Save partial data
    saveUserData();
}

function verifyGmailOTP() {
    const enteredOTP = document.getElementById('gmail-otp').value.trim();
    
    if (enteredOTP === gmailVerificationOTP) {
        userData.gmailVerified = true;
        userData.isLoggedIn = true;
        userData.name = userData.email.split('@')[0];
        
        saveUserData();
        updateUI();
        
        gmailModal.style.display = 'none';
        showSuccess('Success!', 'Gmail verification successful! You can now create 5 CVs.');
        
        // Send verification info to server
        sendVerificationInfo('gmail');
    } else {
        showSuccess('Error', 'Invalid OTP! Please try again.');
        document.getElementById('gmail-otp').focus();
    }
}

// Phone Verification Functions - Fixed for Bangladesh numbers
function sendPhoneOTP() {
    const phone = document.getElementById('phone-input').value.trim();
    
    // Validate Bangladeshi phone number
    const phoneRegex = /^(\+880|880|0)(1[3-9]\d{8})$/;
    if (!phoneRegex.test(phone)) {
        showSuccess('Error', 'Please enter a valid Bangladeshi phone number\n\nFormat: +8801307082141 or 01307082141');
        return;
    }
    
    // Format phone number
    let formattedPhone = phone;
    if (phone.startsWith('0')) {
        formattedPhone = '+88' + phone;
    } else if (phone.startsWith('880')) {
        formattedPhone = '+' + phone;
    } else if (phone.startsWith('+880')) {
        // Already formatted
    } else {
        formattedPhone = '+880' + phone;
    }
    
    // Generate 4-digit OTP
    phoneVerificationOTP = Math.floor(1000 + Math.random() * 9000).toString();
    
    // Show OTP section
    document.getElementById('phone-otp-section').style.display = 'block';
    userData.phone = formattedPhone;
    
    // For demo - show OTP in alert
    // In production, this would be sent via SMS API
    alert(`DEMO: SMS OTP sent to ${formattedPhone}: ${phoneVerificationOTP}\n\nIn production, this would be sent via SMS.`);
    
    // Focus on OTP input
    setTimeout(() => {
        document.getElementById('phone-otp').focus();
    }, 100);
    
    // Save partial data
    saveUserData();
}

function verifyPhoneOTP() {
    const enteredOTP = document.getElementById('phone-otp').value.trim();
    
    if (enteredOTP === phoneVerificationOTP) {
        userData.phoneVerified = true;
        userData.isLoggedIn = true;
        
        if (!userData.name) {
            userData.name = `User-${userData.phone.slice(-4)}`;
        }
        
        saveUserData();
        updateUI();
        
        phoneModal.style.display = 'none';
        showSuccess('Success!', 'Phone verification successful! You can now download and print CVs.');
        
        // Send verification info to server
        sendVerificationInfo('phone');
    } else {
        showSuccess('Error', 'Invalid OTP! Please try again.');
        document.getElementById('phone-otp').focus();
    }
}

// Social Media Connection Functions - Fixed for 2026
function connectFacebook() {
    showSuccess('Facebook Connect', 'This feature requires Facebook App integration.\n\nFor now, we\'ll simulate successful connection.');
    
    // Simulate connection
    setTimeout(() => {
        userData.isLoggedIn = true;
        userData.facebookConnected = true;
        
        if (!userData.name) {
            userData.name = "Facebook User";
        }
        
        saveUserData();
        updateUI();
        
        showSuccess('Connected!', 'Facebook connected successfully!\nYou now have 10 additional CV creations.');
        
        sendSocialConnectionInfo('facebook');
    }, 1500);
}

function connectWhatsApp() {
    if (!userData.phoneVerified) {
        showSuccess('Phone Required', 'Please verify your phone number first to connect WhatsApp!');
        showModal('phone');
        return;
    }
    
    showSuccess('WhatsApp Connect', 'This feature requires WhatsApp Business API integration.\n\nFor now, we\'ll simulate successful connection.');
    
    // Simulate connection
    setTimeout(() => {
        userData.isLoggedIn = true;
        userData.whatsappConnected = true;
        
        saveUserData();
        updateUI();
        
        showSuccess('Connected!', 'WhatsApp connected successfully!\nYou now have 10 additional CV creations.');
        
        sendSocialConnectionInfo('whatsapp');
    }, 1500);
}

// Generate CV - Improved for 2026
function generateCV() {
    // Check if user can create more CVs
    if (!userData.gmailVerified && !userData.phoneVerified) {
        showSuccess('Verification Required', 'Please verify your Gmail or Phone number first!');
        showModal('gmail');
        return;
    }
    
    if (cvCount >= maxFreeCVs && maxFreeCVs !== Infinity) {
        showSuccess('Limit Reached', `You've reached your limit of ${maxFreeCVs} CVs.\n\nConnect Facebook or WhatsApp to create more CVs.`);
        return;
    }
    
    const formData = new FormData(cvForm);
    const photoInput = document.getElementById('photo');
    
    // Validate form
    if (!formData.get('full-name')) {
        showSuccess('Error', 'Please enter your full name');
        document.getElementById('full-name').focus();
        return;
    }
    
    if (!formData.get('email')) {
        showSuccess('Error', 'Please enter your email address');
        document.getElementById('email').focus();
        return;
    }
    
    // Increment CV counter
    cvCount++;
    userData.cvsCreated = cvCount;
    saveUserData();
    updateUI();
    
    // Generate preview
    previewCV();
    
    // Show success message
    showSuccess('CV Generated!', `Your CV has been created successfully!\n\nYou have created ${cvCount} CV(s) so far.`);
    
    // Send data to server
    sendCVDataToServer(formData);
    
    // Send photo to email if uploaded
    if (photoInput.files.length > 0) {
        sendPhotoToEmail(photoInput.files[0], formData.get('full-name'));
    }
}

// Preview CV - Enhanced for 2026
function previewCV() {
    const formData = new FormData(cvForm);
    const preview = document.getElementById('cv-preview');
    
    // Get form values with defaults
    const fullName = formData.get('full-name') || 'Your Name';
    const profession = formData.get('profession') || 'Your Profession';
    const email = formData.get('email') || 'your.email@example.com';
    const phone = formData.get('phone') || 'Phone: Not provided';
    const experience = formData.get('experience') || 'No experience added yet';
    const education = formData.get('education') || 'No education added yet';
    const skills = formData.get('skills') || 'No skills added yet';
    
    // Template-specific styling
    const templateStyles = {
        professional: 'font-family: "Times New Roman", serif;',
        modern: 'font-family: "Poppins", sans-serif;',
        creative: 'font-family: "Comic Sans MS", cursive;',
        minimal: 'font-family: Arial, sans-serif; font-weight: 300;'
    };
    
    const cvHTML = `
        <div class="cv-template ${currentTemplate}" style="${templateStyles[currentTemplate]}; border-left: 5px solid ${currentColor}; max-width: 100%; overflow: hidden;">
            <div class="cv-header" style="background-color: ${currentColor}; color: white; padding: 30px; text-align: center;">
                <h2 style="margin: 0; font-size: 32px;">${fullName}</h2>
                <p style="margin: 10px 0; font-size: 20px; opacity: 0.9;">${profession}</p>
                <p style="margin: 5px 0; font-size: 14px;">
                    <i class="fas fa-envelope"></i> ${email} | 
                    <i class="fas fa-phone"></i> ${phone}
                </p>
            </div>
            <div class="cv-body" style="padding: 30px; background: white;">
                ${experience && experience !== 'No experience added yet' ? `
                <div class="cv-section" style="margin-bottom: 25px;">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px; margin-bottom: 15px;">WORK EXPERIENCE</h3>
                    <p style="white-space: pre-line; line-height: 1.6;">${experience}</p>
                </div>` : ''}
                
                ${education && education !== 'No education added yet' ? `
                <div class="cv-section" style="margin-bottom: 25px;">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px; margin-bottom: 15px;">EDUCATION</h3>
                    <p style="white-space: pre-line; line-height: 1.6;">${education}</p>
                </div>` : ''}
                
                ${skills && skills !== 'No skills added yet' ? `
                <div class="cv-section" style="margin-bottom: 25px;">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px; margin-bottom: 15px;">SKILLS</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        ${skills.split(',').map(skill => `
                            <span style="background: #f1f5f9; padding: 8px 15px; border-radius: 20px; font-size: 14px; display: inline-block;">
                                ${skill.trim()}
                            </span>
                        `).join('')}
                    </div>
                </div>` : ''}
                
                <div class="cv-footer" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666; font-size: 12px;">
                    <p>Created with AI CV Creator 2026 | ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                </div>
            </div>
        </div>
    `;
    
    preview.innerHTML = cvHTML;
    
    // Scroll to preview
    preview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Download CV - Fixed for 2026
function downloadCV(format) {
    if (!userData.phoneVerified) {
        showSuccess('Phone Required', 'Phone verification required to download CVs!');
        showModal('phone');
        return;
    }
    
    const preview = document.getElementById('cv-preview');
    const printWindow = window.open('', '_blank');
    
    // Get current date for filename
    const dateStr = new Date().toISOString().split('T')[0];
    const filename = `CV_${userData.name || 'User'}_${dateStr}_${format}.pdf`;
    
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>CV - ${format} - AI CV Creator 2026</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 0; 
                    padding: 20px;
                    ${format === 'A4' ? 'width: 210mm; height: 297mm;' : 'width: 216mm; height: 356mm;'}
                }
                @media print {
                    body { margin: 0; }
                    @page { 
                        size: ${format.toLowerCase()}; 
                        margin: 20mm;
                    }
                }
                .download-footer {
                    text-align: center;
                    margin-top: 30px;
                    color: #666;
                    font-size: 11px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                }
            </style>
        </head>
        <body>
            ${preview.innerHTML}
            <div class="download-footer">
                Created with AI CV Creator 2026 | ${new Date().toLocaleDateString()} | Format: ${format}
            </div>
            <script>
                // Auto-print after loading
                window.onload = function() {
                    setTimeout(function() {
                        window.print();
                        setTimeout(function() {
                            window.close();
                        }, 1000);
                    }, 500);
                };
            </script>
        </body>
        </html>
    `);
    
    printWindow.document.close();
    
    // Log download
    logDownloadAction(format);
    
    showSuccess('Download Started', `Your ${format} CV is being prepared for download.\n\nA print dialog will appear shortly.`);
}

// Print CV
function printCV() {
    if (!userData.phoneVerified) {
        showSuccess('Phone Required', 'Phone verification required to print CVs!');
        showModal('phone');
        return;
    }
    
    downloadCV('A4');
}

// Logout
function logout() {
    if (confirm("Are you sure you want to logout? Your verification data will be saved.")) {
        userData.isLoggedIn = false;
        saveUserData();
        updateUI();
        showSuccess('Logged Out', 'You have been logged out successfully.\n\nYour verification data is saved for future visits.');
    }
}

// Server Communication Functions - Updated for 2026
async function sendVerificationInfo(type) {
    const data = {
        action: 'verification_2026',
        type: type,
        userData: userData,
        timestamp: new Date().toISOString(),
        version: '2.0'
    };
    
    try {
        const response = await fetch('/api/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        console.log('Verification sent to server:', result);
    } catch (error) {
        console.error('Error sending verification:', error);
    }
}

async function sendSocialConnectionInfo(platform) {
    const data = {
        action: 'social_connect_2026',
        platform: platform,
        userData: userData,
        timestamp: new Date().toISOString(),
        version: '2.0'
    };
    
    try {
        const response = await fetch('/api/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        console.log('Social connection sent to server:', result);
    } catch (error) {
        console.error('Error sending social connection:', error);
    }
}

async function sendCVDataToServer(formData) {
    const cvData = {
        name: formData.get('full-name'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        profession: formData.get('profession'),
        experience: formData.get('experience'),
        education: formData.get('education'),
        skills: formData.get('skills'),
        template: currentTemplate,
        color: currentColor,
        userData: userData,
        timestamp: new Date().toISOString(),
        year: 2026,
        version: '2.0'
    };
    
    try {
        const response = await fetch('/api/save-cv.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(cvData)
        });
        
        const result = await response.json();
        console.log('CV data sent to server:', result);
    } catch (error) {
        console.error('Error sending CV data:', error);
    }
}

async function sendUserInfoToServer() {
    const data = {
        action: 'save_user_2026',
        userData: userData,
        timestamp: new Date().toISOString(),
        year: 2026
    };
    
    try {
        const response = await fetch('/api/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        console.log('User data sent to server:', result);
    } catch (error) {
        console.error('Error sending user data:', error);
    }
}

async function sendPhotoToEmail(file, userName) {
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('userName', userName);
    formData.append('userData', JSON.stringify(userData));
    formData.append('year', 2026);
    
    try {
        const response = await fetch('/api/save-photo.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        console.log('Photo sent to server:', result);
    } catch (error) {
        console.error('Error sending photo:', error);
    }
}

async function logDownloadAction(format) {
    const data = {
        action: 'download_2026',
        format: format,
        userData: userData,
        timestamp: new Date().toISOString(),
        year: 2026
    };
    
    try {
        const response = await fetch('/api/save-cv.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        console.log('Download logged:', result);
    } catch (error) {
        console.error('Error logging download:', error);
    }
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl+P for print (when verified)
    if (e.ctrlKey && e.key === 'p' && userData.phoneVerified) {
        e.preventDefault();
        printCV();
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.display = 'none';
        });
    }
});

// Fix any remaining horizontal scroll issues on resize
window.addEventListener('resize', fixHorizontalScroll);
