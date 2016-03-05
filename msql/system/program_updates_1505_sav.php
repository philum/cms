<?php
//philum_microsql_program_updates_1505
$r["_menus_"]=array('date','text');
$r[1]=array('0502','publication');
$r[2]=array('0502','ajout de recenseimg, met à jour le catalogue d\'après les images détectées dans l\'article');
$r[3]=array('0503','- ajout plugin profil
- les plugins peuvent être nommés dir/plug dans toute la chaîne, pour désigner leur répertoire (mais ce n\'est pas prit en compte par le gestionnaire de plugins, donc laissé en l\'état)
- connecteur :pluf (dans la lignée de :plug et :plup) : appelle une fonction d\'un plugin');
$r[4]=array('0505','ajout gestionnaires mysql subalternes');
$r[5]=array('0508','ajout restrictions pour un meilleur contrôle de ce qu\'affiche le menu admin (peut engendrer des pertes de menus inactifs par défaut)');
$r[6]=array('0509','ajout gestionnaire vidéo html5 pour les .mp4');
$r[7]=array('0510','- ajout contrôle des autorisations des articles appelés à l\'arrache par read_msg() 
- rectif gestionnaire des images, pour éviter les sauts de lignes en mode rstr9
- correctif video_player pour avoir largeur 100% tout le temps
- rectif fix gestionnaire msql (affichage autres hubs empêché)
- prmb2 (anciennement automember, obsolète) devient \'url_read\' : définit le nom de la variable url \'read\' (par défaut)');
$r[8]=array('0512','- mise en conformité php>5.5 (maj massive)
- ajout param utf8, l\'ensemble des sorties est sous contrôle de ce param');
$r[9]=array('0514','tout bête : rendu possible d\'ignorer la variable url /read/ pour appeler un article par une bribe de son titre : /titre');
$r[10]=array('0515','ajout composants gestionnaires protocoles transactions mysql');
$r[11]=array('0517','- rénovation du gestionnaire descript (very oldie)
- quelques mises en conformité pour le switch utf-8
- nouvelle sécurisation des get et post');
$r[12]=array('0520','réemploi du param config/2 en \'devmode\' : substitue au param 1 (mods utilisés) celui du param 2 pour les visiteurs non présents dans une authlist, située dans /hub_authlist.');
$r[13]=array('0521','patch cryptage des mots de passes');
$r[14]=array('0522','le titre de l\'article à importer s\'affiche dans la popup newartcat');
$r[15]=array('0523','réforme/simplification des templates');
$r[16]=array('0529','- usage d\'un template spécialisé pour le mode lecture : \'read\' (très peu différent du mode global)
- le form de commentaire est rétrogradé à sa version textarea (html5 pas dispo sur mobiles)
- le titre de l\'article apparaît dans le menu admin quand il n\'est plus à l\'écran');
$r[17]=array('0530','- requalification de la rstr88 pour rendre activable le template dédié au mode lecture d\'un article
- js informé du mode lecture, pour enclencher le visual');

?>