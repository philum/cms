<?php
//philum_microsql_program_updates_1612
$r["_menus_"]=array('date','text');
$r[1]=array('1201','publication');
$r[2]=array('1204','ajout du plug et du gestionnaire d\'Api tlex (publier articles sur tlex.fr)');
$r[3]=array('1205','r�solution petit pb de compatibilit� en mode utf8');
$r[4]=array('1208','- r�fection du syst�me de newsletters
- rectificatifs divers de compatibilit� avec un serveur ovh mutualis�');
$r[5]=array('1212','- on d�place l\'�diteur dans une dv plut�t qu\'une popup, et de m�me avec le menu folders de l\'�diteur de titres');
$r[6]=array('1213','- ajout du mode (et du template associ�) \'simplified\', permet de r�duire l\'info affich�e au minimum, pour rendre plus agr�able la synth�se vocale.
Les modes sont disponibles dans le menu Phi (g�n�ralement public).
- les boutons d\'api ne s\'affichent que pour leur propri�taire
- le bouton-menu track rendu r�actif au param�tre local');
$r[7]=array('1215','- ajout du connecteur img�height:fluid, permet de poser une image statique dont l\'ensemble se d�couvre pendant le scroll
- le module Banner r�agit de fa�on fluide, et accepte des connecteurs dans le titre (l\'option donne la hauter)');
$r[8]=array('1217','- ajout du module audio_^playlist, comme video_playlist, renvoie les articles contenant des .mp3
- r�novation du retape d\'anciens connecteurs
- mise au rancart du connecteur :popvideo (remplac� par �txt:video)');
$r[9]=array('1220','- ajout du support de conversion multibyte aux capteurs ajax (ceux qui manquaient)
- retrait de la pr�c�dente (politique de \"�a marche, on laisse\")');
$r[10]=array('1221','- ajout des connecteurs :floatleft et :floatright
- obsolescence des connecteurs :2cols, 3cols, :/2, :/3 remplac�s par �2:cols et �2:block
- �radication des anciens connecteurs obsol�tes :microsql, microtemplate
- ajout du connecteur :sigle (certifie l\'affichage des monnaies)
- suppression du module search (y\'a qu\'� /search/) et conversion du module search_form vers search (ouverture du formulaire de recherche)');
$r[11]=array('1225','r�habilitation du connecteur twitter_cache, renomm� twitter_stored (met le r�sultat du twit en cache)');

?>