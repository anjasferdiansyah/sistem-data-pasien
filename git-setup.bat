@echo off
echo ========================================
echo    GIT SETUP & PUSH
echo ========================================
echo.

echo [1/4] Initializing git repository...
git init

echo.
echo [2/4] Adding all files...
git add .

echo.
echo [3/4] Creating initial commit...
git commit -m "Initial commit: Sistem Data Pasien dengan Authentication

- Database MySQL XAMPP dengan database 'javan'
- Migration tabel data-pasien
- CRUD lengkap data pasien
- Authentication (login/register/logout)
- Bootstrap 5 UI responsive
- Middleware proteksi halaman
- Validasi form dan flash messages"

echo.
echo [4/4] Ready for remote setup!
echo.
echo Next steps:
echo 1. Buat repository di GitHub/GitLab
echo 2. Add remote: git remote add origin <URL_REPO>
echo 3. Push: git push -u origin main
echo.
echo Repository siap untuk di-push!
echo.
pause
