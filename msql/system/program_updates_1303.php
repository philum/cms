<?php //msql/program_updates_1303
$r=["_menus_"=>['day','text'],
"1"=>['0301','- la dÃ©tection des dÃ©finitions gÃ©nÃ©riques est rendue secondaire aprÃ¨s les dÃ©finitions locales (c\'est plus logique) ;
- le menu Apps est rendu sensible au paramÃ¨tre \'hide\''],
"2"=>['0302','- petites amÃ©liorations de l\'ordre du confort lors de l\'usage du moteur de recherche ;
- le compteur d\'articles Ã©tait en rade (affichÃ©s dans le menu hubs)'],
"3"=>['0304','ajout d\'un composant trÃ¨s primitif permettant de dessiner Ã  main levÃ©e (tools/draw, plugin \'draw\' et nouvelle version de JQuery) : il faut coller le lien dans un connecteur :img afin de l\'enregistrer dans l\'article'],
"4"=>['0306','ajout du support des images en base 64 (ce qui permet d\'enregistrer les images engendrÃ©es par le plugin \'draw\')'],
"5"=>['0307','fix pb de \'rien qui s\'affiche\' aprÃ¨s usage de l\'Ã©diteur wyswyg, quand un contenu est dÃ©jÃ  placÃ©'],
"6"=>['0309','fix pb d\'\'icÃ´ne \'link\' qui s\'affiche Ã  l\'extÃ©rieur de la restriction \'link\' (27)'],
"7"=>['0312','- rub_taxo rÃ©fÃ¨re Ã  des donnÃ©es permanentes ; 
- le nombre d\'articles affichÃ© tient compte des inclusions (count_r) ; '],
"8"=>['0312','- fix pb addressage d\'image du connecteur :web ;
- fix pb affectation de la rstr 60 aux modules d\'articles ;
- fix faille de sÃ©curitÃ© dans affectation des sessions ;'],
"9"=>['0312','- amÃ©lioration gestion recherche boolÃ©enne : usage de \'*\' Ã  la fin de la requÃªte (commande url) ;
- ajout de rstr 62 (auto dig) : interdit l\'extension de la recherche aux plages temporelles suivantes ;'],
"10"=>['0313','rstr 63 : edit divs, permet d\'Ã©diter les modules sur place'],
"11"=>['0313','amÃ©lioration du fonctionnement de Desktop : fix pb de rÃ©activation, interdiction icÃ´nes contradictoire, non affichage de la fenÃªtre par dÃ©faut si on dÃ©sire des fenÃªtres particuliÃ¨res (boot) ;'],
"12"=>['0313','- correctif connecteur \'rss_read\' pour retrouver la source des images ;
- fix empÃªchement de l\'affichage des articles des hubs fermÃ©s ;'],
"13"=>['0314','Ã©dition des modules : 
- rÃ©novation du gÃ©nÃ©rateur de ligne de commande ;
- ajout d\'un bouton \'preview\' qui affiche le rendu des paramÃ¨tres courants ;'],
"14"=>['0314','- fix pb affichage des non-connecteurs (texte simple entre crochets) ;
- fix pb affichage du module \'codeline\' ;
- rÃ©novation module \'contact\' (dans une popup) ;'],
"15"=>['0315','- fix pb accÃ¨s aux messages depuis le menu admin
- fix mauvais encodage des sauts de lignes dans la version du message envoyÃ© par mail
- fix pas de sujet dans le mail ;
- ajout de la nomination 85 \'message Ã  l\'admin\''],
"16"=>['0316','nouvelle interface du moteur de recherche, en ajax'],
"17"=>['0317','- ajout d\'un composant \'search\' au \'user_menu\' ;
- affichage des rÃ©sultats d\'une recherche vide portant seulement sur les paramÃ¨tres ;
- possibilitÃ© d\'appeler un article depuis son ID ;
- rÃ©sultats mis en cache ;'],
"18"=>['0318','- la rÃ©daction du script d\'appel d\'articles utilise le & comme sÃ©parateur de paramÃ¨tres au lieu ~
- la console propose un bloc modules \'lab\' qui sert pour les tests'],
"19"=>['0319','- rstr 64 : del blocks, n\'affiche pas le contenu des blocs en mode preview ;
- rÃ©vision des appels mysql, tout passe par la fonction sql() ;'],
"20"=>['0320','- amÃ©lioration du comportement du Batch, qui propose laccÃ¨s aux articles nouvellement importÃ©s ;
- plusieurs correctifs pour les pb rencontrÃ©s lors du traitement d\'une Url contenant des guillemets (eh oui) ;
- rÃ©vision du flux rss (appelÃ© comme plugin, il chargeait des scripts) ;
- les aides contextuelles prÃ©sentent systÃ©matiquement un lien vers msql pour les Ã©diter ;'],
"21"=>['0321','- l\'importateur ne tente plus d\'accÃ©der Ã  une page en l\'absence de dÃ©finitions, pour permettre l\'ajout de dÃ©finitions (+ une aide contextuelle) ;
- ajout de filtres au moteur de recherche : ex: \"mot1 mot2:tag mot3:thÃ¨me\" va renvoyer les rÃ©sultats commun aux 3 recherches, une littÃ©rale, une sur les tags, et une sur le tag utilisateur \'thÃ¨me\' ;'],
"22"=>['0322','- correctif pages ajax, support du champ temporel ;
- rÃ©vision du plugin \'book\' : pictos, images qui passaient pas, autoread ;'],
"23"=>['0323','- petits correctifs de prÃ©sentation des tableaux (en css), et du dÃ©filement des popup trop grandes (pas de scroll horizontal) ;
- fix pb affichage derniÃ¨re page dans \'book\' ;
- la table public_template n\'Ã©tait appelÃ©e par l\'update ;
- correctif dÃ©tection d\'url pour l\'importateur, capable de dÃ©tecter des variantes d\'url (rÃ©pertoires), qui doivent figurer avant dans la table pour Ãªtre prises en compte ;
- ajout du filtre \'titres\' dans le moteur de recherche (limite la recherche aux titres) ;'],
"24"=>['0324','- les routines du moteur de recherche sont logÃ©es dans un plugin (7Ko) ;
- un changement de protocole oblige Ã  reformuler certains modules de Apps qui utilisent des appels Ã  msql en ajax (se fier Ã  ceux par dÃ©faut) ;
- fix pb images dans book (pas testÃ©) ;
- fix liens cohÃ©rents entre pages ;
- l\'appel des pages active le module content en entier (pour pas voir les titres partir) ;'],
"25"=>['0325','- le paramÃ¨tre \'hide\' des scripts de modules n\'est plus ignorÃ© ;
- amÃ©lioration de la prÃ©sentation du mode \'flap\' du finder ;
- quelques icÃ´nes system ont Ã©tÃ© ajoutÃ©s ;'],
"26"=>['0326','- modification du fonctionnement de la rstr 60 \'artmod\' : n\'affiche pas les modules d\'articles mais affiche un bouton pour les joindre (comme dans les popups) ;
- amÃ©lioration du fonctionnement et de l\'apparence du systÃ¨me des commentaires (images qui dÃ©passent, rÃ©Ã©dition, css, aides) ;'],
"27"=>['0327','- ajout du connecteur :divtable, qui remplace les tables par dÃ©faut (sans connecteur) et qui renvoie un tableau en css ;
- ajout du connecteur :plup, permet d\'ouvrir un plugin dans une popup (en dev) ;
- le template book est intÃ©grÃ© aux templates par dÃ©faut, et tous ses styles sont dÃ©portÃ©s dans la table css par dÃ©faut (il faut \'append defaults\' pour les ajouter) ;'],
"28"=>['0327','- usage de javascript dans le Flap du Finder ;
- le moteur de recherche peut recevoir une ligne de commande d\'articles du style : priority=4~nbdays=30'],
"29"=>['0328','- ajout du connecteur :popvideo
- la navigation par pages en ajax prend en charge les appels de modules'],
"30"=>['0328','automatisation de la chaÃ®ne \'suggest\' : 
- la mention \'publiÃ© par\' est ajoutÃ©e Ã  l\'article importÃ©
- l\'entrÃ©e est marquÃ©e comme lue
- les doublons sont dÃ©tectÃ©s
- le visiteur accÃ¨de Ã  un rapport de publication de ses articles identifiÃ©s par son email, auxquels il peut accÃ©der
- un mail est envoyÃ© au visiteur pour l\'informer de la publication'],
"31"=>['0329','- petites amÃ©lioration de la compatibilitÃ© lorsqu\'on se contente d\'inverser les couleurs
- les classes de \'book\' passent dans la feuille globale
- fix pb de sauts de lignes dans les commentaires
- ajout d\'un systÃ¨me de surveillance de prÃ©sence de modules critiques, avec une alerte'],
"32"=>['0330','- petites amÃ©lioration du book : fix bad fix, css, espacements, affichage d\'une couverture en mode preview, largeur artificielle, dÃ©filement js, multi-affichages
- fix pb de quelques Ã©checs d\'enregistrement d\'article : autorÃ©activation, gestion de la temporalitÃ©
- le bouton \'Ã©pingler\' de la popup sert aussi Ã  la garder au premier plan'],
"33"=>['0331','- correctifs de la gÃ©nÃ©ration de largeur du constructeur css (content padding comptÃ© deux fois, et ignorer les divs inusitÃ©es dans le module \'blocks\')
- correctifs book : multi-fenÃªtres, pb de largeur due au scroll
- les icones des tags renvoient le rÃ©sultat dans une popup ;']];