@echo off
echo Generating Laravel Application Key...
C:\xampp\php\php.exe artisan key:generate
echo Application key generated successfully!
echo.
echo Starting Laravel Server...
C:\xampp\php\php.exe artisan serve --host=localhost --port=8000
pause
