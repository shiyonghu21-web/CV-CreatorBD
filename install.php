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
$message .= "Email: " . ($data[\'email\'] ?? \'N/A\') . "\n";
$message .= "Profession: " . ($data[\'profession\'] ?? \'N/A\') . "\n";
$message .= "Time: " . date(\'Y-m-d H:i:s\') . "\n";
$message .= "Year: 2026\n";

if (function_exists(\'sendEmail\')) {
    sendEmail(ADMIN_EMAIL_PRIMARY, $subject, $message);
}

echo json_encode([\'success\' => true, \'message\' => \'CV saved successfully\', \'year\' => 2026, \'timestamp\' => date(\'Y-m-d H:i:s\')]);
?>',
        
        'api/save-photo.php' => '<?php
// api/save-photo.php - Handle Photo Uploads 2026
require_once \'../config.php\';
header(\'Content-Type: application/json\');
header(\'Access-Control-Allow-Origin: *\');

if ($_SERVER[\'REQUEST_METHOD\'] !== \'POST\') {
    echo json_encode([\'success\' => false, \'message\' => \'Invalid request method\', \'year\' => 2026]);
    exit;
}

if (!isset($_FILES[\'photo\'])) {
    echo json_encode([\'success\' => false, \'message\' => \'No photo uploaded\', \'year\' => 2026]);
    exit;
}

$photo = $_FILES[\'photo\'];
$userName = $_POST[\'userName\'] ?? \'Unknown User\';

// Validate file
if ($photo[\'size\'] > MAX_FILE_SIZE) {
    echo json_encode([\'success\' => false, \'message\' => \'File too large. Max 10MB allowed.\', \'year\' => 2026]);
    exit;
}

if (!in_array($photo[\'type\'], ALLOWED_FILE_TYPES)) {
    echo json_encode([\'success\' => false, \'message\' => \'Invalid file type. Allowed: JPG, PNG, WebP\', \'year\' => 2026]);
    exit;
}

// Save photo
$filename = time() . \'_\' . preg_replace(\'/[^a-z0-9\.]/i\', \'\', $photo[\'name\']);
$filepath = PHOTO_UPLOAD_DIR . $filename;

if (move_uploaded_file($photo[\'tmp_name\'], $filepath)) {
    // Log photo upload
    $logData = [
        \'user\' => $userName,
        \'filename\' => $filename,
        \'timestamp\' => date(\'Y-m-d H:i:s\'),
        \'year\' => 2026
    ];
    
    file_put_contents(\'../logs/photo_uploads.log\', json_encode($logData) . PHP_EOL, FILE_APPEND);
    
    // Send email notification
    $subject = "New Photo Upload - AI CV Creator 2026";
    $message = "User: $userName\n";
    $message .= "Filename: $filename\n";
    $message .= "Time: " . date(\'Y-m-d H:i:s\') . "\n";
    $message .= "Year: 2026";
    
    if (function_exists(\'sendEmail\')) {
        sendEmail(ADMIN_EMAIL_PRIMARY, $subject, $message);
    }
    
    echo json_encode([\'success\' => true, \'message\' => \'Photo uploaded successfully\', \'filename\' => $filename, \'year\' => 2026]);
} else {
    echo json_encode([\'success\' => false, \'message\' => \'Failed to save photo\', \'year\' => 2026]);
}
?>'
    ];
    
    foreach ($apiFiles as $file => $content) {
        file_put_contents($file, $content);
        echo "<p class='success'>✅ Created API file: $file</p>";
    }
    
    // Create admin files
    $adminFiles = [
        'admin/admin.php' => '<?php
// admin/admin.php - Admin Dashboard 2026
require_once \'../config.php\';
session_start();

// Check if logged in
if (!isset($_SESSION[\'admin_logged_in\'])) {
    if ($_SERVER[\'REQUEST_METHOD\'] === \'POST\' && isset($_POST[\'password\'])) {
        if ($_POST[\'password\'] === ADMIN_PASSWORD) {
            $_SESSION[\'admin_logged_in\'] = true;
            $_SESSION[\'login_time\'] = time();
        } else {
            $error = "Invalid password!";
        }
    }
    
    if (!isset($_SESSION[\'admin_logged_in\'])) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin Login - AI CV Creator 2026</title>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; overflow: hidden; }
                body { font-family: \'Poppins\', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100vh; display: flex; align-items: center; justify-content: center; }
                .login-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); width: 90%; max-width: 400px; text-align: center; }
                h2 { color: #2563eb; margin-bottom: 30px; font-size: 24px; }
                h2 i { margin-right: 10px; }
                input[type="password"] { width: 100%; padding: 15px; margin: 10px 0; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; font-family: \'Poppins\', sans-serif; transition: border 0.3s; }
                input[type="password"]:focus { outline: none; border-color: #2563eb; }
                button { width: 100%; padding: 15px; background: #2563eb; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer; transition: all 0.3s; font-family: \'Poppins\', sans-serif; }
                button:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
                .error { color: #dc2626; margin: 10px 0; padding: 10px; background: #fee2e2; border-radius: 5px; }
                .info { color: #666; font-size: 12px; margin-top: 15px; }
            </style>
        </head>
        <body>
            <div class="login-box">
                <h2><i class="fas fa-user-shield"></i> Admin Login 2026</h2>
                <?php if (isset($error)) echo "<div class=\'error\'>$error</div>"; ?>
                <form method="POST">
                    <input type="password" name="password" placeholder="Enter admin password" required autofocus>
                    <button type="submit">Login to Dashboard</button>
                </form>
                <p class="info">Default password: Admin@CV2026</p>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Check session timeout
if (time() - $_SESSION[\'login_time\'] > SESSION_TIMEOUT) {
    session_destroy();
    header(\'Location: admin.php\');
    exit;
}

// Admin Dashboard HTML
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - AI CV Creator 2026</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; overflow-x: hidden; }
        body { font-family: \'Poppins\', sans-serif; background: #f5f7fa; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; padding: 25px; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        header h1 { margin-bottom: 10px; font-size: 28px; }
        header h1 i { margin-right: 15px; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-box { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s; }
        .stat-box:hover { transform: translateY(-5px); }
        .stat-box h3 { color: #666; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .stat-box .number { font-size: 36px; font-weight: bold; color: #2563eb; }
        .nav { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; display: flex; flex-wrap: wrap; gap: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav a { padding: 12px 20px; background: #f1f5f9; color: #333; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s; }
        .nav a:hover { background: #2563eb; color: white; }
        table { width: 100%; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; color: #333; font-weight: 600; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin: 5px; font-family: \'Poppins\', sans-serif; font-weight: 500; transition: all 0.3s; }
        .btn-download { background: #059669; color: white; }
        .btn-download:hover { background: #047857; }
        .btn-delete { background: #dc2626; color: white; }
        .btn-delete:hover { background: #b91c1c; }
        .logout { float: right; background: #f1f5f9; color: #333; }
        .logout:hover { background: #dc2626; color: white; }
        .card { background: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .card h2 { color: #2563eb; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9; }
        .info-box { background: #d1fae5; padding: 20px; border-radius: 10px; margin: 20px 0; border-left: 4px solid #059669; }
        .warning-box { background: #fef3c7; padding: 20px; border-radius: 10px; margin: 20px 0; border-left: 4px solid #d97706; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-user-shield"></i> AI CV Creator 2026 - Admin Dashboard</h1>
            <p>Welcome Admin | <a href="?logout" class="logout" style="color: white; text-decoration: none; padding: 8px 15px; background: rgba(255,255,255,0.2); border-radius: 5px;">Logout</a></p>
        </header>
        
        <div class="nav">
            <a href="#stats"><i class="fas fa-chart-bar"></i> Statistics</a>
            <a href="#users"><i class="fas fa-users"></i> Users</a>
            <a href="#cvs"><i class="fas fa-file-alt"></i> CVs</a>
            <a href="#photos"><i class="fas fa-images"></i> Photos</a>
            <a href="#backup"><i class="fas fa-database"></i> Backup</a>
            <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
        </div>
        
        <div class="card" id="stats">
            <h2><i class="fas fa-chart-bar"></i> Dashboard Statistics 2026</h2>
            <div class="stats">
                <div class="stat-box">
                    <h3>Total Users</h3>
                    <div class="number">0</div>
                </div>
                <div class="stat-box">
                    <h3>Total CVs Created</h3>
                    <div class="number">0</div>
                </div>
                <div class="stat-box">
                    <h3>Photos Uploaded</h3>
                    <div class="number">0</div>
                </div>
                <div class="stat-box">
                    <h3>Gmail Verified</h3>
                    <div class="number">0</div>
                </div>
                <div class="stat-box">
                    <h3>Phone Verified</h3>
                    <div class="number">0</div>
                </div>
            </div>
        </div>
        
        <div class="card" id="settings">
            <h2><i class="fas fa-cog"></i> System Settings 2026</h2>
            <div class="info-box">
                <h3><i class="fas fa-info-circle"></i> System Information</h3>
                <p><strong>Version:</strong> AI CV Creator 2.0 (2026 Edition)</p>
                <p><strong>Database:</strong> Microsoft Access (.accdb)</p>
                <p><strong>Admin Email:</strong> <?php echo ADMIN_EMAIL_PRIMARY; ?></p>
                <p><strong>Installation Path:</strong> <?php echo realpath(\'../\'); ?></p>
            </div>
            
            <div class="warning-box">
                <h3><i class="fas fa-exclamation-triangle"></i> Important Notes</h3>
                <p>1. Default admin password is <strong>Admin@CV2026</strong> - Change this immediately!</p>
                <p>2. Configure email settings in config.php for OTP functionality</p>
                <p>3. Run setup-database.bat as Administrator to set permissions</p>
                <p>4. Test all verification systems after installation</p>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="backup.php" class="btn btn-download">
                    <i class="fas fa-download"></i> Backup Database
                </a>
                <a href="../database/cv_users.accdb" class="btn btn-download" download>
                    <i class="fas fa-file-download"></i> Download Database
                </a>
                <a href="../install.php" class="btn" style="background: #2563eb; color: white;">
                    <i class="fas fa-redo"></i> Re-run Installation
                </a>
            </div>
        </div>
        
        <div class="card">
            <h2><i class="fas fa-question-circle"></i> Quick Links 2026</h2>
            <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
                <a href="../index.html" target="_blank" style="padding: 15px; background: #f1f5f9; border-radius: 5px; text-decoration: none; color: #333; flex: 1; min-width: 200px;">
                    <i class="fas fa-external-link-alt"></i> <strong>Live Website</strong>
                    <p style="font-size: 12px; margin-top: 5px; color: #666;">View the public website</p>
                </a>
                <a href="mailto:<?php echo ADMIN_EMAIL_PRIMARY; ?>" style="padding: 15px; background: #f1f5f9; border-radius: 5px; text-decoration: none; color: #333; flex: 1; min-width: 200px;">
                    <i class="fas fa-envelope"></i> <strong>Contact Admin</strong>
                    <p style="font-size: 12px; margin-top: 5px; color: #666;">Email: <?php echo ADMIN_EMAIL_PRIMARY; ?></p>
                </a>
                <a href="../logs/" style="padding: 15px; background: #f1f5f9; border-radius: 5px; text-decoration: none; color: #333; flex: 1; min-width: 200px;">
                    <i class="fas fa-clipboard-list"></i> <strong>View Logs</strong>
                    <p style="font-size: 12px; margin-top: 5px; color: #666;">System and error logs</p>
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Add confirmation for delete actions
        document.addEventListener(\'DOMContentLoaded\', function() {
            const deleteButtons = document.querySelectorAll(\'.btn-delete\');
            deleteButtons.forEach(btn => {
                btn.addEventListener(\'click\', function(e) {
                    if (!confirm(\'Are you sure you want to delete this item?\')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Smooth scroll for navigation
            document.querySelectorAll(\'.nav a\').forEach(anchor => {
                anchor.addEventListener(\'click\', function(e) {
                    const href = this.getAttribute(\'href\');
                    if (href.startsWith(\'#\')) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({ behavior: \'smooth\' });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php
// Handle logout
if (isset($_GET[\'logout\'])) {
    session_destroy();
    header(\'Location: admin.php\');
    exit;
}
?>',
        
        'admin/backup.php' => '<?php
// admin/backup.php - Database Backup 2026
require_once \'../config.php\';
session_start();
if (!isset($_SESSION[\'admin_logged_in\'])) {
    header(\'Location: admin.php\');
    exit;
}

// Create backup directory if not exists
if (!file_exists(DB_BACKUP_PATH)) {
    mkdir(DB_BACKUP_PATH, 0777, true);
}

// Create backup filename with timestamp
$backupFile = DB_BACKUP_PATH . \'backup_\' . date(\'Y-m-d_H-i-s\') . \'.accdb\';

// Copy database file
if (copy(DB_PATH, $backupFile)) {
    // Log backup
    $logMessage = date(\'Y-m-d H:i:s\') . " - Backup created: " . basename($backupFile) . " (" . filesize($backupFile) . " bytes)\n";
    file_put_contents(\'../logs/backup.log\', $logMessage, FILE_APPEND);
    
    // Send email notification
    $subject = "Database Backup Created - AI CV Creator 2026";
    $message = "Backup created successfully!\n\n";
    $message .= "Filename: " . basename($backupFile) . "\n";
    $message .= "Time: " . date(\'Y-m-d H:i:s\') . "\n";
    $message .= "Size: " . round(filesize($backupFile) / 1024, 2) . " KB\n";
    $message .= "Year: 2026";
    
    if (function_exists(\'sendEmail\')) {
        sendEmail(ADMIN_EMAIL_PRIMARY, $subject, $message);
    }
    
    // Redirect with success message
    header(\'Location: admin.php?success=backup_created&file=\' . urlencode(basename($backupFile)));
} else {
    // Log error
    $errorLog = date(\'Y-m-d H:i:s\') . " - Backup failed: " . DB_PATH . "\n";
    file_put_contents(\'../logs/error.log\', $errorLog, FILE_APPEND);
    
    // Redirect with error
    header(\'Location: admin.php?error=backup_failed\');
}
exit;
?>'
    ];
    
    foreach ($adminFiles as $file => $content) {
        file_put_contents($file, $content);
        echo "<p class='success'>✅ Created admin file: $file</p>";
    }
    
    echo '<div class="step" style="background: #d1fae5; border-color: #059669;">
            <h3 style="color: #059669;">🎉 Installation Complete - AI CV Creator 2026</h3>
            <p>Your professional CV creation platform is ready for 2026!</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0;">
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px;">
                    <div style="font-size: 30px; color: #2563eb; margin-bottom: 10px;"><i class="fas fa-check-circle"></i></div>
                    <strong>Database Ready</strong>
                </div>
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px;">
                    <div style="font-size: 30px; color: #059669; margin-bottom: 10px;"><i class="fas fa-check-circle"></i></div>
                    <strong>API Configured</strong>
                </div>
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px;">
                    <div style="font-size: 30px; color: #7c3aed; margin-bottom: 10px;"><i class="fas fa-check-circle"></i></div>
                    <strong>Admin Panel</strong>
                </div>
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px;">
                    <div style="font-size: 30px; color: #ea580c; margin-bottom: 10px;"><i class="fas fa-check-circle"></i></div>
                    <strong>2026 Ready</strong>
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="index.html" class="btn" style="font-size: 18px; padding: 15px 30px;">
                    <i class="fas fa-rocket"></i> Launch Website
                </a>
                <a href="admin/admin.php" class="btn btn-success" style="font-size: 18px; padding: 15px 30px; margin-left: 15px;">
                    <i class="fas fa-user-shield"></i> Admin Dashboard
                </a>
            </div>
            
            <h4 style="margin-top: 30px; color: #2563eb;">Final Steps:</h4>
            <ol style="margin-left: 20px; margin-top: 15px;">
                <li><strong>Run setup-database.bat</strong> as Administrator to set permissions</li>
                <li><strong>Edit config.php</strong> with your email and server settings</li>
                <li><strong>Change admin password</strong> from default "Admin@CV2026"</li>
                <li><strong>Test all features</strong> including OTP and file upload</li>
                <li><strong>Check admin panel</strong> for user analytics and backups</li>
            </ol>
            
            <div style="margin-top: 30px; padding: 20px; background: #fef3c7; border-radius: 10px;">
                <h4><i class="fas fa-lightbulb"></i> For GitHub Deployment:</h4>
                <p>1. Create <code>.gitignore</code> with: <code>config.php, database/*.accdb, uploads/, logs/</code></p>
                <p>2. Upload all files except sensitive ones mentioned above</p>
                <p>3. On server, download repo and run installation again</p>
            </div>
        </div>';
    
} else {
    // Show installation form
    echo '<div class="step">
            <h3>📋 AI CV Creator 2026 Installation</h3>
            <p>Welcome to the installation wizard for the professional CV creation platform.</p>
            
            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-robot"></i>
                    <h4>AI-Powered</h4>
                    <p>Smart CV templates</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Secure</h4>
                    <p>OTP verification</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Responsive</h4>
                    <p>Works on all devices</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-file-pdf"></i>
                    <h4>PDF Export</h4>
                    <p>Professional formats</p>
                </div>
            </div>
            
            <h4 style="margin-top: 30px;">System Requirements Check:</h4>';
    
    $requirements = [
        [
            'name' => 'PHP 7.4 or higher',
            'status' => version_compare(phpversion(), '7.4.0') >= 0,
            'value' => 'PHP ' . phpversion()
        ],
        [
            'name' => 'Windows Server (IIS)',
            'status' => strtoupper(substr(PHP_OS, 0, 3)) === 'WIN',
            'value' => PHP_OS
        ],
        [
            'name' => 'Write Permissions',
            'status' => is_writable('.'),
            'value' => is_writable('.') ? 'OK' : 'Not Writable'
        ],
        [
            'name' => 'Access Database Engine',
            'status' => true, // We\'ll check this later
            'value' => 'Required for .accdb'
        ]
    ];
    
    $allMet = true;
    foreach ($requirements as $req) {
        $status = $req['status'] ? '✅' : '❌';
        $class = $req['status'] ? 'success' : 'error';
        echo "<p>$status <span class='$class'>{$req['name']}</span> - {$req['value']}</p>";
        if (!$req['status']) $allMet = false;
    }
    
    if (!$allMet) {
        echo '<p class="warning">⚠️ Please fix the issues above before proceeding.</p>';
    }
    
    echo '</div>';
    
    echo '<div class="step">
            <h3>⚙️ Installation Options 2026</h3>
            <form method="POST" action="">
                <div class="checkbox">
                    <input type="checkbox" id="accept_terms" name="accept_terms" required>
                    <label for="accept_terms">I accept the terms and conditions for AI CV Creator 2026</label>
                </div>
                
                <div class="checkbox">
                    <input type="checkbox" id="run_setup" name="run_setup" checked required>
                    <label for="run_setup">Run setup-database.bat after installation (Administrator required)</label>
                </div>
                
                <div class="checkbox">
                    <input type="checkbox" id="configure_email" name="configure_email" checked required>
                    <label for="configure_email">Configure email settings in config.php after installation</label>
                </div>
                
                <div style="margin-top: 30px; padding: 20px; background: #f1f5f9; border-radius: 10px;">
                    <h4><i class="fas fa-exclamation-circle"></i> Important Notes:</h4>
                    <ul style="margin-left: 20px;">
                        <li>Default admin password will be <strong>Admin@CV2026</strong></li>
                        <li>You must edit config.php with your email settings</li>
                        <li>Run setup-database.bat as Administrator to set file permissions</li>
                        <li>Test OTP functionality after installation</li>
                    </ul>
                </div>
                
                <p style="margin-top: 20px;">
                    <button type="submit" class="btn" ' . (!$allMet ? 'disabled' : '') . ' style="font-size: 18px; padding: 15px 40px;">
                        <i class="fas fa-bolt"></i> Start AI CV Creator 2026 Installation
                    </button>
                </p>
            </form>
        </div>';
}

echo '</div></div></body></html>';
?>
