<?php //msql/program_updates_1505
$r=["_menus_"=>['date','text'],
"1"=>['0502','publication'],
"2"=>['0502','ajout de recenseimg, met Ã  jour le catalogue d\'aprÃ¨s les images dÃ©tectÃ©es dans l\'article'],
"3"=>['0503','- ajout plugin profil
- les plugins peuvent Ãªtre nommÃ©s dir/plug dans toute la chaÃ®ne, pour dÃ©signer leur rÃ©pertoire (mais ce n\'est pas prit en compte par le gestionnaire de plugins, donc laissÃ© en l\'Ã©tat)
- connecteur :pluf (dans la lignÃ©e de :plug et :plup) : appelle une fonction d\'un plugin'],
"4"=>['0505','ajout gestionnaires mysql subalternes'],
"5"=>['0508','ajout restrictions pour un meilleur contrÃ´le de ce qu\'affiche le menu admin (peut engendrer des pertes de menus inactifs par dÃ©faut)'],
"6"=>['0509','ajout gestionnaire vidÃ©o html5 pour les .mp4'],
"7"=>['0510','- ajout contrÃ´le des autorisations des articles appelÃ©s Ã  l\'arrache par read_msg() 
- rectif gestionnaire des images, pour Ã©viter les sauts de lignes en mode rstr9
- correctif video_player pour avoir largeur 100% tout le temps
- rectif fix gestionnaire msql (affichage autres hubs empÃªchÃ©)
- prmb2 (anciennement automember, obsolÃ¨te) devient \'url_read\' : dÃ©finit le nom de la variable url \'read\' (par dÃ©faut)'],
"8"=>['0512','- mise en conformitÃ© php>5.5 (maj massive)
- ajout param utf8, l\'ensemble des sorties est sous contrÃ´le de ce param'],
"9"=>['0514','tout bÃªte : rendu possible d\'ignorer la variable url /read/ pour appeler un article par une bribe de son titre : /titre'],
"10"=>['0515','ajout composants gestionnaires protocoles transactions mysql'],
"11"=>['0517','- rÃ©novation du gestionnaire descript (very oldie)
- quelques mises en conformitÃ© pour le switch utf-8
- nouvelle sÃ©curisation des get et post'],
"12"=>['0520','rÃ©emploi du param config/2 en \'devmode\' : substitue au param 1 (mods utilisÃ©s) celui du param 2 pour les visiteurs non prÃ©sents dans une authlist, situÃ©e dans /hub_authlist.'],
"13"=>['0521','patch cryptage des mots de passes'],
"14"=>['0522','le titre de l\'article Ã  importer s\'affiche dans la popup newartcat'],
"15"=>['0523','rÃ©forme/simplification des templates'],
"16"=>['0529','- usage d\'un template spÃ©cialisÃ© pour le mode lecture : \'read\' (trÃ¨s peu diffÃ©rent du mode global)
- le form de commentaire est rÃ©trogradÃ© Ã  sa version textarea (html5 pas dispo sur mobiles)
- le titre de l\'article apparaÃ®t dans le menu admin quand il n\'est plus Ã  l\'Ã©cran'],
"17"=>['0530','- requalification de la rstr88 pour rendre activable le template dÃ©diÃ© au mode lecture d\'un article
- js informÃ© du mode lecture, pour enclencher le visual']];