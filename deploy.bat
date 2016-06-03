@ECHO off
SET argC=0
FOR %%x in (%*) do SET /A argC+=1
IF %argc% GTR 1 GOTO Syntax
IF %argc% EQU 0 GOTO Empty
IF EXIST %1 (
	CD %1
	) ELSE (
	GOTO :Directory
	)
WHERE php
IF %ERRORLEVEL% NEQ 0 GOTO Php 
CLS
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixture:load --append
php app/console cache:clear
GOTO:EOF
:Empty
ECHO Syntax Error, You Must Enter Your Project's Directory ex: C:\wamp\www\project
GOTO:EOF
:Syntax
ECHO Syntax Error, You must Enter Only One Parameter (Your Project's Directory ex: C:\wamp\www\project)
GOTO:EOF
:Php
ECHO Either The PHP is not Installed In Your System, Or it's Not Added To The PATH Variable!
GOTO:EOF
:Directory
ECHO Directory Does Not Exist