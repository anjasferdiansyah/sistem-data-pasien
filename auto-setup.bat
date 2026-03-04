@echo off
echo ========================================
echo    SISTEM DATA PASIEN - AUTO SETUP
echo ========================================
echo.

echo [1/4] Checking XAMPP services...
net start | findstr "mysql" > nul
if %errorlevel% neq 0 (
    echo MySQL is not running. Starting MySQL...
    net start mysql
) else (
    echo MySQL is already running.
)

echo.
echo [2/4] Installing Composer (if needed)...
if not exist "C:\ProgramData\ComposerSetup\bin\composer.bat" (
    echo Downloading Composer...
    powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/Composer-Setup.exe' -OutFile 'composer-setup.exe'"
    echo Installing Composer...
    start /wait composer-setup.exe
    del composer-setup.exe
) else (
    echo Composer already installed.
)

echo.
echo [3/4] Installing PHP dependencies...
cd /d "c:\Users\ASUS\Downloads\sistem-data-pasien-main\sistem-data-pasien-main"
call composer install

echo.
echo [4/4] Running database migration...
C:\xampp\php\php.exe artisan migrate --force

echo.
echo ========================================
echo    SETUP COMPLETED!
echo ========================================
echo.
echo Starting Laravel server...
echo Server will run at: http://localhost:8000/data-pasien
echo Press Ctrl+C to stop the server
echo.

C:\xampp\php\php.exe artisan serve --host=localhost --port=8000
