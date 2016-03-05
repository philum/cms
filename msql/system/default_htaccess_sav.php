<?php
//philum_microsql_default_htaccess
$r["_menus_"]=array('title_1');
$r[1]=array('RewriteEngine on
Options +Indexes
Options -Multiviews
Options +FollowSymlinks
RewriteEngine on
RewriteRule ^([0-9]+)$ /?read=$1 [L]
RewriteRule ^read/([^/])$ /?read=$1#$1 [L]
RewriteRule ^read/(.+)/page/([0-9]+) /?read=$1&page=$2#pages [L]
RewriteRule ^source/(.+)/([0-9]+)/page/([0-9]+)$ /?source=$1&dig=$2&page=$3#pages [L]
RewriteRule ^source/(.+)/([0-9]+)$ /?source=$1&dig=$2 [L]
RewriteRule ^source/(.+)$ /?source=$1 [L]
RewriteRule ^plugin/([^.]+)/([^.]+)/([^.]+)$ /?plug=$1&p=$2&o=$3 [L]
RewriteRule ^plugin/([^.]+)/([^.]+)$ /?plug=$1&p=$2 [L]
RewriteRule ^plugin/([^.]+)$ /?plug=$1 [L]
RewriteRule ^plug/([^.]+)/([^.]+)/([^.]+)$ /plug.php?call=$1&p=$2&o=$3 [L]
RewriteRule ^plug/([^.]+)/([^.]+)$ /plug.php?call=$1&p=$2 [L]
RewriteRule ^plug/([^.]+)$ /plug.php?call=$1 [L]
RewriteRule ^rss/([^.]+)$ /plug/rss.php?hub=$1 [L]
RewriteRule ^module/([^/]+)/page/([0-9]+)$ /?module=$1&page=$2 [L]
RewriteRule ^module/([^/]+)/([^.]+)/page/([0-9]+)$ /?module=$2:$1&page=$3 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3:$1&page=$4 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3/$4:$1&page=$5 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3/$4/$5:$1&page=$6 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/([^.]+)$ /?module=$2/$3/$4/$5:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)$ /?module=$2/$3/$4:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)$ /?module=$2/$3:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)$ /?module=$2:$1 [L]
RewriteRule ^admin/([^/]+)/(.+)$ /?admin=$1&set=$2 [L]
RewriteRule ^msql/(.+)/(.+)/(.+)/([0-9]+)$ /?msql=$1/$2&page=$4 [L]
RewriteRule ^msql/(.+)$ /?msql=$1 [L]
RewriteRule ^([^.]+)/(.+)/([0-9]+)/page/([0-9]+)$ /?$1=$2&dig=$3&page=$4#pages [L]
RewriteRule ^([^.]+)/(.+)/page/([0-9]+) /?$1=$2&page=$3#pages [L]
RewriteRule ^([^.]+)/(.+)/([0-9]+)$ /?$1=$2&dig=$3 [L]
RewriteRule ^reload/(.+) /?id=$1&refresh== [L]
RewriteRule ^([^.]+)/([^.^/]+)$ /?$1=$2 [L]
RewriteRule ^reload /?refresh== [L]
RewriteRule ^home /?module=Home [L]
RewriteRule ^all /?module=All [L]
RewriteRule ^admin /?admin=console [L]
RewriteRule ^login /?module=login [L]
RewriteRule ^logon /?log=on [L]
RewriteRule ^logout /?log=out [L]
RewriteRule ^logoff /?log=off [L]
RewriteRule ^reboot /?log=reboot [L]
RewriteRule ^shutdown /?log=down [L]
RewriteRule ^dev /?dev=dev [L]
RewriteRule ^lab /?dev=lab [L]
RewriteRule ^([^.]+)$ /?id=$1 [L]');

?>