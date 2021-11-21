<?php
//philum_microsql_program_lexical
$program_lexical["_menus_"]=array('word','definition');
$program_lexical[1]=array('Channels','Module permettant de joindre un autre site philum distant, et d\'en obtenir un déroulé d\'article correspondant à certaines règles de tris.');
$program_lexical[2]=array('Desktop','Le Desktop consiste à utiliser l\'espace comme le bureau d\'un système d\'exploitation (web-OS), en posant le site dans une fenêtre, de façon à conserver à l\'écran les autres popups ouvertes, pendant la confection du site.');
$program_lexical[3]=array('Finder','Le Finder est le gestionnaire de consultation et d\'organisation des fichiers de l\'espace disque utilisateur. 
Il permet de partager ses fichiers, de leur affecter une Url virtuelle, et de consulter les fichiers partagés des autres Hubs ou bien d\'autres serveurs, qui se sont enregistrés sur le serveur de référence, désigné par \'father_server\' (serveur Philum par défaut).');
$program_lexical[4]=array('batch','Le batch process est un automate d\'aspiration d\'article. 
Il fonctionne sur plusieurs niveaux : 
- aspiration d\'un article ponctuel 
- enquête des plus récentes entrées sur les flux rss
- ajout d\'éléments à la liste du Batch
- enregistrement en série des éléments du Batch.');
$program_lexical[5]=array('codeline','La technologie des connecteurs a été répliquée en miniature pour constituer les codeline (lignes de code) qui permettent de générer les balises html spécifiquement liées à la mise en forme.
Le codeline est le langage des templates.
Les codeline sont accessibles de façon transparente depuis les connecteurs, et depuis le codeline on peut accéder aux connecteur via le connecteur \':connector\'.');
$program_lexical[6]=array('codeline_basic','C\'est un premier degrès d\'évolution des connecteurs, qui puisqu\'ils sont imbriqués, laissent entrevoir l\'idée d\'un langage de programmation. 
C\'est le langage des connecteurs et modules personnalisés.
Le résultat de chaque ligne de code est réutilisable lors de la ligne suivante.
Le terme \'basic\' implique que c\'est un code exécutable qui n\'a pas besoin d\'utiliser des crochets.
Les lignes ressemblent à des commandes du type : _1:b:i:u (renvoie le contenu de la variable 1 en bold italic souligné).
On peut appeler un code basic via le connecteur \':codeline\', qui décide si ce qu\'on lui envoie est du basic ou non, en fonction de la présence de crochets.');
$program_lexical[7]=array('command_line','Les lignes de commande sont les scripts qui permettent de générer des modules. Fondamentalement ils fonctionnent comme des connecteurs, et ils sont accessible via le connecter \':module\'.
Il existe divers emplacements d\'où on doit pouvoir appeler des modules, y compris certains modules eux-mêmes.
Une ligne de commande réclame des variables ordonnées, dont l\'emplacement signifie la fonction : 
param/title/command/coption/cacheable/br/template:modulename
On doit souvent spécifier comment afficher ce bouton : p/t:modulename§button ;
On peut spécifier une cible pour le rendu : p/t:mod->target§button ;');
$program_lexical[8]=array('connecteur','Le HTML est remplacé par des connecteurs, plus pratiques, propres, légers, contrôlables et éditables.
Les crochets sont utilisés pour activer des fonctions.');
$program_lexical[9]=array('console','Dans l\'Admin, la console offre une présentation paginée des blocs de modules, et permet d\'agencer et de paramétrer les modules.');
$program_lexical[10]=array('console url','Le Htaccess a été pensé de sorte à pouvoir utiliser la barre d\'adresse du navigateur comme une ligne de commande pour appeler des applications.
Dans la pratique c\'est une convention qui permet d\'obtenir des règles de tris de contenus élémentaires, telles que tag/, search/ ou d\'appeler par exemple \'plugin/chat\' ou \'module/Gallery\'.
Cela permettrait de faire du site un objet interrogeable par un autre serveur.
De cette manière les fonctions du logiciel sont mises à disposition du public, qui peut ainsi générer un contenu personnalisé.
Les sites Philum contiennent souvent des applications utiles au visiteur indépendamment de l\'intérêt du site (les gens peuvent venir utiliser un éditeur de texte).');
$program_lexical[11]=array('export/import','Les transactions possibles entre les hubs consistent à recevoir une copie non éditable d\'un contenu appartenant à un autre hub, autant qu\'à lui proposer la publication d\'un contenu non éditable.
Le connecteur \':import\' garantit l\'accès à un contenu sans condition de privilège.');
$program_lexical[12]=array('filtres','une énorme quantité de filtres assurent l\'homogénéité du contenu, les caractères redondants sont fixés en un seul, les balises redondantes sont évincées, les sauts de ligne sont contrôlés (/n dans la base de donnée, br ou p dans le rendu).
Une petite quantité de ces filtres sont utiles à être rendues disponibles pour l\'utilisateur.');
$program_lexical[13]=array('hub','Le Hub a eu besoin d\'être défini par l\'idée qui consiste à recréer toute une taxonomie de données en n\'ayant eu à ne changer qu\'un seul paramètre au départ. 
Par opposition au Blog qui est un terminal branché sur processus.
Le Hub est lui-même un processus.
Chaque Hub accède à la totalité des fonctions du logiciel.
Il peut recevoir des utilisateurs, de la même manière que l\'Admin d\'un Hub en est un.');
$program_lexical[14]=array('meta','Les Meta sont des clefs qui servent à catégoriser l\'existant. Elles sont extérieures à l\'existant.
Ils sont utiliser pour relier les articles entre eux selon différentes méthodes. 
Il existe deux sortes de méta, les catégories et les tags : les catégories sont exclusives (une seule possible) et parmi les tag il est possible de créer n classes de tags (thème, auteur, pays...).
Les Tags permettent de croiser les données et de sauter d\'un classement à l\'autre via ces données (de surfer à l\'intérieur d\'un site).');
$program_lexical[15]=array('microsql','Philum utilise le gestionnaire classique MySql pour la préservation de ses contenus et éléments de gestion de contenu.
Le logiciel en lui-même est constitué de couches allant du noyau aux parties éditables par l\'utilisateur, et cette partie est stockée par un gestionnaire nommé \'microsql\'. Il est très nettement supérieur en rapidité lorsqu\'il s\'agit de données inférieures à 1Mo. 
Un grand nombre de dispositions rendues disponibles à l\'utilisateur lui proposent d\'éditer des données qui sont stockées, et retrouvables dans l\'éditeur msql.');
$program_lexical[16]=array('microxml','Les données organisées msql peuvent être l\'objet de transaction de server à serveur. Dans ce cas elles sont transmises en Xml, en utilisant le protocole mocroxml, qui consiste à créer des balises du nom et du rang de la colonne et de la ligne du tableau de données.');
$program_lexical[17]=array('modules','Les modules sont des objets logiciels, des Apis, qui peuvent être positionnées en différents endroits de la page, en fonction de divers contextes.
Le module principal, LOAD, renvoie un déroulé d\'articles autant qu\'un article seul et complet quand on est en mode de lecture (read).
Un centaines de modules de complexité très variée permettent de produire à peu près toutes sortes de données ou de tris de données. Tout ce qui est affiché sur la page est le résultat de modules, et chacun d\'entre eux appartient à un bloc de modules, qui signifie une balise \'div\' ayant  le nom de ce bloc comme ID.');
$program_lexical[18]=array('newsletter','Les différents moyens de déploiement sont souvent appelés \'newsletter\' parce que ce mot est plus pratique qu\'un hypothétique équivalent français.
On peut envoyer 
- un article à 1 utilisateur ;
- un article à une liste de mails ;
- un agencement générique d\'articles à une liste d\'abonnés à la \'newsleter\'.');
$program_lexical[19]=array('nodes','Les Hubs d\'un site appartiennent à une couche qui s\'exprime par un préfix du nom des bases de données. L\'utilisateur d\'un nouveau nœud obtient non seulement un hub vierge mais aussi une base de données vierge. Ce sont des calques de hubs qui peuvent être superposés, de sorte à présenter un site web différent à chaque nom de domaines.');
$program_lexical[20]=array('parent','Les contenus peuvent s\'associer de façon hiérarchique à d\'autres contenus, désignés comme \"parents\".
Cela génère une taxonomie d\'articles, dont chaque nœud est lui aussi un contenu, qui peut aussi bien être utilisé pour constituer un simple intitulé de classement.');
$program_lexical[21]=array('popup','Les anciennes fenêtres surgissantes, qui appelaient une fenêtre de navigateur, ayant disparues (par blocage systématique), le nom de \"popup\" revient donc aux fenêtres en ajax qui sont générées par le logiciel et qui peuvent être déplacées, réduites et fermées.');
$program_lexical[22]=array('priority','En mode publié, un contenu peut recevoir 3 états supplémentaires, qui sont signés par 1, 2 ou 3 étoiles (*). 
Les moteurs de recherche perçoivent cette nuance par le niveau de priorité de l\'article : 1, 5, 7 ou 10/10.');
$program_lexical[23]=array('restrictions','De nombreuses fonctionnalités ajoutées au cours du temps peuvent être empêchées par des restrictions. 
Elles peuvent concerner les moyens d\'accéder au contenu, la configuration du logiciel, ainsi que les nombreux éléments qui composent un article.');
$program_lexical[24]=array('templates','Le contenu généré reste sous forme de variables jusqu\'à l\'assemblage où est procédée la mise en forme.
Les templates utilisent un langage spécifique (le codeline) mais peut tout aussi bien se contenter de balises html écrites en dur.
Pour les articles, les restrictions permettent de jouer sur la présence des variables pour ne pas avoir à jouer sur le template.
En effet le Codeline permet de ne pas afficher de balises en l\'absence de contenu.
Certains templates peuvent afférer spécifiquement à la présentation de bases de données microsql, telles que les systèmes de Polls (votes).');
$program_lexical[25]=array('tickets','Nom donné au forum multi-utilisateurs situé dans l\'admin, qui permet de discuter avec d\'autres utilisateurs et avec les développeurs du logiciel.');
$program_lexical[26]=array('tracks','Les commentaires associés à un contenu sont nommés Tracks (fil de discussion - \"ligne de chemin de fer\").');
$program_lexical[27]=array('update','Le logiciel est régulièrement mis à jour. 
Autant que possible il n\'y a qu\'un bouton à appeler pour obtenir la dernière version du logiciel.');

?>