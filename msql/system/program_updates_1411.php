<?php //msql/program_updates_1411
$r=["_menus_"=>['date','text'],
"1"=>['1106','correctif prise en charge de search dans le coupeur par pages, en mode non-ajax'],
"2"=>['1107','rÃ©forme de l\'Ã©criture des modules dans la console url : /module/nom/p/o/c/page/1 (modif htaccess)'],
"3"=>['1110','- rÃ©forme u sÃ©lecteur d\'Ã©tendue temporelle quand param16=auto
- champ temporel Ã  une seule borne quand prm16=\'\'; (articles trop anciens ne s\'affichaient pas)
- le conn :pub peut recevoir des id multiples'],
"4"=>['1112','ajout d\'un contrÃ´leur permettant d\'injecter le rÃ©sultat d\'une recherche comme tag (trÃ¨s pratique car ainsi les tags apparaissent de maniÃ¨re rÃ©troactive)'],
"5"=>['1113','nouveau moteur de lecture de flux rss, avec dÃ©tecteur de structure xml, et qui se rabat sur l\'ancien en cas d\'erreur'],
"6"=>['1114','menu admin msql repensÃ© (meilleure ergonomie)'],
"7"=>['1114','nouveau lecteur rss : ajout d\'un enquÃªteur de balises similaires
gÃ©nÃ©ralisation (abandon progressif de l\'ancien)
rÃ©novation du plugin rssurl'],
"8"=>['1117','rÃ©novation de utf8_decode_b (Ã©vite erreurs de dÃ©codage)'],
"9"=>['1117','rÃ©novation du plugin twitter (qui ne diffuse plus de rss)'],
"10"=>['1118','amÃ©liorations plugin twitter : usage des connecteurs et reconnaissance des hashtags'],
"11"=>['1119','rÃ©paration htaccess pour les modules Ã  4 variables'],
"12"=>['1120','editor est rendu plugin
amÃ©liorations gestionnaire de plugins
savemsql peut Ãªtre appelÃ© de n\'importe oÃ¹
saveBe() rendu obsolÃ¨te'],
"13"=>['1121','rÃ©parations coordination system/htaccess'],
"14"=>['1124','batch_preview permet d\'Ã©diter les defs avant l\'import d\'un article'],
"15"=>['1124','ajout d\'un sleep() lors de l\'Ã©criture pour compenser lenteur serveur'],
"16"=>['1124','implÃ©mentation (dans le cache du boot et les sorties du load) de la notion de \"aucun article\"'],
"17"=>['1127','remise en Ã©tat de marche du codeline basic'],
"18"=>['1128','rÃ©fection de batch_fbi, qui recense les nouveaux articles des flux sÃ©lectionnÃ©s'],
"19"=>['1129','meilleur appellation des modules, un algo trouve l\'indice marquant dans les paramÃ¨tres'],
"20"=>['1130','rÃ©novation du boot et on empÃªche les sources inutiles de se loader avec les appels ajax de menus ou de plugins
amÃ©lioration rÃ©solution urls de msql']];