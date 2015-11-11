<?php
//philum_microsql_program_updates_1304
$r["_menus_"]=array('day','text');
$r[1]=array('0401','- externalisation dans un plugin de tout ce qui concerne les stats (8Ko) ;
- une milliseconde est ajoutée entre chaque enregistrement du batch (évite les mauvais tris, quand param/art_order est sur DAY au lieu de ID) ;
- amélioration de la détection d\'ancres : appliquée d\'office par défaut, prend en compte de nouveaux patterns ;
- rebuild_cache en ajax ;
- fix pb de largeur en appelant le site dans une iframe dans une popup ;');
$r[2]=array('0402','- francisation des restrictions
- les 4 templates pub, titles, tracks et book sont personnalisables individuellement via les restrictions de l\'onglet \'local\'
- meilleure différenciation entre templates publics et privés dans l\'admin, et du transport de l\'un vers l\'autre');
$r[3]=array('0402','- amélioration du fonctionnement du frein aux modules d\'articles (rstr60) qui affiche un bouton qui appelle le contenu sur place ;
-  le template prend en charge le paramètre width du module art_mod, ce qui rend sa largeur contrôlable \"de l\'extérieur\" ; la largeur du content prévoit l\'arrivée du module d\'article ;');
$r[4]=array('0403','- petite amélioration du fonctionnement du AMT : l\'échec incrémente la temporalité des événements
- amélioration de la présentation de la console : on peut créer et appliquer une table sur place
- le moteur de recherche exclut en mode booléen une petite somme de mots courants
- le LOAD accepte les hypertags avec des accents
- grande somme de débugs : inscription, menus admin, auto-réparation des modules critiques, accès aux designs publics, etc...');
$r[5]=array('0404','# Inauguration du nouveau procédé de menus \'bubbles\' : des popups qui s\'ouvrent en menu à tiroirs, en explorant des sous-modules de type \'Apps\' (hiérarchies de type dossier virtuel comme le Finder). phase 1/3 : mise en place des dispositions ajax, des css \'bubs\', physiquement opérationnel, remplacera les menus déroulants en css');
$r[6]=array('0404','- petit correctif pour pas que soit gênant l\'ajustement automatique de la taille des champs de texte 
- ajout du connecteur \'popart\' (ça manquait aux 7 autres du même genre), permet d\'ouvrir un article philum, local ou distant, dans une popup. utilisé dans le \'about\' pour afficher notre pub
- ajout d\'un bouton d\'édition \'test\' dans l\'éditeur pour prévisualiser avant de sauver ;
- ajout du bouton d\'édition \'findconn\' qui sélectionne le connecteur autour du focus, très pratique');
$r[7]=array('0405','# procédé Bubble, phase 2/3 :
- création de tables msql volatiles
- adjonction de la méthode Apps
- regénération des menus de l\'Admin');
$r[8]=array('0406','# procédé Bubble, phase 2,5/3 :
- le chargement des bulles est rendu progressif au fur et à mesure de la navigation (au lieu de tout charger d\'un coup)
- les résultats sont mises en cache
- les données déjà affichées une fois n\'ont plus besoin d\'être chargées à nouveau
- le design des bulles dépend du type de contenu (par défaut affiche des bulles vides)
- ajout d\'une routine de comportement des bulles et de leur contenu (recherche, ajout d\'article et batch : loading, auto-fermeture)');
$r[9]=array('0407','# procédé Bubble, phase 3/3 :
- ajout des menus msql, qui joint le plupart des tables
- ajout de l\'icône \'arts\' qui renvoie les articles du cache ;
- ehancements : animation de la fermeture, fadings, fermeture automatique, détachement dans une popup ;
- suppression de 10Ko de code (contre 14 ajoutés) et de 19 classes css (#menuA, Global) des anciens types de menus ; les pages sont toutes allégées de 11 à 15 Ko à cause de l\'absence de menu prédéfini.');
$r[10]=array('0408','nombreux petits ajustements liés à l\'implantation de des bulles');
$r[11]=array('0408','- meilleur calage des menus bulles qui dépassent
- menu admin en bubbles (celui de derrière) par un menu bubble : 31 classes css supprimées (#menuH, design admin)
- externalisation des fonctions meta et bubble (13 et 7Ko en moins pour les autres appels ajax)');
$r[12]=array('0409','- toutes les images sont renommées en randomname et la détection inclue les images php (images sans nom)
- ajout d\'un bouton \'test\' des css en cours d\'édition
- émulation de la désirée fonction javascript \'onClickOutside\' pour fermer les bulles');
$r[13]=array('0410','- adaptation du module \'submenus\' au système des bulles ;
- suppression des 17 classes associées \'menuH\' du css \'global\', et les 17 du design par défaut
- ajout du connecteur \"bubble\" qui fait comme le module \'submenus\' (avec les menus sur une ligne)');
$r[14]=array('0411','- nouvelle promo, avec 3 slideshows et une centaine d\'images commentées : http://philum.net/129
- amélioration de la commodité et petites réparations au moment de la création des slideshows');
$r[15]=array('0411','- rénovation de la radio et du jukebox, qui sont un peut vieillots...');
$r[16]=array('0412','- ajout du module \'Wall\', système de publication rapide (commentaires attachés à un paramètre)
- petit effort pour rendre l\'ajout de commentaire sans réafficher les autres
- ajout de messages d\'alertes dont un pour les pdf (nécessite google) 
- correctif détection de la racine des répertoires des articles qui voyagent dans les câbles');
$r[17]=array('0413','- rstr 70 : retape, déclenche une conversion des anciennes specs (double accolades, br dans le code, anciens connecteurs)
- ajout de la page ajax à la racine dans l\'update (relifté en passant) : une ligne change car on va conditionner l\'accès à ajxf');
$r[18]=array('0413','- fix pb wyswyg prend pas effet quand on clic sur le textarea
- fix enregistrement AMT dans l\'éditeur sText
- fix s\'y reprendre à deux fois pour déclencher une recherche
- fix bug critique, pour pas que \'retape\' ne soit déclenché lors de la lecture d\'un commentaire');
$r[19]=array('0413','- moteur de recherche : la virgule (,) permet une recherche booléenne sur des termes contenant des espaces( très pratique)
- ajout du module de rendu d\'article \'read\' (preview|full|false|auto|read) : ne retourne que le contenu (sites de showcase)');
$r[20]=array('0414','- les Apps peut êtres publiques ou privées
- les menus de l\'admin tiennent (à nouveau) compte du niveau d\'autorisation');
$r[21]=array('0415','- nouvelle gestion des pages en ajax, marche aussi pour les modules (y compris le moteur de recherche)
- fix pb numérotation des menus ajax quand certains sont désactivés ;
- fix pb localisation de la source des stats (depuis leur externalisation)');
$r[22]=array('0416','normalisation des css avec le webkit (open source alors OK) utilisé par Chrome et Safari (même si ça fait un peu tarte d\'avoir plusieurs définitions d\'une déclaration)');
$r[23]=array('0417','le login auto est conditionné par la reconnaissance IP');
$r[24]=array('0418','- l\'option du desktop définit le jeu de couleur du dégradé du fond d\'écran
- le connecteur :pop permet d\'ouvrir le contenu dans une popup [hello world§button:bub]
- l\'importateur d\'images était fâché avec les .jpEg
- désormais toutes les images renommée avec un randid()
- remise à niveau de l\'auto-réparation des modules critiques (absence de paramètre autant qu\'absence de module)
- les messages d\'alerte s\'affichent dans une popup');
$r[25]=array('0419','nouvelle version de la typo \'philum\' complètement remaniée, en 16px, ajout d\'icônes pour le Finder');
$r[26]=array('0420','un truc génial : 
- ajout du meta \'folder\'
- ajout du module \'desktop_varts\' (virtual articles)
= les articles peuvent figurer dans le Desktop et on peut naviguer dans les répertoires virtuels');
$r[27]=array('0421','- le param \'auto\' du type de sous-modules \'arts\', en plus de renvoyer le titre de l\'article à la place du bouton, renvoie la miniature de l\'image. (par défaut depuis \'desktop_folder\')');
$r[28]=array('0421','- desktop_varts reçoit en paramètre une ligne de commande d\'article (cat=public) pour restreindre les résultats à cette condition
- ajout d\'aides et de cohérence dans l\'éditeur de sous-modules
- ajout du module desktop_arts : comme desktop_varts sauf que les répertoires sont les catégories (n\'utilise pas les répertoires virtuels)');
$r[29]=array('0421','- ajout du module desktop_files : affiche les fichiers partagés dans le Desktop, param = global ou local, option = chemin réel ou virtuel
- le sous-modules \'file\' renvoie la miniature de l\'image. (par défaut depuis \'desktop_files)');
$r[30]=array('0422','- fix pb cohérence des icônes dans les système de navigation ajax
- fix pb de condition dans le menu Apps
- correctifs graphiques et ajout de 11 autres signes dans la typo philum (version 7g)
- fix pg partage des modifs des répertoires virtuels');
$r[31]=array('0423','- réécriture du plugin \'chat\', entièrement en Msql ;
- ajout du plugin \'chatxml\', entre serveurs, multi-canaux, accepte les miniconn (et dans les Apps par défaut)
- ajout des miniconnecteurs, permet de rédiger la mise en forme sans les crochets:b
- et ajout du module \'chatxml\'');
$r[32]=array('0424','amélioration substantielle du Desktop :
- simplification de la fenêtre d\'édition des Apps 
- on peut afficher le premier niveau du Desktop en mode \'icônes de bureau\'
- le module \'desktop\' renvoie désormais les icônes de bureau, séparément de l\'effacement du contenu, confiée à un module \'deskload\' (les actions sont distinctes)
- la condition \'tools\' est renommée \'desk\', plus compréhensible, à part que toutes vos Apps sont invalidées, il faut soit les renommer soit recharger les valeurs par défaut (très conseillé)');
$r[33]=array('0424','- les commentaires utilisent désormais une série minimale de connecteurs
- les liens vers des vidéos sont tous interprétés en :popvideo');
$r[34]=array('0425','- amélioration de la présentation des Apps prédéfinies
- nouveau gestionnaire de positionnement des modules (et sous-modules)
- nouvelles vidéos dans le showroom : defcons, batch, et usertags
- dans les articles, les @adresses Twitter sont détectés et appellent le flux dans une popup');
$r[35]=array('0426','chatXml : 
- les miniconn marchent en série : test:b:i:u
- on peut appeler d\'autres #chaînes avec le #
- fonctionne en n\'étant pas logué');
$r[36]=array('0426','- la rstr 48 était stupide : auto-update devient un paramètre serveur et rstr 48 devient \'login\' pour ne pas afficher le login au public
- améliorations du gestionnaire Apps');
$r[37]=array('0427','- amélioration des miniconn : miniatures, connecteurs :video, :room, picto ;
- partages de ressources avec les smallconn (vrais connecteurs destinés au public), notamment pour l\'itération de type :b:i:u
- tickets et preview tracks utilisent miniconn
- preview article : sconn
- chat et tracks : sconn + miniconn');
$r[38]=array('0427','- ajout du connecteur \':chatxml\', permet d\'ouvrir un chat (comme :room dans les miniconn)
- ajout du connecteur \':modpop\', le même que \':module\', permet d\'ouvrir un module dans une popup (ce qu\'on pouvait faire avec \':apps\')');
$r[39]=array('0428','- remise en forme du codeline basic
- édition de la nouvelle typo \'microsys4\' et son pendant \'microsys4l\', la typo du logo Philum');
$r[40]=array('0429','- encore des modifs sur les typos + système pour qu\'elles soient chargées correctement
- modernisation du design global et par défaut');
$r[41]=array('0430','- correctif de sécurité (n\'importe qui pouvait se loguer...)
- patch d\'optimisation des tables msql (18 changements...)
- la popup d\'édition des css se relance quand on recherge la page (commodité)
- les css rendus publics n\'étaient pas visibles dans le sélecteur de design parce que leur nom n\'était pas signalé enregistré ;
- un module très inutile, csscode, permet d\'appeler des fonction prédéfinies (pour la dev des pictos) ;
- fond d\'écran : on peut signaler une image dans l\'option du desktop au lieu des couleurs');

?>