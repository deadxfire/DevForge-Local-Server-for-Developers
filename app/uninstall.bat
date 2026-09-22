@echo off
setlocal enabledelayedexpansion
title DevForge Uninstaller

echo ======================================================================
echo                      DevForge Complete Uninstaller
echo ======================================================================
echo.
echo NOTE: All DevForge runtimes, configurations, databases, and application
echo       files will be removed.
echo.
echo       *** YOUR PROJECT FILES IN C:\DevForge\projects WILL BE PRESERVED ***
echo ======================================================================
echo.

set /p CONFIRM="Are you sure you want to completely uninstall DevForge? (Y/N): "
if /i not "%CONFIRM%"=="Y" (
    echo Uninstallation cancelled.
    exit /b 0
)

echo.
echo [1/4] Stopping all active DevForge services and processes...
taskkill /F /IM DevForge.App.exe >nul 2>&1
taskkill /F /IM httpd.exe >nul 2>&1
taskkill /F /IM mysqld.exe >nul 2>&1
taskkill /F /IM mailpit.exe >nul 2>&1

echo [2/4] Searching for DevForge Windows Installer registration...
set "UNINST_FOUND=0"
set "UNINST_CMD="

:: 1. Search in 64-bit registry
for /f "tokens=*" %%K in ('reg query "HKLM\SOFTWARE\Microsoft\Windows\CurrentVersion\Uninstall" 2^>nul') do (
    for /f "tokens=2,*" %%A in ('reg query "%%K" /v DisplayName 2^>nul ^| findstr /i /c:"DevForge"') do (
        for /f "tokens=2,*" %%C in ('reg query "%%K" /v UninstallString 2^>nul') do (
            set "UNINST_FOUND=1"
            set "UNINST_CMD=%%D"
            goto :run_uninstaller
        )
    )
)

:: 2. Search in WOW6432Node registry
for /f "tokens=*" %%K in ('reg query "HKLM\SOFTWARE\WOW6432Node\Microsoft\Windows\CurrentVersion\Uninstall" 2^>nul') do (
    for /f "tokens=2,*" %%A in ('reg query "%%K" /v DisplayName 2^>nul ^| findstr /i /c:"DevForge"') do (
        for /f "tokens=2,*" %%C in ('reg query "%%K" /v UninstallString 2^>nul') do (
            set "UNINST_FOUND=1"
            set "UNINST_CMD=%%D"
            goto :run_uninstaller
        )
    )
)

:: 3. Fallback: Search in HKCU
for /f "tokens=*" %%K in ('reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Uninstall" 2^>nul') do (
    for /f "tokens=2,*" %%A in ('reg query "%%K" /v DisplayName 2^>nul ^| findstr /i /c:"DevForge"') do (
        for /f "tokens=2,*" %%C in ('reg query "%%K" /v UninstallString 2^>nul') do (
            set "UNINST_FOUND=1"
            set "UNINST_CMD=%%D"
            goto :run_uninstaller
        )
    )
)

:run_uninstaller
if "%UNINST_FOUND%"=="1" (
    echo Executing Windows Uninstaller: !UNINST_CMD!
    call !UNINST_CMD!
) else (
    echo No MSI registration found; proceeding with manual file cleanup...
)

echo [3/4] Cleaning DevForge runtime data (preserving C:\DevForge\projects)...
powershell.exe -NoProfile -ExecutionPolicy Bypass -Command "$root = 'C:\DevForge'; if (Test-Path $root) { Write-Host 'Scanning ' $root; Get-ChildItem -Path $root | Where-Object { $_.Name -ne 'projects' } | ForEach-Object { Write-Host 'Removing' $_.FullName; Remove-Item -LiteralPath $_.FullName -Recurse -Force -ErrorAction SilentlyContinue } }; $appData = Join-Path $env:LOCALAPPDATA 'DevForge'; if (Test-Path $appData) { Remove-Item -LiteralPath $appData -Recurse -Force -ErrorAction SilentlyContinue }"

echo [4/4] Cleaning shortcuts...
del /f /q "%USERPROFILE%\Desktop\DevForge.lnk" >nul 2>&1
del /f /q "%PUBLIC%\Desktop\DevForge.lnk" >nul 2>&1
rd /s /q "%APPDATA%\Microsoft\Windows\Start Menu\Programs\DevForge" >nul 2>&1

echo.
echo ======================================================================
echo DevForge has been successfully uninstalled.
echo.
echo PRESERVED: Your website projects in C:\DevForge\projects were NOT touched.
echo ======================================================================
echo.
pause
exit /b 0
