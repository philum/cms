<?php
//philum_microsql_program_updates_1509
$r["_menus_"]=array('date','text');
$r[1]=array('0901','publication');
$r[2]=array('0901','- correctif friend_rub pour qu\'il prenne en compte les articles _system
- correctif id_of_urlsuj(), qui, sans condition, permet à sql de s\'arrêter sur l\'occurrence la plus pertinente');
$r[3]=array('0902','- le connecteur :track renvoie le contenu plutôt qu\'un bouton vers popup, du commentaire prit en référence
- sconn prend en compte les connecteurs list, html, font, size, color, css
- refonte du connecteur :web, renvoie une preview de la page linkée, titre, image et description qui sont présents dans l\'espace de nommage ob: des méta');
$r[4]=array('0903','- amélioration du traitement (rendu récursif) du connecteur :track, pour lire les commentaires pris en référence
- le bouton du connecteur vidéo convertit directement la sélection sans passer par le formulaire');
$r[5]=array('0904','- correctif pour que les tags ne soient plus sensibles au champ temporel
- correctif lien des titres du gestionnaire des titres');
$r[6]=array('0907','- correctif login mobile
- correctif sécurité accès à la console');
$r[7]=array('0909','- ajout du plugin genpswd, génère un mot de passe naturel avec accents et nombres
- ajout du plug md5');
$r[8]=array('0910','- fix pb liens à variables dans l\'interprétateur (depuis le fix précédent)
- correctif à l\'essai du non-traitement des sauts de lignes dans du code html (chose non interdite quoi que exceptionnelle)');
$r[9]=array('0912','- fix pb nl2br dans tracks
- rénove détect philum defs dans import
- réduit qté méta, rstr74=espaces de noms ob, sinon metas normaux
- nettoie ajx
- todo retarder titres SaveI
- oubli remise en marche cache boutons d\'éditeur');
$r[10]=array('0913','- améliore gestion des notes de glossaires
- ajout de prop_detect()
- améliore gestionnaire admin de consultation rapide des articles');
$r[11]=array('0916','- répercussion des icônes des utags dans l\'éditeur
- requalification du defcon4 de nobr (obsolète) vers détection de footer
- ajout d\'un nouveau membre vidéo : vk.com (reste inusité)');
$r[12]=array('0917','- ajout du paramètre 12 de modules : js
permet de lancer le module via javascript, après le lancement de la page
- amélioration gestionnaire de modules de sorte à supporter le nouveau dispositif à retardateur : rendu responsable des requires');
$r[13]=array('0920','- fix pb controls lecteur mp4 html5');
$r[14]=array('0925','- réforme de l\'outil de tags, ajout de la suppression');

?>