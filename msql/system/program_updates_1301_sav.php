<?php
//philum_microsql_program_updates_1301
$r["_menus_"]=array('day','text');
$r[1]=array('0101','- am�lioration de la pr�sentation des versions d\'une table dans l\'admin msql ;
- r�paration du filtre \'rename_img\' (importation renom�e d\'image) ;');
$r[2]=array('0102','- la fonction \'coller html\' re�oit le contenu courant (�diteur wyswyg d\'articles, version pr�liminaire) ;
- le connecteur :video peut recevoir une url compl�te, pour qu\'il suffise d\'ajouter \':video\' � l\'url (m�me sans crochets) pour g�n�rer un player ;
- admin/apps : possibilit� d\'obtenir les menus par d�faut ;');
$r[3]=array('0103','- correctifs sur le rendu de la description de l\'article (clean_internal_tags) ;
- le connecteur \'color\' n\'�tait pas signal� dans la liste, d�sormais ordonn�e ;
- nouveau processus de suppression de connecteurs, plus efficace ;
- ajout des boutons \'text\'  et \'html\' dans la fen�tre public de distribution du code de l\'article (textbrut) ;');
$r[4]=array('0104','- d�couverte qu\'on peut faire ceci (non document� mais �a marche) : $var(); appelle la fonction nomm�e $var ;
- fix erreur d�tection d\'images (stristr valide aussi les portions, ici le point) ;
- correctif pour que la suppression de connecteurs laisse passer les crochets volontaires ;');
$r[5]=array('0105','- correctif erreur critique lors du partage d\'un fichier ;
- les ic�nes de Finder sont g�r�s par le process pictographique ;
- correctif disparition impromptue du signe % dans les textes contenant des entit�s html ;');
$r[6]=array('0106','- r�novation de l\'appli sText, francisation, fonctionnement (tables pas forc�ment bien ordonn�es) ;
- ajout de b�quille au process \'pop\' (relance une popup au m�me emplacement) : conservation des propri�t�s de d�placement ;');
$r[7]=array('0107','- ajout du connecteur \'apps\', qui permet de cr�er un ic�ne d\'application, ou d\'en joindre une existante par son ID.

exemples : 
[stext;plug;stext:apps]
[iframe;link;;http://w41k.info/429:apps]
[msql;ajax;popup;msql___system_program_updates_1301:apps]
[6:apps]');
$r[8]=array('0108','- ajout d\'un \'permalink\' qui permet de joindre un chemin d\'acc�s vers le finder, incluant les options d\'affichage ;');
$r[9]=array('0109','- les pictos non disponibles dans la session affichent leur intitul� (au lieu de rien) ;');
$r[10]=array('0110','- finder : apparition du mode \'flap\' ;');
$r[11]=array('0111','- nouveau syst�me d\'appel des ressources ;
- fix compatibilit� des sources de la newsletter ;');
$r[12]=array('0112','- am�lioration excitante du mode flap du finder ; l\'id�e de s�parer les r�pertoires et les fichiers, qui n�cessitent une pr�sentation diff�rente, incite � faire de ce mode l\'environnement du Finder ;');
$r[13]=array('0113','- flap finder : r�pertoire ne s\'ouvre pas s\'il est vide ;');
$r[14]=array('0114','- am�lioration densit� des fonctions des popups (composants partag�s) ;
- ne d�passent plus de l\'�cran ;
- peuvent recevoir des boutons optionnels ;');
$r[15]=array('0115','- am�lioration visionnage des images : usage de popup, mode zoom sur place ;
- la consultation d\'une image d\'un article propose de voir les autres ;');

?>