<?php
//philum_microsql_program_updates_1210
$program_updates_1210["_menus_"]=array('day','text');
$program_updates_1210[1]=array('1001','- les popups slident dans l\'�diteur externe ;
- compatibilit� multifen�trage de l\'�diteur msql ;
- editmsql : l\'ajout d\'une table peut s\'inspirer de celle en cours (num�ro de version incr�ment�, en-t�tes) ;
- r�forme (normalisation avec les autres) du connecteur \':iframe\' : l\'option revient � droite du \'�\', ce qui permet l\'ajout de param�tres attendus suppl�mentaires : [url/w/l/name] (et le titre parvient � la popup) ;
- am�lioration du mode Desktop : les css de la div \'#page\' sont remodel�s � la vol�e : fix� � droite et aucune marge ;
- am�lioration du rendu de Finder une fois ouvert au visiteur, de sorte � ne pas le laisser consulter les r�pertoires non autoris�s ; par d�faut il tombe sur les fichiers partag�s.');
$program_updates_1210[2]=array('1002','- petite r�forme du fichier index (dates), qui va n�cessiter une action sp�ciale pour la mise � jour ;
- ajout d\'un loading pour les longs appels ajax (indicateur 3 de SaveJ) ;
- la taille de la fen�tre du desktop est d\'apr�s les css ;
- tous les liens en absolu dans msql (�vite les erreurs d�s aux multiples pages ouvertes) ;
');
$program_updates_1210[3]=array('1003','- am�lioration popup : esth�tique, et fonctionnelle : pour �viter les barre de d�filement horizontale, il suffit de mettre un padding 20px � droite ;
- (pur loisir) loading anim� (devient rouge) ;
- petit correctif d�filement des entr�es msql (d�pend de la pr�sence d\'un menu) ;
- patch qui emp�che ajax de renouveler l\'action en attente toutes les fractions de secondes avant aboutissement ;
- on a fait en sorte que l\'article affich� en \'popart\' s\'affiche beaucoup plus rapidement ;');
$program_updates_1210[4]=array('1004','- Desktop ouvre le site dans une popup (et tout prend son sens) ;
- la restriction 22 \'anti_motors_filters\' est renomm�e \'lets_bots\' (inversion de sens) pour contourner une erreur de z�ro ;
- m�morisation de l\'emplacement des fen�tres minimis�es ;
- l\'�diteur de module affiche le script de commande qui permet de l\'appeler depuis autres emplacements (MenusJ, Apps, ...)
- cool : le menu Apps peut lancer n\'importe quel module dans une popup ;
- la cat�gorie de modules \'all\' est renomm�e \'once\', plus explicite ;');
$program_updates_1210[5]=array('1005','- module de chat remit � niveau ; 
- r�vision syst�me de largeur des popups ;
- Desktop sur fond d\'�cran d�grad� ; 
- restriction 56 pour pas afficher le bouton finder dans le menu admin ;
- connecteur :thumb sensible au r�glage, renomm� \'mini-limits\' ;');
$program_updates_1210[6]=array('1006','- suppression du palliatif \'wyswyg\', le bouton renvoie un �diteur dans une popup, maintenant qu\'elles sont multipliables ;
- mise � jour d\'un filtre de normalisation des caract�res ;
- cr�ation de la table program_lexical : base de vocables utilis�s par Philum ;');
$program_updates_1210[7]=array('1007','- remise � niveau de quelques aides contextuelles ;
- correctifs gestion du plugin \'postit\' (du au changement de nom, anciennement \'text\') ;
- correctif gestion du \'loading\' qui pouvait rester b�tement affich� ;
- ajout du plugin \'mail\' disponible dans le menu Apps ;');
$program_updates_1210[8]=array('1008','- am�liorations de la popup : prise en charge des dimensions et des couleurs personnalis�es d\'apr�s param�tres ;
- ajout de la fonction \'inject_globals\' dans l\'�diteur css, plus puissante que \'append_globals\', elle ajoute des d�finitions aux d�finitions existantes (c\'est tr�s invasif).
- l\'�diteur msql ajax devait pouvoir prendre en charge les grosses entr�es (Amt) ;
- les couleurs des d�finitions globales sont relatives pour donner de l\'int�r�t � la fonction \'append_globals\'  ;
- mise � jour du css par d�faut pour qu\'il prenne en charge les nouveaux outils ;');
$program_updates_1210[9]=array('1009','- instauration des �l�ments du mode \'desktop\' (admin/params) qui sert � proposer au visiteur un espace de travail avec des applications ;
- obsolescence de l\'icone \'iframe\' d\'un article, et de la rstr 54 ;
- \'tools\' dans les Apps est une fa�on de pr�senter les outils dans une fen�tre avec des ic�nes ;
- apps/mail propose les mails qui sont dans la liste ;');
$program_updates_1210[10]=array('1010','- la rstr 8 content/ajax_mode pr�sente les articles dans une popup ;
- mode desktop : les apps utilisateur sont pr�sent�es au visiteur ;
- on peut proposer des articles dans les apps ;
- msql : champ de saisie � dimension auto-adaptable ;
- tools/mail a pour unique destinataire l\'admin si l\'utilisateur n\'est pas logu� ;');
$program_updates_1210[11]=array('1011','- introduction du plugin \'pictography\', permet de dessiner soi-m�me ses ic�nes, qui serviront � la nouvelle iconographie du site, encore enti�rement r�nov�e, et log�e dans une feuille css plut�t qu\'une table msql ;
- r�novation de la s�lection et cr�ation de cat�gories dans l\'�diteur ;
- l\'ajout d\'un nouvel article l\'affiche dans une popup ;');
$program_updates_1210[12]=array('1012','- ajout de la restriction 57 : save_in_popup pour d�sactiver l\'affichage en retour d\'un nouvel article dans une popup ;
- postit renomm� \'stext\' ;
- ajout de \'sticky\', post-it rapide (avec une t�te de posti-it) ;');
$program_updates_1210[13]=array('1013','r�vision syst�me iconographique : tous les fichiers utilis�s sont dans le r�pertoire \'system\' ;');
$program_updates_1210[14]=array('1014','cr�ation de la typo \'philum\' qui aura pour charge la pictographie globale');
$program_updates_1210[15]=array('1016','phase 2 de la r�vision pictographique : cr�ation de la typo \'philum\'');
$program_updates_1210[16]=array('1016','finalisation de la r�forme pictographique, de la typo \'philum\' et des bases affili�es, total 100 pictogrammes font partie int�grante du logiciel et l\'ensemble des ic�nes utiles au syst�me sont dans le r�pertoire \'system\', tous les inutiles ont �l� enlev�s, la version compl�te du logiciel ne prend plus en compte les milliers d\'ic�nes devenus optionnels.');
$program_updates_1210[17]=array('1017','- encore des glyphes dans la typo, qui n\'�tait pas hint�e ;
- ajout de checkboxes ajax ;');
$program_updates_1210[18]=array('1018','- ajout de la routine \'icons\' dans finder ; 
- ajout de l\'onglet \'pictos\' pour mettre � jour la police syst�me, dont la mise � jour est exceptionnelle, mais pas impossible contrairement aux autres typos');
$program_updates_1210[19]=array('1019','- correctif prise en compte de la cat�gorie depuis un nouvel article ajax ;
- autodestruction des fichiers xml obsol�tes, cr��s par le g�n�rateur de cache rss ;');
$program_updates_1210[20]=array('1020','- admin/param 19 : sert � sp�cifier les pictos associ�s aux classes de tags ;');
$program_updates_1210[21]=array('1021','- le mode icons de finder peut recevoir des miniatures ;');
$program_updates_1210[22]=array('1022','- connecteur :link admet :picto en plus de :icon comme pr�cision de l\'option : Home�home:picto:link : appelle le module Home et affiche le picto home ;
- finder obtient des dimensions fixes et s\'auto affecte l\'attribut overflow ;');
$program_updates_1210[23]=array('1023','- correctif d\'un probl�me de prise en compte des donn�es permettant l\'ajout d\'un article en mode ajax quand sa taille faisait appel au multithread ;
- am�lioration du transit des donn�es d\'un article import� dans l\'�diteur (n\'oblige plus � r�ouvrir un nouvel �diteur en cas d\'�chec) ;
- correctif inversion de l\'apparence 1/0 des restrictions ;
- ajout d\'aide pour suivre le cheminement des breadcrumbs (page_titles) ;
- en principe la typo des pictos est prise en compte dans l\'update ;');
$program_updates_1210[24]=array('1024','- les panneaux \'disk\' et \'icons\' de l\'�diteur utilisent le navigateur Finder ;
- le bouton tr�s utilis�  \'del_lines\' est plac� parmi les basiques ;
- l\'admin obtient la capacit� d\'�diteur plusieurs modules en m�me temps ;
- du coup les blocs de modules sont �ditables ind�pendamment, et mis � disposition de l\'admin-rapide (c\'est tr�s pratique) ;
fin de l\'�tape 2/3 de la r�forme de l\'admin ;
- les pictos ne s\'affichent pas dans la newsletter, dont les sigles y sont interdits ;
- r�vision des aides contextuelles des modules et de leur affichage ;');
$program_updates_1210[25]=array('1025','- les onglets des modules d\'articles affichent des pictos ;
- les commentaires obtiennent la capacit� d\'envoyer de longs textes (Amt) ;');
$program_updates_1210[26]=array('1026','addition d\'un �diteur pour les sous-modules, quand on double-clic sur la ligne ;');
$program_updates_1210[27]=array('1027','am�lioration substantielle du processus Desktop : on peut commander les fen�tres qui seront ouvertes � l\'accueil, qu\'il soit command� par la consultation temporaire ou par le param�tre admin/param/desktop, qui re�oit d�sormais une commande du style \'tools, site\' (ouvre ces deux fen�tres dans cet ordre)');
$program_updates_1210[28]=array('1028','- correctif pointage de base msql depuis tools ;
- correctif fichiers distants dans finder ;
- les url internes ouvrent des popups, en ajax_mode (rstr 8) ;');
$program_updates_1210[29]=array('1029','- instauration de la table \'system/admin_apps\' qui d�finit les types de requ�tes pour la construction d\'une structure de dossiers et d\'actions ou fichiers ;
- ajout d\'une m�thode de popup qui permet de la positionner aux alentours du bouton d\'appel ;');
$program_updates_1210[30]=array('1030','�volution significative du module \'apps\' :
- les donn�es sont dans une table user_apps ;
- la m�canique accepte diff�rents types de requ�tes (admin, modules, articles, plugins...) ;
- nouveau gestionnaire \'submod\' pour les sous-modules, qui peuvent �tre r�organis�s et import�s depuis la base system ;

Apps permet de pr�senter les applications ou documents � pr�senter dans le lanceur du menu admin et celui du desktop ; ');
$program_updates_1210[31]=array('1031','- r��criture du gestionnaire d\'enregistrement des meta (vieux de cinq ans) de fa�on � les �diter dans une popup (et supprimer toute un pav� de code) ;
- les titres sont modifi�s sit�t apr�s l\'enregistrement des metas ;
- Desktop : on peut classer les sous-modules dans des r�pertoires virtuels, afin de cr�er une structure de fichiers ;');

?>