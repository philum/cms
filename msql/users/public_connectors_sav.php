<?php
//philum_microsql_public_connectors
$public_connectors["_menus_"]=array('function');
$public_connectors["count"]=array('users/public_defcons§msq_count:conn');
$public_connectors["cut"]=array('//:cut return older connector
abcdef§b/e:cut
br
abcdef/b/e/0§embed_detect:core');
$public_connectors["split"]=array('+string§i:split
_1§:text
br
/used to split subparam
!_PARAM=p/b
+_PARAM§/:split
_1§_2:html');
$public_connectors["plug"]=array('!_PARAM=login
_PARAM§register:plug');
$public_connectors["if"]=array('_PARAM§:text
/affect if empty
!_PARAM=
?_PARAM=hello
br
_PARAM§:text');
$public_connectors["balise"]=array('!_PARAM=p/b
+_PARAM§/:split
-_1§_2:html');
$public_connectors["read"]=array('!_PARAM=365
_PARAM§4§pub:conn§h2:html
_PARAM:read§div||panel justy:balise');
$public_connectors["philum"]=array('[[[[:version]:idart]§Version [:version]]:b]

[ark§everaldo/128:icon]

[[philum_philumsize_[:version]§Ko:microsql] Ko / [philum_philumsize_[:version]§functions:microsql] fonctions:l]
[[system/admin_modules:msq_count] modules à placer sur les pages:l]
[[users/public_defcons:msq_count] définitions d\'importation de sites:l]
[[system/connectors_all:msq_count] connecteurs à placer dans les articles:l] 
[[system/program_core:msq_count] fonctions publiques du noyau:l] 
[[system/edition_typos:msq_count] typos libres de droits
703 icones cristallins !:l]');
$public_connectors["phi-lastupdate"]=array('/return most recent entry
!_PARAM=ym:date
!1=ym:date
!2=system/program_updates__1§msq_count:conn
/_1 _2 :
/br
+system/program_updates__1/_2§msql_read:core
_1 : _2:');
$public_connectors["dl"]=array('[[333§Version _PARAM]:b]

[users/philum/maj/installer.tar.gz§[ark§everaldo/128:icon]:url]

[[philum_philumsize__PARAM§Ko:microsql] Ko / [philum_philumsize__PARAM§functions:microsql] fonctions:l]
[[system/admin_modules:msq_count] modules à placer sur les pages:l]
[[users/public_defcons:msq_count] définitions d\'importation de sites:l]
[[system/connectors_all:msq_count] connecteurs à placer dans les articles:l] 
[[system/program_core:msq_count] fonctions publiques du noyau:l] 
[[system/edition_typos:msq_count] typos libres de droits
703 icones cristallins !:l]');
$public_connectors["stext"]=array('_PARAM:text

:text');
$public_connectors["philum_basic"]=array(':version!idart:conn
§Version :version

ark§everaldo/128:icon:conn

[[philum_philumsize_[:version]§Ko:microsql] Ko / [philum_philumsize_[:version]§functions:microsql] fonctions:l]
[[system/admin_modules:msq_count] modules à placer sur les pages:l]
[[users/public_defcons:msq_count] définitions d\'importation de sites:l]
[[system/connectors_all:msq_count] connecteurs à placer dans les articles:l] 
[[system/program_core:msq_count] fonctions publiques du noyau:l] 
[[system/edition_typos:msq_count] typos libres de droits
703 icones cristallins !:l]');
$public_connectors["login"]=array('!_PARAM=login
_PARAM§register:plug');

?>