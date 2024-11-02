@echo off
set D=%DATE:~6,4%%DATE:~3,2%%DATE:~0,2%
set T=%TIME:~0,2%%TIME:~3,2%%TIME:~6,2%
rem C:\www\mariadb\bin\mysqldump --extended-insert=false --port=3307 --user=root --password=root markup_datamist > ./dumps/%D%-%T%_markup_datamist.sql
C:\www\mariadb\bin\mysqldump --extended-insert=false --port=3307 --user=root --password=root markup_datamist > ./dumps/_markup_datamist.sql
