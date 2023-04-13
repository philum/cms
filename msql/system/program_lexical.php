<?php //msql/program_lexical
$r=["_menus_"=>['word','definition'],
"1"=>['Channels','Module permettant de joindre un autre site philum distant, et d\'en obtenir un dÃ©roulÃ© d\'article correspondant Ã  certaines rÃ¨gles de tris.'],
"2"=>['Desktop','Le Desktop consiste Ã  utiliser l\'espace comme le bureau d\'un systÃ¨me d\'exploitation (web-OS), en posant le site dans une fenÃªtre, de faÃ§on Ã  conserver Ã  l\'Ã©cran les autres popups ouvertes, pendant la confection du site.'],
"3"=>['Finder','Le Finder est le gestionnaire de consultation et d\'organisation des fichiers de l\'espace disque utilisateur. 
Il permet de partager ses fichiers, de leur affecter une Url virtuelle, et de consulter les fichiers partagÃ©s des autres Hubs ou bien d\'autres serveurs, qui se sont enregistrÃ©s sur le serveur de rÃ©fÃ©rence, dÃ©signÃ© par \'father_server\' (serveur Philum par dÃ©faut).'],
"4"=>['batch','Le batch process est un automate d\'aspiration d\'article. 
Il fonctionne sur plusieurs niveaux : 
- aspiration d\'un article ponctuel 
- enquÃªte des plus rÃ©centes entrÃ©es sur les flux rss
- ajout d\'Ã©lÃ©ments Ã  la liste du Batch
- enregistrement en sÃ©rie des Ã©lÃ©ments du Batch.'],
"5"=>['codeline','La technologie des connecteurs a Ã©tÃ© rÃ©pliquÃ©e en miniature pour constituer les codeline (lignes de code) qui permettent de gÃ©nÃ©rer les balises html spÃ©cifiquement liÃ©es Ã  la mise en forme.
Le codeline est le langage des templates.
Les codeline sont accessibles de faÃ§on transparente depuis les connecteurs, et depuis le codeline on peut accÃ©der aux connecteur via le connecteur \':connector\'.'],
"6"=>['codeline_basic','C\'est un premier degrÃ¨s d\'Ã©volution des connecteurs, qui puisqu\'ils sont imbriquÃ©s, laissent entrevoir l\'idÃ©e d\'un langage de programmation. 
C\'est le langage des connecteurs et modules personnalisÃ©s.
Le rÃ©sultat de chaque ligne de code est rÃ©utilisable lors de la ligne suivante.
Le terme \'basic\' implique que c\'est un code exÃ©cutable qui n\'a pas besoin d\'utiliser des crochets.
Les lignes ressemblent Ã  des commandes du type : _1:b:i:u (renvoie le contenu de la variable 1 en bold italic soulignÃ©).
On peut appeler un code basic via le connecteur \':codeline\', qui dÃ©cide si ce qu\'on lui envoie est du basic ou non, en fonction de la prÃ©sence de crochets.'],
"7"=>['command_line','Les lignes de commande sont les scripts qui permettent de gÃ©nÃ©rer des modules. Fondamentalement ils fonctionnent comme des connecteurs, et ils sont accessible via le connecter \':module\'.
Il existe divers emplacements d\'oÃ¹ on doit pouvoir appeler des modules, y compris certains modules eux-mÃªmes.
Une ligne de commande rÃ©clame des variables ordonnÃ©es, dont l\'emplacement signifie la fonction : 
param/title/command/coption/cacheable/br/template:modulename
On doit souvent spÃ©cifier comment afficher ce bouton : p/t:modulenameÂ§button ;
On peut spÃ©cifier une cible pour le rendu : p/t:mod->targetÂ§button ;'],
"8"=>['connecteur','Le HTML est remplacÃ© par des connecteurs, plus pratiques, propres, lÃ©gers, contrÃ´lables et Ã©ditables.
Les crochets sont utilisÃ©s pour activer des fonctions.'],
"9"=>['console','Dans l\'Admin, la console offre une prÃ©sentation paginÃ©e des blocs de modules, et permet d\'agencer et de paramÃ©trer les modules.'],
"10"=>['console url','Le Htaccess a Ã©tÃ© pensÃ© de sorte Ã  pouvoir utiliser la barre d\'adresse du navigateur comme une ligne de commande pour appeler des applications.
Dans la pratique c\'est une convention qui permet d\'obtenir des rÃ¨gles de tris de contenus Ã©lÃ©mentaires, telles que tag/, search/ ou d\'appeler par exemple \'plugin/chat\' ou \'module/Gallery\'.
Cela permettrait de faire du site un objet interrogeable par un autre serveur.
De cette maniÃ¨re les fonctions du logiciel sont mises Ã  disposition du public, qui peut ainsi gÃ©nÃ©rer un contenu personnalisÃ©.
Les sites Philum contiennent souvent des applications utiles au visiteur indÃ©pendamment de l\'intÃ©rÃªt du site (les gens peuvent venir utiliser un Ã©diteur de texte).'],
"11"=>['export/import','Les transactions possibles entre les hubs consistent Ã  recevoir une copie non Ã©ditable d\'un contenu appartenant Ã  un autre hub, autant qu\'Ã  lui proposer la publication d\'un contenu non Ã©ditable.
Le connecteur \':import\' garantit l\'accÃ¨s Ã  un contenu sans condition de privilÃ¨ge.'],
"12"=>['filtres','une Ã©norme quantitÃ© de filtres assurent l\'homogÃ©nÃ©itÃ© du contenu, les caractÃ¨res redondants sont fixÃ©s en un seul, les balises redondantes sont Ã©vincÃ©es, les sauts de ligne sont contrÃ´lÃ©s (/n dans la base de donnÃ©e, br ou p dans le rendu).
Une petite quantitÃ© de ces filtres sont utiles Ã  Ãªtre rendues disponibles pour l\'utilisateur.'],
"13"=>['hub','Le Hub a eu besoin d\'Ãªtre dÃ©fini par l\'idÃ©e qui consiste Ã  recrÃ©er toute une taxonomie de donnÃ©es en n\'ayant eu Ã  ne changer qu\'un seul paramÃ¨tre au dÃ©part. 
Par opposition au Blog qui est un terminal branchÃ© sur processus.
Le Hub est lui-mÃªme un processus.
Chaque Hub accÃ¨de Ã  la totalitÃ© des fonctions du logiciel.
Il peut recevoir des utilisateurs, de la mÃªme maniÃ¨re que l\'Admin d\'un Hub en est un.'],
"14"=>['meta','Les Meta sont des clefs qui servent Ã  catÃ©goriser l\'existant. Elles sont extÃ©rieures Ã  l\'existant.
Ils sont utiliser pour relier les articles entre eux selon diffÃ©rentes mÃ©thodes. 
Il existe deux sortes de mÃ©ta, les catÃ©gories et les tags : les catÃ©gories sont exclusives (une seule possible) et parmi les tag il est possible de crÃ©er n classes de tags (thÃ¨me, auteur, pays...).
Les Tags permettent de croiser les donnÃ©es et de sauter d\'un classement Ã  l\'autre via ces donnÃ©es (de surfer Ã  l\'intÃ©rieur d\'un site).'],
"15"=>['microsql','Philum utilise le gestionnaire classique MySql pour la prÃ©servation de ses contenus et Ã©lÃ©ments de gestion de contenu.
Le logiciel en lui-mÃªme est constituÃ© de couches allant du noyau aux parties Ã©ditables par l\'utilisateur, et cette partie est stockÃ©e par un gestionnaire nommÃ© \'microsql\'. Il est trÃ¨s nettement supÃ©rieur en rapiditÃ© lorsqu\'il s\'agit de donnÃ©es infÃ©rieures Ã  1Mo. 
Un grand nombre de dispositions rendues disponibles Ã  l\'utilisateur lui proposent d\'Ã©diter des donnÃ©es qui sont stockÃ©es, et retrouvables dans l\'Ã©diteur msql.'],
"16"=>['microxml','Les donnÃ©es organisÃ©es msql peuvent Ãªtre l\'objet de transaction de server Ã  serveur. Dans ce cas elles sont transmises en Xml, en utilisant le protocole mocroxml, qui consiste Ã  crÃ©er des balises du nom et du rang de la colonne et de la ligne du tableau de donnÃ©es.'],
"17"=>['modules','Les modules sont des objets logiciels, des Apis, qui peuvent Ãªtre positionnÃ©es en diffÃ©rents endroits de la page, en fonction de divers contextes.
Le module principal, LOAD, renvoie un dÃ©roulÃ© d\'articles autant qu\'un article seul et complet quand on est en mode de lecture (read).
Un centaines de modules de complexitÃ© trÃ¨s variÃ©e permettent de produire Ã  peu prÃ¨s toutes sortes de donnÃ©es ou de tris de donnÃ©es. Tout ce qui est affichÃ© sur la page est le rÃ©sultat de modules, et chacun d\'entre eux appartient Ã  un bloc de modules, qui signifie une balise \'div\' ayant  le nom de ce bloc comme ID.'],
"18"=>['newsletter','Les diffÃ©rents moyens de dÃ©ploiement sont souvent appelÃ©s \'newsletter\' parce que ce mot est plus pratique qu\'un hypothÃ©tique Ã©quivalent franÃ§ais.
On peut envoyer 
- un article Ã  1 utilisateur ;
- un article Ã  une liste de mails ;
- un agencement gÃ©nÃ©rique d\'articles Ã  une liste d\'abonnÃ©s Ã  la \'newsleter\'.'],
"19"=>['nodes','Les Hubs d\'un site appartiennent Ã  une couche qui s\'exprime par un prÃ©fix du nom des bases de donnÃ©es. L\'utilisateur d\'un nouveau nÂud obtient non seulement un hub vierge mais aussi une base de donnÃ©es vierge. Ce sont des calques de hubs qui peuvent Ãªtre superposÃ©s, de sorte Ã  prÃ©senter un site web diffÃ©rent Ã  chaque nom de domaines.'],
"20"=>['parent','Les contenus peuvent s\'associer de faÃ§on hiÃ©rarchique Ã  d\'autres contenus, dÃ©signÃ©s comme \"parents\".
Cela gÃ©nÃ¨re une taxonomie d\'articles, dont chaque nÂud est lui aussi un contenu, qui peut aussi bien Ãªtre utilisÃ© pour constituer un simple intitulÃ© de classement.'],
"21"=>['popup','Les anciennes fenÃªtres surgissantes, qui appelaient une fenÃªtre de navigateur, ayant disparues (par blocage systÃ©matique), le nom de \"popup\" revient donc aux fenÃªtres en ajax qui sont gÃ©nÃ©rÃ©es par le logiciel et qui peuvent Ãªtre dÃ©placÃ©es, rÃ©duites et fermÃ©es.'],
"22"=>['priority','En mode publiÃ©, un contenu peut recevoir 3 Ã©tats supplÃ©mentaires, qui sont signÃ©s par 1, 2 ou 3 Ã©toiles (*). 
Les moteurs de recherche perÃ§oivent cette nuance par le niveau de prioritÃ© de l\'article : 1, 5, 7 ou 10/10.'],
"23"=>['restrictions','De nombreuses fonctionnalitÃ©s ajoutÃ©es au cours du temps peuvent Ãªtre empÃªchÃ©es par des restrictions. 
Elles peuvent concerner les moyens d\'accÃ©der au contenu, la configuration du logiciel, ainsi que les nombreux Ã©lÃ©ments qui composent un article.'],
"24"=>['templates','Le contenu gÃ©nÃ©rÃ© reste sous forme de variables jusqu\'Ã  l\'assemblage.
Les templates utilisent un langage spÃ©cifique (le codeline) mais peut tout aussi bien se contenter de balises html Ã©crites en dur.
Les restrictions \'template\' permettent de jouer sur la prÃ©sence des variables pour ne pas avoir Ã  jouer sur le template.
En effet l\'avantage du langage Codeline est de ne pas afficher de balises en l\'absence de contenu.
Certains templates peuvent affÃ©rer spÃ©cifiquement Ã  la prÃ©sentation de bases de donnÃ©es microsql, telles que les systÃ¨mes de Polls (votes).'],
"25"=>['tickets','Nom donnÃ© au forum multi-utilisateurs situÃ© dans l\'admin, qui permet de discuter avec d\'autres utilisateurs et avec les dÃ©veloppeurs du logiciel.'],
"26"=>['tracks','Les commentaires associÃ©s Ã  un contenu sont nommÃ©s Tracks (fil de discussion - \"ligne de chemin de fer\").'],
"27"=>['update','Le cycle de dÃ©veloppement est quotidien.
Les mises Ã  jour se font automatiquement.']];