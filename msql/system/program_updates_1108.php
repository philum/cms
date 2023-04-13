<?php //msql/program_updates_1108
$r=["_menus_"=>['day','txt'],
"1"=>['110803','rÃ©paration de admin/fonts qui met Ã  jour la base serveur des typos rÃ©ellement prÃ©sentes par rapport Ã  la base system des typos disponibles et aux fichiers dÃ©tectÃ©s dans /fonts'],
"2"=>['110803','ajout du support d\'update du rÃ©pertoire \'bkg\''],
"3"=>['110803','nouveau design par dÃ©faut, nÂ°8 dans les designs publiques'],
"4"=>['110804','ajout du support de crÃ©ation de nouveaux rÃ©pertoires commandÃ©s par l\'update'],
"5"=>['110806','crÃ©ation du plugin \'goog\' qui permet d\'afficher les rÃ©fÃ©rences d\'un flux rss google'],
"6"=>['110807','ajout des restrictions
- \'auto_parent\' : dÃ©finit si le nouvel article utilise celui en cours comme parent ;
- \'auto_publish\' : publie automatiquement un nouvel article ;'],
"7"=>['110809','amÃ©lioration du systÃ¨me de dÃ©tection d\'encodage des flux rss'],
"8"=>['110810','amÃ©lioration du systÃ¨me d\'adaptation aux diffÃ©rents types de dates des flux rss'],
"9"=>['110811','ajout de la restriction \'p_balise\' qui permet d\'utiliser des balises \'p\' Ã  la place du double saut de ligne'],
"10"=>['110811','ajout des filtres de nettoyage \'del_h\', \'del_i\', et \'del_qmark\' qui convertit les \'?\' en dÃ©but de ligne en \'-\' ;'],
"11"=>['110811','ajout d\'un rapport des questions frÃ©quentes (et utiles) dans admin/faq'],
"12"=>['110811','ajout d\'un rapport des questions frÃ©quentes (et utiles) dans admin/faq'],
"13"=>['110811','ajout d\'un rapport des questions frÃ©quentes (et utiles) dans admin/faq'],
"14"=>['110812','adaptation des css MenuH (menus hiÃ©rarchiques) au nouveau design par dÃ©faut'],
"15"=>['110812','correctif sur la gÃ©nÃ©ration de balises \'p\' quand \'p_balise\' est activÃ©'],
"16"=>['110812','la taille des miniatures du connecteur \':photo\' devient dÃ©pendant des paramÃ¨tres de taille des miniatures dans admin/params/27'],
"17"=>['110813','la taille des images gÃ©nÃ©rÃ©es est affichÃ©e dans le html, pour faire plaisir Ã  IE (on a Ã©tÃ© sympas)'],
"18"=>['110813','correctifs sur le mode p_balise (pour pas Ã©craser les simples sauts de lignes)'],
"19"=>['110813','systÃ¨me de commoditÃ© d\'ajout de connecteurs comportant un paramÃ¨tre'],
"20"=>['110813','le bouton connecteur :css propose les classes disponibles et l\'applique au texte sÃ©lectionnÃ©'],
"21"=>['110814','affichage des Tickets par pages'],
"22"=>['110814','ajout d\'une imbrication de requÃªte mysql pour amÃ©liorer le rÃ©sultat des tris multiples, quand une langue est sÃ©lectionnÃ©e (la vitesse reste Ã  amÃ©liorer) ;
le module \'articles\' devient capable de trier les langues'],
"23"=>['110815','petite rÃ©vision de l\'affichage des trackbacks, correctif affichage de l\'avatar et ajout de la classe \'track\''],
"24"=>['110815','la suppression d\'une classe css rÃ©ordonne les clefs'],
"25"=>['110816','connecteur \':codeline\' : affiche le rendu d\'un template en codeline : chaque ligne doit contenir une instruction sans les crochets au dÃ©but et Ã  la fin de la ligne. 
Ce fonctionnement particulier oblige le logiciel Ã  lire le contenu du connecteur en mode \'codeline\'.'],
"26"=>['110816','connecteur \':thumb\' : fabrique des miniatures avec des dimensions personnalisÃ©es : [img.jpgÂ§140/100:thumb]

:thumb est une instruction de Codeline (pour les templates), mais n\'Ã©tait pas disponible pour les connecteurs logiciels (articles)'],
"27"=>['110816','connecteur \':mini\' : fabrique des miniatures aux dimensions personnalisÃ©es (voir :thumb) et renvoie un lien vers une popup en ajax'],
"28"=>['110817','ajout d\'une option \'nb\' dans le module \'hubs\' pour afficher le nombre d\'articles de chaque hub'],
"29"=>['110817','petites rÃ©parations dans Slider pour le \'apply to all\' et la nomination des images'],
"30"=>['110818','connecteur \'sliderJ\' : galerie photo profitant de Slider (qui crÃ©e un rÃ©pertoire, des miniatures et permet d\'ajouter des commentaires mis en forme), mais en ajax au lieu de Flash.'],
"31"=>['110818','correctifs sur :photo2 :
- supporte les images de l\'EDU (espace disque utilisateur) ;
- premiÃ¨re image qui ne s\'affichait pas
- capacitÃ© d\'en mettre plusieurs sur une page ;
- timer (en chantier)'],
"32"=>['110819','finalisation de :sliderJ : 
- fonctionnement palpÃ© sur :photo2 (ajax)
- rÃ©vision de la mÃ©morisation de la position ;'],
"33"=>['110819','correctifs sur :photo2 et :photo :
- dÃ©filement en boucle
- supporte les sources hÃ©tÃ©rogÃ¨nes (EDU ou image d\'article)
- rÃ©vision de la compatibilitÃ© entre les 3 sortes de sources et les 3 sortes de rendus (9 combinaisons)'],
"34"=>['110820','sliderJ : 
- affiche les miniatures qui dÃ©filent quand on clique dessus si on ajoute \'Â§1\' : \'[tableÂ§1:sliderJ ]\'
- peut Ãªtre appelÃ© plusieurs fois'],
"35"=>['110820','images plein-Ã©cran : exit la popup, l\'image est redimensionnÃ©e Ã  la taille de la fenÃªtre, centrÃ©e, et le fond de page est obscurcit'],
"36"=>['110821','compatibilitÃ© interne de l\'importation d\'articles d\'un hub Ã  l\'autre avec p_balise'],
"37"=>['110821','newsletter : Ã©tendue du champ d\'action de la fabrication de liens absolus'],
"38"=>['110822','ajout d\'options dans master_config (niveau 7) :
- timezone : fixe le fuseau horaire (Europe/Paris) ;
- error_report : niveau du rapport d\'erreurs (en dev, NULL en prod) ;'],
"39"=>['110823','mise en conformitÃ© de l\'installer avec PHP 5.3 et ses prÃ©fÃ©rences :
- fichier .user.ini
- error_rporting Ã  E_STRICT
- permission 705'],
"40"=>['110823','les petits articles sont enregistrÃ©s en ajax'],
"41"=>['110824','la galerie ajax :photo2 dÃ©marre Ã  la premiÃ¨re image et non la deuxiÃ¨me ;
la galerie SliderJ est capable de gÃ©rer les liste d\'objets discontinus (quand une entrÃ©e a Ã©tÃ© effacÃ©e)'],
"42"=>['110825','correctif templates : espace indÃ©sirable qui provoquait des erreurs'],
"43"=>['110826','le module Taxonomy peut recevoir en option l\'Ã©tendue temporelle en nombre de jour (suite Ã  quoi les articles parents sont affichÃ©s en contexte)'],
"44"=>['110828','ajout du support de modules d\'article :
- module systÃ¨me \'art_mod\', oÃ¹ on spÃ©cifie la commande de modules, comme dans tab_mods (onglets html) ou MenusJ (appelÃ©s en ajax);
- en option la largeur par dÃ©faut est de 160, ce qui permet de redimensionner les contenus qui se trouvent ejectÃ©s par la colonne additionnelle ;
- template rÃ©visÃ© pour supporter la variable ARTMOD ;'],
"45"=>['110829','aujout du support de nomination des termes usuels utilisÃ©s par le logiciel :
- ajout la table lang/helps_nominations (31 intitulÃ©s) ;
- application de la sessions \'nms\'  (27 placements) ;
les nominations actuelles sont prÃ©liminaires.'],
"46"=>['110829','ajout de la restriction \'nb_arts\' qui interrompt l\'affichage du nombre d\'articles aprÃ¨s un titre ; celui-ci est nÃ©anmoins enclenchÃ© dans le cadre de la navigation temporelle (dont la recherche).'],
"47"=>['110830','petites amÃ©liorations dans les templates d\'article et de commentaire (classes Ã©ditables, dates relatives)'],
"48"=>['110831','admin/banner obtient un champ qui s\'informe d\'un chemin vers un dossier de l\'EDU (ex: \'images/ban\') ou de l\'ID d\'un article pour produire des miniatures et les proposer pour se faire Ã©lire \"banniÃ¨re\"'],
"49"=>['110831','la taille de l\'image de la banniÃ¨re s\'adapte Ã  la largeur indiquÃ©e dans le module system \'banner\''],
"50"=>['110831','nouveau logo nuque dÃ©gagÃ©e pour la rentrÃ©e']];