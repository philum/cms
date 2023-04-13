<?php //msql/program_updates_1204
$r=["_menus_"=>['day','text'],
"1"=>['0401','on peut modifier la date d\'un article dans l\'Ã©diteur des meta'],
"2"=>['0404','tools/paste (Ã©dition) : permet de coller du code html Ã©ditable et de le convertir'],
"3"=>['0406','amÃ©lioration de l\'Ã©diteur :
- onglets (plus pratique pour l\'usage dans une popup)
- un champ wysiwyg
- lit/enregistre des documents dans le notepad'],
"4"=>['0409','l\'ajout d\'une microtable numÃ©rotÃ©e rempli les rangs vides avant d\'incrÃ©menter une valeur (1, 2, 4 existent, 3 est crÃ©Ã© avant 5) ; ceci est appliquÃ© en gÃ©nÃ©ral Ã  toutes les procÃ©dures d\'ajout de tables numÃ©rotÃ©es (css, post-it, etc...)'],
"5"=>['0412','dans le template d\'articles (restrictions) le bouton \'popen\' est comme \'open\' sauf que Ã§a ouvre l\'article dans une popup'],
"6"=>['0413','rÃ©vision de la routine \'dig\' (qui permet de creuser dans le temps) : rÃ©forme, unification, et ajout d\'une sous-routine qui dÃ©termine l\'utilitÃ© des champs (pour pas proposer une recherche sur huit ans sur un jeune hub)'],
"7"=>['0414','le backup des articles se rabat sur la version enregistrÃ©e (au lieu de celle en cours) quand la quantitÃ© est ingÃ©rable par ajax (8100 caractÃ¨res).'],
"8"=>['0414','- le module \'user_menus\' accepte la commande \'br\' pour choisir les sauts de lignes au lieu de ceux imposÃ©s ;
- correctif transactions ajax (choses non converties qui apparaissaient dans les champs des modules)'],
"9"=>['0420','- le module \'most_read\' profite d\'une nouvelle disposition qui permet au visiteur de choisir la valeur \'dig\' (creuser dans le temps), qui est l\'un des paramÃ¨tres de la configuration d\'un module.'],
"10"=>['0420','ajout du module \'short_arts\' : systÃ¨me de \"brÃ¨ves\", renvoie les articles dont le nombre de caractÃ¨res est infÃ©rieur Ã  celui qui est spÃ©cifiÃ© en paramÃ¨tre ;
- le module \'articles\' s\'enrichit (donc) de la commande \'lenght\''],
"11"=>['0420','la restriction \'ajax_menus\' n\'agit plus sur les menus, seulement sur l\'appel des articles, donc est renommÃ© \'ajax_mode\"'],
"12"=>['0421','amÃ©lioration du navigateur de pages ajax : navigation par approximation (affichage des nombres intermÃ©diaires, ce qui permet de trouver rapidement une page parmi un grande quantitÃ©, en pointant la moitiÃ©, puis la moitiÃ© de la moitiÃ©, etc...)'],
"13"=>['0421','- les modules \'see_also_tag\' et \'usertag\' renvoient les rÃ©sultats dans des onglets s\'il y en a plusieurs
- le module \'MenusJ\' se comporte comme les onglets pour ce qui est d\'activer le bouton courant (et dÃ©sactiver les autres) ;'],
"14"=>['0422','amÃ©lioration de l\'Ã©criture javascript sur les boutons de listes (onglets html et ajax)'],
"15"=>['0427','batch_system : rÃ©Ã©criture complÃ¨te :
propose d\'importer (en sÃ©rie ou individuellement) les articles des flux sÃ©lectionnÃ©s
- dont la date (quel que soit son format) est ultÃ©rieure Ã  la derniÃ¨re entrÃ©e ;
- dont l\'url est absente des articles prÃ©sents dans le cache ;
- dont le titre n\'est pas dÃ©jÃ  utilisÃ© ailleurs dans les articles en cache'],
"16"=>['0427','- correctif label des cases Ã  cocher ;
- restriction import-url : permet d\'avoir le champ d\'importation d \'article directement dans le panneau admin ;
- les sous-menus du panneau admin s\'affichent instantanÃ©ment ;'],
"17"=>['0429','amÃ©lioration de la prÃ©sentation des modules lors de l\'ajout : ils sont classÃ©s par catÃ©gorie et une aide les explique'],
"18"=>['0430','introduction du panneau d\'admin \'builders/tools\' (niveau 7 - superadmin) : permet d\'ajouter facilement des outils qui iront affecter les bases. Deux outils ont Ã©tÃ© ajoutÃ©s : 
- del-file : permet d\'effacer un fichier ou les fichiers d\'un rÃ©pertoire sur le serveur ;
- modif_usertags : pemret de transfÃ©rer un utag d\'un champ ) un autre ou de renommer des champs de tags utilisateur ;']];