<?php
//philum_microsql_program_updates_1703
$r["_menus_"]=array('date','text');
$r[1]=array('0301','publication');
$r[2]=array('0303','- r�fection du module tag_cloud (nuage de tags)
- ajout du module frequent_tags : tags les plus fr�quents, capable de prendre en compte toutes les classes de tags');
$r[3]=array('0306','- le moteur de recherche se dote d\'un syst�me de mise en cache des r�sultats (sur 2 nouvelles tables), qui peuvent �tre aliment�es par les nouveaux r�sultats trouv�s.');
$r[4]=array('0307','- ajout de la navigation par pages au sein du moteur de recherche');
$r[5]=array('0309','- r�vision du moteur de commentaires (tr�s ancien) visant � unifier les requ�tes');
$r[6]=array('0310','- r�forme du moteur mysql, en vue de son passage (tardif) � mysqli');
$r[7]=array('0311','- finalisation du passage � mysqli ; le fichier _connect est � r��diter');
$r[8]=array('0311','- ajout du plug know, base de connaissances qui sert � r�colter des infos manuellement');
$r[9]=array('0312','- mise en conformit� html5
- correctif passage � mysqli
- correctif affichage non logu� dans msql');
$r[10]=array('0313','- mise en place des �l�ments du nouveau syst�me d\'upload ajax');
$r[11]=array('0314','- conformit� doctype html5 : les coordonn�es de la souris incluent l\'offsetY, qu\'il a fallu donc d�duire dans la fonction clickoutside');
$r[12]=array('0315','- finalisation de l\'impl�mentation du nouveau upload ajax dans les articles, le finder, l\'avatar, la banni�re et les css. on peut envoyer des images en masse.');
$r[13]=array('0315','- correctifs et am�liorations de qq boutons d\'�dition');
$r[14]=array('0317','- maintenance �volutive des css, de la compatibilit� du scrolltop avec le doctype');
$r[15]=array('0318','- ajout du mode de bubble \'panup\', activable par la rstr102, permet d\'avoir des menus ouvrables en mode panneau (utile sur petits �crans)');
$r[16]=array('0319','- ajout de umrenum, conf�re une nomenclature aux articles d\'une cat�gorie');
$r[17]=array('0320','- tentative mise en berne d\'utiliser le desktop pour faire un random background
- le select_j ne captait pas le param connu (date d\'un nouvel article)
- �tude de la remise en marche de rub_tag (vieille fonction rendue obsol�te)
- le connecteur :web stocke le r�sultat de sa capture og dans une table hub_web');
$r[18]=array('0321','- maintenance applicative de Finder, gestion des uploads (les fichiers sont dirig�s dans les bons dossiers, accepte .mid, .flac)
- mise en place des �l�ments d\'un upload par glissement de fichier');
$r[19]=array('0322','- fonctionnement des menus bub (dropmenus) : se positionne dans le menu parent en mode panup, ferme les autres familles de menus
- suppression d\'antiques formulaires, d�nonc�s par des notices dans le DOM');
$r[20]=array('0323','- le connecteur :pdf (changer juste .pdf en :pdf) ouvre d�sormais directement le lecteur google en pleine page (et un lien vers la popup en mode preview) - pour se passer du player, utiliser simplement une iframe.');
$r[21]=array('0324','- correctif pb d\'encodage avec yandex recevant des langues utf8');
$r[22]=array('0329','- correctif pb enregistrement secondaire des rstr (celui qui sert en deuxi�me instance)
- correctif statsee');
$r[23]=array('0330','- le dispositif sconn (connecteurs r�duits) est annihil� (les commentaires et autres passent pas les connecteurs classiques) et r�habilit� de fa�on � servir au futur type d\'�diteur composite
- :radio accepte un chemin vers un r�pertoire au lieu de la table de la playlist, qui dans ce cas peut �tre fabriqu�e');
$r[24]=array('0330','- mise en place du dispositif du nouvel �diteur mixte. L\'article peut �tre �dit� directement sur place, dans changer la mise en forme, sauf pour les connecteurs logiciel');

?>