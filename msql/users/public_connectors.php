<?php
//philum_microsql_public_connectors
$r["_menus_"]=array('function');
$r["count"]=array('/nb de defcons
users/public_defcons§msq_count:conn');
$r["cut"]=array('//:cut return older connector
abcdef§b/e:cut
br
abcdef/b/e/0§embed_detect:core');
$r["split"]=array('+string§i:split
_1§:text
br
/used to split subparam
!_PARAM=p/b
+_PARAM§/:split
_1§_2:html');
$r["balise"]=array('!_PARAM=p/b
+_PARAM§/:split
-_1§_2:html');
$r["read"]=array('/assign
!_PARAM=365
/:pub
_PARAM§pub:conn§h2:html
/:read:balise
_PARAM:read§div||panel justy:balise');
$r["philum"]=array('[[[[ym:date]:idart]§Version [:ver]]:b]
[philum/maj/install.tar.gz§[download§96:picto]:download]

[Noyau : [progb:dirsize] Ko / [system/program_sizes_[ym:date]§functions:microsql] fonctions + [:countplugs] plugins
Au lancement : 283 Ko ; Sur le disque : 11Mo:l]
[[system/admin_modules:msq_count] modules à placer sur les pages:l]
[[users/public_defcons:msq_count] définitions d\'importation de sites:l]
[[system/connectors_all:msq_count] connecteurs à placer dans les articles:l] 
[[system/program_core:msq_count] fonctions publiques du noyau:l] 
[[system/edition_typos:msq_count] typos libres de droits
1441 icônes + 783 pictos svg !:l]');
$r["login"]=array('!_PARAM=login
_PARAM§register:plug');
$r["version"]=array('/return most recent entry
!_PARAM=ym:date
!1=ym:date
!2=system/program_updates__1§msq_count:conn
+system/program_updates__1/_2§msql_read:core
_1');
$r["countfile"]=array('!_PARAM=plug
countfiles§_PARAM:plug');
$r["countplugs"]=array('[system/program_plugs:msq_count]');
$r["strsplit"]=array('?_PARAM=hello
+_PARAM§strsplit:core
_5_4_2§:text');
$r["microsys"]=array('[_PARAM§span||microsys|font-size:32px:balise]');
$r["test"]=array('?_1=81
!_81=a
=_1§b:conn
_PARAM:text
/!_2=_1§b:balise
/see
/_1
/-_1
/§_1:u
/!_2=_1
/_2:text');

?>