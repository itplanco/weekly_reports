@if "%SCM_TRACE_LEVEL%" NEQ "4" @echo off

:: ----------------------
:: KUDU Deployment Script
:: Version: 1.0.13
:: ----------------------

:: Prerequisites
:: -------------

:: Verify node.js installed
where node 2>nul >nul
IF %ERRORLEVEL% NEQ 0 (
  echo Missing node.js executable, please install node.js, if already installed make sure it can be reached from current environment.
  goto error
)

:: Setup
:: -----

setlocal enabledelayedexpansion

SET ARTIFACTS=%~dp0%..\artifacts

IF NOT DEFINED DEPLOYMENT_SOURCE (
  SET DEPLOYMENT_SOURCE=%~dp0%.
)

IF NOT DEFINED DEPLOYMENT_TARGET (
  SET DEPLOYMENT_TARGET=%ARTIFACTS%\wwwroot
)

IF NOT DEFINED NEXT_MANIFEST_PATH (
  SET NEXT_MANIFEST_PATH=%ARTIFACTS%\manifest

  IF NOT DEFINED PREVIOUS_MANIFEST_PATH (
    SET PREVIOUS_MANIFEST_PATH=%ARTIFACTS%\manifest
  )
)

IF NOT DEFINED KUDU_SYNC_CMD (
  :: Install kudu sync
  echo Installing Kudu Sync
  call npm install kudusync -g --silent
  IF !ERRORLEVEL! NEQ 0 goto error

  :: Locally just running "kuduSync" would also work
  SET KUDU_SYNC_CMD=%appdata%\npm\kuduSync.cmd
)

IF NOT DEFINED DEPLOYMENT_SERVER_SOURCE (
  SET DEPLOYMENT_SERVER_SOURCE=%DEPLOYMENT_SOURCE%\src\server
)

IF NOT DEFINED DEPLOYMENT_CLIENT_SOURCE (
  SET DEPLOYMENT_CLIENT_SOURCE=%DEPLOYMENT_SOURCE%\src\client
)

IF NOT DEFINED DEPLOYMENT_CLIENT_DIST (
  SET DEPLOYMENT_CLIENT_DIST=%DEPLOYMENT_CLIENT_SOURCE%\dist
)

::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:: Deployment
:: ----------

:Deployment
echo Handling server deployment.
:: 1. Copy files to temp
IF /I "%IN_PLACE_DEPLOYMENT%" NEQ "1" (
  pushd "%DEPLOYMENT_SERVER_SOURCE%"
  call :ExecuteCmd xcopy * %DEPLOYMENT_TEMP% /E /Y /Q
  IF !ERRORLEVEL! NEQ 0 goto error
  popd
)

echo Handling client deployment.

:: 1. Install npm packages
IF EXIST "%DEPLOYMENT_CLIENT_SOURCE%\package.json" (
  pushd "%DEPLOYMENT_CLIENT_SOURCE%"
  call :ExecuteCmd npm install
  IF !ERRORLEVEL! NEQ 0 goto error
  popd
)

:: 2. Build target
IF EXIST "%DEPLOYMENT_CLIENT_SOURCE%\node_modules" (
  pushd "%DEPLOYMENT_CLIENT_SOURCE%"
  call :ExecuteCmd npm run build
  IF !ERRORLEVEL! NEQ 0 goto error
  popd
)

:: 3. Copy dist to temp
IF /I "%IN_PLACE_DEPLOYMENT%" NEQ "1" (
  pushd "%DEPLOYMENT_CLIENT_DIST%"
  call :ExecuteCmd xcopy * %DEPLOYMENT_TEMP%\public /E /Y /Q
  IF !ERRORLEVEL! NEQ 0 goto error
  popd
)

echo Copy temporary files to target.
:: 1. KuduSync
IF /I "%IN_PLACE_DEPLOYMENT%" NEQ "1" (
  call :ExecuteCmd "%KUDU_SYNC_CMD%" -v 50 -f "%DEPLOYMENT_TEMP%" -t "%DEPLOYMENT_TARGET%" -n "%NEXT_MANIFEST_PATH%" -p "%PREVIOUS_MANIFEST_PATH%" -i ".git;.hg;.deployment;deploy.cmd"
  IF !ERRORLEVEL! NEQ 0 goto error
)

::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
goto end

:: Execute command routine that will echo out when error
:ExecuteCmd
setlocal
set _CMD_=%*
call %_CMD_%
if "%ERRORLEVEL%" NEQ "0" echo Failed exitCode=%ERRORLEVEL%, command=%_CMD_%
exit /b %ERRORLEVEL%

:error
endlocal
echo An error has occurred during web site deployment.
call :exitSetErrorLevel
call :exitFromFunction 2>nul

:exitSetErrorLevel
exit /b 1

:exitFromFunction
()

:end
endlocal
echo Finished successfully.
