<?php
//philum/microsql/program_lexical
$r["_menus_"]=['word','definition'];
$r[1]=['Channels','Module permettant de joindre un autre site philum distant, et d\'en obtenir un d�roul� d\'article correspondant � certaines r�gles de tris.'];
$r[2]=['Desktop','Le Desktop consiste � utiliser l\'espace comme le bureau d\'un syst�me d\'exploitation (web-OS), en posant le site dans une fen�tre, de fa�on � conserver � l\'�cran les autres popups ouvertes, pendant la confection du site.'];
$r[3]=['Finder','Le Finder est le gestionnaire de consultation et d\'organisation des fichiers de l\'espace disque utilisateur. 
Il permet de partager ses fichiers, de leur affecter une Url virtuelle, et de consulter les fichiers partag�s des autres Hubs ou bien d\'autres serveurs, qui se sont enregistr�s sur le serveur de r�f�rence, d�sign� par \'father_server\' (serveur Philum par d�faut).'];
$r[4]=['batch','Le batch process est un automate d\'aspiration d\'article. 
Il fonctionne sur plusieurs niveaux : 
- aspiration d\'un article ponctuel 
- enqu�te des plus r�centes entr�es sur les flux rss
- ajout d\'�l�ments � la liste du Batch
- enregistrement en s�rie des �l�ments du Batch.'];
$r[5]=['codeline','La technologie des connecteurs a �t� r�pliqu�e en miniature pour constituer les codeline (lignes de code) qui permettent de g�n�rer les balises html sp�cifiquement li�es � la mise en forme.
Le codeline est le langage des templates.
Les codeline sont accessibles de fa�on transparente depuis les connecteurs, et depuis le codeline on peut acc�der aux connecteur via le connecteur \':connector\'.'];
$r[6]=['codeline_basic','C\'est un premier degr�s d\'�volution des connecteurs, qui puisqu\'ils sont imbriqu�s, laissent entrevoir l\'id�e d\'un langage de programmation. 
C\'est le langage des connecteurs et modules personnalis�s.
Le r�sultat de chaque ligne de code est r�utilisable lors de la ligne suivante.
Le terme \'basic\' implique que c\'est un code ex�cutable qui n\'a pas besoin d\'utiliser des crochets.
Les lignes ressemblent � des commandes du type : _1:b:i:u (renvoie le contenu de la variable 1 en bold italic soulign�).
On peut appeler un code basic via le connecteur \':codeline\', qui d�cide si ce qu\'on lui envoie est du basic ou non, en fonction de la pr�sence de crochets.'];
$r[7]=['command_line','Les lignes de commande sont les scripts qui permettent de g�n�rer des modules. Fondamentalement ils fonctionnent comme des connecteurs, et ils sont accessible via le connecter \':module\'.
Il existe divers emplacements d\'o� on doit pouvoir appeler des modules, y compris certains modules eux-m�mes.
Une ligne de commande r�clame des variables ordonn�es, dont l\'emplacement signifie la fonction : 
param/title/command/coption/cacheable/br/template:modulename
On doit souvent sp�cifier comment afficher ce bouton : p/t:modulename�button ;
On peut sp�cifier une cible pour le rendu : p/t:mod->target�button ;'];
$r[8]=['connecteur','Le HTML est remplac� par des connecteurs, plus pratiques, propres, l�gers, contr�lables et �ditables.
Les crochets sont utilis�s pour activer des fonctions.'];
$r[9]=['console','Dans l\'Admin, la console offre une pr�sentation pagin�e des blocs de modules, et permet d\'agencer et de param�trer les modules.'];
$r[10]=['console url','Le Htaccess a �t� pens� de sorte � pouvoir utiliser la barre d\'adresse du navigateur comme une ligne de commande pour appeler des applications.
Dans la pratique c\'est une convention qui permet d\'obtenir des r�gles de tris de contenus �l�mentaires, telles que tag/, search/ ou d\'appeler par exemple \'plugin/chat\' ou \'module/Gallery\'.
Cela permettrait de faire du site un objet interrogeable par un autre serveur.
De cette mani�re les fonctions du logiciel sont mises � disposition du public, qui peut ainsi g�n�rer un contenu personnalis�.
Les sites Philum contiennent souvent des applications utiles au visiteur ind�pendamment de l\'int�r�t du site (les gens peuvent venir utiliser un �diteur de texte).'];
$r[11]=['export/import','Les transactions possibles entre les hubs consistent � recevoir une copie non �ditable d\'un contenu appartenant � un autre hub, autant qu\'� lui proposer la publication d\'un contenu non �ditable.
Le connecteur \':import\' garantit l\'acc�s � un contenu sans condition de privil�ge.'];
$r[12]=['filtres','une �norme quantit� de filtres assurent l\'homog�n�it� du contenu, les caract�res redondants sont fix�s en un seul, les balises redondantes sont �vinc�es, les sauts de ligne sont contr�l�s (/n dans la base de donn�e, br ou p dans le rendu).
Une petite quantit� de ces filtres sont utiles � �tre rendues disponibles pour l\'utilisateur.'];
$r[13]=['hub','Le Hub a eu besoin d\'�tre d�fini par l\'id�e qui consiste � recr�er toute une taxonomie de donn�es en n\'ayant eu � ne changer qu\'un seul param�tre au d�part. 
Par opposition au Blog qui est un terminal branch� sur processus.
Le Hub est lui-m�me un processus.
Chaque Hub acc�de � la totalit� des fonctions du logiciel.
Il peut recevoir des utilisateurs, de la m�me mani�re que l\'Admin d\'un Hub en est un.'];
$r[14]=['meta','Les Meta sont des clefs qui servent � cat�goriser l\'existant. Elles sont ext�rieures � l\'existant.
Ils sont utiliser pour relier les articles entre eux selon diff�rentes m�thodes. 
Il existe deux sortes de m�ta, les cat�gories et les tags : les cat�gories sont exclusives (une seule possible) et parmi les tag il est possible de cr�er n classes de tags (th�me, auteur, pays...).
Les Tags permettent de croiser les donn�es et de sauter d\'un classement � l\'autre via ces donn�es (de surfer � l\'int�rieur d\'un site).'];
$r[15]=['microsql','Philum utilise le gestionnaire classique MySql pour la pr�servation de ses contenus et �l�ments de gestion de contenu.
Le logiciel en lui-m�me est constitu� de couches allant du noyau aux parties �ditables par l\'utilisateur, et cette partie est stock�e par un gestionnaire nomm� \'microsql\'. Il est tr�s nettement sup�rieur en rapidit� lorsqu\'il s\'agit de donn�es inf�rieures � 1Mo. 
Un grand nombre de dispositions rendues disponibles � l\'utilisateur lui proposent d\'�diter des donn�es qui sont stock�es, et retrouvables dans l\'�diteur msql.'];
$r[16]=['microxml','Les donn�es organis�es msql peuvent �tre l\'objet de transaction de server � serveur. Dans ce cas elles sont transmises en Xml, en utilisant le protocole mocroxml, qui consiste � cr�er des balises du nom et du rang de la colonne et de la ligne du tableau de donn�es.'];
$r[17]=['modules','Les modules sont des objets logiciels, des Apis, qui peuvent �tre positionn�es en diff�rents endroits de la page, en fonction de divers contextes.
Le module principal, LOAD, renvoie un d�roul� d\'articles autant qu\'un article seul et complet quand on est en mode de lecture (read).
Un centaines de modules de complexit� tr�s vari�e permettent de produire � peu pr�s toutes sortes de donn�es ou de tris de donn�es. Tout ce qui est affich� sur la page est le r�sultat de modules, et chacun d\'entre eux appartient � un bloc de modules, qui signifie une balise \'div\' ayant  le nom de ce bloc comme ID.'];
$r[18]=['newsletter','Les diff�rents moyens de d�ploiement sont souvent appel�s \'newsletter\' parce que ce mot est plus pratique qu\'un hypoth�tique �quivalent fran�ais.
On peut envoyer 
- un article � 1 utilisateur ;
- un article � une liste de mails ;
- un agencement g�n�rique d\'articles � une liste d\'abonn�s � la \'newsleter\'.'];
$r[19]=['nodes','Les Hubs d\'un site appartiennent � une couche qui s\'exprime par un pr�fix du nom des bases de donn�es. L\'utilisateur d\'un nouveau n�ud obtient non seulement un hub vierge mais aussi une base de donn�es vierge. Ce sont des calques de hubs qui peuvent �tre superpos�s, de sorte � pr�senter un site web diff�rent � chaque nom de domaines.'];
$r[20]=['parent','Les contenus peuvent s\'associer de fa�on hi�rarchique � d\'autres contenus, d�sign�s comme \"parents\".
Cela g�n�re une taxonomie d\'articles, dont chaque n�ud est lui aussi un contenu, qui peut aussi bien �tre utilis� pour constituer un simple intitul� de classement.'];
$r[21]=['popup','Les anciennes fen�tres surgissantes, qui appelaient une fen�tre de navigateur, ayant disparues (par blocage syst�matique), le nom de \"popup\" revient donc aux fen�tres en ajax qui sont g�n�r�es par le logiciel et qui peuvent �tre d�plac�es, r�duites et ferm�es.'];
$r[22]=['priority','En mode publi�, un contenu peut recevoir 3 �tats suppl�mentaires, qui sont sign�s par 1, 2 ou 3 �toiles (*). 
Les moteurs de recherche per�oivent cette nuance par le niveau de priorit� de l\'article : 1, 5, 7 ou 10/10.'];
$r[23]=['restrictions','De nombreuses fonctionnalit�s ajout�es au cours du temps peuvent �tre emp�ch�es par des restrictions. 
Elles peuvent concerner les moyens d\'acc�der au contenu, la configuration du logiciel, ainsi que les nombreux �l�ments qui composent un article.'];
$r[24]=['templates','Le contenu g�n�r� reste sous forme de variables jusqu\'� l\'assemblage.
Les templates utilisent un langage sp�cifique (le codeline) mais peut tout aussi bien se contenter de balises html �crites en dur.
Les restrictions \'template\' permettent de jouer sur la pr�sence des variables pour ne pas avoir � jouer sur le template.
En effet l\'avantage du langage Codeline est de ne pas afficher de balises en l\'absence de contenu.
Certains templates peuvent aff�rer sp�cifiquement � la pr�sentation de bases de donn�es microsql, telles que les syst�mes de Polls (votes).'];
$r[25]=['tickets','Nom donn� au forum multi-utilisateurs situ� dans l\'admin, qui permet de discuter avec d\'autres utilisateurs et avec les d�veloppeurs du logiciel.'];
$r[26]=['tracks','Les commentaires associ�s � un contenu sont nomm�s Tracks (fil de discussion - \"ligne de chemin de fer\").'];
$r[27]=['update','Le cycle de d�veloppement est quotidien.
Les mises � jour se font automatiquement.'];

?>