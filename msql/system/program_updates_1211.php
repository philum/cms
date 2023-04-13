<?php //msql/program_updates_1211
$r=["_menus_"=>['day','text'],
"1"=>['1101','- rÃ©paration de la restriction 57 \'save_in_popup\', pour ne pas ; - ajout du submodule \'link\', ouvre l\'url dans une iframe ; - ajout du plugin ixquick, permet de faire une recherche ; - fix conflit provoquant erreur d\'enregistrement du paramÃ¨tre trackback des articles ; - l\'Ã©diteur des commentaires est placÃ© dans une popup ;'],
"2"=>['1102','- ajout d\'un Ã©diteur pour les sous-modules ;
- dans user_menu le bouton \'tools\' renvoie un accÃ¨s Ã  la racine du desktop, nommÃ©e \'tools\' ;
- fix pb dossier vide dans finder ;
- ajout d\'aides dans l\'Ã©dition des sous-modules ;'],
"3"=>['1103','- le plugin twitter reÃ§oit le hashtag en paramÃ¨tre rendu Ã©ditable par le visiteur ;
- rÃ©novation plugin exec, usage des popups ;'],
"4"=>['1104','- ajout de \'text brut\' dans les boutons d\'article proposÃ© au visiteur'],
"5"=>['1105','- le mode desktop est appelÃ© en ajax et on n\'a plus besoin de exit pour en sortir ;'],
"6"=>['1106','ajout de classes globales pour avoir des boutons systÃ¨me qui n\'utilisent pas les css de l\'utilisateur ;'],
"7"=>['1107','centralisation de la prise en charge du scroll des popups '],
"8"=>['1108','paramÃ¨tre autosize de SaveJ obsolÃ¨te : prit en charge automatiquement ;'],
"9"=>['1109','buffer du multithread passe Ã  1500 car. '],
"10"=>['1110','amÃ©lioration de l\'ajout de sous-modules (dans Apps) ;'],
"11"=>['1111','amÃ©lioration de l\'Ã©dition des lignes de commandes de modules, l\'Ã©diteur passe au second plan, remplacÃ© par des boutons'],
"12"=>['1112','ajout de pictos dans la borne d\'information sur l\'article \'words\''],
"13"=>['1113','- ajout du connecteur \':color\' (reÃ§oit un hexa) ;
- ajout du codeline \':span\' qui se comporte comme \':div\' (reÃ§oit d\'autres connecteurs comme \':style\') ;
- ajout du paramÃ¨tre serveur \'ajax_buffer\' (admin/params/server) pour ajuster soi-mÃªme la taille du buffer AMT, 1500 par dÃ©faut ;
- rÃ©habilitation des rss, qu\'on peut appeler comme ceci : /plugin/rss/hub/preview'],
"14"=>['1114','- rÃ©habilitation de l\'Ã©diteur rapide d\'articles de l\'admin, aussi appelÃ© par l\'icÃ´ne \'text brut\' disponible au public ; (permet d\'Ã©diter sans rÃ©afficher l\'article)'],
"15"=>['1115','- ajout d\'une aide Ã  l\'Ã©dition du module \'articles\' ;
- nouvelle prÃ©sentation du panneau \'ajouter modules\' ;
- introduction des variables d\'article \'jurl\' et \'purl\' pour ouvrir en ajax dans le content ou dans une popup ;
- ajout du codeline \':jurl\' : [_PURLÂ§_SUJ:jurl]
- le module Category accepte les templates ;'],
"16"=>['1116','- ajout de l\'attribut \'scrold\' (d pour dÃ©file) pour retrouver les barres de dÃ©filement rendues invisibles par l\'esthÃ©tique ;
- ajout de  l\'attribut \'auto\' au mode d\'affichage de l\'article (preview, false, true) : dÃ©fini par le niveau de prioritÃ© de l\'article (2=preview) ;'],
"17"=>['1117','- le mot \'Home\' fait appel Ã  sa nomination (accueil en fr) ;
- rÃ©novation de la prÃ©sentation des taxonomies ;
- rÃ©parations sur l\'Ã©diteur de font-faces ;
'],
"18"=>['1118','parfois le nouvel article ne s\'affichait pas Ã  cause d\'une importation d\'image avortÃ©e : pb fixÃ© ;'],
"19"=>['1119','fix pb de dÃ©tection de position et Ã©tat d\'un article lors de sa crÃ©ation ;'],
"20"=>['1120','l\'appel de la fenÃªtre \'site\' rendue indÃ©pendante du desktop'],
"21"=>['1121','fix pb plein Ã©cran des images seules'],
"22"=>['1122','rÃ©novation appli sText'],
"23"=>['1123','le module \'taxo_nav\' qui est si cool, est rendu sensible Ã  la catÃ©gorie ; il fait concurrence Ã  \'rub_taxo\' car il permet d\'ouvrir les menus et de prendre en compte l\'article parent hors du champ temporel courant ;'],
"24"=>['1124','ajout d\'aides Ã  l\'Ã©diteur de sous-modules'],
"25"=>['1125','rÃ©novation de l\'envoi de message Ã  l\'admin'],
"26"=>['1126','amÃ©lioraton lisibilitÃ© et commoditÃ© des sÃ©lecteurs ajax'],
"27"=>['1127','finder : correctif renommage, francisation, systÃ¨me d\'icÃ´nes Ã  bulles'],
"28"=>['1128','petite rÃ©novation du chat et de l\'outil public de mails'],
"29"=>['1129','rÃ©novation du login, ajout d\'une option \'rester loguÃ©\' utilisant les cookies, activÃ©e par une restriction \'permalog\' (59) ;'],
"30"=>['1130','ajout du module \'bridge\' qui permet d\'importer un article au travers d\'un autre serveur philum ;']];