<?php //msql/program_updates_1404
$r=["_menus_"=>['date','text'],
"1"=>['0404','amÃ©lioration du responsive : 
- les font-size sont variables
- les images Ã  redimensionner sont ciblÃ©es
- les css globaux et par dÃ©faut sont adaptatifs
- les js sont rÃ©Ã©cris, (positions et sensibilitÃ© Ã  Android)
- la taille des popus est mieux contrÃ´lÃ©e
- apparition du bouton \'resize\' dans les popups'],
"2"=>['0414','rstr54 permet d\'afficher la date sans pour autant offrir le lien vers timesystem (assez lourd et que les moteurs appellent bcp)'],
"3"=>['0418','petites rÃ©Ã©critures pour gagner en vitesse : 
- les tags sont triÃ©s dÃ¨s sql
- amÃ©lioration du protecteur de chaÃ®nes ajax'],
"4"=>['0419','modification de la gestion des modules d\'articles : la rstr60 popartmod empÃªche l\'affichage dans le corps de l\'article tout en conservant disponible l\'icÃ´ne d\'appel de la popup ; ainsi les images ne sont plus resizÃ©es par avance et sans rÃ©el intÃ©rÃªt'],
"5"=>['0420','l\'option \'ktag\' de sql() permet Ã  terme de se passer de tri_tags : les catÃ©gories et tags apparaissant dans les complÃ©tions, recherche ou sÃ©lection ont une gestion commune de leur champ temporel et utilisent ktag'],
"6"=>['0421','- ajout des param par dÃ©faut dans le boot pour popadmin ;
- les modules systÃ¨me peuvent recevoir des array, provenant de msql ;
- le module systÃ¨me design utilise l\'option width prioritairement au module \'content\' ;
- on peut utiliser le design par dÃ©faut \'classic\' dans le mod systÃ¨me design ou un design publique ;
- le css \'defaut\' est une copie de \'classic\' mais sans les couleurs, et vient s\'ajouter au css existant ;
- amÃ©lioration du design classic
- rÃ©vision du cssbuilder;
- les menus admin sont en rollover'],
"7"=>['0423','- rÃ©solution pb de qq paramÃ¨tres de post-traitement qui Ã©taient inactifs ;
- les car. %u201C%u201D ne sont actuellement standardisÃ©s qu\'aprÃ¨s une modif, pas Ã  la sortie de l\'import ;
- prise en charge du nouveau car venu Â¨ ;']];