@echo off
echo Checking Laravel Application Key...
C:\xampp\php\php.exe check-key.php
echo.
echo Press any key to start server...
pause > nul
C:\xampp\php\php.exe artisan serve --host=localhost --port=8000
