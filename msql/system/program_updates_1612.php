<?php //msql/program_updates_1612
$r=["_menus_"=>['date','text'],
"1"=>['1201','publication'],
"2"=>['1204','ajout du plug et du gestionnaire d\'Api tlex (publier articles sur tlex.fr)'],
"3"=>['1205','rÃ©solution petit pb de compatibilitÃ© en mode utf8'],
"4"=>['1208','- rÃ©fection du systÃ¨me de newsletters
- rectificatifs divers de compatibilitÃ© avec un serveur ovh mutualisÃ©'],
"5"=>['1212','- on dÃ©place l\'Ã©diteur dans une dv plutÃ´t qu\'une popup, et de mÃªme avec le menu folders de l\'Ã©diteur de titres'],
"6"=>['1213','- ajout du mode (et du template associÃ©) \'simplified\', permet de rÃ©duire l\'info affichÃ©e au minimum, pour rendre plus agrÃ©able la synthÃ¨se vocale.
Les modes sont disponibles dans le menu Phi (gÃ©nÃ©ralement public).
- les boutons d\'api ne s\'affichent que pour leur propriÃ©taire
- le bouton-menu track rendu rÃ©actif au paramÃ¨tre local'],
"7"=>['1215','- ajout du connecteur imgÂ§height:fluid, permet de poser une image statique dont l\'ensemble se dÃ©couvre pendant le scroll
- le module Banner rÃ©agit de faÃ§on fluide, et accepte des connecteurs dans le titre (l\'option donne la hauter)'],
"8"=>['1217','- ajout du module audio_^playlist, comme video_playlist, renvoie les articles contenant des .mp3
- rÃ©novation du retape d\'anciens connecteurs
- mise au rancart du connecteur :popvideo (remplacÃ© par Â§txt:video)'],
"9"=>['1220','- ajout du support de conversion multibyte aux capteurs ajax (ceux qui manquaient)
- retrait de la prÃ©cÃ©dente (politique de \"Ã§a marche, on laisse\")'],
"10"=>['1221','- ajout des connecteurs :floatleft et :floatright
- obsolescence des connecteurs :2cols, 3cols, :/2, :/3 remplacÃ©s par Â§2:cols et Â§2:block
- Ã©radication des anciens connecteurs obsolÃ¨tes :microsql, microtemplate
- ajout du connecteur :sigle (certifie l\'affichage des monnaies)
- suppression du module search (y\'a qu\'Ã  /search/) et conversion du module search_form vers search (ouverture du formulaire de recherche)'],
"11"=>['1225','rÃ©habilitation du connecteur twitter_cache, renommÃ© twitter_stored (met le rÃ©sultat du twit en cache)']];