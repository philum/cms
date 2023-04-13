<?php //msql/program_updates_1210
$r=["_menus_"=>['day','text'],
"1"=>['1001','- les popups slident dans l\'Ã©diteur externe ;
- compatibilitÃ© multifenÃªtrage de l\'Ã©diteur msql ;
- editmsql : l\'ajout d\'une table peut s\'inspirer de celle en cours (numÃ©ro de version incrÃ©mentÃ©, en-tÃªtes) ;
- rÃ©forme (normalisation avec les autres) du connecteur \':iframe\' : l\'option revient Ã  droite du \'Â§\', ce qui permet l\'ajout de paramÃ¨tres attendus supplÃ©mentaires : [url/w/l/name] (et le titre parvient Ã  la popup) ;
- amÃ©lioration du mode Desktop : les css de la div \'#page\' sont remodelÃ©s Ã  la volÃ©e : fixÃ© Ã  droite et aucune marge ;
- amÃ©lioration du rendu de Finder une fois ouvert au visiteur, de sorte Ã  ne pas le laisser consulter les rÃ©pertoires non autorisÃ©s ; par dÃ©faut il tombe sur les fichiers partagÃ©s.'],
"2"=>['1002','- petite rÃ©forme du fichier index (dates), qui va nÃ©cessiter une action spÃ©ciale pour la mise Ã  jour ;
- ajout d\'un loading pour les longs appels ajax (indicateur 3 de SaveJ) ;
- la taille de la fenÃªtre du desktop est d\'aprÃ¨s les css ;
- tous les liens en absolu dans msql (Ã©vite les erreurs dÃ»s aux multiples pages ouvertes) ;
'],
"3"=>['1003','- amÃ©lioration popup : esthÃ©tique, et fonctionnelle : pour Ã©viter les barre de dÃ©filement horizontale, il suffit de mettre un padding 20px Ã  droite ;
- (pur loisir) loading animÃ© (devient rouge) ;
- petit correctif dÃ©filement des entrÃ©es msql (dÃ©pend de la prÃ©sence d\'un menu) ;
- patch qui empÃªche ajax de renouveler l\'action en attente toutes les fractions de secondes avant aboutissement ;
- on a fait en sorte que l\'article affichÃ© en \'popart\' s\'affiche beaucoup plus rapidement ;'],
"4"=>['1004','- Desktop ouvre le site dans une popup (et tout prend son sens) ;
- la restriction 22 \'anti_motors_filters\' est renommÃ©e \'lets_bots\' (inversion de sens) pour contourner une erreur de zÃ©ro ;
- mÃ©morisation de l\'emplacement des fenÃªtres minimisÃ©es ;
- l\'Ã©diteur de module affiche le script de commande qui permet de l\'appeler depuis autres emplacements (MenusJ, Apps, ...)
- cool : le menu Apps peut lancer n\'importe quel module dans une popup ;
- la catÃ©gorie de modules \'all\' est renommÃ©e \'once\', plus explicite ;'],
"5"=>['1005','- module de chat remit Ã  niveau ; 
- rÃ©vision systÃ¨me de largeur des popups ;
- Desktop sur fond d\'Ã©cran dÃ©gradÃ© ; 
- restriction 56 pour pas afficher le bouton finder dans le menu admin ;
- connecteur :thumb sensible au rÃ©glage, renommÃ© \'mini-limits\' ;'],
"6"=>['1006','- suppression du palliatif \'wyswyg\', le bouton renvoie un Ã©diteur dans une popup, maintenant qu\'elles sont multipliables ;
- mise Ã  jour d\'un filtre de normalisation des caractÃ¨res ;
- crÃ©ation de la table program_lexical : base de vocables utilisÃ©s par Philum ;'],
"7"=>['1007','- remise Ã  niveau de quelques aides contextuelles ;
- correctifs gestion du plugin \'postit\' (du au changement de nom, anciennement \'text\') ;
- correctif gestion du \'loading\' qui pouvait rester bÃªtement affichÃ© ;
- ajout du plugin \'mail\' disponible dans le menu Apps ;'],
"8"=>['1008','- amÃ©liorations de la popup : prise en charge des dimensions et des couleurs personnalisÃ©es d\'aprÃ¨s paramÃ¨tres ;
- ajout de la fonction \'inject_globals\' dans l\'Ã©diteur css, plus puissante que \'append_globals\', elle ajoute des dÃ©finitions aux dÃ©finitions existantes (c\'est trÃ¨s invasif).
- l\'Ã©diteur msql ajax devait pouvoir prendre en charge les grosses entrÃ©es (Amt) ;
- les couleurs des dÃ©finitions globales sont relatives pour donner de l\'intÃ©rÃªt Ã  la fonction \'append_globals\'  ;
- mise Ã  jour du css par dÃ©faut pour qu\'il prenne en charge les nouveaux outils ;'],
"9"=>['1009','- instauration des Ã©lÃ©ments du mode \'desktop\' (admin/params) qui sert Ã  proposer au visiteur un espace de travail avec des applications ;
- obsolescence de l\'icone \'iframe\' d\'un article, et de la rstr 54 ;
- \'tools\' dans les Apps est une faÃ§on de prÃ©senter les outils dans une fenÃªtre avec des icÃ´nes ;
- apps/mail propose les mails qui sont dans la liste ;'],
"10"=>['1010','- la rstr 8 content/ajax_mode prÃ©sente les articles dans une popup ;
- mode desktop : les apps utilisateur sont prÃ©sentÃ©es au visiteur ;
- on peut proposer des articles dans les apps ;
- msql : champ de saisie Ã  dimension auto-adaptable ;
- tools/mail a pour unique destinataire l\'admin si l\'utilisateur n\'est pas loguÃ© ;'],
"11"=>['1011','- introduction du plugin \'pictography\', permet de dessiner soi-mÃªme ses icÃ´nes, qui serviront Ã  la nouvelle iconographie du site, encore entiÃ¨rement rÃ©novÃ©e, et logÃ©e dans une feuille css plutÃ´t qu\'une table msql ;
- rÃ©novation de la sÃ©lection et crÃ©ation de catÃ©gories dans l\'Ã©diteur ;
- l\'ajout d\'un nouvel article l\'affiche dans une popup ;'],
"12"=>['1012','- ajout de la restriction 57 : save_in_popup pour dÃ©sactiver l\'affichage en retour d\'un nouvel article dans une popup ;
- postit renommÃ© \'stext\' ;
- ajout de \'sticky\', post-it rapide (avec une tÃªte de posti-it) ;'],
"13"=>['1013','rÃ©vision systÃ¨me iconographique : tous les fichiers utilisÃ©s sont dans le rÃ©pertoire \'system\' ;'],
"14"=>['1014','crÃ©ation de la typo \'philum\' qui aura pour charge la pictographie globale'],
"15"=>['1016','phase 2 de la rÃ©vision pictographique : crÃ©ation de la typo \'philum\''],
"16"=>['1016','finalisation de la rÃ©forme pictographique, de la typo \'philum\' et des bases affiliÃ©es, total 100 pictogrammes font partie intÃ©grante du logiciel et l\'ensemble des icÃ´nes utiles au systÃ¨me sont dans le rÃ©pertoire \'system\', tous les inutiles ont Ã©lÃ© enlevÃ©s, la version complÃ¨te du logiciel ne prend plus en compte les milliers d\'icÃ´nes devenus optionnels.'],
"17"=>['1017','- encore des glyphes dans la typo, qui n\'Ã©tait pas hintÃ©e ;
- ajout de checkboxes ajax ;'],
"18"=>['1018','- ajout de la routine \'icons\' dans finder ; 
- ajout de l\'onglet \'pictos\' pour mettre Ã  jour la police systÃ¨me, dont la mise Ã  jour est exceptionnelle, mais pas impossible contrairement aux autres typos'],
"19"=>['1019','- correctif prise en compte de la catÃ©gorie depuis un nouvel article ajax ;
- autodestruction des fichiers xml obsolÃ¨tes, crÃ©Ã©s par le gÃ©nÃ©rateur de cache rss ;'],
"20"=>['1020','- admin/param 19 : sert Ã  spÃ©cifier les pictos associÃ©s aux classes de tags ;'],
"21"=>['1021','- le mode icons de finder peut recevoir des miniatures ;'],
"22"=>['1022','- connecteur :link admet :picto en plus de :icon comme prÃ©cision de l\'option : HomeÂ§home:picto:link : appelle le module Home et affiche le picto home ;
- finder obtient des dimensions fixes et s\'auto affecte l\'attribut overflow ;'],
"23"=>['1023','- correctif d\'un problÃ¨me de prise en compte des donnÃ©es permettant l\'ajout d\'un article en mode ajax quand sa taille faisait appel au multithread ;
- amÃ©lioration du transit des donnÃ©es d\'un article importÃ© dans l\'Ã©diteur (n\'oblige plus Ã  rÃ©ouvrir un nouvel Ã©diteur en cas d\'Ã©chec) ;
- correctif inversion de l\'apparence 1/0 des restrictions ;
- ajout d\'aide pour suivre le cheminement des breadcrumbs (page_titles) ;
- en principe la typo des pictos est prise en compte dans l\'update ;'],
"24"=>['1024','- les panneaux \'disk\' et \'icons\' de l\'Ã©diteur utilisent le navigateur Finder ;
- le bouton trÃ¨s utilisÃ©  \'del_lines\' est placÃ© parmi les basiques ;
- l\'admin obtient la capacitÃ© d\'Ã©diteur plusieurs modules en mÃªme temps ;
- du coup les blocs de modules sont Ã©ditables indÃ©pendamment, et mis Ã  disposition de l\'admin-rapide (c\'est trÃ¨s pratique) ;
fin de l\'Ã©tape 2/3 de la rÃ©forme de l\'admin ;
- les pictos ne s\'affichent pas dans la newsletter, dont les sigles y sont interdits ;
- rÃ©vision des aides contextuelles des modules et de leur affichage ;'],
"25"=>['1025','- les onglets des modules d\'articles affichent des pictos ;
- les commentaires obtiennent la capacitÃ© d\'envoyer de longs textes (Amt) ;'],
"26"=>['1026','addition d\'un Ã©diteur pour les sous-modules, quand on double-clic sur la ligne ;'],
"27"=>['1027','amÃ©lioration substantielle du processus Desktop : on peut commander les fenÃªtres qui seront ouvertes Ã  l\'accueil, qu\'il soit commandÃ© par la consultation temporaire ou par le paramÃ¨tre admin/param/desktop, qui reÃ§oit dÃ©sormais une commande du style \'tools, site\' (ouvre ces deux fenÃªtres dans cet ordre)'],
"28"=>['1028','- correctif pointage de base msql depuis tools ;
- correctif fichiers distants dans finder ;
- les url internes ouvrent des popups, en ajax_mode (rstr 8) ;'],
"29"=>['1029','- instauration de la table \'system/admin_apps\' qui dÃ©finit les types de requÃªtes pour la construction d\'une structure de dossiers et d\'actions ou fichiers ;
- ajout d\'une mÃ©thode de popup qui permet de la positionner aux alentours du bouton d\'appel ;'],
"30"=>['1030','Ã©volution significative du module \'apps\' :
- les donnÃ©es sont dans une table user_apps ;
- la mÃ©canique accepte diffÃ©rents types de requÃªtes (admin, modules, articles, plugins...) ;
- nouveau gestionnaire \'submod\' pour les sous-modules, qui peuvent Ãªtre rÃ©organisÃ©s et importÃ©s depuis la base system ;

Apps permet de prÃ©senter les applications ou documents Ã  prÃ©senter dans le lanceur du menu admin et celui du desktop ; '],
"31"=>['1031','- rÃ©Ã©criture du gestionnaire d\'enregistrement des meta (vieux de cinq ans) de faÃ§on Ã  les Ã©diter dans une popup (et supprimer toute un pavÃ© de code) ;
- les titres sont modifiÃ©s sitÃ´t aprÃ¨s l\'enregistrement des metas ;
- Desktop : on peut classer les sous-modules dans des rÃ©pertoires virtuels, afin de crÃ©er une structure de fichiers ;']];