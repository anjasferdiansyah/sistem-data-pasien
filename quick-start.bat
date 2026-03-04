@echo off
echo ========================================
echo    QUICK START - SISTEM DATA PASIEN
echo ========================================
echo.

echo Step 1: Navigate to project directory...
cd /d "c:\Users\ASUS\Downloads\sistem-data-pasien-main\sistem-data-pasien-main"

echo Step 2: Install dependencies using PHP Composer...
echo Downloading Composer if not exists...
if not exist "composer.phar" (
    powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/download/latest-stable/composer.phar' -OutFile 'composer.phar'"
)

echo Installing vendor packages...
C:\xampp\php\php.exe composer.phar install

echo Step 3: Run database migration...
C:\xampp\php\php.exe artisan migrate --force

echo Step 4: Start Laravel server...
echo.
echo ========================================
echo SERVER STARTING...
echo Open: http://localhost:8000/data-pasien
echo Press Ctrl+C to stop
echo ========================================
echo.

C:\xampp\php\php.exe artisan serve --host=localhost --port=8000
