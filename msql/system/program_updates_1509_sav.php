<?php
//philum_microsql_program_updates_1509
$r["_menus_"]=array('date','text');
$r[1]=array('0901','publication');
$r[2]=array('0901','- correctif friend_rub pour qu\'il prenne en compte les articles _system
- correctif id_of_urlsuj(), qui, sans condition, permet � sql de s\'arr�ter sur l\'occurrence la plus pertinente');
$r[3]=array('0902','- le connecteur :track renvoie le contenu plut�t qu\'un bouton vers popup, du commentaire prit en r�f�rence
- sconn prend en compte les connecteurs list, html, font, size, color, css
- refonte du connecteur :web, renvoie une preview de la page link�e, titre, image et description qui sont pr�sents dans l\'espace de nommage ob: des m�ta');
$r[4]=array('0903','- am�lioration du traitement (rendu r�cursif) du connecteur :track, pour lire les commentaires pris en r�f�rence
- le bouton du connecteur vid�o convertit directement la s�lection sans passer par le formulaire');
$r[5]=array('0904','- correctif pour que les tags ne soient plus sensibles au champ temporel
- correctif lien des titres du gestionnaire des titres');
$r[6]=array('0907','- correctif login mobile
- correctif s�curit� acc�s � la console');
$r[7]=array('0909','- ajout du plugin genpswd, g�n�re un mot de passe naturel avec accents et nombres
- ajout du plug md5');
$r[8]=array('0910','- fix pb liens � variables dans l\'interpr�tateur (depuis le fix pr�c�dent)
- correctif � l\'essai du non-traitement des sauts de lignes dans du code html (chose non interdite quoi que exceptionnelle)');
$r[9]=array('0912','- fix pb nl2br dans tracks
- r�nove d�tect philum defs dans import
- r�duit qt� m�ta, rstr74=espaces de noms ob, sinon metas normaux
- nettoie ajx
- todo retarder titres SaveI
- oubli remise en marche cache boutons d\'�diteur');
$r[10]=array('0913','- am�liore gestion des notes de glossaires
- ajout de prop_detect()
- am�liore gestionnaire admin de consultation rapide des articles');
$r[11]=array('0916','- r�percussion des ic�nes des utags dans l\'�diteur
- requalification du defcon4 de nobr (obsol�te) vers d�tection de footer
- ajout d\'un nouveau membre vid�o : vk.com (reste inusit�)');
$r[12]=array('0917','- ajout du param�tre 12 de modules : js
permet de lancer le module via javascript, apr�s le lancement de la page
- am�lioration gestionnaire de modules de sorte � supporter le nouveau dispositif � retardateur : rendu responsable des requires');
$r[13]=array('0920','- fix pb controls lecteur mp4 html5');
$r[14]=array('0925','- r�forme de l\'outil de tags, ajout de la suppression');

?>