<?php
//philum_microsql_program_updates_1108
$r["_menus_"]=array('day','txt');
$r[1]=array('110803','r�paration de admin/fonts qui met � jour la base serveur des typos r�ellement pr�sentes par rapport � la base system des typos disponibles et aux fichiers d�tect�s dans /fonts');
$r[2]=array('110803','ajout du support d\'update du r�pertoire \'bkg\'');
$r[3]=array('110803','nouveau design par d�faut, n�8 dans les designs publiques');
$r[4]=array('110804','ajout du support de cr�ation de nouveaux r�pertoires command�s par l\'update');
$r[5]=array('110806','cr�ation du plugin \'goog\' qui permet d\'afficher les r�f�rences d\'un flux rss google');
$r[6]=array('110807','ajout des restrictions
- \'auto_parent\' : d�finit si le nouvel article utilise celui en cours comme parent ;
- \'auto_publish\' : publie automatiquement un nouvel article ;');
$r[7]=array('110809','am�lioration du syst�me de d�tection d\'encodage des flux rss');
$r[8]=array('110810','am�lioration du syst�me d\'adaptation aux diff�rents types de dates des flux rss');
$r[9]=array('110811','ajout de la restriction \'p_balise\' qui permet d\'utiliser des balises \'p\' � la place du double saut de ligne');
$r[10]=array('110811','ajout des filtres de nettoyage \'del_h\', \'del_i\', et \'del_qmark\' qui convertit les \'?\' en d�but de ligne en \'-\' ;');
$r[11]=array('110811','ajout d\'un rapport des questions fr�quentes (et utiles) dans admin/faq');
$r[12]=array('110811','ajout d\'un rapport des questions fr�quentes (et utiles) dans admin/faq');
$r[13]=array('110811','ajout d\'un rapport des questions fr�quentes (et utiles) dans admin/faq');
$r[14]=array('110812','adaptation des css MenuH (menus hi�rarchiques) au nouveau design par d�faut');
$r[15]=array('110812','correctif sur la g�n�ration de balises \'p\' quand \'p_balise\' est activ�');
$r[16]=array('110812','la taille des miniatures du connecteur \':photo\' devient d�pendant des param�tres de taille des miniatures dans admin/params/27');
$r[17]=array('110813','la taille des images g�n�r�es est affich�e dans le html, pour faire plaisir � IE (on a �t� sympas)');
$r[18]=array('110813','correctifs sur le mode p_balise (pour pas �craser les simples sauts de lignes)');
$r[19]=array('110813','syst�me de commodit� d\'ajout de connecteurs comportant un param�tre');
$r[20]=array('110813','le bouton connecteur :css propose les classes disponibles et l\'applique au texte s�lectionn�');
$r[21]=array('110814','affichage des Tickets par pages');
$r[22]=array('110814','ajout d\'une imbrication de requ�te mysql pour am�liorer le r�sultat des tris multiples, quand une langue est s�lectionn�e (la vitesse reste � am�liorer) ;
le module \'articles\' devient capable de trier les langues');
$r[23]=array('110815','petite r�vision de l\'affichage des trackbacks, correctif affichage de l\'avatar et ajout de la classe \'track\'');
$r[24]=array('110815','la suppression d\'une classe css r�ordonne les clefs');
$r[25]=array('110816','connecteur \':codeline\' : affiche le rendu d\'un template en codeline : chaque ligne doit contenir une instruction sans les crochets au d�but et � la fin de la ligne. 
Ce fonctionnement particulier oblige le logiciel � lire le contenu du connecteur en mode \'codeline\'.');
$r[26]=array('110816','connecteur \':thumb\' : fabrique des miniatures avec des dimensions personnalis�es : [img.jpg�140/100:thumb]

:thumb est une instruction de Codeline (pour les templates), mais n\'�tait pas disponible pour les connecteurs logiciels (articles)');
$r[27]=array('110816','connecteur \':mini\' : fabrique des miniatures aux dimensions personnalis�es (voir :thumb) et renvoie un lien vers une popup en ajax');
$r[28]=array('110817','ajout d\'une option \'nb\' dans le module \'hubs\' pour afficher le nombre d\'articles de chaque hub');
$r[29]=array('110817','petites r�parations dans Slider pour le \'apply to all\' et la nomination des images');
$r[30]=array('110818','connecteur \'sliderJ\' : galerie photo profitant de Slider (qui cr�e un r�pertoire, des miniatures et permet d\'ajouter des commentaires mis en forme), mais en ajax au lieu de Flash.');
$r[31]=array('110818','correctifs sur :photo2 :
- supporte les images de l\'EDU (espace disque utilisateur) ;
- premi�re image qui ne s\'affichait pas
- capacit� d\'en mettre plusieurs sur une page ;
- timer (en chantier)');
$r[32]=array('110819','finalisation de :sliderJ : 
- fonctionnement palp� sur :photo2 (ajax)
- r�vision de la m�morisation de la position ;');
$r[33]=array('110819','correctifs sur :photo2 et :photo :
- d�filement en boucle
- supporte les sources h�t�rog�nes (EDU ou image d\'article)
- r�vision de la compatibilit� entre les 3 sortes de sources et les 3 sortes de rendus (9 combinaisons)');
$r[34]=array('110820','sliderJ : 
- affiche les miniatures qui d�filent quand on clique dessus si on ajoute \'�1\' : \'[table�1:sliderJ ]\'
- peut �tre appel� plusieurs fois');
$r[35]=array('110820','images plein-�cran : exit la popup, l\'image est redimensionn�e � la taille de la fen�tre, centr�e, et le fond de page est obscurcit');
$r[36]=array('110821','compatibilit� interne de l\'importation d\'articles d\'un hub � l\'autre avec p_balise');
$r[37]=array('110821','newsletter : �tendue du champ d\'action de la fabrication de liens absolus');
$r[38]=array('110822','ajout d\'options dans master_config (niveau 7) :
- timezone : fixe le fuseau horaire (Europe/Paris) ;
- error_report : niveau du rapport d\'erreurs (en dev, NULL en prod) ;');
$r[39]=array('110823','mise en conformit� de l\'installer avec PHP 5.3 et ses pr�f�rences :
- fichier .user.ini
- error_rporting � E_STRICT
- permission 705');
$r[40]=array('110823','les petits articles sont enregistr�s en ajax');
$r[41]=array('110824','la galerie ajax :photo2 d�marre � la premi�re image et non la deuxi�me ;
la galerie SliderJ est capable de g�rer les liste d\'objets discontinus (quand une entr�e a �t� effac�e)');
$r[42]=array('110825','correctif templates : espace ind�sirable qui provoquait des erreurs');
$r[43]=array('110826','le module Taxonomy peut recevoir en option l\'�tendue temporelle en nombre de jour (suite � quoi les articles parents sont affich�s en contexte)');
$r[44]=array('110828','ajout du support de modules d\'article :
- module syst�me \'art_mod\', o� on sp�cifie la commande de modules, comme dans tab_mods (onglets html) ou MenusJ (appel�s en ajax);
- en option la largeur par d�faut est de 160, ce qui permet de redimensionner les contenus qui se trouvent eject�s par la colonne additionnelle ;
- template r�vis� pour supporter la variable ARTMOD ;');
$r[45]=array('110829','aujout du support de nomination des termes usuels utilis�s par le logiciel :
- ajout la table lang/helps_nominations (31 intitul�s) ;
- application de la sessions \'nms\'  (27 placements) ;
les nominations actuelles sont pr�liminaires.');
$r[46]=array('110829','ajout de la restriction \'nb_arts\' qui interrompt l\'affichage du nombre d\'articles apr�s un titre ; celui-ci est n�anmoins enclench� dans le cadre de la navigation temporelle (dont la recherche).');
$r[47]=array('110830','petites am�liorations dans les templates d\'article et de commentaire (classes �ditables, dates relatives)');
$r[48]=array('110831','admin/banner obtient un champ qui s\'informe d\'un chemin vers un dossier de l\'EDU (ex: \'images/ban\') ou de l\'ID d\'un article pour produire des miniatures et les proposer pour se faire �lire \"banni�re\"');
$r[49]=array('110831','la taille de l\'image de la banni�re s\'adapte � la largeur indiqu�e dans le module system \'banner\'');
$r[50]=array('110831','nouveau logo nuque d�gag�e pour la rentr�e');

?>