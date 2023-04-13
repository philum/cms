<?php //msql/program_updates_1304
$r=["_menus_"=>['day','text'],
"1"=>['0401','- externalisation dans un plugin de tout ce qui concerne les stats (8Ko) ;
- une milliseconde est ajoutÃ©e entre chaque enregistrement du batch (Ã©vite les mauvais tris, quand param/art_order est sur DAY au lieu de ID) ;
- amÃ©lioration de la dÃ©tection d\'ancres : appliquÃ©e d\'office par dÃ©faut, prend en compte de nouveaux patterns ;
- rebuild_cache en ajax ;
- fix pb de largeur en appelant le site dans une iframe dans une popup ;'],
"2"=>['0402','- francisation des restrictions
- les 4 templates pub, titles, tracks et book sont personnalisables individuellement via les restrictions de l\'onglet \'local\'
- meilleure diffÃ©renciation entre templates publics et privÃ©s dans l\'admin, et du transport de l\'un vers l\'autre'],
"3"=>['0402','- amÃ©lioration du fonctionnement du frein aux modules d\'articles (rstr60) qui affiche un bouton qui appelle le contenu sur place ;
-  le template prend en charge le paramÃ¨tre width du module art_mod, ce qui rend sa largeur contrÃ´lable \"de l\'extÃ©rieur\" ; la largeur du content prÃ©voit l\'arrivÃ©e du module d\'article ;'],
"4"=>['0403','- petite amÃ©lioration du fonctionnement du AMT : l\'Ã©chec incrÃ©mente la temporalitÃ© des Ã©vÃ©nements
- amÃ©lioration de la prÃ©sentation de la console : on peut crÃ©er et appliquer une table sur place
- le moteur de recherche exclut en mode boolÃ©en une petite somme de mots courants
- le LOAD accepte les hypertags avec des accents
- grande somme de dÃ©bugs : inscription, menus admin, auto-rÃ©paration des modules critiques, accÃ¨s aux designs publics, etc...'],
"5"=>['0404','# Inauguration du nouveau procÃ©dÃ© de menus \'bubbles\' : des popups qui s\'ouvrent en menu Ã  tiroirs, en explorant des sous-modules de type \'Apps\' (hiÃ©rarchies de type dossier virtuel comme le Finder). phase 1/3 : mise en place des dispositions ajax, des css \'bubs\', physiquement opÃ©rationnel, remplacera les menus dÃ©roulants en css'],
"6"=>['0404','- petit correctif pour pas que soit gÃªnant l\'ajustement automatique de la taille des champs de texte 
- ajout du connecteur \'popart\' (Ã§a manquait aux 7 autres du mÃªme genre), permet d\'ouvrir un article philum, local ou distant, dans une popup. utilisÃ© dans le \'about\' pour afficher notre pub
- ajout d\'un bouton d\'Ã©dition \'test\' dans l\'Ã©diteur pour prÃ©visualiser avant de sauver ;
- ajout du bouton d\'Ã©dition \'findconn\' qui sÃ©lectionne le connecteur autour du focus, trÃ¨s pratique'],
"7"=>['0405','# procÃ©dÃ© Bubble, phase 2/3 :
- crÃ©ation de tables msql volatiles
- adjonction de la mÃ©thode Apps
- regÃ©nÃ©ration des menus de l\'Admin'],
"8"=>['0406','# procÃ©dÃ© Bubble, phase 2,5/3 :
- le chargement des bulles est rendu progressif au fur et Ã  mesure de la navigation (au lieu de tout charger d\'un coup)
- les rÃ©sultats sont mises en cache
- les donnÃ©es dÃ©jÃ  affichÃ©es une fois n\'ont plus besoin d\'Ãªtre chargÃ©es Ã  nouveau
- le design des bulles dÃ©pend du type de contenu (par dÃ©faut affiche des bulles vides)
- ajout d\'une routine de comportement des bulles et de leur contenu (recherche, ajout d\'article et batch : loading, auto-fermeture)'],
"9"=>['0407','# procÃ©dÃ© Bubble, phase 3/3 :
- ajout des menus msql, qui joint le plupart des tables
- ajout de l\'icÃ´ne \'arts\' qui renvoie les articles du cache ;
- ehancements : animation de la fermeture, fadings, fermeture automatique, dÃ©tachement dans une popup ;
- suppression de 10Ko de code (contre 14 ajoutÃ©s) et de 19 classes css (#menuA, Global) des anciens types de menus ; les pages sont toutes allÃ©gÃ©es de 11 Ã  15 Ko Ã  cause de l\'absence de menu prÃ©dÃ©fini.'],
"10"=>['0408','nombreux petits ajustements liÃ©s Ã  l\'implantation de des bulles'],
"11"=>['0408','- meilleur calage des menus bulles qui dÃ©passent
- menu admin en bubbles (celui de derriÃ¨re) par un menu bubble : 31 classes css supprimÃ©es (#menuH, design admin)
- externalisation des fonctions meta et bubble (13 et 7Ko en moins pour les autres appels ajax)'],
"12"=>['0409','- toutes les images sont renommÃ©es en randomname et la dÃ©tection inclue les images php (images sans nom)
- ajout d\'un bouton \'test\' des css en cours d\'Ã©dition
- Ã©mulation de la dÃ©sirÃ©e fonction javascript \'onClickOutside\' pour fermer les bulles'],
"13"=>['0410','- adaptation du module \'submenus\' au systÃ¨me des bulles ;
- suppression des 17 classes associÃ©es \'menuH\' du css \'global\', et les 17 du design par dÃ©faut
- ajout du connecteur \"bubble\" qui fait comme le module \'submenus\' (avec les menus sur une ligne)'],
"14"=>['0411','- nouvelle promo, avec 3 slideshows et une centaine d\'images commentÃ©es : http://philum.fr/129
- amÃ©lioration de la commoditÃ© et petites rÃ©parations au moment de la crÃ©ation des slideshows'],
"15"=>['0411','- rÃ©novation de la radio et du jukebox, qui sont un peut vieillots...'],
"16"=>['0412','- ajout du module \'Wall\', systÃ¨me de publication rapide (commentaires attachÃ©s Ã  un paramÃ¨tre)
- petit effort pour rendre l\'ajout de commentaire sans rÃ©afficher les autres
- ajout de messages d\'alertes dont un pour les pdf (nÃ©cessite google) 
- correctif dÃ©tection de la racine des rÃ©pertoires des articles qui voyagent dans les cÃ¢bles'],
"17"=>['0413','- rstr 70 : retape, dÃ©clenche une conversion des anciennes specs (double accolades, br dans le code, anciens connecteurs)
- ajout de la page ajax Ã  la racine dans l\'update (reliftÃ© en passant) : une ligne change car on va conditionner l\'accÃ¨s Ã  ajxf'],
"18"=>['0413','- fix pb wyswyg prend pas effet quand on clic sur le textarea
- fix enregistrement AMT dans l\'Ã©diteur sText
- fix s\'y reprendre Ã  deux fois pour dÃ©clencher une recherche
- fix bug critique, pour pas que \'retape\' ne soit dÃ©clenchÃ© lors de la lecture d\'un commentaire'],
"19"=>['0413','- moteur de recherche : la virgule (,) permet une recherche boolÃ©enne sur des termes contenant des espaces( trÃ¨s pratique)
- ajout du module de rendu d\'article \'read\' (preview|full|false|auto|read) : ne retourne que le contenu (sites de showcase)'],
"20"=>['0414','- les Apps peut Ãªtres publiques ou privÃ©es
- les menus de l\'admin tiennent (Ã  nouveau) compte du niveau d\'autorisation'],
"21"=>['0415','- nouvelle gestion des pages en ajax, marche aussi pour les modules (y compris le moteur de recherche)
- fix pb numÃ©rotation des menus ajax quand certains sont dÃ©sactivÃ©s ;
- fix pb localisation de la source des stats (depuis leur externalisation)'],
"22"=>['0416','normalisation des css avec le webkit (open source alors OK) utilisÃ© par Chrome et Safari (mÃªme si Ã§a fait un peu tarte d\'avoir plusieurs dÃ©finitions d\'une dÃ©claration)'],
"23"=>['0417','le login auto est conditionnÃ© par la reconnaissance IP'],
"24"=>['0418','- l\'option du desktop dÃ©finit le jeu de couleur du dÃ©gradÃ© du fond d\'Ã©cran
- le connecteur :pop permet d\'ouvrir le contenu dans une popup [hello worldÂ§button:bub]
- l\'importateur d\'images Ã©tait fÃ¢chÃ© avec les .jpEg
- dÃ©sormais toutes les images renommÃ©e avec un randid()
- remise Ã  niveau de l\'auto-rÃ©paration des modules critiques (absence de paramÃ¨tre autant qu\'absence de module)
- les messages d\'alerte s\'affichent dans une popup'],
"25"=>['0419','nouvelle version de la typo \'philum\' complÃ¨tement remaniÃ©e, en 16px, ajout d\'icÃ´nes pour le Finder'],
"26"=>['0420','un truc gÃ©nial : 
- ajout du meta \'folder\'
- ajout du module \'desktop_varts\' (virtual articles)
= les articles peuvent figurer dans le Desktop et on peut naviguer dans les rÃ©pertoires virtuels'],
"27"=>['0421','- le param \'auto\' du type de sous-modules \'arts\', en plus de renvoyer le titre de l\'article Ã  la place du bouton, renvoie la miniature de l\'image. (par dÃ©faut depuis \'desktop_folder\')'],
"28"=>['0421','- desktop_varts reÃ§oit en paramÃ¨tre une ligne de commande d\'article (cat=public) pour restreindre les rÃ©sultats Ã  cette condition
- ajout d\'aides et de cohÃ©rence dans l\'Ã©diteur de sous-modules
- ajout du module desktop_arts : comme desktop_varts sauf que les rÃ©pertoires sont les catÃ©gories (n\'utilise pas les rÃ©pertoires virtuels)'],
"29"=>['0421','- ajout du module desktop_files : affiche les fichiers partagÃ©s dans le Desktop, param = global ou local, option = chemin rÃ©el ou virtuel
- le sous-modules \'file\' renvoie la miniature de l\'image. (par dÃ©faut depuis \'desktop_files)'],
"30"=>['0422','- fix pb cohÃ©rence des icÃ´nes dans les systÃ¨me de navigation ajax
- fix pb de condition dans le menu Apps
- correctifs graphiques et ajout de 11 autres signes dans la typo philum (version 7g)
- fix pg partage des modifs des rÃ©pertoires virtuels'],
"31"=>['0423','- rÃ©Ã©criture du plugin \'chat\', entiÃ¨rement en Msql ;
- ajout du plugin \'chatxml\', entre serveurs, multi-canaux, accepte les miniconn (et dans les Apps par dÃ©faut)
- ajout des miniconnecteurs, permet de rÃ©diger la mise en forme sans les crochets:b
- et ajout du module \'chatxml\''],
"32"=>['0424','amÃ©lioration substantielle du Desktop :
- simplification de la fenÃªtre d\'Ã©dition des Apps 
- on peut afficher le premier niveau du Desktop en mode \'icÃ´nes de bureau\'
- le module \'desktop\' renvoie dÃ©sormais les icÃ´nes de bureau, sÃ©parÃ©ment de l\'effacement du contenu, confiÃ©e Ã  un module \'deskload\' (les actions sont distinctes)
- la condition \'tools\' est renommÃ©e \'desk\', plus comprÃ©hensible, Ã  part que toutes vos Apps sont invalidÃ©es, il faut soit les renommer soit recharger les valeurs par dÃ©faut (trÃ¨s conseillÃ©)'],
"33"=>['0424','- les commentaires utilisent dÃ©sormais une sÃ©rie minimale de connecteurs
- les liens vers des vidÃ©os sont tous interprÃ©tÃ©s en :popvideo'],
"34"=>['0425','- amÃ©lioration de la prÃ©sentation des Apps prÃ©dÃ©finies
- nouveau gestionnaire de positionnement des modules (et sous-modules)
- nouvelles vidÃ©os dans le showroom : defcons, batch, et usertags
- dans les articles, les @adresses Twitter sont dÃ©tectÃ©s et appellent le flux dans une popup'],
"35"=>['0426','chatXml : 
- les miniconn marchent en sÃ©rie : test:b:i:u
- on peut appeler d\'autres #chaÃ®nes avec le #
- fonctionne en n\'Ã©tant pas loguÃ©'],
"36"=>['0426','- la rstr 48 Ã©tait stupide : auto-update devient un paramÃ¨tre serveur et rstr 48 devient \'login\' pour ne pas afficher le login au public
- amÃ©liorations du gestionnaire Apps'],
"37"=>['0427','- amÃ©lioration des miniconn : miniatures, connecteurs :video, :room, picto ;
- partages de ressources avec les smallconn (vrais connecteurs destinÃ©s au public), notamment pour l\'itÃ©ration de type :b:i:u
- tickets et preview tracks utilisent miniconn
- preview article : sconn
- chat et tracks : sconn + miniconn'],
"38"=>['0427','- ajout du connecteur \':chatxml\', permet d\'ouvrir un chat (comme :room dans les miniconn)
- ajout du connecteur \':modpop\', le mÃªme que \':module\', permet d\'ouvrir un module dans une popup (ce qu\'on pouvait faire avec \':apps\')'],
"39"=>['0428','- remise en forme du codeline basic
- Ã©dition de la nouvelle typo \'microsys4\' et son pendant \'microsys4l\', la typo du logo Philum'],
"40"=>['0429','- encore des modifs sur les typos + systÃ¨me pour qu\'elles soient chargÃ©es correctement
- modernisation du design global et par dÃ©faut'],
"41"=>['0430','- correctif de sÃ©curitÃ© (n\'importe qui pouvait se loguer...)
- patch d\'optimisation des tables msql (18 changements...)
- la popup d\'Ã©dition des css se relance quand on recherge la page (commoditÃ©)
- les css rendus publics n\'Ã©taient pas visibles dans le sÃ©lecteur de design parce que leur nom n\'Ã©tait pas signalÃ© enregistrÃ© ;
- un module trÃ¨s inutile, csscode, permet d\'appeler des fonction prÃ©dÃ©finies (pour la dev des pictos) ;
- fond d\'Ã©cran : on peut signaler une image dans l\'option du desktop au lieu des couleurs']];