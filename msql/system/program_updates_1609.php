<?php //msql/program_updates_1609
$r=["_menus_"=>['date','text'],
"1"=>['0901','publication'],
"2"=>['0903','rÃ©vision de mode boolÃ©en du moteur de recherche, qui ne marchait pas (produisait un merge au lieu d\'un intersect)'],
"3"=>['0908','amÃ©lioration du moteur de recherche : ajout du paramÃ¨tre \'segment\', activÃ© auto si aucun rÃ©sultat, car dÃ©sormais la recherche se fait sur un mot entier par dÃ©faut (plus rapide)'],
"4"=>['0909','rÃ©forme des anciens escape en nouveaux encoreURI : ratÃ©, interprÃ¨te utf8, donc centralisation dans encURI et decURI'],
"5"=>['0919','divers petits correctifs
francisation de l\'Ã©diteur de commentaires
ajout msqlang : utiliser n\'importe quelle base de langes
rÃ©forme sesmk() : le cache prend en compte le param de la fonction appelÃ©e'],
"6"=>['0919','amÃ©lioration des favoris :
- revue design
- les articles issus des tags s\'affichent en icÃ´nes
- ajout d\'une aide pour dire Ã  quoi Ã§a sert
- l\'export html renvoie les contenus bruts avec des liens absolus et utilise un template
- le lecteur \'book\' s\'adapte aux sources (favs, likes, polls, dÃ©jÃ  vus, et api)'],
"7"=>['0922','amÃ©lioration des favoris :
- ajout du paramÃ¨tre et de l\'onglet \'public\', pour publier ses scripts de recherche']];