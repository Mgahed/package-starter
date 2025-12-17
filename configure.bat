@echo off
pause
echo Configuration completed successfully!
echo.

)
    exit /b 1
    pause
    echo Make sure PHP is installed and in your PATH.
    echo ERROR: Configuration failed!
    echo.
if %ERRORLEVEL% NEQ 0 (

php configure.php

echo.
echo ========================================
echo   Package Configuration Script
echo ========================================
echo.

REM This is a convenience wrapper for configure.php
REM Windows Batch Script to Run Package Configuration

