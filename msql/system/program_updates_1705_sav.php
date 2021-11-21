<?php
//philum_microsql_program_updates_1705_sav
$r["_menus_"]=array('date','text');
$r[1]=array('0502','publication');
$r[2]=array('0502','ajout du nouveau dispositif slct_cases, utilisé dans le moteur de recherche. Permet la sélection multiple inclusive ou exclusive des termes de la recherche, parmi les catégories et les tags. (on en rêvait depuis longtemps)');
$r[3]=array('0503','mise à niveau du dispositif panup :
- le panneau ne recouvre pas le menu de premier niveau
- les css indiquent le menu actif du panneau en cours');
$r[4]=array('0503','finalisation de slct_cases :
- amélioration de la recherche via les tags
- suppression de l\'antique rech_catag()
- ajout de maxdays() et oldest_art(), pour survenir aux manquements quand rstr3 n\'est pas actif ; maxdays() supporte les dates négatives.');
$r[5]=array('0505','php7 compliant');
$r[6]=array('0505','amélioration du support de reconnaissance de twitter lors de l\'import. renvoie :twitter (avec mise en cache), en partant d\'une iframe ou d\'une div, issu du rendu d\'une iframe.');
$r[7]=array('0518','ajout d\'un filtre du nombre d\'occurrences dans le résultat d\'une recherche. permet d\'élaguer les résultats moins pertinents.');

?>