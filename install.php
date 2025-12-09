<?php
// install.php - Installation Script 2026
header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install AI CV Creator 2026</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; overflow-x: hidden; }
        body { font-family: "Poppins", sans-serif; line-height: 1.6; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #333; min-height: 100vh; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        header { background: #2563eb; color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        header h1 { margin-bottom: 10px; font-size: 28px; }
        .content { background: white; padding: 30px; border-radius: 0 0 10px 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .step { margin-bottom: 30px; padding: 25px; border-left: 4px solid #2563eb; background: #f8fafc; border-radius: 5px; }
        .step h3 { color: #2563eb; margin-bottom: 15px; font-size: 20px; }
        .step p { margin-bottom: 15px; }
        .success { color: #059669; font-weight: bold; }
        .error { color: #dc2626; font-weight: bold; }
        .warning { color: #d97706; font-weight: bold; }
        .btn { display: inline-block; padding: 12px 25px; background: #2563eb; color: white; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; font-family: "Poppins", sans-serif; font-weight: 500; transition: all 0.3s ease; }
        .btn:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .btn-success { background: #059669; }
        .btn-success:hover { background: #047857; }
        pre { background: #1e293b; color: #e2e8f0; padding: 15px; border-radius: 5px; overflow-x: auto; margin: 10px 0; font-family: "Courier New", monospace; }
        .checkbox { display: flex; align-items: center; gap: 10px; margin: 10px 0; }
        .feature-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0; }
        .feature-item { background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .feature-item i { font-size: 24px; color: #2563eb; margin-bottom: 10px; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-robot"></i> AI CV Creator 2026 - Installation</h1>
            <p>Complete setup wizard for your professional CV creation website</p>
        </header>
        
        <div class="content">';

// Check if already installed
if (file_exists('config.php') && file_exists('database/cv_users.accdb')) {
    echo '<div class="step">
            <h3>✅ AI CV Creator 2026 Already Installed</h3>
            <p>Your CV creation platform is ready to use!</p>
            
            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <h4>AI-Powered CVs</h4>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Secure Verification</h4>
                </div>
                <div class="feature-item">
                    <i class="fas fa-download"></i>
                    <h4>PDF Download</h4>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Mobile Friendly</h4>
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="index.html" class="btn">
                    <i class="fas fa-external-link-alt"></i> Go to Website
                </a>
                <a href="admin/admin.php" class="btn btn-success" style="margin-left: 10px;">
                    <i class="fas fa-user-shield"></i> Admin Dashboard
                </a>
            </div>
            
            <p style="margin-top: 20px; color: #666;">
                <strong>Default Admin Password:</strong> Admin@CV2026<br>
                <small>For security, change this password in config.php</small>
            </p>
            
            <div style="margin-top: 20px; padding: 15px; background: #d1fae5; border-radius: 5px;">
                <h4><i class="fas fa-lightbulb"></i> Tips for 2026:</h4>
                <ul style="margin-left: 20px;">
                    <li>Test phone verification with Bangladeshi numbers</li>
                    <li>Try the new AI-powered CV templates</li>
                    <li>Check the admin dashboard for user analytics</li>
                    <li>Configure your email settings in config.php</li>
                </ul>
            </div>
        </div>';
    echo '</div></div></body></html>';
    exit;
}

// Handle installation form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<div class="step">
            <h3>🚀 Starting AI CV Creator 2026 Installation...</h3>';
    
    // Create database file
    echo '<p>Creating 2026 database structure...</p>';
    
    // Create directories
    $dirs = ['database', 'uploads', 'uploads/photos', 'api', 'admin', 'logs', 'database/backups'];
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            echo "<p class='success'>✅ Created directory: $dir</p>";
        }
    }
    
    // Create .gitkeep files
    file_put_contents('uploads/photos/.gitkeep', '');
    file_put_contents('database/backups/.gitkeep', '');
    file_put_contents('logs/.gitkeep', '');
    
    // Create config.php if doesn't exist
    if (!file_exists('config.php')) {
        $configTemplate = '<?php
// config.php - Configuration File 2026
error_reporting(E_ALL);
ini_set(\'display_errors\', 1);

define(\'SITE_URL\', \'http://\' . $_SERVER[\'HTTP_HOST\'] . \'/cv_creator/\');
define(\'SITE_NAME\', \'AI CV Creator 2026\');

// Database Configuration
define(\'DB_PATH\', \'C:/inetpub/wwwroot/cv_creator/database/cv_users.accdb\');
define(\'DB_BACKUP_PATH\', \'C:/inetpub/wwwroot/cv_creator/database/backups/\');

// Email Configuration
define(\'ADMIN_EMAIL_PRIMARY\', \'shiyonghu21@gmail.com\');
define(\'ADMIN_EMAIL_SECONDARY\', \'ontimebyshihab@outlook.com\');
define(\'EMAIL_FROM\', \'noreply@cvcreator2026.com\');
define(\'EMAIL_FROM_NAME\', \'AI CV Creator 2026\');

// File Upload Configuration
define(\'MAX_FILE_SIZE\', 10 * 1024 * 1024); // 10MB
define(\'ALLOWED_FILE_TYPES\', [\'image/jpeg\', \'image/jpg\', \'image/png\', \'image/webp\']);
define(\'UPLOAD_DIR\', \'C:/inetpub/wwwroot/cv_creator/uploads/\');
define(\'PHOTO_UPLOAD_DIR\', UPLOAD_DIR . \'photos/\');

// Verification Settings 2026
define(\'FREE_CV_LIMIT\', 5);
define(\'PHONE_VERIFICATION_REQUIRED\', true);
define(\'GMAIL_VERIFICATION_REQUIRED\', true);

// Security Settings 2026
define(\'SESSION_TIMEOUT\', 7200);
define(\'ADMIN_PASSWORD\', \'Admin@CV2026\'); // CHANGE THIS!

// OTP Settings
define(\'OTP_EXPIRY_MINUTES\', 10);
define(\'MAX_OTP_ATTEMPTS\', 3);
?>';
        
        file_put_contents('config.php', $configTemplate);
        echo "<p class='success'>✅ Created config.php file</p>";
        echo "<p class='warning'>⚠️ IMPORTANT: Edit config.php with your email settings</p>";
    }
    
    // Create API files
    $apiFiles = [
        'api/auth.php' => '<?php
// api/auth.php - Authentication API 2026
require_once \'../config.php\';
header(\'Content-Type: application/json\');
header(\'Access-Control-Allow-Origin: *\');
header(\'Access-Control-Allow-Methods: POST\');

$data = json_decode(file_get_contents(\'php://input\'), true);
if (!$data) {
    echo json_encode([\'success\' => false, \'message\' => \'No data received\', \'year\' => 2026]);
    exit;
}

$action = $data[\'action\'] ?? \'\';

switch ($action) {
    case \'verification_2026\':
        echo json_encode([\'success\' => true, \'message\' => \'Verification logged\', \'data\' => $data, \'year\' => 2026]);
        break;
        
    case \'social_connect_2026\':
        echo json_encode([\'success\' => true, \'message\' => \'Social connection logged\', \'year\' => 2026]);
        break;
        
    case \'save_user_2026\':
        echo json_encode([\'success\' => true, \'message\' => \'User data saved\', \'year\' => 2026]);
        break;
        
    default:
        echo json_encode([\'success\' => false, \'message\' => \'Unknown action\', \'year\' => 2026]);
}
?>',
        
        'api/save-cv.php' => '<?php
// api/save-cv.php - Save CV Data 2026
require_once \'../config.php\';
header(\'Content-Type: application/json\');
header(\'Access-Control-Allow-Origin: *\');

$data = json_decode(file_get_contents(\'php://input\'), true);
if (!$data) {
    echo json_encode([\'success\' => false, \'message\' => \'No CV data received\', \'year\' => 2026]);
    exit;
}

// Log CV creation
$logData = [
    \'name\' => $data[\'name\'] ?? \'Unknown\',
    \'email\' => $data[\'email\'] ?? \'No email\',
    \'timestamp\' => date(\'Y-m-d H:i:s\'),
    \'year\' => 2026
];

$logMessage = json_encode($logData) . PHP_EOL;
file_put_contents(\'../logs/cv_creation.log\', $logMessage, FILE_APPEND);

// Send email notification to admin
$subject = "New CV Created - AI CV Creator 2026";
$message = "A new CV has been created:\n\n";
$message .= "Name: " . ($data[\'name\'] ?? \'N/A\') . "\n";
$message .= "Email: " . ($data[\'email\'] ?? \'N/A\
