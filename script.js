// Global variables
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
const closeModal = document.querySelectorAll('.close-modal');
const gmailIcon = document.getElementById('gmail-icon');
const phoneIcon = document.getElementById('phone-icon');

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadUserData();
    updateUI();
    setupEventListeners();
    setupTemplateSelection();
    setupColorSelection();
});

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
    
    // Modal buttons
    document.getElementById('send-gmail-otp').addEventListener('click', sendGmailOTP);
    document.getElementById('verify-gmail-otp').addEventListener('click', verifyGmailOTP);
    document.getElementById('send-phone-otp').addEventListener('click', sendPhoneOTP);
    document.getElementById('verify-phone-otp').addEventListener('click', verifyPhoneOTP);
    
    // Social Login Buttons
    facebookLoginBtn.addEventListener('click', connectFacebook);
    whatsappLoginBtn.addEventListener('click', connectWhatsApp);
    
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
        document.getElementById('gmail-input').value = '';
    } else if (type === 'phone') {
        phoneModal.style.display = 'flex';
        document.getElementById('phone-otp-section').style.display = 'none';
        document.getElementById('phone-input').value = '';
    }
}

// Load user data from localStorage
function loadUserData() {
    const savedData = localStorage.getItem('cvUserData');
    if (savedData) {
        userData = JSON.parse(savedData);
        cvCount = userData.cvsCreated || 0;
    }
}

// Save user data to localStorage
function saveUserData() {
    userData.cvsCreated = cvCount;
    localStorage.setItem('cvUserData', JSON.stringify(userData));
    
    // Also send to server
    sendUserInfoToServer();
}

// Update UI based on user state
function updateUI() {
    const remaining = maxFreeCVs - cvCount;
    freeCounter.textContent = remaining > 0 ? remaining : 0;
    progressBar.style.width = `${(cvCount / maxFreeCVs) * 100}%`;
    
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
        downloadA4Btn.innerHTML = '<i class="fas fa-download"></i> Download A4';
        downloadLegalBtn.innerHTML = '<i class="fas fa-download"></i> Download Legal';
        printBtn.innerHTML = '<i class="fas fa-print"></i> Print CV';
    }
    
    // Show user info if logged in
    if (userData.isLoggedIn || userData.gmailVerified || userData.phoneVerified) {
        userInfo.style.display = 'flex';
        userName.textContent = userData.name || userData.email || 'User';
        
        let status = [];
        if (userData.gmailVerified) status.push('Gmail Verified');
        if (userData.phoneVerified) status.push('Phone Verified');
        if (userData.facebookConnected) status.push('Facebook');
        if (userData.whatsappConnected) status.push('WhatsApp');
        
        userStatus.textContent = status.join(' | ');
        userStatus.className = 'status-badge status-verified';
    } else {
        userInfo.style.display = 'none';
    }
    
    // Update CV allowance
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

// Gmail Verification Functions
function sendGmailOTP() {
    const gmail = document.getElementById('gmail-input').value;
    
    if (!gmail || !gmail.includes('@gmail.com')) {
        alert("Please enter a valid Gmail address!");
        return;
    }
    
    // Generate 6-digit OTP
    gmailVerificationOTP = Math.floor(100000 + Math.random() * 900000);
    
    // In real app, send OTP via email
    // For demo, show in alert
    alert(`OTP sent to ${gmail}: ${gmailVerificationOTP}\n(In production, this would be sent via email)`);
    
    document.getElementById('otp-section').style.display = 'block';
    userData.email = gmail;
}

function verifyGmailOTP() {
    const enteredOTP = document.getElementById('gmail-otp').value;
    
    if (enteredOTP == gmailVerificationOTP) {
        userData.gmailVerified = true;
        userData.isLoggedIn = true;
        userData.name = userData.email.split('@')[0];
        
        saveUserData();
        updateUI();
        
        gmailModal.style.display = 'none';
        alert("Gmail verification successful! You can now create 5 CVs.");
        
        // Send verification info to server
        sendVerificationInfo('gmail');
    } else {
        alert("Invalid OTP! Please try again.");
    }
}

// Phone Verification Functions
function sendPhoneOTP() {
    const phone = document.getElementById('phone-input').value;
    
    // Validate Bangladeshi phone number
    const phoneRegex = /^(01[3-9]\d{8})$/;
    if (!phoneRegex.test(phone)) {
        alert("Please enter a valid Bangladeshi phone number (11 digits, starting with 01)");
        return;
    }
    
    // Generate 4-digit OTP
    phoneVerificationOTP = Math.floor(1000 + Math.random() * 9000);
    
    // In real app, send OTP via SMS
    // For demo, show in alert
    alert(`OTP sent to ${phone}: ${phoneVerificationOTP}\n(In production, this would be sent via SMS)`);
    
    document.getElementById('phone-otp-section').style.display = 'block';
    userData.phone = phone;
}

function verifyPhoneOTP() {
    const enteredOTP = document.getElementById('phone-otp').value;
    
    if (enteredOTP == phoneVerificationOTP) {
        userData.phoneVerified = true;
        userData.isLoggedIn = true;
        
        if (!userData.name) {
            userData.name = `User-${userData.phone.slice(-4)}`;
        }
        
        saveUserData();
        updateUI();
        
        phoneModal.style.display = 'none';
        alert("Phone verification successful! You can now download and print CVs.");
        
        // Send verification info to server
        sendVerificationInfo('phone');
    } else {
        alert("Invalid OTP! Please try again.");
    }
}

// Social Media Connection Functions
function connectFacebook() {
    if (confirm("Connect with Facebook? This will give you 10 additional CV creations.")) {
        userData.isLoggedIn = true;
        userData.facebookConnected = true;
        
        if (!userData.name) {
            userData.name = "Facebook User";
        }
        
        saveUserData();
        updateUI();
        alert("Facebook connected successfully! You now have 10 additional CV creations.");
        
        sendSocialConnectionInfo('facebook');
    }
}

function connectWhatsApp() {
    if (!userData.phoneVerified) {
        alert("Please verify your phone number first to connect WhatsApp!");
        showModal('phone');
        return;
    }
    
    if (confirm("Connect with WhatsApp? This will give you 10 additional CV creations.")) {
        userData.isLoggedIn = true;
        userData.whatsappConnected = true;
        
        saveUserData();
        updateUI();
        alert("WhatsApp connected successfully! You now have 10 additional CV creations.");
        
        sendSocialConnectionInfo('whatsapp');
    }
}

// Generate CV
function generateCV() {
    // Check if user can create more CVs
    if (!userData.gmailVerified && !userData.phoneVerified) {
        alert("Please verify your Gmail or Phone number first!");
        showModal('gmail');
        return;
    }
    
    if (cvCount >= maxFreeCVs && maxFreeCVs !== Infinity) {
        alert(`You've reached your limit of ${maxFreeCVs} CVs. Connect Facebook or WhatsApp to create more.`);
        return;
    }
    
    const formData = new FormData(cvForm);
    const photoInput = document.getElementById('photo');
    
    // Validate form
    if (!formData.get('full-name')) {
        alert("Please enter your full name");
        return;
    }
    
    // Increment CV counter
    cvCount++;
    userData.cvsCreated = cvCount;
    saveUserData();
    updateUI();
    
    // Send data to server
    sendCVDataToServer(formData);
    
    // Send photo to email if uploaded
    if (photoInput.files.length > 0) {
        sendPhotoToEmail(photoInput.files[0], formData.get('full-name'));
    }
    
    // Generate preview
    previewCV();
    
    alert("CV generated successfully!");
}

// Preview CV
function previewCV() {
    const formData = new FormData(cvForm);
    const preview = document.getElementById('cv-preview');
    
    const cvHTML = `
        <div class="cv-template ${currentTemplate}" style="border-left: 5px solid ${currentColor};">
            <div class="cv-header" style="background-color: ${currentColor}; color: white; padding: 30px;">
                <h2>${formData.get('full-name') || 'Your Name'}</h2>
                <p>${formData.get('profession') || 'Your Profession'}</p>
                <p>${formData.get('email') || 'your.email@example.com'} | ${formData.get('phone') || 'Phone: Not provided'}</p>
            </div>
            <div class="cv-body" style="padding: 30px;">
                ${formData.get('experience') ? `
                <div class="cv-section">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px;">Experience</h3>
                    <p style="white-space: pre-line;">${formData.get('experience')}</p>
                </div>` : ''}
                
                ${formData.get('education') ? `
                <div class="cv-section">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px;">Education</h3>
                    <p style="white-space: pre-line;">${formData.get('education')}</p>
                </div>` : ''}
                
                ${formData.get('skills') ? `
                <div class="cv-section">
                    <h3 style="color: ${currentColor}; border-bottom: 2px solid ${currentColor}; padding-bottom: 5px;">Skills</h3>
                    <p>${formData.get('skills').split(',').map(skill => `<span class="skill-tag">${skill.trim()}</span>`).join('')}</p>
                </div>` : ''}
            </div>
        </div>
        
        <style>
            .skill-tag {
                display: inline-block;
                background: #f1f5f9;
                padding: 5px 15px;
                margin: 5px;
                border-radius: 20px;
                font-size: 14px;
            }
        </style>
    `;
    
    preview.innerHTML = cvHTML;
}

// Download CV
function downloadCV(format) {
    if (!userData.phoneVerified) {
        alert("Phone verification required to download CVs!");
        showModal('phone');
        return;
    }
    
    const preview = document.getElementById('cv-preview');
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>CV - ${format}</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 0; 
                    padding: 20px;
                    ${format === 'A4' ? 'width: 210mm; height: 297mm;' : 'width: 216mm; height: 356mm;'}
                }
                @media print {
                    body { margin: 0; }
                    @page { size: ${format.toLowerCase()}; }
                }
            </style>
        </head>
        <body>
            ${preview.innerHTML}
            <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
                Created with AI CV Creator | ${new Date().toLocaleDateString()}
            </div>
        </body>
        </html>
    `);
    
    printWindow.document.close();
    setTimeout(() => {
        printWindow.print();
    }, 500);
    
    // Log download
    logDownloadAction(format);
}

// Print CV
function printCV() {
    if (!userData.phoneVerified) {
        alert("Phone verification required to print CVs!");
        showModal('phone');
        return;
    }
    
    downloadCV('A4');
}

// Logout
function logout() {
    if (confirm("Are you sure you want to logout?")) {
        userData.isLoggedIn = false;
        saveUserData();
        updateUI();
        alert("Logged out successfully!");
    }
}

// Server Communication Functions
async function sendVerificationInfo(type) {
    const data = {
        action: 'verification',
        type: type,
        userData: userData,
        timestamp: new Date().toISOString()
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
        action: 'social_connect',
        platform: platform,
        userData: userData,
        timestamp: new Date().toISOString()
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
        timestamp: new Date().toISOString()
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
        action: 'save_user',
        userData: userData,
        timestamp: new Date().toISOString()
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
    
    try {
        const response = await fetch('/api/save-photo.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        console.log('Photo sent to server:', result);
        
        if (result.success) {
            console.log('Photo email sent to admin');
        }
    } catch (error) {
        console.error('Error sending photo:', error);
    }
}

async function logDownloadAction(format) {
    const data = {
        action: 'download',
        format: format,
        userData: userData,
        timestamp: new Date().toISOString()
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