<?php
//philum_microsql_program_updates_1703_sav
$r["_menus_"]=array('date','text');
$r[1]=array('0301','publication');
$r[2]=array('0303','- réfection du module tag_cloud (nuage de tags)
- ajout du module frequent_tags : tags les plus fréquents, capable de prendre en compte toutes les classes de tags');
$r[3]=array('0306','- le moteur de recherche se dote d\'un système de mise en cache des résultats (sur 2 nouvelles tables), qui peuvent être alimentées par les nouveaux résultats trouvés.');
$r[4]=array('0307','- ajout de la navigation par pages au sein du moteur de recherche');
$r[5]=array('0309','- révision du moteur de commentaires (très ancien) visant à unifier les requêtes');
$r[6]=array('0310','- réforme du moteur mysql, en vue de son passage (tardif) à mysqli');
$r[7]=array('0311','- finalisation du passage à mysqli ; le fichier _connect est à rééditer');
$r[8]=array('0311','- ajout du plug know, base de connaissances qui sert à récolter des infos manuellement');
$r[9]=array('0312','- mise en conformité html5
- correctif passage à mysqli
- correctif affichage non logué dans msql');
$r[10]=array('0313','- mise en place des éléments du nouveau système d\'upload ajax');
$r[11]=array('0314','- conformité doctype html5 : les coordonnées de la souris incluent l\'offsetY, qu\'il a fallu donc déduire dans la fonction clickoutside');
$r[12]=array('0315','- finalisation de l\'implémentation du nouveau upload ajax dans les articles, le finder, l\'avatar, la bannière et les css. on peut envoyer des images en masse.');
$r[13]=array('0315','- correctifs et améliorations de qq boutons d\'édition');
$r[14]=array('0317','- maintenance évolutive des css, de la compatibilité du scrolltop avec le doctype');
$r[15]=array('0318','- ajout du mode de bubble \'panup\', activable par la rstr102, permet d\'avoir des menus ouvrables en mode panneau (utile sur petits écrans)');
$r[16]=array('0319','- ajout de umrenum, confère une nomenclature aux articles d\'une catégorie');
$r[17]=array('0320','- tentative mise en berne d\'utiliser le desktop pour faire un random background
- le select_j ne captait pas le param connu (date d\'un nouvel article)
- étude de la remise en marche de rub_tag (vieille fonction rendue obsolète)
- le connecteur :web stocke le résultat de sa capture og dans une table hub_web');
$r[18]=array('0321','- maintenance applicative de Finder, gestion des uploads (les fichiers sont dirigés dans les bons dossiers, accepte .mid, .flac)
- mise en place des éléments d\'un upload par glissement de fichier');
$r[19]=array('0322','- fonctionnement des menus bub (dropmenus) : se positionne dans le menu parent en mode panup, ferme les autres familles de menus
- suppression d\'antiques formulaires, dénoncés par des notices dans le DOM');
$r[20]=array('0323','- le connecteur :pdf (changer juste .pdf en :pdf) ouvre désormais directement le lecteur google en pleine page (et un lien vers la popup en mode preview) - pour se passer du player, utiliser simplement une iframe.');
$r[21]=array('0324','- correctif pb d\'encodage avec yandex recevant des langues utf8');
$r[22]=array('0329','- correctif pb enregistrement secondaire des rstr (celui qui sert en deuxième instance)
- correctif statsee');
$r[23]=array('0330','- le dispositif sconn (connecteurs réduits) est annihilé (les commentaires et autres passent pas les connecteurs classiques) et réhabilité de façon à servir au futur type d\'éditeur composite
- :radio accepte un chemin vers un répertoire au lieu de la table de la playlist, qui dans ce cas peut être fabriquée');
$r[24]=array('0330','- mise en place du dispositif du nouvel éditeur mixte. L\'article peut être édité directement sur place, dans changer la mise en forme, sauf pour les connecteurs logiciel');

?>