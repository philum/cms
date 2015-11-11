<?php
//philum_microsql_program_updates_1108
$r["_menus_"]=array('day','txt');
$r[1]=array('110803','réparation de admin/fonts qui met à jour la base serveur des typos réellement présentes par rapport à la base system des typos disponibles et aux fichiers détectés dans /fonts');
$r[2]=array('110803','ajout du support d\'update du répertoire \'bkg\'');
$r[3]=array('110803','nouveau design par défaut, n°8 dans les designs publiques');
$r[4]=array('110804','ajout du support de création de nouveaux répertoires commandés par l\'update');
$r[5]=array('110806','création du plugin \'goog\' qui permet d\'afficher les références d\'un flux rss google');
$r[6]=array('110807','ajout des restrictions
- \'auto_parent\' : définit si le nouvel article utilise celui en cours comme parent ;
- \'auto_publish\' : publie automatiquement un nouvel article ;');
$r[7]=array('110809','amélioration du système de détection d\'encodage des flux rss');
$r[8]=array('110810','amélioration du système d\'adaptation aux différents types de dates des flux rss');
$r[9]=array('110811','ajout de la restriction \'p_balise\' qui permet d\'utiliser des balises \'p\' à la place du double saut de ligne');
$r[10]=array('110811','ajout des filtres de nettoyage \'del_h\', \'del_i\', et \'del_qmark\' qui convertit les \'?\' en début de ligne en \'-\' ;');
$r[11]=array('110811','ajout d\'un rapport des questions fréquentes (et utiles) dans admin/faq');
$r[12]=array('110811','ajout d\'un rapport des questions fréquentes (et utiles) dans admin/faq');
$r[13]=array('110811','ajout d\'un rapport des questions fréquentes (et utiles) dans admin/faq');
$r[14]=array('110812','adaptation des css MenuH (menus hiérarchiques) au nouveau design par défaut');
$r[15]=array('110812','correctif sur la génération de balises \'p\' quand \'p_balise\' est activé');
$r[16]=array('110812','la taille des miniatures du connecteur \':photo\' devient dépendant des paramètres de taille des miniatures dans admin/params/27');
$r[17]=array('110813','la taille des images générées est affichée dans le html, pour faire plaisir à IE (on a été sympas)');
$r[18]=array('110813','correctifs sur le mode p_balise (pour pas écraser les simples sauts de lignes)');
$r[19]=array('110813','système de commodité d\'ajout de connecteurs comportant un paramètre');
$r[20]=array('110813','le bouton connecteur :css propose les classes disponibles et l\'applique au texte sélectionné');
$r[21]=array('110814','affichage des Tickets par pages');
$r[22]=array('110814','ajout d\'une imbrication de requête mysql pour améliorer le résultat des tris multiples, quand une langue est sélectionnée (la vitesse reste à améliorer) ;
le module \'articles\' devient capable de trier les langues');
$r[23]=array('110815','petite révision de l\'affichage des trackbacks, correctif affichage de l\'avatar et ajout de la classe \'track\'');
$r[24]=array('110815','la suppression d\'une classe css réordonne les clefs');
$r[25]=array('110816','connecteur \':codeline\' : affiche le rendu d\'un template en codeline : chaque ligne doit contenir une instruction sans les crochets au début et à la fin de la ligne. 
Ce fonctionnement particulier oblige le logiciel à lire le contenu du connecteur en mode \'codeline\'.');
$r[26]=array('110816','connecteur \':thumb\' : fabrique des miniatures avec des dimensions personnalisées : [img.jpg§140/100:thumb]

:thumb est une instruction de Codeline (pour les templates), mais n\'était pas disponible pour les connecteurs logiciels (articles)');
$r[27]=array('110816','connecteur \':mini\' : fabrique des miniatures aux dimensions personnalisées (voir :thumb) et renvoie un lien vers une popup en ajax');
$r[28]=array('110817','ajout d\'une option \'nb\' dans le module \'hubs\' pour afficher le nombre d\'articles de chaque hub');
$r[29]=array('110817','petites réparations dans Slider pour le \'apply to all\' et la nomination des images');
$r[30]=array('110818','connecteur \'sliderJ\' : galerie photo profitant de Slider (qui crée un répertoire, des miniatures et permet d\'ajouter des commentaires mis en forme), mais en ajax au lieu de Flash.');
$r[31]=array('110818','correctifs sur :photo2 :
- supporte les images de l\'EDU (espace disque utilisateur) ;
- première image qui ne s\'affichait pas
- capacité d\'en mettre plusieurs sur une page ;
- timer (en chantier)');
$r[32]=array('110819','finalisation de :sliderJ : 
- fonctionnement palpé sur :photo2 (ajax)
- révision de la mémorisation de la position ;');
$r[33]=array('110819','correctifs sur :photo2 et :photo :
- défilement en boucle
- supporte les sources hétérogènes (EDU ou image d\'article)
- révision de la compatibilité entre les 3 sortes de sources et les 3 sortes de rendus (9 combinaisons)');
$r[34]=array('110820','sliderJ : 
- affiche les miniatures qui défilent quand on clique dessus si on ajoute \'§1\' : \'[table§1:sliderJ ]\'
- peut être appelé plusieurs fois');
$r[35]=array('110820','images plein-écran : exit la popup, l\'image est redimensionnée à la taille de la fenêtre, centrée, et le fond de page est obscurcit');
$r[36]=array('110821','compatibilité interne de l\'importation d\'articles d\'un hub à l\'autre avec p_balise');
$r[37]=array('110821','newsletter : étendue du champ d\'action de la fabrication de liens absolus');
$r[38]=array('110822','ajout d\'options dans master_config (niveau 7) :
- timezone : fixe le fuseau horaire (Europe/Paris) ;
- error_report : niveau du rapport d\'erreurs (en dev, NULL en prod) ;');
$r[39]=array('110823','mise en conformité de l\'installer avec PHP 5.3 et ses préférences :
- fichier .user.ini
- error_rporting à E_STRICT
- permission 705');
$r[40]=array('110823','les petits articles sont enregistrés en ajax');
$r[41]=array('110824','la galerie ajax :photo2 démarre à la première image et non la deuxième ;
la galerie SliderJ est capable de gérer les liste d\'objets discontinus (quand une entrée a été effacée)');
$r[42]=array('110825','correctif templates : espace indésirable qui provoquait des erreurs');
$r[43]=array('110826','le module Taxonomy peut recevoir en option l\'étendue temporelle en nombre de jour (suite à quoi les articles parents sont affichés en contexte)');
$r[44]=array('110828','ajout du support de modules d\'article :
- module système \'art_mod\', où on spécifie la commande de modules, comme dans tab_mods (onglets html) ou MenusJ (appelés en ajax);
- en option la largeur par défaut est de 160, ce qui permet de redimensionner les contenus qui se trouvent ejectés par la colonne additionnelle ;
- template révisé pour supporter la variable ARTMOD ;');
$r[45]=array('110829','aujout du support de nomination des termes usuels utilisés par le logiciel :
- ajout la table lang/helps_nominations (31 intitulés) ;
- application de la sessions \'nms\'  (27 placements) ;
les nominations actuelles sont préliminaires.');
$r[46]=array('110829','ajout de la restriction \'nb_arts\' qui interrompt l\'affichage du nombre d\'articles après un titre ; celui-ci est néanmoins enclenché dans le cadre de la navigation temporelle (dont la recherche).');
$r[47]=array('110830','petites améliorations dans les templates d\'article et de commentaire (classes éditables, dates relatives)');
$r[48]=array('110831','admin/banner obtient un champ qui s\'informe d\'un chemin vers un dossier de l\'EDU (ex: \'images/ban\') ou de l\'ID d\'un article pour produire des miniatures et les proposer pour se faire élire \"bannière\"');
$r[49]=array('110831','la taille de l\'image de la bannière s\'adapte à la largeur indiquée dans le module system \'banner\'');
$r[50]=array('110831','nouveau logo nuque dégagée pour la rentrée');

?>