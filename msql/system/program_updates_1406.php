<?php //msql/program_updates_1406
$r=["_menus_"=>['date','text'],
"1"=>['0601','- le bouton \'tablet\' se rÃ©fÃ¨re au plug \'tablet\' et le statut est conservÃ© dans une session
- dispositifs :
-- yesno et yesnoses : switch Ã©tat d\'une var/sess
-- le param 4 de SaveJ peut recevoir le nom de la fonction oÃ¹ s\'applique le rÃ©sultat ajax
- rÃ©novation de \'favs\', le plugin est mieux intÃ©grÃ© (une table par iq)'],
"2"=>['0602','- renommage savething en msquery
- amÃ©liorations codeview, codev, dev'],
"3"=>['0603','- dans l\'Ã©diteur des Apps on peut sÃ©lectionner plusieurs sources de boutons par dÃ©faut'],
"4"=>['0604','rÃ©novation du systÃ¨me de stats 
- les tables eye et stats sont confisquÃ©es
- Ã©criture de nouvelles tables live et ips'],
"5"=>['0605','- renommages split_only, split_one, explode_k, implode_k, implode_r
- correctifs dÃ©tection dailymotion
- le nouveau systÃ¨me de stats dÃ©lÃ¨gue le plus possible de charge Ã  mysql (Ã©criture des requÃªtes)'],
"6"=>['0606','Ã©criture du nouveau plugin \'stats\'
- graphique en canvas, boutons en ajax'],
"7"=>['0607','- nouveaux outputs ajax : self, url, et exec, qui ouvrent bcp de possibilitÃ©s
- dans les apps les type link ouvrent l\'url en js ; ajout du process \'url\' dans les apps'],
"8"=>['0608','- amÃ©lioration du plugin ouvreur de plugins, en utilisant la mÃ©thode pop (rÃ©ouverture de la popup) plutÃ´t qu\'une div cible'],
"9"=>['0610','- sous android les popups sont en position absolue (pour pas Ãªtre masquÃ©es par le clavier)'],
"10"=>['0611','- coloniz() renvoie des colonnes redimensionnables
- scrollb() produit un scroller invisible sans avoir besoin d\'une largeur fixe'],
"11"=>['0612','- on peut rajouter des capteurs pour eye() dans le hangar ajax
- amÃ©lioration du rendu sur mobiles, combinÃ© avec le mode \'tablet\'
- ajout d\'une table pour les apps par dÃ©faut de l\'utilisateur (les autres Ã©tant devenues statiques et dÃ©sactivables)
-menu pictos dans l\'Ã©diteur d\'apps'],
"12"=>['0613','- refonte du mode multilingue: externalisation du constructeur sql pour qu\'il soit joignable par les diffÃ©rents points d\'entrÃ©e (play_arts, mod:article, nbarts)
- le mode multilingue allume un menu admin langues
- ajout d\'un ucom (ligne de commande d\'url)'],
"13"=>['0614','- mise en place du patch pour les tables de stats
- la gÃ©nÃ©ration du css par dÃ©faut \'classic\' gÃ©nÃ¨re aussi une feuille \'default\' sans les couleurs : c\'est elle qui est possible Ã  appeler dans system/design comme sous-couche css'],
"14"=>['0615','- nouveaux media query adaptÃ© au plein Ã©cran
- le z-index du menu admin peut passer par-dessus les popups
- le bouton \'update\' apparaÃ®t plutÃ´t sur chaque flux rss ; il permet de pomper immÃ©diatement tous les articles inconnus'],
"15"=>['0616','- le patch sql fonctionne de faÃ§on secure
- fix pb sous-couche css par dÃ©faut
'],
"16"=>['0617','- le plugin suggest reconnaÃ®t le mail du visiteur
- msq_where() renvoie une liste ou la derniÃ¨re valeur de la liste'],
"17"=>['0618','- url explicites : on peut appeler un article avec une partie de son titre : /read/portion de texte ; c\'est le plus rÃ©cent avec cette portion qui sera affichÃ©
- dans les stats, les pages vues s\'affichent dans une popup, qui renvoie deux autres, pour poursuivre les utilisateurs ayant vu une page, puis les pages vues par un utilisateur (rÃ©surrection des anciennes fonctions en mode moderne)
- (htaccess) /login affiche le module login'],
"18"=>['0619','- abandon du prms5 (ancien mÃ©canisme du design par dÃ©faut)
- les hubs apparaissent dans me menu sys'],
"19"=>['0620','- dans les stats, l\'iq prend la valeur de idu (id user) s\'il est connu'],
"20"=>['0623','le param 5 \'auto_design\' supplante le travail du module system \'design\' en plaÃ§ant un css construit d\'aprÃ¨s les couleurs locles et les derniÃ¨res dÃ©finitions du css _classic'],
"21"=>['0623','le module app_link rattrape le connecteur :apps et permet d\'afficher des apps dans les menus'],
"22"=>['0623','le module link accepte d\'appeler une apps : appsÂ§14:default'],
"23"=>['0624','auto_design : ajout d\'un dÃ©tecteur pour n\'agiter la moulinette qu\'Ã  chaque nouvelle version'],
"24"=>['0625','connecteurs plug et plup : [36Â§12:testÂ§[phi:picto]:plup] affiche un plugin dans une popup en y envoyant 2 paramÃ¨tres'],
"25"=>['0625','le dispositif negcss (menu system/utils/black) permet d\'inverser les couleurs du css en cours (mÃªme les css auto) ;
la rstr63 permet de dÃ©sactiver cette dÃ©tection : negcss compare les dates des fichiers css et recrÃ©e le negcss si besoin'],
"26"=>['0626','le module app_menu est destinÃ© Ã  remplacer \'user_menu\' : il produit une liste d\'apps prÃ©dÃ©finies ou permettant un paramÃ¨tre'],
"27"=>['0627','ajout du connecteur oldconn, qui rejoint retape() (conn obsolÃ¨tes) et suppression de delblocks (anciens connecteurs)'],
"28"=>['0627','- amÃ©lioration du fonctionnement de l\'admin msql quand on crÃ©e des tables
- app_menu peut recevoir en plus des modules, des plugs, des mods (switcher), des urls, et des noms de catÃ©gorie avec un espace'],
"29"=>['0628','amÃ©lioration du rss, dÃ©sormais joignable au /rss/hub'],
"30"=>['0630','la session cl est rendue sensible Ã  l\'Ã©tat _neg (css nÃ©gatifs)']];