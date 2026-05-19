@echo off
setlocal enabledelayedexpansion

rem Busca la IP asignada por DHCP (la IP real de la red, no adaptadores virtuales)
for /f %%i in ('powershell -NoProfile -Command "Get-NetIPAddress -AddressFamily IPv4 | Where-Object { $_.PrefixOrigin -eq 'Dhcp' } | Select-Object -First 1 -ExpandProperty IPAddress"') do set IP=%%i

if "%IP%"=="" (
    echo No se encontro IP por DHCP, usando localhost...
    set IP=localhost
)

echo.
echo  Abriendo StatsZone en: http://%IP%/ProyectoFinal/ProyectoFinal/
echo  Puedes compartir esa direccion con cualquier dispositivo de tu red.
echo.

start http://%IP%/ProyectoFinal/ProyectoFinal/
