@echo off
echo Installing dependencies...
cd /d "c:\Users\ASUS\Downloads\sistem-data-pasien-main\sistem-data-pasien-main"
C:\xampp\php\php.exe "C:\xampp\composer.phar" install
echo.
echo Running migration...
C:\xampp\php\php.exe artisan migrate
pause
