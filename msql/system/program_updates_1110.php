<?php //msql/program_updates_1110
$r=["_menus_"=>['day','text'],
"1"=>['111001','le bouton \'mod\' dans user_menus permet d\'utiliser une autre table de modules (qui peut pointer vers un autre css). ex: \'modÂ§2\' peut renvoyer un template pour les GSM'],
"2"=>['111004','la feuille utils.js est loadÃ©e sans condition ;
augmentation de l\'imprÃ©gnation des nominations ainsi rendues relatives (poÃ©sie geek)'],
"3"=>['111007','- dir2table : crÃ©e une table Ã  partir des fichers d\'un rÃ©pertoire
- table2img : affiche les images d\'une table (colonne 0) ;
- callplug : interface d\'appel Ã  un plug-in respectant les spÃ©cifications (deux variables, nom de table sur la deuxiÃ¨me)
- crÃ©ation de la table program_plug qui relate les spÃ©cifications des plug-in'],
"4"=>['111008','ajout de 72 icÃ´nes joignables par icon(\'name\') dans les rÃ©pertoires imgb/system/icons
connecteur :icon ;'],
"5"=>['111009','- normalisation des les miniatures autour d\'un protocole commun (pas de doublons) qui tient compte des dimensions ;
- rÃ©organisation : imgb reÃ§oit les rÃ©pertoires publics, imgc les images fabriquÃ©es et uploadÃ©es ; 
- rÃ©organisation complÃ¨te de imgb, reÃ§oit \'icons\' dans lequel \'system/com\' retient les Ã©lÃ©ments graphiques obligatoires. tous les autres rÃ©pertoires dans imgb sont obsolÃ¨tes. imgb ne reÃ§oit plus que les images fabriquÃ©es durables (banniÃ¨re, avatars...)
- dans \'bkg\', \'_mbr\' est remplacÃ© par \'shadow\' ;'],
"6"=>['111010','le rÃ©pertoire \'icon\' est accessible par le connecteur [imgÂ§directory:icon] ; 
Un navigateur (rÃ©cursif) d\'icÃ´nes est ajoutÃ© Ã  l\'Ã©diteur d\'articles ;'],
"7"=>['111010','constructeur de miniatures capable reÃ§oit nouveau param \'inset\' pour cadrer Ã  l\'intÃ©rieur ou Ã  l\'extÃ©rieur de l\'image d\'origine ; 
et si l\'image est plus petite que la taille demandÃ©e dans le cadre d\'un \'inset\' c\'est l\'image d\'origine qui est retournÃ©e.'],
"8"=>['111011','ajout de la restriction \'float_width\' qui permet de faire passer le constructeur de miniatures en mode \'inset\' auquel cas, par exemple, les images verticales apparaissent en entier.'],
"9"=>['111012','ajout de la restriction \'smart_edit\' qui permet d\'interdire l\'affichage des autres modules que \'content\' pendant l\'Ã©dition, ce qui la rend plus rapide'],
"10"=>['111012','pour uploader un rÃ©pertoire entier on peut dÃ©sormais envoyer un fichier .tar (ou .tar.gz) '],
"11"=>['111012','ajout d\'avatars au format gif 48x48, \'persos\''],
"12"=>['111013','table users/hub_design : les designs peuvent recevoir une nomination, une date de mise Ã  jour et un crÃ©dit'],
"13"=>['111014','correctifs affichage des pages et importation forcÃ©e d\'image sans extension et \':img\''],
"14"=>['111015','implÃ©mentation de Gravatar (gravatar.com) pour affichÃ©s les avatars liÃ©s Ã  un email'],
"15"=>['111016','- nouveau css pour l\'admin, dÃ©sormais branchÃ© sur un design Ã©ditable (public_6)
- les designs publics relatent diffÃ©rents designs par dÃ©faut qui ont Ã©tÃ© dÃ©veloppÃ©, celui en cours Ã©tant le \"classic3\".'],
"16"=>['111018','- suppression de gravatar (la vitesse du rendu est trop vitale pour la saccager ainsi) 
- nombreux nettoyages et affinements'],
"17"=>['111020','- ajout d\'un bouton \'+\' pour ajouter des articles des flux rss dans le Batch
- amÃ©lioration support caractÃ¨res spÃ©ciaux dans les transactions javascript ;'],
"18"=>['111020','- ajout du support \'save_all\' dans le batch_process : les articles ajoutÃ©s au batch sont importÃ©s Ã  la chaÃ®ne, dans la section \'public\' et en mode non publiÃ©.']];