<?php //msql/program_updates_1703
$r=["_menus_"=>['date','text'],
"1"=>['0301','publication'],
"2"=>['0303','- rÃ©fection du module tag_cloud (nuage de tags)
- ajout du module frequent_tags : tags les plus frÃ©quents, capable de prendre en compte toutes les classes de tags'],
"3"=>['0306','- le moteur de recherche se dote d\'un systÃ¨me de mise en cache des rÃ©sultats (sur 2 nouvelles tables), qui peuvent Ãªtre alimentÃ©es par les nouveaux rÃ©sultats trouvÃ©s.'],
"4"=>['0307','- ajout de la navigation par pages au sein du moteur de recherche'],
"5"=>['0309','- rÃ©vision du moteur de commentaires (trÃ¨s ancien) visant Ã  unifier les requÃªtes'],
"6"=>['0310','- rÃ©forme du moteur mysql, en vue de son passage (tardif) Ã  mysqli'],
"7"=>['0311','- finalisation du passage Ã  mysqli ; le fichier _connect est Ã  rÃ©Ã©diter'],
"8"=>['0311','- ajout du plug know, base de connaissances qui sert Ã  rÃ©colter des infos manuellement'],
"9"=>['0312','- mise en conformitÃ© html5
- correctif passage Ã  mysqli
- correctif affichage non loguÃ© dans msql'],
"10"=>['0313','- mise en place des Ã©lÃ©ments du nouveau systÃ¨me d\'upload ajax'],
"11"=>['0314','- conformitÃ© doctype html5 : les coordonnÃ©es de la souris incluent l\'offsetY, qu\'il a fallu donc dÃ©duire dans la fonction clickoutside'],
"12"=>['0315','- finalisation de l\'implÃ©mentation du nouveau upload ajax dans les articles, le finder, l\'avatar, la banniÃ¨re et les css. on peut envoyer des images en masse.'],
"13"=>['0315','- correctifs et amÃ©liorations de qq boutons d\'Ã©dition'],
"14"=>['0317','- maintenance Ã©volutive des css, de la compatibilitÃ© du scrolltop avec le doctype'],
"15"=>['0318','- ajout du mode de bubble \'panup\', activable par la rstr102, permet d\'avoir des menus ouvrables en mode panneau (utile sur petits Ã©crans)'],
"16"=>['0319','- ajout de umrenum, confÃ¨re une nomenclature aux articles d\'une catÃ©gorie'],
"17"=>['0320','- tentative mise en berne d\'utiliser le desktop pour faire un random background
- le select_j ne captait pas le param connu (date d\'un nouvel article)
- Ã©tude de la remise en marche de rub_tag (vieille fonction rendue obsolÃ¨te)
- le connecteur :web stocke le rÃ©sultat de sa capture og dans une table hub_web'],
"18"=>['0321','- maintenance applicative de Finder, gestion des uploads (les fichiers sont dirigÃ©s dans les bons dossiers, accepte .mid, .flac)
- mise en place des Ã©lÃ©ments d\'un upload par glissement de fichier'],
"19"=>['0322','- fonctionnement des menus bub (dropmenus) : se positionne dans le menu parent en mode panup, ferme les autres familles de menus
- suppression d\'antiques formulaires, dÃ©noncÃ©s par des notices dans le DOM'],
"20"=>['0323','- le connecteur :pdf (changer juste .pdf en :pdf) ouvre dÃ©sormais directement le lecteur google en pleine page (et un lien vers la popup en mode preview) - pour se passer du player, utiliser simplement une iframe.'],
"21"=>['0324','- correctif pb d\'encodage avec yandex recevant des langues utf8'],
"22"=>['0329','- correctif pb enregistrement secondaire des rstr (celui qui sert en deuxiÃ¨me instance)
- correctif statsee'],
"23"=>['0330','- le dispositif sconn (connecteurs rÃ©duits) est annihilÃ© (les commentaires et autres passent pas les connecteurs classiques) et rÃ©habilitÃ© de faÃ§on Ã  servir au futur type d\'Ã©diteur composite
- :radio accepte un chemin vers un rÃ©pertoire au lieu de la table de la playlist, qui dans ce cas peut Ãªtre fabriquÃ©e'],
"24"=>['0330','- mise en place du dispositif du nouvel Ã©diteur mixte. L\'article peut Ãªtre Ã©ditÃ© directement sur place, dans changer la mise en forme, sauf pour les connecteurs logiciel']];