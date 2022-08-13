<?php
//philum_microsql_program_updates_1610_sav
$r["_menus_"]=array('date','text');
$r[1]=array('1001','publication');
$r[2]=array('1004','ajout du plug et du gestionnaire d\'Api tlex (publier articles sur tlex.fr)');
$r[3]=array('1005','résolution petit pb de compatibilité en mode utf8');
$r[4]=array('1008','- réfection du système de newsletters
- rectificatifs divers de compatibilité avec un serveur ovh mutualisé');
$r[5]=array('1012','- on déplace l\'éditeur dans une dv plutôt qu\'une popup, et de même avec le menu folders de l\'éditeur de titres');
$r[6]=array('1013','- ajout du mode (et du template associé) \'simplified\', permet de réduire l\'info affichée au minimum, pour rendre plus agréable la synthèse vocale.
Les modes sont disponibles dans le menu Phi (généralement public).
- les boutons d\'api ne s\'affichent que pour leur propriétaire
- le bouton-menu track rendu réactif au paramètre local');
$r[7]=array('1015','- ajout du connecteur img§height:fluid, permet de poser une image statique dont l\'ensemble se découvre pendant le scroll
- le module Banner réagit de façon fluide, et accepte des connecteurs dans le titre (l\'option donne la hauter)');
$r[8]=array('1017','- ajout du module audio_^playlist, comme video_playlist, renvoie les articles contenant des .mp3
- rénovation du retape d\'anciens connecteurs
- mise au rancart du connecteur :popvideo (remplacé par §txt:video)');
$r[9]=array('1020','- ajout du support de conversion multibyte aux capteurs ajax (ceux qui manquaient)
- retrait de la précédente (politique de \"ça marche, on laisse\")');
$r[10]=array('1021','- ajout des connecteurs :floatleft et :floatright
- obsolescence des connecteurs :2cols, 3cols, :/2, :/3 remplacés par §2:cols et §2:block
- éradication des anciens connecteurs obsolètes :microsql, microtemplate
- ajout du connecteur :sigle (certifie l\'affichage des monnaies)
- suppression du module search (y\'a qu\'à /search/) et conversion du module search_form vers search (ouverture du formulaire de recherche)');

?>