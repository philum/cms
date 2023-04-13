<?php //msql/program_updates_1209
$r=["_menus_"=>['day','text'],
"1"=>['0801','amÃ©liorations css global et classic, compatibilitÃ© et design avec des dÃ©gradÃ©s'],
"2"=>['0802','la restriction 55 active les templates personnalisÃ©s, pour les titres de page et les commentaires ; Ã§a permet d\'Ã©conomiser des ressources quand ces fonctions ne sont pas utilisÃ©es'],
"3"=>['0803','- rÃ©solution des problÃ¨mes d\'importation des e dans l\'o (&#339;)
- la plupart des menus ajax font dÃ©sormais rÃ©fÃ©rence Ã  la classe \'nb_pages\' qui est activable, plutÃ´t qu\'aux classes indÃ©pendantes \'txtx\' et \'txtred\' : cela peut avoir un impact sur la mise en forme.'],
"4"=>['0804','- function hexrgb (usage de transparences) ;
- le rafraÃ®chissement css en cours d\'Ã©dition est plus rapide ;
- temporisation de la complÃ©tion auto ;
- qq pb ponctuels d\'interprÃ©tation des ascii rÃ©solus ;
- rÃ©habilitation du multithread pour l\'utilitaire \'postit\', + normalisation des caractÃ¨res spÃ©ciaux ;'],
"5"=>['0805','- prÃ©sentation en onglets de l\'admin de la newsletter ;
- la construction de miniatures est limitÃ©e aux objets de moins de 10000 pixels de haut (sinon Ã§a bloque tout)'],
"6"=>['0806','dÃ©but des travaux sur le nouvel explorateur de fichiers, nommÃ© finder\' :
- mise en place du protocole des options : 
//0=disk/shared
//1=local/global/distant
//2=virtual/real
//3=flap/icons/list
//4=dirs
//5=update'],
"7"=>['0807','- uniformisation de toutes les fonctions de traitement des rÃ©pertoires en une seule nommÃ©e \'explore()\', qui reÃ§oit les options files/dirs et 1=non-rÃ©cursif ;
- mise Ã  jour de la table des plugins ;
- rÃ©paration consultation des rÃ©pertoires depuis l\'extÃ©rieur (considÃ¨re l\'image comme existante mais ne l\'est pas, donc il y avait un patch, mais il demandait Ã  refabriquer les images Ã  chaque fois : reÃ§oit un paramÃ¨tre qui Ã©vite la refabrication)'],
"8"=>['0808','- petite rÃ©paration erreurs de sauvegarde dans l\'admin msql ;
- ajout de la table program_urls, rÃ©pertorie les commandes url ;
- ajout de la table program_icons, dÃ©stinÃ©e Ã  rendre protocolaire l\'usage de tables d\'icones ;
- ajout de 1036 icones de picol.com (16 et 32) ;'],
"9"=>['0809','support Svg :
- ajout de 260 icÃ´nes svg (noun_project) ;
- ajout de 144 (sur 521) icÃ´nes svg (picol) ;
- ajout du connecteur \':svg\' qui reÃ§oit le paramÃ¨tre \'nameÂ§h/v\' ;
- adaptation du lecteur d\'icÃ´nes dans l\'Ã©diteur ;
- centralisation des principaux icÃ´nes utilisÃ©s par le systÃ¨me ;
- admin/icons permet d\'Ã©diter les icÃ´nes du systÃ¨me, et de choisir des formats img/svg Ã  la place de la typo par dÃ©faut ;'],
"10"=>['0810','- ajout d\'un bouton \'investigate\' dans le batch, permet de rÃ©colter (d\'une traite) les articles rÃ©cents inexistants des sites sÃ©lectionnÃ©s ;
- une recherche boolÃ©enne a Ã©tÃ© ajoutÃ©e parmi les contrÃ´leur de prÃ©sence ;
- ajout d\'un bouton \'wyswyg\' Ã  cÃ´tÃ© de l\'Ã©diteur pour appeler rapidement un champ oÃ¹ coller un contenu dÃ©jÃ  formatÃ© ;
- (en passant devant) le rendu de la recherche boolÃ©enne Ã©vite d\'afficher plusieurs fois un paragraphe oÃ¹ une occurrence diffÃ©rente a Ã©tÃ© trouvÃ©e (elles sont compilÃ©es) ;'],
"11"=>['0811','- rÃ©forme de l\'update pour que les dossiers volumineux soient compressÃ©s : les rÃ©pertoires \'icons\' et \'bkg\' sont groupÃ©s dans un fichier .tar. Si un seul fichier change, l\'update installe tout le pack, c\'est pas grave, au moins comme Ã§a il ne crash pas ;'],
"12"=>['0812','- l\'application \'distribution\' est mise Ã  niveau et un peu amÃ©liorÃ©e en rapiditÃ© ;
- mise Ã  niveau \'publish_site\' et \'zip_prog\' (logiciels d\'Ã©diteur d\'update) ;'],
"13"=>['0813','- le visiteur publiant un commentaire peut le modifier Ã  posteriori pendant une heure ;
- finale rÃ©vision du constructeur de miniature, qui redimensionne l\'image Ã  l\'intÃ©rieur ou Ã  l\'extÃ©rieur de la zone dÃ©finie ;'],
"14"=>['0814','maintenant que le systÃ¨me d\'icÃ´nes est au point...
- avancÃ©e de l\'ergonomie du Finder : on a choisi la maniÃ¨re la plus simple de prÃ©senter une hiÃ©rarchie de rÃ©pertoires ;
- le Finder est conÃ§u pour permettre toutes les formes de prÃ©sentation et toutes les sources de donnÃ©es, rÃ©pertoires, tables, rÃ©pertoires virtuels ;

Il remplacera de nombreuses dispositions hÃ©tÃ©rogÃ¨nes dans le systÃ¨me : admin/disk, admin/share, les explorateurs d&#8217;icÃ´nes, de background, d\'avatars, et potentiellement des articles. Il pourra se connecter Ã  des serveurs distants. 
C\'est le dÃ©but de l\'OS (philum_Os) puisqu\'il permet enfin d\'ouvrir les fichiers avec leur lecteur dÃ©diÃ© (pdf, flash, image, vidÃ©o, audio, tables...)'],
"15"=>['0815','- le dÃ©tecteur de tags avait hÃ©ritÃ© d\'un petit dÃ©faut qui empÃªchait la dÃ©tection dans quelques rares cas de figure (saut de ligne impromptu) ;'],
"16"=>['0816','- Finder gÃ¨re les tables'],
"17"=>['0817','correctif affectation des largeurs dans css_admin (on se demande qui a Ã©crit Ã§a)'],
"18"=>['0818','- le connecteur :link (utilisÃ© pour les menus) peut recevoir un connecteur :icon en option : \'HomeÂ§home:icon\' (fonction Home, affiche home:icon) ;
- le terme \'usertag\' n\'apparaÃ®t plus, Ã  la place c\'est le nom de la classe de tags qui apparaÃ®t dans l\'url (quand mÃªme beacoup plus joli) ;'],
"19"=>['0819','Finder se dote des fonctions rename, delete, et share'],
"20"=>['0820','Finder se dote des fonctions rename, delete, et new concernant les rÃ©pertoires'],
"21"=>['0821','Finder est incorporÃ© au noyau, ce qui en fait un objet du systÃ¨me (lui Ã©pargne les dispositions propres aux plugins) ;
Finder est dÃ©sormais opÃ©rationnel, dans sa phase primitive (admin/finder)'],
"22"=>['0822','- un truc cool : on peut ouvrir plusieurs popups en mÃªme temps ; elles se comportent comme les fenÃªtres d\'une application ;
- les plugins \'disk\' et \'share\' sont rendus obsolÃ¨tes (le plugin finder est supprimÃ©) ;
- icÃ´ne Finder dans le menu Admin ;'],
"23"=>['0823','- Finder : le renommage affecte la table des fichiers partagÃ©s ;'],
"24"=>['0824','- mise Ã  jour des icÃ´nes systÃ¨me, + ajout d\'un dossier \'22\' dans \'everaldo\' ;
- Finder se dotes d\'icÃ´nes ;
- la consultation msql se fait dans une popup ;
- le menu admin msql renvoie vers l\'Ã©diteur dans une popup plutÃ´t que admin/msql ;
- le master admin accÃ¨de Ã  l\'ensemble des rÃ©pertoires dans Finder ;
- dans la console, l\'Ã©dition d\'un module n\'ouvre pas une popup supplÃ©mentaire (conflits) ;'],
"25"=>['0825','- Finder : ajout de la fonction \'dowlnoad\' ;
amÃ©lioration de l\'upload de sorte Ã  ne pas avoir Ã  relancer la page ;
- les fenÃªtres rÃ©duites s\'empilent Ã  gauche ;'],
"26"=>['0826','- amÃ©lioration du copier-coller, afin d\'Ãªtre utilisÃ© par \'notepad\' ;
- l\'Ã©diteur msql autorise l\'Ã©dition de plusieurs entrÃ©es simultanÃ©ment (permit par le multifenÃªtrage) ;
- le nouveau upload est appliquÃ© Ã  l\'Ã©dition des articles, ce qui permet l\'upload en sÃ©rie ;'],
"27"=>['0827','- ajout du menu admin \'Apps\' : l\'utilisateur peut ajouter des actions dans le menu systÃ¨me \'apps\' (anciennement \'sysmenu\'). On peut appeler des modules (page), des plugins (popup) et des tables msql.
'],
"28"=>['0828','mise en fonctionnement de partage distant :
- on peut consulter (rÃ©cupÃ©rer la taille, date, largeurs) et downloader les fichiers d\'un autre serveur (Ã  80 Mo/s).
- microsql mit en conformitÃ© ;
- on peut s\'inscrire comme Hub du rÃ©seau ;

- le truc qui bloquait les mises Ã  jour depuis 1 semaine a Ã©tÃ© dÃ©nichÃ© ;'],
"29"=>['0829','correctifs de confort et de sÃ©curitÃ© dans Finder :
- dossier virtuel dispo aprÃ¨s partage
- interdire renommages hors du hub
- rÃ©affectation du chemin en cours quand on passe en mode miniatures
- affichage du gestionnaire de dossier Ã  la racine
- affichage de la racine en mode partage
- correction erreur de reconstruction superflue de miniature
- contrÃ´le de validitÃ© du renommage
- systÃ¨me basique de permissions pour l\'ouverture au visiteur (\'download\' ne signifie plus sur le serveur mais vers l\'utilisateur)

- ajout du module \'finder\', permet d\'appeler et proposer le finder aux visiteurs : param = chemin et option = configuration (7 params) ;
- suppression du module \'share\' et on laisse l\'ancien \'disk\' qui n\'appelle aucune ressource ;'],
"30"=>['0830','introduction du Desktop : 
- activation dans le menu admin \'actions\' ;
- permet d\'Ã©diter le site depuis un bureau oÃ¹ les fenÃªtres ouvertes restent statiques, l\'ensemble du site Ã©tant dans une iframe ;

- iconographie du Finder utilise Picol ;
- mise Ã  jour des icones de Picol']];