<?php
//philum_microsql_program_updates_1301
$r["_menus_"]=array('day','text');
$r[1]=array('0101','- amélioration de la présentation des versions d\'une table dans l\'admin msql ;
- réparation du filtre \'rename_img\' (importation renomée d\'image) ;');
$r[2]=array('0102','- la fonction \'coller html\' reçoit le contenu courant (éditeur wyswyg d\'articles, version préliminaire) ;
- le connecteur :video peut recevoir une url complète, pour qu\'il suffise d\'ajouter \':video\' à l\'url (même sans crochets) pour générer un player ;
- admin/apps : possibilité d\'obtenir les menus par défaut ;');
$r[3]=array('0103','- correctifs sur le rendu de la description de l\'article (clean_internal_tags) ;
- le connecteur \'color\' n\'était pas signalé dans la liste, désormais ordonnée ;
- nouveau processus de suppression de connecteurs, plus efficace ;
- ajout des boutons \'text\'  et \'html\' dans la fenêtre public de distribution du code de l\'article (textbrut) ;');
$r[4]=array('0104','- découverte qu\'on peut faire ceci (non documenté mais ça marche) : $var(); appelle la fonction nommée $var ;
- fix erreur détection d\'images (stristr valide aussi les portions, ici le point) ;
- correctif pour que la suppression de connecteurs laisse passer les crochets volontaires ;');
$r[5]=array('0105','- correctif erreur critique lors du partage d\'un fichier ;
- les icônes de Finder sont gérés par le process pictographique ;
- correctif disparition impromptue du signe % dans les textes contenant des entités html ;');
$r[6]=array('0106','- rénovation de l\'appli sText, francisation, fonctionnement (tables pas forcément bien ordonnées) ;
- ajout de béquille au process \'pop\' (relance une popup au même emplacement) : conservation des propriétés de déplacement ;');
$r[7]=array('0107','- ajout du connecteur \'apps\', qui permet de créer un icône d\'application, ou d\'en joindre une existante par son ID.

exemples : 
[stext;plug;stext:apps]
[iframe;link;;http://w41k.info/429:apps]
[msql;ajax;popup;msql___system_program_updates_1301:apps]
[6:apps]');
$r[8]=array('0108','- ajout d\'un \'permalink\' qui permet de joindre un chemin d\'accès vers le finder, incluant les options d\'affichage ;');
$r[9]=array('0109','- les pictos non disponibles dans la session affichent leur intitulé (au lieu de rien) ;');
$r[10]=array('0110','- finder : apparition du mode \'flap\' ;');
$r[11]=array('0111','- nouveau système d\'appel des ressources ;
- fix compatibilité des sources de la newsletter ;');
$r[12]=array('0112','- amélioration excitante du mode flap du finder ; l\'idée de séparer les répertoires et les fichiers, qui nécessitent une présentation différente, incite à faire de ce mode l\'environnement du Finder ;');
$r[13]=array('0113','- flap finder : répertoire ne s\'ouvre pas s\'il est vide ;');
$r[14]=array('0114','- amélioration densité des fonctions des popups (composants partagés) ;
- ne dépassent plus de l\'écran ;
- peuvent recevoir des boutons optionnels ;');
$r[15]=array('0115','- amélioration visionnage des images : usage de popup, mode zoom sur place ;
- la consultation d\'une image d\'un article propose de voir les autres ;');

?>