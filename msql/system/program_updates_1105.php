<?php //msql/program_updates_1105
$r=["_menus_"=>['day','txt'],
"1"=>['110501','systÃ¨me de sauvegardes multiples d\'un article : ajout de l\'onglet \'backup\' (dans l\'Ã©dition d\'articles) qui propose \'backup\', \'restore\' et \'delete\', valable pour chacune des sauvegardes d\'un articles, qui sont d\'un nombre illimitÃ©.
Initiation d\'une nouvelle architecture pour dÃ©passer certains problÃ¨mes de ajax (impossibilitÃ© de modifier un document qu\'on a modifiÃ© !)'],
"2"=>['110501','amÃ©lioration du filtre automatique \'clean_punct\' (qui applique les rÃ¨gles typographiques) : dÃ©sormais capable d\'interprÃ©ter le texte pour rÃ©parer les guillemets prÃ©cÃ©dÃ©s et suivis d\'un espace (la rÃ¨gle c\'est pas d\'espaces Ã  l\'intÃ©rieur des guillemets)'],
"3"=>['110502','ajout du support des Font-faces : 
- sÃ©lection de 87 typos (.eot, .woff, .otf et mÃªme .ttf) qui soient web, gratuites et supportent les accents) ;
- ajout d\'un sÃ©lecteur avec prÃ©visualisation de typos dans css_builder ;
C\'est une rÃ©volution, le web ne sera plus jamais comme avant !'],
"4"=>['110502','ajout d\'un sÃ©lecteur rapide de balises css qui permette de s\'y habituer rapidement ;'],
"5"=>['110503','amÃ©lioration de fiabilitÃ© pour css_builder (sÃ©lection automatique des tables courantes quand on change de Hub) ; ajout d\'un menu de sÃ©lection des tables de modules'],
"6"=>['110503','sÃ©lection de 1200 typos libres de droits pour font-face, dans les 3 formats (web, explorer et mobiles)'],
"7"=>['110504','faire Ã©viter qu\'un tag sÃ©lectionnÃ© n\'envoie un rÃ©sultat alors qu\'on le dÃ©sÃ©ctionne Ã  la derniÃ¨re seconde...'],
"8"=>['110504','auto-dig_tags : s\'il n\'y a pas assez de tags pour le menus \'see_also_tags\' (le seul Ã  ne se rÃ©fÃ©rer qu\'Ã  la table du cache), la recherche s\'approfondit dans le temps jusqu\'aux 20 derniers articles'],
"9"=>['110504','retour Ã  la premiÃ¨re version de Filters (Ã©dition d\'articles) : le texte traitÃ© est toujours celui en mÃ©moire et il ne faut pas le modifier pour que Ã§a marche ; l\'autre version permettait de le modifier et de faire se succÃ©der les filtres, mais ajax ne prend pas en charge les documents longs ; pour Ã©viter la confusion, une seule rÃ¨gle est conservÃ©e'],
"10"=>['110504','rÃ©paration pour que l\'envoi par mail et le dÃ©ploiement d\'un article l\'envoie en entier'],
"11"=>['110504','rÃ©paration activation bouton de menu \'link\' pour les catÃ©gories'],
"12"=>['110504','variable $sbdm dans _connectx pour interdire les sous-domaines quand un site est appelÃ© par une Url propriÃ©taire'],
"13"=>['110504','sophistication du module see_also-tags et see_also-usertags pour qu\'il profite puisse produire des \'pubs\' (titre+img) ou des articles, incluant un template ponctuel'],
"14"=>['110504','connecteur \'form\' peut recevoir un \'button\' pour nommer le bouton d\'envoi'],
"15"=>['110504','ajout du support de nom de catÃ©gorie dans le module \'tag_arts\' et \'usertag_arts\' de sorte Ã ... obtenir les articles ayant pour tag le nom de la rubrique en cours.
Cela permet la gÃ©nÃ©ration de catÃ©gories floues !'],
"16"=>['110505','amÃ©lioration substantielle du sÃ©lecteur de typos : sÃ©lection par catÃ©gories, par famille, par accents et par favoris, affichage des tailles, toutes ces options Ã©tant commutatives'],
"17"=>['110505','ajout d\'une centaines de typos de la famille \'myfonts.com\''],
"18"=>['110506','crÃ©ation d\'une nouvelle base de donnÃ©es microsql \'server\' destinÃ©e Ã  concerner tous les hubs d\'un site sans pour autant Ãªtre affectÃ© par les mises Ã  jour (contrairement Ã  \'system\''],
"19"=>['110506','sophistication du fonctionnement des typos : elles sont rÃ©fÃ©rencÃ©es dans une table publique qui arrive dans \'system/edition_typos\', puis cette table doit Ãªtre copiÃ©e dans \'server/edition_typos\' depuis le nouvel onglet dans admin/builders/fonts ; passer par lÃ  permet d\'informer la table en fonction des polices prÃ©sentes sur le serveur et d\'alimenter la table avec des typos qui appartiennent seulement Ã  l\'utilisateur.'],
"20"=>['110507','prise en compte des vidÃ©o flv lors du transport d\'article entre deux sites philum ; correctif sur l\'import en passant par \'rss1\' : un nouvel indicateur d\'option de lecteure \'nlb\' (\'nl\' pour newsletter sert Ã  produire des url absolues) \'nlb\' fait la mÃªme chose mais spÃ©cifie que l\'article est en mode \'preview=full\' ;'],
"21"=>['110508','ajout d\'un sÃ©lecteur qui permet de choisir la condition Ã  affecter Ã  un nouveau module, afin d\'Ã©viter d\'avoir Ã  le faire aprÃ¨s coup, car la condition en cours n\'est pas forcÃ©ment celle Ã  laquelle on destine le nouveau module'],
"22"=>['110508','renommage des connecteurs :binvalues et :graph en msql_bin et msql_graph ; crÃ©ation d\'un gestionnaire pour sÃ©lectionner la base d\'aprÃ¨s des syntaxes qui peuvent Ãªtre confuses (le 4iÃ¨me Ã©lÃ©ment peut Ãªtre une ligne ou un indicateur) ; crÃ©ation des connecteurs :msql_html et :msql_count, le premier pour renvoyer un rendu html des connecteurs qui sont dans les donnÃ©es de la table, le second, juste pour renvoyer le nombre d\'objets de la table (trÃ¨s utile !)'],
"23"=>['110508','ajout d\'une distinction Ã©lÃ©mentaire permettant de considÃ©rer des signes < et > comme n\'Ã©tant pas les objets d\'une balise, au moment de l\'importation'],
"24"=>['110509','ajout d\'un champ de post-traitement des articles nommÃ© \'linenolink\' : \'del-link\' Ã©tait capable de suprimer un lien contenant des caractÃ¨res attendus, \'linenolink\' est capable de supprimer un lien inattendu en conservant le contenant Ã  un numÃ©ro de ligne connu. (les noms des auteurs d\'articles sont parfois liÃ©s Ã  une page sans aucun intÃ©rÃªt)'],
"25"=>['110509','ajout du support font-face qui permet d\'affecter la nouvelle dÃ©finition Ã  une classe css existante, plutÃ´t que d\'avoir Ã  aller ouvrir un panneau et y coller manuellement le nom de la typo'],
"26"=>['110510','abandon de la classe \'t\' (titres) lors de l\'importation au profit des h2, h3 (c\'est trÃ¨s important que la mise en forme soit confiÃ©e Ã  html et que les css ne servent qu\'Ã  la pagination)'],
"27"=>['110512','apparition de \'radio\', systÃ¨me de lecture audio par playliste administrÃ©e dans une base microsql :
- construction de la playliste d\'aprÃ¨s un rÃ©pertoire ;
- redimensionnable ;
- exportable ;
- algorithmes dÃ©ductifs ; 
- dÃ©filement auto ;
- support d\'information connexe Ã  chaque fichier audio (texte, images) ;
- ergonomique ;'],
"28"=>['110512','rÃ©troinjection de nouvelles avancÃ©es techniques dans \'jukebox\' : dÃ©filement auto amÃ©liorÃ© (fonction infinie), scroller remaniÃ© (puretÃ© de l\'Ã©criture)'],
"29"=>['110515','fonction array_flip_b qui fabrique les index (array_flip de php Ã©crase les index identiques) ;
function array_keys_r qui vide une colonne d\'un tableau multidimensionnel (array_keys de php ne prend pas en compte les tableaux multidimensionnels) ;
fonction commune (librairie) de recherche de table microsql ;'],
"30"=>['110516','ajout du connecteur \'ted.com\' dans l\'onglet \'medias\''],
"31"=>['110517','ajout de 400 typos, minutieusement classÃ©es'],
"32"=>['110518','amÃ©lioration de la gestion des typos : possibilitÃ© de les classer sur place et de crÃ©er des catÃ©gories, moteur de recherche, petites rÃ©parations'],
"33"=>['110519','intervention dans \'treat_links\' pour qu\'il soit capable (lors de l\'importation d\'article) de conserver le contenu d\'un lien de type javascript (oÃ¹ donc, rien n\'est Ã  prendre en compte)'],
"34"=>['110520','amÃ©lioration prÃ©sentation du menu admin ; apparition d\'un embryon de menu de gestion de l\'admin sur place pour accÃ©der rapidement aux fonctions courantes, comme la console, newsletter, restrictions, space_disk, hubs et css'],
"35"=>['110521','renommage des catÃ©gories des modules qui servent Ã  n\'afficher que celles qui sont compatibles avec le type de bloc de modules ; rÃ©affectation de certaines devenues entre temps capables d\'Ãªtre affichÃ©es Ã  d\'autres endroits'],
"36"=>['110522','le module \'best_arts\' est renommÃ© \'most_read\' (il faut mettre Ã  jour la console) ; \'most_read\' est plus puissant, capable de prendre en paramÃ¨tre le nombre de jours et le nombre d\'articles du rendu, et capable de les faire s\'assembler par le tronc logiciel central, avec les commandes habituelles (scroll, cols ou articles)'],
"37"=>['110523','rÃ©novation du connecteur \'rsstwitter\' qui est renommÃ© \'twitter\' : ne demande en paramÃ¨tre que le mot-clef au lieu du flux rss entier, et le flux est rafraÃ®chi toutes les 5 secondes ; 
- ajout du module \'twitter\' qui relaie le connecteur du mÃªme nom mais en laissant la possibilitÃ©  de rÃ©gler manuellement les paramÃ¨tres, la commande \'scroll\' et l\'option \'autorefresh\''],
"38"=>['110524','le module \'twitter\' Ã©tant dÃ©sormais capable de se rafraÃ®chir toutes les n secondes :
ajout du plug-in \'twitter\' qui ne fait que reprendre les fonctions existantes de 3 pages, de sortes Ã  n\'appeler que 9Ko Ã  chaque appel au lieu de 113Ko.
Sur notre serveur, le test a montrÃ© que le temps de chargement Ã©tait de 1/100 de seconde par tranche de 40Ko.'],
"39"=>['110524','ajout du connecteur html \'code\' (balise)'],
"40"=>['110524','amÃ©lioration du lecteur twitter : conformitÃ© des liens @ et # (hashtags), modification du template twitter ;'],
"41"=>['110524','admin/update offre dÃ©sormais aux utilisateurs de niveau 6 d\'Ãªtre tenu informÃ© des mises Ã  jour'],
"42"=>['110525','les nouveaux commentaires sont signalÃ©s Ã  l\'admin par mail'],
"43"=>['110525','les rÃ©dacteurs (niveau 3) ne peuvent plus modifier leur article une fois qu\'il a Ã©tÃ© publiÃ© par un utilisateur de niveau >4'],
"44"=>['110525','les rÃ©dacteurs reÃ§oivent par mail les commentaires Ã  leur article'],
"45"=>['110525','les rÃ©dacteurs reÃ§oivent un mail de confirmation quand leur article a Ã©tÃ© publiÃ© (qui dÃ©pend de la langue, Ã©ditable dans msql/lang/?/help_txts/published_art)'],
"46"=>['110525','remise Ã  niveau du bouton \'twitter\', qui permet de faire circuler un article (twitter ayant changÃ© son fonctionnement)'],
"47"=>['110526','possibilitÃ© d\'appeler des connecteurs :/n (oÃ¹ n est un nombre) en plus de :/2 et :/3 (largeur de colonne par rapport au bloc courant) ;
rÃ©novation de :2cols et :3cols (texte sur plusieurs colonnes) pour accepter les petits textes (sans sauts de lignes)
suppression des classes htab et htab 3 ;'],
"48"=>['110527','meilleure gestion des ancres non reconnues : prÃ©paration des donnÃ©es pour application du filtre \'auto_anchors\''],
"49"=>['110528','ajout du support de transport groupÃ© : les fichiers multiples sont stockÃ©s en .tar.gz et dÃ©compactÃ©s Ã  leur arrivÃ©e ;
dÃ©sormais le transport des typos par updates est disponibles (aux formats .woff, .oet et .svg)'],
"50"=>['110529','correctif d\'Ã©radication des apostrophes typographiques ;
gestion globale des systÃ¨mes de protection des caractÃ¨res joker de mysql (dont les apostrophes)'],
"51"=>['110529','empÃªcher l\'affichage des colonnes en mode preview'],
"52"=>['110530','- les transports de fichiers se font au format .gz : gain de fiabilitÃ© et de vitesse lors des mises Ã  jour ;
- la fonction \'update_all\' transporte les fichiers rÃ©cents au format GNU .tar.gz : la mise a jour du logiciel peut devenir entiÃ¨rement automatique'],
"53"=>['110531','mise Ã  niveau de lÂinstallateur avec les nouveaux protocoles de transport de donnÃ©es : l\'ensemble du logiciel se tÃ©lÃ©charge sur le serveur d\'une traite.'],
"54"=>['110531','amÃ©lioration des tickets : possibilitÃ© de rÃ©pondre Ã  un message']];