<?php
//philum_microsql_program_updates_1209
$program_updates_1209["_menus_"]=array('day','text');
$program_updates_1209[1]=array('0801','améliorations css global et classic, compatibilité et design avec des dégradés');
$program_updates_1209[2]=array('0802','la restriction 55 active les templates personnalisés, pour les titres de page et les commentaires ; ça permet d\'économiser des ressources quand ces fonctions ne sont pas utilisées');
$program_updates_1209[3]=array('0803','- résolution des problèmes d\'importation des e dans l\'o (&#339;)
- la plupart des menus ajax font désormais référence à la classe \'nb_pages\' qui est activable, plutôt qu\'aux classes indépendantes \'txtx\' et \'txtred\' : cela peut avoir un impact sur la mise en forme.');
$program_updates_1209[4]=array('0804','- function hexrgb (usage de transparences) ;
- le rafraîchissement css en cours d\'édition est plus rapide ;
- temporisation de la complétion auto ;
- qq pb ponctuels d\'interprétation des ascii résolus ;
- réhabilitation du multithread pour l\'utilitaire \'postit\', + normalisation des caractères spéciaux ;');
$program_updates_1209[5]=array('0805','- présentation en onglets de l\'admin de la newsletter ;
- la construction de miniatures est limitée aux objets de moins de 10000 pixels de haut (sinon ça bloque tout)');
$program_updates_1209[6]=array('0806','début des travaux sur le nouvel explorateur de fichiers, nommé finder\' :
- mise en place du protocole des options : 
//0=disk/shared
//1=local/global/distant
//2=virtual/real
//3=flap/icons/list
//4=dirs
//5=update');
$program_updates_1209[7]=array('0807','- uniformisation de toutes les fonctions de traitement des répertoires en une seule nommée \'explore()\', qui reçoit les options files/dirs et 1=non-récursif ;
- mise à jour de la table des plugins ;
- réparation consultation des répertoires depuis l\'extérieur (considère l\'image comme existante mais ne l\'est pas, donc il y avait un patch, mais il demandait à refabriquer les images à chaque fois : reçoit un paramètre qui évite la refabrication)');
$program_updates_1209[8]=array('0808','- petite réparation erreurs de sauvegarde dans l\'admin msql ;
- ajout de la table program_urls, répertorie les commandes url ;
- ajout de la table program_icons, déstinée à rendre protocolaire l\'usage de tables d\'icones ;
- ajout de 1036 icones de picol.com (16 et 32) ;');
$program_updates_1209[9]=array('0809','support Svg :
- ajout de 260 icônes svg (noun_project) ;
- ajout de 144 (sur 521) icônes svg (picol) ;
- ajout du connecteur \':svg\' qui reçoit le paramètre \'name§h/v\' ;
- adaptation du lecteur d\'icônes dans l\'éditeur ;
- centralisation des principaux icônes utilisés par le système ;
- admin/icons permet d\'éditer les icônes du système, et de choisir des formats img/svg à la place de la typo par défaut ;');
$program_updates_1209[10]=array('0810','- ajout d\'un bouton \'investigate\' dans le batch, permet de récolter (d\'une traite) les articles récents inexistants des sites sélectionnés ;
- une recherche booléenne a été ajoutée parmi les contrôleur de présence ;
- ajout d\'un bouton \'wyswyg\' à côté de l\'éditeur pour appeler rapidement un champ où coller un contenu déjà formaté ;
- (en passant devant) le rendu de la recherche booléenne évite d\'afficher plusieurs fois un paragraphe où une occurrence différente a été trouvée (elles sont compilées) ;');
$program_updates_1209[11]=array('0811','- réforme de l\'update pour que les dossiers volumineux soient compressés : les répertoires \'icons\' et \'bkg\' sont groupés dans un fichier .tar. Si un seul fichier change, l\'update installe tout le pack, c\'est pas grave, au moins comme ça il ne crash pas ;');
$program_updates_1209[12]=array('0812','- l\'application \'distribution\' est mise à niveau et un peu améliorée en rapidité ;
- mise à niveau \'publish_site\' et \'zip_prog\' (logiciels d\'éditeur d\'update) ;');
$program_updates_1209[13]=array('0813','- le visiteur publiant un commentaire peut le modifier à posteriori pendant une heure ;
- finale révision du constructeur de miniature, qui redimensionne l\'image à l\'intérieur ou à l\'extérieur de la zone définie ;');
$program_updates_1209[14]=array('0814','maintenant que le système d\'icônes est au point...
- avancée de l\'ergonomie du Finder : on a choisi la manière la plus simple de présenter une hiérarchie de répertoires ;
- le Finder est conçu pour permettre toutes les formes de présentation et toutes les sources de données, répertoires, tables, répertoires virtuels ;

Il remplacera de nombreuses dispositions hétérogènes dans le système : admin/disk, admin/share, les explorateurs d&#8217;icônes, de background, d\'avatars, et potentiellement des articles. Il pourra se connecter à des serveurs distants. 
C\'est le coeur de l\'OS (philum_Os) puisqu\'il permet enfin d\'ouvrir les fichiers avec leur lecteur dédié (pdf, flash, image, vidéo, audio, tables...)');
$program_updates_1209[15]=array('0815','- le détecteur de tags avait hérité d\'un petit défaut qui empêchait la détection dans quelques rares cas de figure (saut de ligne impromptu) ;');
$program_updates_1209[16]=array('0816','- Finder gère les tables');
$program_updates_1209[17]=array('0817','correctif affectation des largeurs dans css_admin (on se demande qui a écrit ça)');
$program_updates_1209[18]=array('0818','- le connecteur :link (utilisé pour les menus) peut recevoir un connecteur :icon en option : \'Home§home:icon\' (fonction Home, affiche home:icon) ;
- le terme \'usertag\' n\'apparaît plus, à la place c\'est le nom de la classe de tags qui apparaît dans l\'url (quand même beacoup plus joli) ;');
$program_updates_1209[19]=array('0819','Finder se dote des fonctions rename, delete, et share');
$program_updates_1209[20]=array('0820','Finder se dote des fonctions rename, delete, et new concernant les répertoires');
$program_updates_1209[21]=array('0821','Finder est incorporé au noyau, ce qui en fait un objet du système (lui épargne les dispositions propres aux plugins) ;
Finder est désormais opérationnel, dans sa phase primitive (admin/finder)');
$program_updates_1209[22]=array('0822','- un truc cool : on peut ouvrir plusieurs popups en même temps ; elles se comportent comme les fenêtres d\'une application ;
- les plugins \'disk\' et \'share\' sont rendus obsolètes (le plugin finder est supprimé) ;
- icône Finder dans le menu Admin ;');
$program_updates_1209[23]=array('0823','- Finder : le renommage affecte la table des fichiers partagés ;');
$program_updates_1209[24]=array('0824','- mise à jour des icônes système, + ajout d\'un dossier \'22\' dans \'everaldo\' ;
- Finder se dotes d\'icônes ;
- la consultation msql se fait dans une popup ;
- le menu admin msql renvoie vers l\'éditeur dans une popup plutôt que admin/msql ;
- le master admin accède à l\'ensemble des répertoires dans Finder ;
- dans la console, l\'édition d\'un module n\'ouvre pas une popup supplémentaire (conflits) ;');
$program_updates_1209[25]=array('0825','- Finder : ajout de la fonction \'dowlnoad\' ;
amélioration de l\'upload de sorte à ne pas avoir à relancer la page ;
- les fenêtres réduites s\'empilent à gauche ;');
$program_updates_1209[26]=array('0826','- amélioration du copier-coller, afin d\'être utilisé par \'notepad\' ;
- l\'éditeur msql autorise l\'édition de plusieurs entrées simultanément (permit par le multifenêtrage) ;
- le nouveau upload est appliqué à l\'édition des articles, ce qui permet l\'upload en série ;');
$program_updates_1209[27]=array('0827','- ajout du menu admin \'Apps\' : l\'utilisateur peut ajouter des actions dans le menu système \'apps\' (anciennement \'sysmenu\'). On peut appeler des modules (page), des plugins (popup) et des tables msql.
');
$program_updates_1209[28]=array('0828','mise en fonctionnement de partage distant :
- on peut consulter (récupérer la taille, date, largeurs) et downloader les fichiers d\'un autre serveur (à 80 Mo/s).
- microsql mit en conformité ;
- on peut s\'inscrire comme Hub du réseau ;

- le truc qui bloquait les mises à jour depuis 1 semaine a été déniché ;');
$program_updates_1209[29]=array('0829','correctifs de confort et de sécurité dans Finder :
- dossier virtuel dispo après partage
- interdire renommages hors du hub
- réaffectation du chemin en cours quand on passe en mode miniatures
- affichage du gestionnaire de dossier à la racine
- affichage de la racine en mode partage
- correction erreur de reconstruction superflue de miniature
- contrôle de validité du renommage
- système basique de permissions pour l\'ouverture au visiteur (\'download\' ne signifie plus sur le serveur mais vers l\'utilisateur)

- ajout du module \'finder\', permet d\'appeler et proposer le finder aux visiteurs : param = chemin et option = configuration (7 params) ;
- suppression du module \'share\' et on laisse l\'ancien \'disk\' qui n\'appelle aucune ressource ;');
$program_updates_1209[30]=array('0830','introduction du Desktop : 
- activation dans le menu admin \'actions\' ;
- permet d\'éditer le site depuis un bureau où les fenêtres ouvertes restent statiques, l\'ensemble du site étant dans une iframe ;

- iconographie du Finder utilise Picol ;
- mise à jour des icones de Picol');

?>