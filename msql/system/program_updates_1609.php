<?php
//philum_microsql_program_updates_1609
$r["_menus_"]=array('date','text');
$r[1]=array('0901','publication');
$r[2]=array('0903','r�vision de mode bool�en du moteur de recherche, qui ne marchait pas (produisait un merge au lieu d\'un intersect)');
$r[3]=array('0908','am�lioration du moteur de recherche : ajout du param�tre \'segment\', activ� auto si aucun r�sultat, car d�sormais la recherche se fait sur un mot entier par d�faut (plus rapide)');
$r[4]=array('0909','r�forme des anciens escape en nouveaux encoreURI : rat�, interpr�te utf8, donc centralisation dans encURI et decURI');
$r[5]=array('0919','divers petits correctifs
francisation de l\'�diteur de commentaires
ajout msqlang : utiliser n\'importe quelle base de langes
r�forme sesmk() : le cache prend en compte le param de la fonction appel�e');
$r[6]=array('0919','am�lioration des favoris :
- revue design
- les articles issus des tags s\'affichent en ic�nes
- ajout d\'une aide pour dire � quoi �a sert
- l\'export html renvoie les contenus bruts avec des liens absolus et utilise un template
- le lecteur \'book\' s\'adapte aux sources (favs, likes, polls, d�j� vus, et api)');
$r[7]=array('0922','am�lioration des favoris :
- ajout du param�tre et de l\'onglet \'public\', pour publier ses scripts de recherche');

?>