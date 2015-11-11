<?php
//philum_microsql_program_updates_1110
$r["_menus_"]=array('day','text');
$r[1]=array('111001','le bouton \'mod\' dans user_menus permet d\'utiliser une autre table de modules (qui peut pointer vers un autre css). ex: \'mod§2\' peut renvoyer un template pour les GSM');
$r[2]=array('111004','la feuille utils.js est loadée sans condition ;
augmentation de l\'imprégnation des nominations ainsi rendues relatives (poésie geek)');
$r[3]=array('111007','- dir2table : crée une table à partir des fichers d\'un répertoire
- table2img : affiche les images d\'une table (colonne 0) ;
- callplug : interface d\'appel à un plug-in respectant les spécifications (deux variables, nom de table sur la deuxième)
- création de la table program_plug qui relate les spécifications des plug-in');
$r[4]=array('111008','ajout de 72 icônes joignables par icon(\'name\') dans les répertoires imgb/system/icons
connecteur :icon ;');
$r[5]=array('111009','- normalisation des les miniatures autour d\'un protocole commun (pas de doublons) qui tient compte des dimensions ;
- réorganisation : imgb reçoit les répertoires publics, imgc les images fabriquées et uploadées ; 
- réorganisation complète de imgb, reçoit \'icons\' dans lequel \'system/com\' retient les éléments graphiques obligatoires. tous les autres répertoires dans imgb sont obsolètes. imgb ne reçoit plus que les images fabriquées durables (bannière, avatars...)
- dans \'bkg\', \'_mbr\' est remplacé par \'shadow\' ;');
$r[6]=array('111010','le répertoire \'icon\' est accessible par le connecteur [img§directory:icon] ; 
Un navigateur (récursif) d\'icônes est ajouté à l\'éditeur d\'articles ;');
$r[7]=array('111010','constructeur de miniatures capable reçoit nouveau param \'inset\' pour cadrer à l\'intérieur ou à l\'extérieur de l\'image d\'origine ; 
et si l\'image est plus petite que la taille demandée dans le cadre d\'un \'inset\' c\'est l\'image d\'origine qui est retournée.');
$r[8]=array('111011','ajout de la restriction \'float_width\' qui permet de faire passer le constructeur de miniatures en mode \'inset\' auquel cas, par exemple, les images verticales apparaissent en entier.');
$r[9]=array('111012','ajout de la restriction \'smart_edit\' qui permet d\'interdire l\'affichage des autres modules que \'content\' pendant l\'édition, ce qui la rend plus rapide');
$r[10]=array('111012','pour uploader un répertoire entier on peut désormais envoyer un fichier .tar (ou .tar.gz) ');
$r[11]=array('111012','ajout d\'avatars au format gif 48x48, \'persos\'');
$r[12]=array('111013','table users/hub_design : les designs peuvent recevoir une nomination, une date de mise à jour et un crédit');
$r[13]=array('111014','correctifs affichage des pages et importation forcée d\'image sans extension et \':img\'');
$r[14]=array('111015','implémentation de Gravatar (gravatar.com) pour affichés les avatars liés à un email');
$r[15]=array('111016','- nouveau css pour l\'admin, désormais branché sur un design éditable (public_6)
- les designs publics relatent différents designs par défaut qui ont été développé, celui en cours étant le \"classic3\".');
$r[16]=array('111018','- suppression de gravatar (la vitesse du rendu est trop vitale pour la saccager ainsi) 
- nombreux nettoyages et affinements');
$r[17]=array('111020','- ajout d\'un bouton \'+\' pour ajouter des articles des flux rss dans le Batch
- amélioration support caractères spéciaux dans les transactions javascript ;');
$r[18]=array('111020','- ajout du support \'save_all\' dans le batch_process : les articles ajoutés au batch sont importés à la chaîne, dans la section \'public\' et en mode non publié.');

?>