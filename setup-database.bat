@echo off
echo ========================================
echo AI CV Creator Database Setup Script
echo ========================================
echo.

REM Check if running as administrator
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo ERROR: Please run as Administrator!
    echo Right-click Command Prompt and select "Run as administrator"
    pause
    exit /b 1
)

echo Step 1: Setting up directory structure...
cd /d C:\inetpub\wwwroot\cv_creator

REM Create necessary directories
if not exist database mkdir database
if not exist uploads mkdir uploads
if not exist uploads\photos mkdir uploads\photos
if not exist logs mkdir logs
if not exist api mkdir api
if not exist admin mkdir admin

echo Step 2: Setting permissions for database folder...
icacls database /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls database /grant "Everyone:(OI)(CI)F" /T
icacls database /grant "NETWORK SERVICE:(OI)(CI)F" /T
icacls database /grant "%USERNAME%:(OI)(CI)F" /T

echo Step 3: Setting permissions for uploads folder...
icacls uploads /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls uploads /grant "Everyone:(OI)(CI)F" /T
icacls uploads /grant "NETWORK SERVICE:(OI)(CI)F" /T
icacls uploads\photos /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls uploads\photos /grant "Everyone:(OI)(CI)F" /T

echo Step 4: Setting permissions for logs folder...
icacls logs /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls logs /grant "Everyone:(OI)(CI)F" /T

echo Step 5: Setting permissions for API folder...
icacls api /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls api /grant "Everyone:(OI)(CI)F" /T

echo Step 6: Creating test database file...
REM Create empty .accdb file using PowerShell
powershell -Command "& {[System.IO.File]::WriteAllBytes('C:\inetpub\wwwroot\cv_creator\database\cv_users.accdb', [byte[]]@())}"

echo Step 7: Setting permissions for database file...
icacls database\cv_users.accdb /grant "IIS_IUSRS:F"
icacls database\cv_users.accdb /grant "Everyone:F"
icacls database\cv_users.accdb /grant "%USERNAME%:F"

echo.
echo ========================================
echo SETUP COMPLETE!
echo ========================================
echo.
echo Created database file: C:\inetpub\wwwroot\cv_creator\database\cv_users.accdb
echo.
echo Next steps:
echo 1. Run install.php in browser: http://localhost/cv_creator/install.php
echo 2. Access website: http://localhost/cv_creator/
echo 3. Admin panel: http://localhost/cv_creator/admin/admin.php
echo.
pause