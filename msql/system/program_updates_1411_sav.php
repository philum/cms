<?
//philum_microsql_program_updates_1411
$r["_menus_"]=array('date','text');
$r[1]=array('1106','correctif prise en charge de search dans le coupeur par pages, en mode non-ajax');
$r[2]=array('1107','r�forme de l\'�criture des modules dans la console url : /module/nom/p/o/c/page/1 (modif htaccess)');
$r[3]=array('1110','- r�forme u s�lecteur d\'�tendue temporelle quand param16=auto
- champ temporel � une seule borne quand prm16=\'\'; (articles trop anciens ne s\'affichaient pas)
- le conn :pub peut recevoir des id multiples');
$r[4]=array('1112','ajout d\'un contr�leur permettant d\'injecter le r�sultat d\'une recherche comme tag (tr�s pratique car ainsi les tags apparaissent de mani�re r�troactive)');
$r[5]=array('1113','nouveau moteur de lecture de flux rss, avec d�tecteur de structure xml, et qui se rabat sur l\'ancien en cas d\'erreur');
$r[6]=array('1114','menu admin msql repens� (meilleure ergonomie)');
$r[7]=array('1114','nouveau lecteur rss : ajout d\'un enqu�teur de balises similaires
g�n�ralisation (abandon progressif de l\'ancien)
r�novation du plugin rssurl');
$r[8]=array('1117','r�novation de utf8_decode_b (�vite erreurs de d�codage)');
$r[9]=array('1117','r�novation du plugin twitter (qui ne diffuse plus de rss)');
$r[10]=array('1118','am�liorations plugin twitter : usage des connecteurs et reconnaissance des hashtags');
$r[11]=array('1119','r�paration htaccess pour les modules � 4 variables');
$r[12]=array('1120','editor est rendu plugin
am�liorations gestionnaire de plugins
savemsql peut �tre appel� de n\'importe o�
saveBe() rendu obsol�te');
$r[13]=array('1121','r�parations coordination system/htaccess');
$r[14]=array('1124','batch_preview permet d\'�diter les defs avant l\'import d\'un article');
$r[15]=array('1124','ajout d\'un sleep() lors de l\'�criture pour compenser lenteur serveur');
$r[16]=array('1124','impl�mentation (dans le cache du boot et les sorties du load) de la notion de \"aucun article\"');
$r[17]=array('1127','remise en �tat de marche du codeline basic');
$r[18]=array('1128','r�fection de batch_fbi, qui recense les nouveaux articles des flux s�lectionn�s');
$r[19]=array('1129','meilleur appellation des modules, un algo trouve l\'indice marquant dans les param�tres');
$r[20]=array('1130','r�novation du boot et on emp�che les sources inutiles de se loader avec les appels ajax de menus ou de plugins');

?>