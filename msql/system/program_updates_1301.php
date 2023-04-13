<?php //msql/program_updates_1301
$r=["_menus_"=>['day','text'],
"1"=>['0101','- amÃ©lioration de la prÃ©sentation des versions d\'une table dans l\'admin msql ;
- rÃ©paration du filtre \'rename_img\' (importation renomÃ©e d\'image) ;'],
"2"=>['0102','- la fonction \'coller html\' reÃ§oit le contenu courant (Ã©diteur wyswyg d\'articles, version prÃ©liminaire) ;
- le connecteur :video peut recevoir une url complÃ¨te, pour qu\'il suffise d\'ajouter \':video\' Ã  l\'url (mÃªme sans crochets) pour gÃ©nÃ©rer un player ;
- admin/apps : possibilitÃ© d\'obtenir les menus par dÃ©faut ;'],
"3"=>['0103','- correctifs sur le rendu de la description de l\'article (clean_internal_tags) ;
- le connecteur \'color\' n\'Ã©tait pas signalÃ© dans la liste, dÃ©sormais ordonnÃ©e ;
- nouveau processus de suppression de connecteurs, plus efficace ;
- ajout des boutons \'text\'  et \'html\' dans la fenÃªtre public de distribution du code de l\'article (textbrut) ;'],
"4"=>['0104','- dÃ©couverte qu\'on peut faire ceci (non documentÃ© mais Ã§a marche) : $var(); appelle la fonction nommÃ©e $var ;
- fix erreur dÃ©tection d\'images (stristr valide aussi les portions, ici le point) ;
- correctif pour que la suppression de connecteurs laisse passer les crochets volontaires ;'],
"5"=>['0105','- correctif erreur critique lors du partage d\'un fichier ;
- les icÃ´nes de Finder sont gÃ©rÃ©s par le process pictographique ;
- correctif disparition impromptue du signe % dans les textes contenant des entitÃ©s html ;'],
"6"=>['0106','- rÃ©novation de l\'appli sText, francisation, fonctionnement (tables pas forcÃ©ment bien ordonnÃ©es) ;
- ajout de bÃ©quille au process \'pop\' (relance une popup au mÃªme emplacement) : conservation des propriÃ©tÃ©s de dÃ©placement ;'],
"7"=>['0107','- ajout du connecteur \'apps\', qui permet de crÃ©er un icÃ´ne d\'application, ou d\'en joindre une existante par son ID.

exemples : 
[stext;plug;stext:apps]
[iframe;link;;http://w41k.info/429:apps]
[msql;ajax;popup;msql___system_program_updates_1301:apps]
[6:apps]'],
"8"=>['0108','- ajout d\'un \'permalink\' qui permet de joindre un chemin d\'accÃ¨s vers le finder, incluant les options d\'affichage ;'],
"9"=>['0109','- les pictos non disponibles dans la session affichent leur intitulÃ© (au lieu de rien) ;'],
"10"=>['0110','- finder : apparition du mode \'flap\' ;'],
"11"=>['0111','- nouveau systÃ¨me d\'appel des ressources ;
- fix compatibilitÃ© des sources de la newsletter ;'],
"12"=>['0112','- amÃ©lioration excitante du mode flap du finder ; l\'idÃ©e de sÃ©parer les rÃ©pertoires et les fichiers, qui nÃ©cessitent une prÃ©sentation diffÃ©rente, incite Ã  faire de ce mode l\'environnement du Finder ;'],
"13"=>['0113','- flap finder : rÃ©pertoire ne s\'ouvre pas s\'il est vide ;'],
"14"=>['0114','- amÃ©lioration densitÃ© des fonctions des popups (composants partagÃ©s) ;
- ne dÃ©passent plus de l\'Ã©cran ;
- peuvent recevoir des boutons optionnels ;'],
"15"=>['0115','- amÃ©lioration visionnage des images : usage de popup, mode zoom sur place, consultation des autres images de l\'article courant ;
- les modules d\'articles sont dÃ©sactivÃ©s pendant la lecture dans une popup (qui doivent rester rapides Ã  lancer) ;'],
"16"=>['0116','- rÃ©paration de livestats ;
- ajout du module most_read_stat, articles les plus visitÃ©s ces n derniers jours, y compris les articles hors champ temporel (stats serveur consolidÃ©es, plus lent) ;'],
"17"=>['0117','- fix pb de sÃ©lection de texte pendant le dÃ©placement de la popup ;
- l\'usage antique des double-accolades est rendu obsolÃ¨te ;'],
"18"=>['0118','- le moteur de recherche pousse automatiquement Ã  la plage temporelle suivante quand aucun rÃ©sultat n\'est trouvÃ© ;
- fix pb de pluriel dans le rÃ©sultat du moteur ;'],
"19"=>['0119','- le module rssin (import d\'articles depuis les flux) reÃ§oit deux boutons en plus, un pour preview, un pour save direct (trÃ¨s efficace !) ;
- (en passant devant) ajout du connecteur \'popurl\' qui ira afficher une page web transcodÃ©e dans une popup ;
- l\'absence de miniature est compensÃ©e par un picto d\'article (pour la lisibilitÃ©) ;'],
"20"=>['0120','- la navigation entre les pages d\'un dÃ©roulÃ© d\'articles peut se faire en ajax ;
- la restriction 39 (2-cols) est requalifiÃ©e \'pages ajax\' ;'],
"21"=>['0121','- ajout du support des sites Blogspot de faÃ§on gÃ©nÃ©rique : plus besoin de dÃ©finitions personnalisÃ©es pour l\'importation d\'article ;'],
"22"=>['0122','- rÃ©solution d\'un conflit de slashes (transports ajax)'],
"23"=>['0123','- rÃ©solution des problÃ¨mes d\'importation en cas d\'image manquante (fonction \'joinable\' ne renvoie pas de message d\'erreur qui bloque l\'affichage du rÃ©sultat de l\'importation) ;'],
"24"=>['0128','- auto-reboot si on appelle ajax aprÃ¨s la fermeture des sessions ;
- design de la popup ;'],
"25"=>['0130','- amÃ©lioration du killeur de lignes dans l\'Ã©diteur, rÃ©duit de 2 Ã  1 saut de lignes, mais aussi de 1 Ã  0 si aucun double-saut est dÃ©tectÃ©, de faÃ§on Ã  Ã©muler le filtre \'clean_mail\' ;
- clean_mail est plus pratique pour les rÃ©duire les sauts de lignes inutiles sans rÃ©duire les double-sauts de ligne, dans le texte sÃ©lectionnÃ© ;']];