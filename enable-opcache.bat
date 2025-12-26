@echo off
echo ; === OPCACHE OPTIMIZATION === >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo zend_extension=opcache >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo opcache.enable=1 >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo opcache.memory_consumption=256 >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo opcache.max_accelerated_files=20000 >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo opcache.validate_timestamps=1 >> "c:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.ini"
echo Opcache config added!
