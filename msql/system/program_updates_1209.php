<?php
//philum_microsql_program_updates_1209
$r["_menus_"]=array('day','text');
$r[1]=array('0801','am�liorations css global et classic, compatibilit� et design avec des d�grad�s');
$r[2]=array('0802','la restriction 55 active les templates personnalis�s, pour les titres de page et les commentaires ; �a permet d\'�conomiser des ressources quand ces fonctions ne sont pas utilis�es');
$r[3]=array('0803','- r�solution des probl�mes d\'importation des e dans l\'o (&#339;)
- la plupart des menus ajax font d�sormais r�f�rence � la classe \'nb_pages\' qui est activable, plut�t qu\'aux classes ind�pendantes \'txtx\' et \'txtred\' : cela peut avoir un impact sur la mise en forme.');
$r[4]=array('0804','- function hexrgb (usage de transparences) ;
- le rafra�chissement css en cours d\'�dition est plus rapide ;
- temporisation de la compl�tion auto ;
- qq pb ponctuels d\'interpr�tation des ascii r�solus ;
- r�habilitation du multithread pour l\'utilitaire \'postit\', + normalisation des caract�res sp�ciaux ;');
$r[5]=array('0805','- pr�sentation en onglets de l\'admin de la newsletter ;
- la construction de miniatures est limit�e aux objets de moins de 10000 pixels de haut (sinon �a bloque tout)');
$r[6]=array('0806','d�but des travaux sur le nouvel explorateur de fichiers, nomm� finder\' :
- mise en place du protocole des options : 
//0=disk/shared
//1=local/global/distant
//2=virtual/real
//3=flap/icons/list
//4=dirs
//5=update');
$r[7]=array('0807','- uniformisation de toutes les fonctions de traitement des r�pertoires en une seule nomm�e \'explore()\', qui re�oit les options files/dirs et 1=non-r�cursif ;
- mise � jour de la table des plugins ;
- r�paration consultation des r�pertoires depuis l\'ext�rieur (consid�re l\'image comme existante mais ne l\'est pas, donc il y avait un patch, mais il demandait � refabriquer les images � chaque fois : re�oit un param�tre qui �vite la refabrication)');
$r[8]=array('0808','- petite r�paration erreurs de sauvegarde dans l\'admin msql ;
- ajout de la table program_urls, r�pertorie les commandes url ;
- ajout de la table program_icons, d�stin�e � rendre protocolaire l\'usage de tables d\'icones ;
- ajout de 1036 icones de picol.com (16 et 32) ;');
$r[9]=array('0809','support Svg :
- ajout de 260 ic�nes svg (noun_project) ;
- ajout de 144 (sur 521) ic�nes svg (picol) ;
- ajout du connecteur \':svg\' qui re�oit le param�tre \'name�h/v\' ;
- adaptation du lecteur d\'ic�nes dans l\'�diteur ;
- centralisation des principaux ic�nes utilis�s par le syst�me ;
- admin/icons permet d\'�diter les ic�nes du syst�me, et de choisir des formats img/svg � la place de la typo par d�faut ;');
$r[10]=array('0810','- ajout d\'un bouton \'investigate\' dans le batch, permet de r�colter (d\'une traite) les articles r�cents inexistants des sites s�lectionn�s ;
- une recherche bool�enne a �t� ajout�e parmi les contr�leur de pr�sence ;
- ajout d\'un bouton \'wyswyg\' � c�t� de l\'�diteur pour appeler rapidement un champ o� coller un contenu d�j� format� ;
- (en passant devant) le rendu de la recherche bool�enne �vite d\'afficher plusieurs fois un paragraphe o� une occurrence diff�rente a �t� trouv�e (elles sont compil�es) ;');
$r[11]=array('0811','- r�forme de l\'update pour que les dossiers volumineux soient compress�s : les r�pertoires \'icons\' et \'bkg\' sont group�s dans un fichier .tar. Si un seul fichier change, l\'update installe tout le pack, c\'est pas grave, au moins comme �a il ne crash pas ;');
$r[12]=array('0812','- l\'application \'distribution\' est mise � niveau et un peu am�lior�e en rapidit� ;
- mise � niveau \'publish_site\' et \'zip_prog\' (logiciels d\'�diteur d\'update) ;');
$r[13]=array('0813','- le visiteur publiant un commentaire peut le modifier � posteriori pendant une heure ;
- finale r�vision du constructeur de miniature, qui redimensionne l\'image � l\'int�rieur ou � l\'ext�rieur de la zone d�finie ;');
$r[14]=array('0814','maintenant que le syst�me d\'ic�nes est au point...
- avanc�e de l\'ergonomie du Finder : on a choisi la mani�re la plus simple de pr�senter une hi�rarchie de r�pertoires ;
- le Finder est con�u pour permettre toutes les formes de pr�sentation et toutes les sources de donn�es, r�pertoires, tables, r�pertoires virtuels ;

Il remplacera de nombreuses dispositions h�t�rog�nes dans le syst�me : admin/disk, admin/share, les explorateurs d&#8217;ic�nes, de background, d\'avatars, et potentiellement des articles. Il pourra se connecter � des serveurs distants. 
C\'est le d�but de l\'OS (philum_Os) puisqu\'il permet enfin d\'ouvrir les fichiers avec leur lecteur d�di� (pdf, flash, image, vid�o, audio, tables...)');
$r[15]=array('0815','- le d�tecteur de tags avait h�rit� d\'un petit d�faut qui emp�chait la d�tection dans quelques rares cas de figure (saut de ligne impromptu) ;');
$r[16]=array('0816','- Finder g�re les tables');
$r[17]=array('0817','correctif affectation des largeurs dans css_admin (on se demande qui a �crit �a)');
$r[18]=array('0818','- le connecteur :link (utilis� pour les menus) peut recevoir un connecteur :icon en option : \'Home�home:icon\' (fonction Home, affiche home:icon) ;
- le terme \'usertag\' n\'appara�t plus, � la place c\'est le nom de la classe de tags qui appara�t dans l\'url (quand m�me beacoup plus joli) ;');
$r[19]=array('0819','Finder se dote des fonctions rename, delete, et share');
$r[20]=array('0820','Finder se dote des fonctions rename, delete, et new concernant les r�pertoires');
$r[21]=array('0821','Finder est incorpor� au noyau, ce qui en fait un objet du syst�me (lui �pargne les dispositions propres aux plugins) ;
Finder est d�sormais op�rationnel, dans sa phase primitive (admin/finder)');
$r[22]=array('0822','- un truc cool : on peut ouvrir plusieurs popups en m�me temps ; elles se comportent comme les fen�tres d\'une application ;
- les plugins \'disk\' et \'share\' sont rendus obsol�tes (le plugin finder est supprim�) ;
- ic�ne Finder dans le menu Admin ;');
$r[23]=array('0823','- Finder : le renommage affecte la table des fichiers partag�s ;');
$r[24]=array('0824','- mise � jour des ic�nes syst�me, + ajout d\'un dossier \'22\' dans \'everaldo\' ;
- Finder se dotes d\'ic�nes ;
- la consultation msql se fait dans une popup ;
- le menu admin msql renvoie vers l\'�diteur dans une popup plut�t que admin/msql ;
- le master admin acc�de � l\'ensemble des r�pertoires dans Finder ;
- dans la console, l\'�dition d\'un module n\'ouvre pas une popup suppl�mentaire (conflits) ;');
$r[25]=array('0825','- Finder : ajout de la fonction \'dowlnoad\' ;
am�lioration de l\'upload de sorte � ne pas avoir � relancer la page ;
- les fen�tres r�duites s\'empilent � gauche ;');
$r[26]=array('0826','- am�lioration du copier-coller, afin d\'�tre utilis� par \'notepad\' ;
- l\'�diteur msql autorise l\'�dition de plusieurs entr�es simultan�ment (permit par le multifen�trage) ;
- le nouveau upload est appliqu� � l\'�dition des articles, ce qui permet l\'upload en s�rie ;');
$r[27]=array('0827','- ajout du menu admin \'Apps\' : l\'utilisateur peut ajouter des actions dans le menu syst�me \'apps\' (anciennement \'sysmenu\'). On peut appeler des modules (page), des plugins (popup) et des tables msql.
');
$r[28]=array('0828','mise en fonctionnement de partage distant :
- on peut consulter (r�cup�rer la taille, date, largeurs) et downloader les fichiers d\'un autre serveur (� 80 Mo/s).
- microsql mit en conformit� ;
- on peut s\'inscrire comme Hub du r�seau ;

- le truc qui bloquait les mises � jour depuis 1 semaine a �t� d�nich� ;');
$r[29]=array('0829','correctifs de confort et de s�curit� dans Finder :
- dossier virtuel dispo apr�s partage
- interdire renommages hors du hub
- r�affectation du chemin en cours quand on passe en mode miniatures
- affichage du gestionnaire de dossier � la racine
- affichage de la racine en mode partage
- correction erreur de reconstruction superflue de miniature
- contr�le de validit� du renommage
- syst�me basique de permissions pour l\'ouverture au visiteur (\'download\' ne signifie plus sur le serveur mais vers l\'utilisateur)

- ajout du module \'finder\', permet d\'appeler et proposer le finder aux visiteurs : param = chemin et option = configuration (7 params) ;
- suppression du module \'share\' et on laisse l\'ancien \'disk\' qui n\'appelle aucune ressource ;');
$r[30]=array('0830','introduction du Desktop : 
- activation dans le menu admin \'actions\' ;
- permet d\'�diter le site depuis un bureau o� les fen�tres ouvertes restent statiques, l\'ensemble du site �tant dans une iframe ;

- iconographie du Finder utilise Picol ;
- mise � jour des icones de Picol');

?>