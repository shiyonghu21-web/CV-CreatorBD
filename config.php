<?php
// config.php - Configuration File 2026
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/cv_creator/');
define('SITE_NAME', 'AI CV Creator 2026');

// Database Configuration
define('DB_PATH', 'C:/inetpub/wwwroot/cv_creator/database/cv_users.accdb');
define('DB_BACKUP_PATH', 'C:/inetpub/wwwroot/cv_creator/database/backups/');

// Email Configuration
define('ADMIN_EMAIL_PRIMARY', 'shiyonghu21@gmail.com');
define('ADMIN_EMAIL_SECONDARY', 'ontimebyshihab@outlook.com');
define('EMAIL_FROM', 'noreply@cvcreator2026.com');
define('EMAIL_FROM_NAME', 'AI CV Creator 2026');

// File Upload Configuration
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);
define('UPLOAD_DIR', 'C:/inetpub/wwwroot/cv_creator/uploads/');
define('PHOTO_UPLOAD_DIR', UPLOAD_DIR . 'photos/');

// Verification Settings 2026
define('FREE_CV_LIMIT', 5);
define('PHONE_VERIFICATION_REQUIRED', true);
define('GMAIL_VERIFICATION_REQUIRED', true);

// Security Settings 2026
define('SESSION_TIMEOUT', 7200);
define('ADMIN_PASSWORD', 'Admin@CV2026'); // CHANGE THIS!

// OTP Settings
define('OTP_EXPIRY_MINUTES', 10);
define('MAX_OTP_ATTEMPTS', 3);

// Create necessary directories
function createDirectories() {
    $directories = [
        UPLOAD_DIR,
        PHOTO_UPLOAD_DIR,
        DB_BACKUP_PATH,
        'C:/inetpub/wwwroot/cv_creator/logs/',
        'C:/inetpub/wwwroot/cv_creator/database/backups/'
    ];
    
    foreach ($directories as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}

// Initialize directories
createDirectories();

// Database Connection Function 2026
function getDatabaseConnection() {
    try {
        $connectionString = "Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=" . DB_PATH;
        $conn = odbc_connect($connectionString, '', '');
        
        if (!$conn) {
            throw new Exception("Cannot connect to Microsoft Access database. Make sure Access Database Engine is installed.");
        }
        
        return $conn;
    } catch (Exception $e) {
        error_log("Database Error 2026: " . $e->getMessage());
        return false;
    }
}

// Send Email Function 2026
function sendEmail($to, $subject, $message, $isHTML = false) {
    $headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM . ">\r\n";
    
    if ($isHTML) {
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    } else {
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    }
    
    return mail($to, $subject, $message, $headers);
}

// Send OTP Email Function
function sendOTPEmail($email, $otp) {
    $subject = "Your OTP for AI CV Creator 2026";
    $message = "Your verification code is: " . $otp . "\n\n";
    $message .= "This code will expire in " . OTP_EXPIRY_MINUTES . " minutes.\n";
    $message .= "If you didn't request this, please ignore this email.\n\n";
    $message .= "Thank you,\nAI CV Creator 2026 Team";
    
    return sendEmail($email, $subject, $message);
}

// Security Functions 2026
function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    return $input;
}

function generateOTP($length = 6) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

// Response Helper Function 2026
function jsonResponse($success, $message = '', $data = []) {
    header('Content-Type: application/json');
    $response = [
        'success' => $success,
        'message' => $message,
        'data' => $data,
        'timestamp' => date('Y-m-d H:i:s'),
        'year' => 2026
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// Validate Phone Number for Bangladesh
function validateBangladeshiPhone($phone) {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    
    // Check if number is valid Bangladeshi format
    if (preg_match('/^(\+880|880|0)(1[3-9]\d{8})$/', $phone)) {
        return true;
    }
    
    return false;
}

// Format Phone Number to International Format
function formatPhoneNumber($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    if (strlen($phone) === 11 && substr($phone, 0, 1) === '0') {
        return '+88' . $phone;
    } elseif (strlen($phone) === 10) {
        return '+880' . $phone;
    } elseif (strlen($phone) === 13 && substr($phone, 0, 3) === '880') {
        return '+' . $phone;
    }
    
    return $phone;
}
?>
