@echo off
echo ========================================
echo    SISTEM DATA PASIEN - FINAL SETUP
echo ========================================
echo.

echo [1/5] Checking XAMPP services...
net start | findstr "mysql" > nul
if %errorlevel% neq 0 (
    echo Starting MySQL service...
    net start mysql
) else (
    echo MySQL is already running.
)

echo.
echo [2/5] Installing Composer...
if not exist "composer.phar" (
    echo Downloading Composer...
    powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/download/latest-stable/composer.phar' -OutFile 'composer.phar'"
)

echo.
echo [3/5] Installing PHP dependencies...
C:\xampp\php\php.exe composer.phar install

echo.
echo [4/5] Running database migrations...
C:\xampp\php\php.exe artisan migrate --force

echo.
echo [5/5] Starting Laravel development server...
echo.
echo ========================================
echo    SERVER READY!
echo ========================================
echo Login Page: http://localhost:8000/login
echo Register: http://localhost:8000/register
echo Data Pasien: http://localhost:8000/data-pasien
echo.
echo Press Ctrl+C to stop the server
echo ========================================
echo.

C:\xampp\php\php.exe artisan serve --host=localhost --port=8000
