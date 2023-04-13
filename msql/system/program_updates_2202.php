<?php //msql/program_updates_2202
$r=["_menus_"=>[''],
"1"=>['0201','publication'],
"2"=>['0201','- fix pb styl::dsnam
- suppression de scroll_b(), qui servait Ã  Ã©viter le scrollbar dans une aire navigable, trÃ¨s joli, mais inutile depuis qu\'est (rÃ©)apparu le scroll thin.
- remise Ã  niveau des apps du dossier sci
- rÃ©forme des transports dans comline'],
"3"=>['0202','- fix pb sÃ©lecteur comline
- retape des nominations de comline et submods'],
"4"=>['0203','- les gets sont filtrÃ©s et envoyÃ©s dans le cache systÃ¨me avant usage (aucun get n\'arrive fraÃ®chement dans le code)
- les assignations de gets (geta) nourrissent les pseudo get()
- getsb() est une variante pour les callback ajax qui n\'ont pas besoin d\'Ãªtre utf8_decode
- rÃ©forme en masse des affectations en cours de route
- fix gestionnaire de commandes api depuis les rÃ©sultats de l\'api'],
"5"=>['0204','- correctif rssin, la balise \'link\' ne passe pas, on utilise des supplÃ©ances divers selon les cas'],
"6"=>['0205','- correctif de masse pour remplacer tous les list() par des []'],
"7"=>['0206','- correctif de masse pour remplacer tous les array() par des []
- correctif de masse du format des fichiers (convertis en utf8 par les prÃ©cÃ©dents correctifs de masse, ahlala)'],
"8"=>['0209','- Ã©lagage des anciennes versions de spitable, spisvg, spiline, pour ne garder que ces dÃ©nominations pour les versions les plus rÃ©centes
- correctif bouton de rÃ©duction des images'],
"9"=>['0210','- rÃ©fection de spisvg, pour avoir une lÃ©gende cohÃ©rente + ajout de l\'origine des atomes'],
"10"=>['0211','- amÃ©liorations de spisvg, spitable et spiline'],
"11"=>['0212','- fix pb (rÃ©cent) de ? dans l\'enregistrement des titres'],
"12"=>['0219','- ajout de contrÃ´leurs externalisÃ©s de min-width et min-height dans le gestionnaire de popups'],
"13"=>['0227','- ajout d\'un moyen de contourner les proxy, en collant directement le contenu de la source Ã  la place de ce que rÃ©colte le robot'],
"14"=>['0228','- correctif du titrage des ebooks fabriquÃ©s par l\'utilisateur']];