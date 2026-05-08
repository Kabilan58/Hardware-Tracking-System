@echo off
title HWTracking Project Auto Starter (Admin & Minimized)
color 0A

:: ------------------------------------------------------
:: Check for administrator privileges
:: ------------------------------------------------------
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo ⚠️ Administrator rights required. Restarting as admin...
    powershell -Command "Start-Process '%~f0' -Verb RunAs"
    exit /b
)

echo =====================================================
echo         🚀 Launching HWTracking Project Setup
echo =====================================================

:: ------------------------------------------------------
:: Step 1 — Start XAMPP Control Panel minimized as Admin
:: ------------------------------------------------------
cd /d "C:\xampp"
powershell -Command "Start-Process 'xampp-control.exe' -WindowStyle Minimized -Verb RunAs"
timeout /t 3 /nobreak >nul

:: ------------------------------------------------------
:: Step 2 — Start Apache service if not running
:: ------------------------------------------------------
echo Checking Apache service...
sc query "Apache2.4" | find "RUNNING" >nul
if errorlevel 1 (
    echo Apache not running. Starting now...
    net start Apache2.4 >nul 2>&1
) else (
    echo Apache already running.
)

:: ------------------------------------------------------
:: Step 3 — Start MySQL service if not running
:: ------------------------------------------------------
echo Checking MySQL service...
sc query "MySQL" | find "RUNNING" >nul
if errorlevel 1 (
    echo MySQL not running. Starting now...
    net start MySQL >nul 2>&1
) else (
    echo MySQL already running.
)

:: ------------------------------------------------------
:: Step 4 — Wait for Apache to be ready on port 80
:: ------------------------------------------------------
echo Waiting for Apache to fully start on port 80...
set /a ApacheSec=0
:WaitApache
timeout /t 1 /nobreak >nul
set /a ApacheSec+=1
set /p=Waiting for Apache... %ApacheSec%s <nul
echo.
powershell -Command "$tcp=Test-NetConnection -ComputerName localhost -Port 80; if($tcp.TcpTestSucceeded){exit 0}else{exit 1}"
if errorlevel 1 goto WaitApache

:: ------------------------------------------------------
:: Step 5 — Wait for MySQL to be ready on port 3306
:: ------------------------------------------------------
echo Waiting for MySQL to fully start on port 3306...
set /a MySQLSec=0
:WaitMySQL
timeout /t 1 /nobreak >nul
set /a MySQLSec+=1
set /p=Waiting for MySQL... %MySQLSec%s <nul
echo.
powershell -Command "$tcp=Test-NetConnection -ComputerName localhost -Port 3306; if($tcp.TcpTestSucceeded){exit 0}else{exit 1}"
if errorlevel 1 goto WaitMySQL

:: ------------------------------------------------------
:: Step 6 — Open project in Chrome
:: ------------------------------------------------------
echo Apache and MySQL are ready. Opening HWTracking project in Chrome...
if exist "C:\Program Files\Google\Chrome\Application\chrome.exe" (
    start "" "C:\Program Files\Google\Chrome\Application\chrome.exe" --new-window "http://localhost/hwtracking/"
) else if exist "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" (
    start "" "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" --new-window "http://localhost/hwtracking/"
) else (
    start "" "http://localhost/hwtracking/"
)

:: ------------------------------------------------------
:: Step 7 — Show final popup notification
:: ------------------------------------------------------
powershell -Command "Add-Type -AssemblyName PresentationFramework;[System.Windows.MessageBox]::Show('✅ HWTracking Project is Ready! Apache and MySQL are running.','HWTracking Launcher')"


echo =====================================================
echo ✅ All set! Apache and MySQL are running.
echo =====================================================
exit
