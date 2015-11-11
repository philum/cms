<?php
//philum_microsql_program_errors
$r["_menus_"]=array('error','repair');
$r[1]=array('error 500','permission error : delete all and re-install from installer without copy yourself files by ftp ;
the server set himself his good permissions : 777 or 705

on installed servers, just put the unworking file on permission 705 or specified number by server');
$r[2]=array('lot of messages type \'Notice\'','from php 5.3 the installer add .user.ini to set error_reporting(E_STRICT)');
$r[3]=array('Unable to access','error from .htaccess : the installed one does not know the specifications of the server ; make a backup and erase it, then modify it and try again !');
$r[4]=array('error with files','error of permission on the server, change it to 664 or 777 by ftp');

?>