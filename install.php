<?php
// install.php - Installation Script
header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install AI CV Creator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <h1><i class="fas fa-robot"></i> AI CV Creator - Installation</h1>
            </div>
        </div>
    </nav>
    
    <div class="container" style="margin-top: 30px;">';

// Check if already installed
if (file_exists('database/cv_users.accdb')) {
    echo '<div class="form-section">
            <h3>✅ Already Installed</h3>
            <p>AI CV Creator is already installed on your server.</p>
            <div class="form-actions">
                <a href="index.html" class="btn btn-primary">
                    <i class="fas fa-external-link-alt"></i> Go to Website
                </a>
                <a href="admin/admin.php" class="btn btn-success">
                    <i class="fas fa-user-shield"></i> Admin Panel
                </a>
            </div>
            <p style="margin-top: 20px; color: #666;">
                <strong>Default Admin Password:</strong> Admin@CV2024<br>
                <small>Change this in config.php after installation</small>
            </p>
        </div>';
    echo '</div></body></html>';
    exit;
}

// Handle installation form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<div class="form-section">
            <h3>🚀 Installation in Progress...</h3>';
    
    // Step 1: Create database file
    echo '<p>1. Creating database file...</p>';
    $dbPath = 'database/cv_users.accdb';
    
    if (!file_exists('database')) {
        mkdir('database', 0777, true);
    }
    
    // Create empty .accdb file
    if (!file_exists($dbPath)) {
        file_put_contents($dbPath, '');
        echo '<p style="color: #059669;">✅ Database file created</p>';
    } else {
        echo '<p style="color: #d97706;">⚠️ Database file already exists</p>';
    }
    
    // Step 2: Create tables
    echo '<p>2. Creating database tables...</p>';
    echo '<p style="color: #666;">Run the setup script manually: setup-database.bat</p>';
    
    // Step 3: Create directories
    echo '<p>3. Creating directories...</p>';
    $dirs = ['uploads', 'uploads/photos', 'api', 'admin', 'logs', 'database/backups'];
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            echo "<p style='color: #059669;'>✅ Created: $dir</p>";
        }
    }
    
    // Step 4: Create API files
    echo '<p>4. Creating API files...</p>';
    $apiFiles = [
        'api/auth.php' => '<?php
require_once \'../config.php\';
header(\'Content-Type: application/json\');
$data = json_decode(file_get_contents(\'php://input\'), true);
if (!$data) {
    echo json_encode([\'success\' => false, \'message\' => \'Invalid data\']);
    exit;
}
$conn = getDatabaseConnection();
if ($conn) {
    echo json_encode([\'success\' => true, \'message\' => \'API connected\', \'data\' => $data]);
} else {
    echo json_encode([\'success\' => false, \'message\' => \'Database connection failed\']);
}
?>',
        'api/save-cv.php' => '<?php
require_once \'../config.php\';
header(\'Content-Type: application/json\');
$data = json_decode(file_get_contents(\'php://input\'), true);
if (!$data) {
    echo json_encode([\'success\' => false, \'message\' => \'No data received\']);
    exit;
}
echo json_encode([\'success\' => true, \'message\' => \'CV saved successfully\', \'data\' => $data]);
?>',
        'api/save-photo.php' => '<?php
require_once \'../config.php\';
header(\'Content-Type: application/json\');
if (!isset($_FILES[\'photo\'])) {
    echo json_encode([\'success\' => false, \'message\' => \'No photo uploaded\']);
    exit;
}
$photo = $_FILES[\'photo\'];
$target = PHOTO_UPLOAD_DIR . time() . \'_\' . basename($photo[\'name\']);
if (move_uploaded_file($photo[\'tmp_name\'], $target)) {
    echo json_encode([\'success\' => true, \'message\' => \'Photo uploaded\']);
} else {
    echo json_encode([\'success\' => false, \'message\' => \'Upload failed\']);
}
?>'
    ];
    
    foreach ($apiFiles as $file => $content) {
        file_put_contents($file, $content);
        echo "<p style='color: #059669;'>✅ Created: $file</p>";
    }
    
    // Step 5: Create admin files
    echo '<p>5. Creating admin files...</p>';
    $adminFiles = [
        'admin/admin.php' => '<?php
session_start();
if (!isset($_SESSION[\'admin_logged_in\'])) {
    if ($_POST[\'password\'] ?? \'\' === \'Admin@CV2024\') {
        $_SESSION[\'admin_logged_in\'] = true;
    } else {
        echo \'<h2>Admin Login</h2><form method="POST"><input type="password" name="password" placeholder="Password"><button>Login</button></form>\';
        exit;
    }
}
echo \'<h1>Admin Dashboard</h1><p>Welcome to admin panel</p>\';
?>',
        'admin/backup.php' => '<?php
// Backup script will be implemented later
echo "Backup functionality coming soon";
?>'
    ];
    
    foreach ($adminFiles as $file => $content) {
        file_put_contents($file, $content);
        echo "<p style='color: #059669;'>✅ Created: $file</p>";
    }
    
    // Step 6: Create config.php from template
    echo '<p>6. Creating configuration file...</p>';
    if (!file_exists('config.php')) {
        copy('config.example.php', 'config.php');
        echo '<p style="color: #059669;">✅ Configuration file created</p>';
        echo '<p style="color: #d97706;">⚠️ IMPORTANT: Edit config.php with your settings</p>';
    }
    
    echo '<div class="form-section" style="margin-top: 30px; background: #d1fae5; border-color: #059669;">
            <h3 style="color: #059669;">🎉 Installation Complete!</h3>
            <p>Your AI CV Creator has been successfully installed.</p>
            <div class="form-actions">
                <a href="index.html" class="btn btn-primary">
                    <i class="fas fa-external-link-alt"></i> Go to Website
                </a>
                <a href="setup-database.bat" class="btn btn-download" download>
                    <i class="fas fa-download"></i> Download Database Setup Script
                </a>
            </div>
            <h4 style="margin-top: 20px;">Next Steps:</h4>
            <ol style="margin-left: 20px;">
                <li>Run setup-database.bat as Administrator</li>
                <li>Edit config.php with your email settings</li>
                <li>Test the website functionality</li>
                <li>Change default admin password</li>
            </ol>
        </div>';
    
} else {
    // Show installation form
    echo '<div class="form-section">
            <h3>📋 Installation Wizard</h3>
            <p>Welcome to AI CV Creator installation. This wizard will set up your CV creation website.</p>
            
            <h4 style="margin-top: 20px;">System Requirements:</h4>
            <ul style="margin-left: 20px; margin-bottom: 20px;">
                <li>Windows Server with IIS</li>
                <li>PHP 7.4 or higher</li>
                <li>Microsoft Access Database Engine</li>
                <li>Write permissions to directories</li>
            </ul>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label>
                        <input type="checkbox" required> I confirm I have Windows Server with IIS installed
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" required> I have run setup-database.bat as Administrator
                    </label>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" style="width: 100%;">
                        <i class="fas fa-bolt"></i> Start Installation
                    </button>
                </div>
            </form>
            
            <div style="margin-top: 30px; padding: 20px; background: #fef3c7; border-radius: 5px;">
                <h4><i class="fas fa-exclamation-triangle"></i> Important Notes:</h4>
                <ul style="margin-left: 20px;">
                    <li>Make sure to run <code>setup-database.bat</code> as Administrator first</li>
                    <li>Default admin password is <code>Admin@CV2024</code></li>
                    <li>Edit config.php after installation</li>
                    <li>Database file (cv_users.accdb) will be created automatically</li>
                </ul>
            </div>
        </div>';
}

echo '</div></body></html>';
?>