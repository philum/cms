<?php
//philum_microsql_program_updates_1304
$r["_menus_"]=array('day','text');
$r[1]=array('0401','- externalisation dans un plugin de tout ce qui concerne les stats (8Ko) ;
- une milliseconde est ajout�e entre chaque enregistrement du batch (�vite les mauvais tris, quand param/art_order est sur DAY au lieu de ID) ;
- am�lioration de la d�tection d\'ancres : appliqu�e d\'office par d�faut, prend en compte de nouveaux patterns ;
- rebuild_cache en ajax ;
- fix pb de largeur en appelant le site dans une iframe dans une popup ;');
$r[2]=array('0402','- francisation des restrictions
- les 4 templates pub, titles, tracks et book sont personnalisables individuellement via les restrictions de l\'onglet \'local\'
- meilleure diff�renciation entre templates publics et priv�s dans l\'admin, et du transport de l\'un vers l\'autre');
$r[3]=array('0402','- am�lioration du fonctionnement du frein aux modules d\'articles (rstr60) qui affiche un bouton qui appelle le contenu sur place ;
-  le template prend en charge le param�tre width du module art_mod, ce qui rend sa largeur contr�lable \"de l\'ext�rieur\" ; la largeur du content pr�voit l\'arriv�e du module d\'article ;');
$r[4]=array('0403','- petite am�lioration du fonctionnement du AMT : l\'�chec incr�mente la temporalit� des �v�nements
- am�lioration de la pr�sentation de la console : on peut cr�er et appliquer une table sur place
- le moteur de recherche exclut en mode bool�en une petite somme de mots courants
- le LOAD accepte les hypertags avec des accents
- grande somme de d�bugs : inscription, menus admin, auto-r�paration des modules critiques, acc�s aux designs publics, etc...');
$r[5]=array('0404','# Inauguration du nouveau proc�d� de menus \'bubbles\' : des popups qui s\'ouvrent en menu � tiroirs, en explorant des sous-modules de type \'Apps\' (hi�rarchies de type dossier virtuel comme le Finder). phase 1/3 : mise en place des dispositions ajax, des css \'bubs\', physiquement op�rationnel, remplacera les menus d�roulants en css');
$r[6]=array('0404','- petit correctif pour pas que soit g�nant l\'ajustement automatique de la taille des champs de texte 
- ajout du connecteur \'popart\' (�a manquait aux 7 autres du m�me genre), permet d\'ouvrir un article philum, local ou distant, dans une popup. utilis� dans le \'about\' pour afficher notre pub
- ajout d\'un bouton d\'�dition \'test\' dans l\'�diteur pour pr�visualiser avant de sauver ;
- ajout du bouton d\'�dition \'findconn\' qui s�lectionne le connecteur autour du focus, tr�s pratique');
$r[7]=array('0405','# proc�d� Bubble, phase 2/3 :
- cr�ation de tables msql volatiles
- adjonction de la m�thode Apps
- reg�n�ration des menus de l\'Admin');
$r[8]=array('0406','# proc�d� Bubble, phase 2,5/3 :
- le chargement des bulles est rendu progressif au fur et � mesure de la navigation (au lieu de tout charger d\'un coup)
- les r�sultats sont mises en cache
- les donn�es d�j� affich�es une fois n\'ont plus besoin d\'�tre charg�es � nouveau
- le design des bulles d�pend du type de contenu (par d�faut affiche des bulles vides)
- ajout d\'une routine de comportement des bulles et de leur contenu (recherche, ajout d\'article et batch : loading, auto-fermeture)');
$r[9]=array('0407','# proc�d� Bubble, phase 3/3 :
- ajout des menus msql, qui joint le plupart des tables
- ajout de l\'ic�ne \'arts\' qui renvoie les articles du cache ;
- ehancements : animation de la fermeture, fadings, fermeture automatique, d�tachement dans une popup ;
- suppression de 10Ko de code (contre 14 ajout�s) et de 19 classes css (#menuA, Global) des anciens types de menus ; les pages sont toutes all�g�es de 11 � 15 Ko � cause de l\'absence de menu pr�d�fini.');
$r[10]=array('0408','nombreux petits ajustements li�s � l\'implantation de des bulles');
$r[11]=array('0408','- meilleur calage des menus bulles qui d�passent
- menu admin en bubbles (celui de derri�re) par un menu bubble : 31 classes css supprim�es (#menuH, design admin)
- externalisation des fonctions meta et bubble (13 et 7Ko en moins pour les autres appels ajax)');
$r[12]=array('0409','- toutes les images sont renomm�es en randomname et la d�tection inclue les images php (images sans nom)
- ajout d\'un bouton \'test\' des css en cours d\'�dition
- �mulation de la d�sir�e fonction javascript \'onClickOutside\' pour fermer les bulles');
$r[13]=array('0410','- adaptation du module \'submenus\' au syst�me des bulles ;
- suppression des 17 classes associ�es \'menuH\' du css \'global\', et les 17 du design par d�faut
- ajout du connecteur \"bubble\" qui fait comme le module \'submenus\' (avec les menus sur une ligne)');
$r[14]=array('0411','- nouvelle promo, avec 3 slideshows et une centaine d\'images comment�es : http://philum.net/129
- am�lioration de la commodit� et petites r�parations au moment de la cr�ation des slideshows');
$r[15]=array('0411','- r�novation de la radio et du jukebox, qui sont un peut vieillots...');
$r[16]=array('0412','- ajout du module \'Wall\', syst�me de publication rapide (commentaires attach�s � un param�tre)
- petit effort pour rendre l\'ajout de commentaire sans r�afficher les autres
- ajout de messages d\'alertes dont un pour les pdf (n�cessite google) 
- correctif d�tection de la racine des r�pertoires des articles qui voyagent dans les c�bles');
$r[17]=array('0413','- rstr 70 : retape, d�clenche une conversion des anciennes specs (double accolades, br dans le code, anciens connecteurs)
- ajout de la page ajax � la racine dans l\'update (relift� en passant) : une ligne change car on va conditionner l\'acc�s � ajxf');
$r[18]=array('0413','- fix pb wyswyg prend pas effet quand on clic sur le textarea
- fix enregistrement AMT dans l\'�diteur sText
- fix s\'y reprendre � deux fois pour d�clencher une recherche
- fix bug critique, pour pas que \'retape\' ne soit d�clench� lors de la lecture d\'un commentaire');
$r[19]=array('0413','- moteur de recherche : la virgule (,) permet une recherche bool�enne sur des termes contenant des espaces( tr�s pratique)
- ajout du module de rendu d\'article \'read\' (preview|full|false|auto|read) : ne retourne que le contenu (sites de showcase)');
$r[20]=array('0414','- les Apps peut �tres publiques ou priv�es
- les menus de l\'admin tiennent (� nouveau) compte du niveau d\'autorisation');
$r[21]=array('0415','- nouvelle gestion des pages en ajax, marche aussi pour les modules (y compris le moteur de recherche)
- fix pb num�rotation des menus ajax quand certains sont d�sactiv�s ;
- fix pb localisation de la source des stats (depuis leur externalisation)');
$r[22]=array('0416','normalisation des css avec le webkit (open source alors OK) utilis� par Chrome et Safari (m�me si �a fait un peu tarte d\'avoir plusieurs d�finitions d\'une d�claration)');
$r[23]=array('0417','le login auto est conditionn� par la reconnaissance IP');
$r[24]=array('0418','- l\'option du desktop d�finit le jeu de couleur du d�grad� du fond d\'�cran
- le connecteur :pop permet d\'ouvrir le contenu dans une popup [hello world�button:bub]
- l\'importateur d\'images �tait f�ch� avec les .jpEg
- d�sormais toutes les images renomm�e avec un randid()
- remise � niveau de l\'auto-r�paration des modules critiques (absence de param�tre autant qu\'absence de module)
- les messages d\'alerte s\'affichent dans une popup');
$r[25]=array('0419','nouvelle version de la typo \'philum\' compl�tement remani�e, en 16px, ajout d\'ic�nes pour le Finder');
$r[26]=array('0420','un truc g�nial : 
- ajout du meta \'folder\'
- ajout du module \'desktop_varts\' (virtual articles)
= les articles peuvent figurer dans le Desktop et on peut naviguer dans les r�pertoires virtuels');
$r[27]=array('0421','- le param \'auto\' du type de sous-modules \'arts\', en plus de renvoyer le titre de l\'article � la place du bouton, renvoie la miniature de l\'image. (par d�faut depuis \'desktop_folder\')');
$r[28]=array('0421','- desktop_varts re�oit en param�tre une ligne de commande d\'article (cat=public) pour restreindre les r�sultats � cette condition
- ajout d\'aides et de coh�rence dans l\'�diteur de sous-modules
- ajout du module desktop_arts : comme desktop_varts sauf que les r�pertoires sont les cat�gories (n\'utilise pas les r�pertoires virtuels)');
$r[29]=array('0421','- ajout du module desktop_files : affiche les fichiers partag�s dans le Desktop, param = global ou local, option = chemin r�el ou virtuel
- le sous-modules \'file\' renvoie la miniature de l\'image. (par d�faut depuis \'desktop_files)');
$r[30]=array('0422','- fix pb coh�rence des ic�nes dans les syst�me de navigation ajax
- fix pb de condition dans le menu Apps
- correctifs graphiques et ajout de 11 autres signes dans la typo philum (version 7g)
- fix pg partage des modifs des r�pertoires virtuels');
$r[31]=array('0423','- r��criture du plugin \'chat\', enti�rement en Msql ;
- ajout du plugin \'chatxml\', entre serveurs, multi-canaux, accepte les miniconn (et dans les Apps par d�faut)
- ajout des miniconnecteurs, permet de r�diger la mise en forme sans les crochets:b
- et ajout du module \'chatxml\'');
$r[32]=array('0424','am�lioration substantielle du Desktop :
- simplification de la fen�tre d\'�dition des Apps 
- on peut afficher le premier niveau du Desktop en mode \'ic�nes de bureau\'
- le module \'desktop\' renvoie d�sormais les ic�nes de bureau, s�par�ment de l\'effacement du contenu, confi�e � un module \'deskload\' (les actions sont distinctes)
- la condition \'tools\' est renomm�e \'desk\', plus compr�hensible, � part que toutes vos Apps sont invalid�es, il faut soit les renommer soit recharger les valeurs par d�faut (tr�s conseill�)');
$r[33]=array('0424','- les commentaires utilisent d�sormais une s�rie minimale de connecteurs
- les liens vers des vid�os sont tous interpr�t�s en :popvideo');
$r[34]=array('0425','- am�lioration de la pr�sentation des Apps pr�d�finies
- nouveau gestionnaire de positionnement des modules (et sous-modules)
- nouvelles vid�os dans le showroom : defcons, batch, et usertags
- dans les articles, les @adresses Twitter sont d�tect�s et appellent le flux dans une popup');
$r[35]=array('0426','chatXml : 
- les miniconn marchent en s�rie : test:b:i:u
- on peut appeler d\'autres #cha�nes avec le #
- fonctionne en n\'�tant pas logu�');
$r[36]=array('0426','- la rstr 48 �tait stupide : auto-update devient un param�tre serveur et rstr 48 devient \'login\' pour ne pas afficher le login au public
- am�liorations du gestionnaire Apps');
$r[37]=array('0427','- am�lioration des miniconn : miniatures, connecteurs :video, :room, picto ;
- partages de ressources avec les smallconn (vrais connecteurs destin�s au public), notamment pour l\'it�ration de type :b:i:u
- tickets et preview tracks utilisent miniconn
- preview article : sconn
- chat et tracks : sconn + miniconn');
$r[38]=array('0427','- ajout du connecteur \':chatxml\', permet d\'ouvrir un chat (comme :room dans les miniconn)
- ajout du connecteur \':modpop\', le m�me que \':module\', permet d\'ouvrir un module dans une popup (ce qu\'on pouvait faire avec \':apps\')');
$r[39]=array('0428','- remise en forme du codeline basic
- �dition de la nouvelle typo \'microsys4\' et son pendant \'microsys4l\', la typo du logo Philum');
$r[40]=array('0429','- encore des modifs sur les typos + syst�me pour qu\'elles soient charg�es correctement
- modernisation du design global et par d�faut');
$r[41]=array('0430','- correctif de s�curit� (n\'importe qui pouvait se loguer...)
- patch d\'optimisation des tables msql (18 changements...)
- la popup d\'�dition des css se relance quand on recherge la page (commodit�)
- les css rendus publics n\'�taient pas visibles dans le s�lecteur de design parce que leur nom n\'�tait pas signal� enregistr� ;
- un module tr�s inutile, csscode, permet d\'appeler des fonction pr�d�finies (pour la dev des pictos) ;
- fond d\'�cran : on peut signaler une image dans l\'option du desktop au lieu des couleurs');

?>