<?php
//philum_microsql_program_updates_1404
$r["_menus_"]=array('date','text');
$r[1]=array('0404','am�lioration du responsive : 
- les font-size sont variables
- les images � redimensionner sont cibl�es
- les css globaux et par d�faut sont adaptatifs
- les js sont r��cris, (positions et sensibilit� � Android)
- la taille des popus est mieux contr�l�e
- apparition du bouton \'resize\' dans les popups');
$r[2]=array('0414','rstr54 permet d\'afficher la date sans pour autant offrir le lien vers timesystem (assez lourd et que les moteurs appellent bcp)');
$r[3]=array('0418','petites r��critures pour gagner en vitesse : 
- les tags sont tri�s d�s sql
- am�lioration du protecteur de cha�nes ajax');
$r[4]=array('0419','modification de la gestion des modules d\'articles : la rstr60 popartmod emp�che l\'affichage dans le corps de l\'article tout en conservant disponible l\'ic�ne d\'appel de la popup ; ainsi les images ne sont plus resiz�es par avance et sans r�el int�r�t');
$r[5]=array('0420','l\'option \'ktag\' de sql() permet � terme de se passer de tri_tags : les cat�gories et tags apparaissant dans les compl�tions, recherche ou s�lection ont une gestion commune de leur champ temporel et utilisent ktag');
$r[6]=array('0421','- ajout des param par d�faut dans le boot pour popadmin ;
- les modules syst�me peuvent recevoir des array, provenant de msql ;
- le module syst�me design utilise l\'option width prioritairement au module \'content\' ;
- on peut utiliser le design par d�faut \'classic\' dans le mod syst�me design ou un design publique ;
- le css \'defaut\' est une copie de \'classic\' mais sans les couleurs, et vient s\'ajouter au css existant ;
- am�lioration du design classic
- r�vision du cssbuilder;
- les menus admin sont en rollover');
$r[7]=array('0423','- r�solution pb de qq param�tres de post-traitement qui �taient inactifs ;
- les car. %u201C%u201D ne sont actuellement standardis�s qu\'apr�s une modif, pas � la sortie de l\'import ;
- prise en charge du nouveau car venu � ;');

?>