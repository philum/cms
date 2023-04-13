<?php //msql/program_updates_1509
$r=["_menus_"=>['date','text'],
"1"=>['0901','publication'],
"2"=>['0901','- correctif friend_rub pour qu\'il prenne en compte les articles _system
- correctif id_of_urlsuj(), qui, sans condition, permet Ã  sql de s\'arrÃªter sur l\'occurrence la plus pertinente'],
"3"=>['0902','- le connecteur :track renvoie le contenu plutÃ´t qu\'un bouton vers popup, du commentaire prit en rÃ©fÃ©rence
- sconn prend en compte les connecteurs list, html, font, size, color, css
- refonte du connecteur :web, renvoie une preview de la page linkÃ©e, titre, image et description qui sont prÃ©sents dans l\'espace de nommage ob: des mÃ©ta'],
"4"=>['0903','- amÃ©lioration du traitement (rendu rÃ©cursif) du connecteur :track, pour lire les commentaires pris en rÃ©fÃ©rence
- le bouton du connecteur vidÃ©o convertit directement la sÃ©lection sans passer par le formulaire'],
"5"=>['0904','- correctif pour que les tags ne soient plus sensibles au champ temporel
- correctif lien des titres du gestionnaire des titres'],
"6"=>['0907','- correctif login mobile
- correctif sÃ©curitÃ© accÃ¨s Ã  la console'],
"7"=>['0909','- ajout du plugin genpswd, gÃ©nÃ¨re un mot de passe naturel avec accents et nombres
- ajout du plug md5'],
"8"=>['0910','- fix pb liens Ã  variables dans l\'interprÃ©tateur (depuis le fix prÃ©cÃ©dent)
- correctif Ã  l\'essai du non-traitement des sauts de lignes dans du code html (chose non interdite quoi que exceptionnelle)'],
"9"=>['0912','- fix pb nl2br dans tracks
- rÃ©nove dÃ©tect philum defs dans import
- rÃ©duit qtÃ© mÃ©ta, rstr74=espaces de noms ob, sinon metas normaux
- nettoie ajx
- todo retarder titres SaveI
- oubli remise en marche cache boutons d\'Ã©diteur'],
"10"=>['0913','- amÃ©liore gestion des notes de glossaires
- ajout de prop_detect()
- amÃ©liore gestionnaire admin de consultation rapide des articles'],
"11"=>['0916','- rÃ©percussion des icÃ´nes des utags dans l\'Ã©diteur
- requalification du defcon4 de nobr (obsolÃ¨te) vers dÃ©tection de footer
- ajout d\'un nouveau membre vidÃ©o : vk.com (reste inusitÃ©)'],
"12"=>['0917','- ajout du paramÃ¨tre 12 de modules : js
permet de lancer le module via javascript, aprÃ¨s le lancement de la page
- amÃ©lioration gestionnaire de modules de sorte Ã  supporter le nouveau dispositif Ã  retardateur : rendu responsable des requires'],
"13"=>['0920','- fix pb controls lecteur mp4 html5'],
"14"=>['0925','- rÃ©forme de l\'outil de tags, ajout de la suppression']];