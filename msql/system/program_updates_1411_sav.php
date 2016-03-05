<?
//philum_microsql_program_updates_1411
$r["_menus_"]=array('date','text');
$r[1]=array('1106','correctif prise en charge de search dans le coupeur par pages, en mode non-ajax');
$r[2]=array('1107','réforme de l\'écriture des modules dans la console url : /module/nom/p/o/c/page/1 (modif htaccess)');
$r[3]=array('1110','- réforme u sélecteur d\'étendue temporelle quand param16=auto
- champ temporel à une seule borne quand prm16=\'\'; (articles trop anciens ne s\'affichaient pas)
- le conn :pub peut recevoir des id multiples');
$r[4]=array('1112','ajout d\'un contrôleur permettant d\'injecter le résultat d\'une recherche comme tag (très pratique car ainsi les tags apparaissent de manière rétroactive)');
$r[5]=array('1113','nouveau moteur de lecture de flux rss, avec détecteur de structure xml, et qui se rabat sur l\'ancien en cas d\'erreur');
$r[6]=array('1114','menu admin msql repensé (meilleure ergonomie)');
$r[7]=array('1114','nouveau lecteur rss : ajout d\'un enquêteur de balises similaires
généralisation (abandon progressif de l\'ancien)
rénovation du plugin rssurl');
$r[8]=array('1117','rénovation de utf8_decode_b (évite erreurs de décodage)');
$r[9]=array('1117','rénovation du plugin twitter (qui ne diffuse plus de rss)');
$r[10]=array('1118','améliorations plugin twitter : usage des connecteurs et reconnaissance des hashtags');
$r[11]=array('1119','réparation htaccess pour les modules à 4 variables');
$r[12]=array('1120','editor est rendu plugin
améliorations gestionnaire de plugins
savemsql peut être appelé de n\'importe où
saveBe() rendu obsolète');
$r[13]=array('1121','réparations coordination system/htaccess');
$r[14]=array('1124','batch_preview permet d\'éditer les defs avant l\'import d\'un article');
$r[15]=array('1124','ajout d\'un sleep() lors de l\'écriture pour compenser lenteur serveur');
$r[16]=array('1124','implémentation (dans le cache du boot et les sorties du load) de la notion de \"aucun article\"');
$r[17]=array('1127','remise en état de marche du codeline basic');
$r[18]=array('1128','réfection de batch_fbi, qui recense les nouveaux articles des flux sélectionnés');
$r[19]=array('1129','meilleur appellation des modules, un algo trouve l\'indice marquant dans les paramètres');
$r[20]=array('1130','rénovation du boot et on empêche les sources inutiles de se loader avec les appels ajax de menus ou de plugins');

?>