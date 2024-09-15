@echo off
set DB_LOCALHOST=localhost
set DB_NAME=yii2basic
set DB_USERNAME=root
set DB_PASSWORD=12345678
set DB_CHARSET=utf8
set SALT=thlEfgPoewvHLPqlGYgfegPuTr84F12qFViHOzbcJcjLjyQteK1stax9cmWHlWuY0clus4YiLmVkHYkaIux24kaA6khPxiHGmsZi

echo DB_LOCALHOST: %DB_LOCALHOST%
echo DB_NAME: %DB_NAME%
echo DB_USERNAME: %DB_USERNAME%
echo DB_PASSWORD: %DB_PASSWORD%
echo DB_CHARSET: %DB_CHARSET%
echo SALT: %SALT%

@REM ejcutar el servidor de desarrollo de Yii2

..\yii serve

