<?php
//philum_microsql_program_updates_1609_sav
$r["_menus_"]=array('date','text');
$r[1]=array('0901','publication');
$r[2]=array('0903','révision de mode booléen du moteur de recherche, qui ne marchait pas (produisait un merge au lieu d\'un intersect)');
$r[3]=array('0908','amélioration du moteur de recherche : ajout du paramètre \'segment\', activé auto si aucun résultat, car désormais la recherche se fait sur un mot entier par défaut (plus rapide)');
$r[4]=array('0909','réforme des anciens escape en nouveaux encoreURI : raté, interprète utf8, donc centralisation dans encURI et decURI');
$r[5]=array('0919','divers petits correctifs
francisation de l\'éditeur de commentaires
ajout msqlang : utiliser n\'importe quelle base de langes
réforme sesmk() : le cache prend en compte le param de la fonction appelée');
$r[6]=array('0919','amélioration des favoris :
- revue design
- les articles issus des tags s\'affichent en icônes
- ajout d\'une aide pour dire à quoi ça sert
- l\'export html renvoie les contenus bruts avec des liens absolus et utilise un template
- le lecteur \'book\' s\'adapte aux sources (favs, likes, polls, déjà vus, et api)');
$r[7]=array('0922','amélioration des favoris :
- ajout du paramètre et de l\'onglet \'public\', pour publier ses scripts de recherche');

?>