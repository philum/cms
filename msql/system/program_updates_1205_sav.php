<?php
//philum_microsql_program_updates_1205
$program_updates_1205["_menus_"]=array('day','text');
$program_updates_1205[1]=array('0501','mise � jour de toutes les aides pour les 219 functions publiques du noyau (base program_core)');
$program_updates_1205[2]=array('0502','- introduction du param�tre \'auto_member\' : permet de d�l�guer des privil�ges au visiteur (de 1 � 4) et faire de lui un membre automatiquement au moment o� il poste un article ;
- les privil�ges ont �t� un peu r�organis�s pour que :
1 : poste des commentaires
2 : poste des articles mais ne peut les publier
3 : peut publier
4 : peut �diter les autres articles
Cela permettra d\'offrir des capacit�s du logiciel � de simples \'membres\' autolgu�s.
- le syst�me des membres est ind�pendant de celui des utilisateurs, chaque utilisateur ou visiteur pouvant devenir membre d\'un hub.
');
$program_updates_1205[3]=array('0505','- nouveaux boutons de la popup ;
- bouton \'import\' remplac� par le m�me que celui du menus rapide ;
- champ de recherche aussi, m�me syst�me (lance le script d�s que le texte est coll�) ;
- am�nagements en vue d\'accueillir le mode \'auto_member\'  (syst�me sans login)');
$program_updates_1205[4]=array('0511','- correctif faille de s�curit� engendr� par le nouveau param \'auto_member\' ;
- continuit� du travail sur \'auto_member\' pour trouver une solution �l�gante � l\'ouverture des autorisations au public ;
- am�lioration des commentaires qui peuvent reconna�tre un utilisateur ;
- petite am�lioration de la prise en compte des majuscules apr�s un espace ins�cable dans le formatage du titre ;
- ajout d\'un filtre \'del_blocks\' qui efface les blocs �crits avec des crochets ;
- nouvelle r�novation du batch_process, en utilisant une requ�te mysql une fois les autres conditions remplies, pour ne pas prendre en compte les articles parus � une date ant�rieure (c\'est pas encore parfait) ;
- il table utilis�e par le s�lecteur du batch (qui va chercher les nouveaux articles dans un rss) est rss_url_1 ;');
$program_updates_1205[5]=array('0512','perfectionnement de la fonction \'auto_member\' :
- le niveau d\'autorisation affect� au param�tre est attribu� au visiteur (3 dans l\'id�al, il peut publier ses articles, 2 il ne peut que poster, 4 il peut �diter ceux des autres) ;
- une enqu�te renvoie l\'identit� du visiteur ;
- s\'il est inconnu il est enregistr� sans nom ;
- au premier commentaire il est connu, au premier article publi� son nom est enregistr� ;
- l\'enregistrement de l\'automember consiste en un message de type commentaire affect� � \'automember\' et � une identification temporaire en tant que membre du hub ;
- le champ \'name\' interdit l\'usage des noms de hubs existants ;
- une �mergence impromptue de cette disposition est que le superadmin est logu� de facto ;');
$program_updates_1205[6]=array('0513','- r�paration du s�lecteur d\'onglet (qui doit se souvenir de sa osition d\'une page � l\'autre) ;
- r�vision du syst�me de s�lection du niveau d\'affichage (1,2 ou 3, = false, preview, full) : la restriction est court-circuit�e par l\'option de module (load, All, Category) ou n\'importe quel module d\'article. Ce fonctionnement est rendu uniforme (ce param�tre peut �tre introduit tout au long des cha�nes de fonctions)');
$program_updates_1205[7]=array('0513','am�lioration du fil rss :
- syst�me de cache en dur ;
- meilleure prise en charge des articles import�s ;
- miniatures et pas d\'images ;
- destruction des balises qui ne sont pas des liens ;
- ajout des balises \'author\' (branch� sur l\'usertag \'author\' et langage ;');
$program_updates_1205[8]=array('0514','ajout des modules : 
- \'ajxget\' (nom de la fonction du noyau) qui permet d\'�chapper les caract�res utilis�s par le connecteur \'module\' ;
- rss_input (alias vers le module) pour �viter de s\'emb�ter avec ajxget...');
$program_updates_1205[9]=array('0514','finalisation de la disposition automember :
- l\'utilisateur invit� est enregistr� comme inconnu, identifi� au premier article, peut �diter et voir ses articles non publi�s, ne peut pas prendre le nom d\'un autre membre, peut adopter un avatar.
Si son IP change ses donn�es deviennent inaccessibles...');
$program_updates_1205[10]=array('0515','- ajout d\'une temporisation sur le d�tecteur d\'�v�nements lors de la manipulation de champ d\'�dition de l\'article, pour ne pas obtenir le bouton d\'enregistrement ajax alors que le nombre de caract�res est trop �lev�
- temporisation qui referme le menu admin rapide');
$program_updates_1205[11]=array('0515','- suppression d\'un trop ancien syst�me de toggle au profit du nouveau, am�lior�, (toggle) qui permet de choisir le mode, appartenant ou non � un groupe de boutons ;
- nouveaux boutons d\'�dition d\'article ;
- dans la console les modules d�sactiv�s apparaissent en gris� ;');
$program_updates_1205[12]=array('0515','(jour des tralalas)
- suppression d\'un trop ancien syst�me de toggle au profit du nouveau, am�lior�, (toggle) qui permet de choisir le mode, appartenant ou non � un groupe de boutons ;
- nouveaux boutons d\'�dition d\'article ;
- dans la console les modules d�sactiv�s apparaissent en gris� ;
- mise � niveau des css par d�faut ;
- r�paration de l\'impossibilit� d\'ouvrir les css 2, 3 et 4 ;
- impossibilit� d\'enregistrer la couleur  bkg1 dans les css (� r�parer) ;
- meilleur fonctionnement des actions du champ de recherche, il commence se recherche quand on a fini de taper le texte ;');
$program_updates_1205[13]=array('0516','- �dition d\'articles dans l\'admin : le bouton \'save\' au-dessus de 5000 caract�res ;
- la \'pop_open\' ouvre d�sormais l\'article dans une fen�tre dans une iframe, ce qui permet d\'y continuer l\'�dition ;
- l\'instruction \'smart_edit\' (restriction 17) est activable depuis l\'url, ce qui sert pour l\'�dition dans une iframe ;
- l\'enregistrement des articles depuis le batch devient direct et renvoie sur l\'article publi� pr�t � �tre �dit� (avant il proposait l\'enregistrement � faire, c\'est nettement plus pratique !) ;
- le batch_process est incorpor� au menu admin_rapide, toutes les actions y font r�f�rence, et on peut choisir la cat�gorie et si l\'article cr�� sera parent de celui en cours ; 
- dernier correctif sur le d�tecteur d\'usage de clavier du champ de recherche ;
- dans l\'admin le bouton (...) sert � lancer le corps du texte de la cellule en entier ;
- correctif caract�res mal d�cod�s dans \'Channel\' ;');
$program_updates_1205[14]=array('0517','r�paration erreur des checkbox, qui pouvait provoquer l\'enregistrement syst�matique d\'un mauvais �tat du droit de publier des commentaires (l\'erreur semble dater de quelques jours) - donc maj imm�diate');
$program_updates_1205[15]=array('0517','- r�paration d�tecteur d\'activit� du champ de recherche, pour �muler un \'onpaste\' tout en �vitant les appels r�p�titifs ;
- ajout du connecteur \':weppage\', comme \':web\' mais se r�f�re au plugin \'suggest\' (pas besoin des d�finitions de sites) pour afficher une page web dans une popup (tr�s pratique !) ;');
$program_updates_1205[16]=array('0518','- les \'autotags\' propos�s (et pr�sent�s dans le module \'words\') sont class�s par ordre de pertinence (d\'abord les plus nombreux, puis les ressemblances) ;
- r�paration de l\'importateur de tables d\'autres serveurs dans  l\'admin msql ;');
$program_updates_1205[17]=array('0519','- ajout restriction 52 : afficher le batch_menu ;
- restriction 53 : emp�cher l\'enregistrement en ajax des articles courts (certains serveurs sont trop courts !) ;
- ajout proc�dure constructeur de listes imbriqu�es (tr�s pratique) : make_list_r() ;
- am�lioration du menu admin (techniques mixtes js/css) ;
- mise � jour \'_menus.css\' ;
- on d�cide que les h3, comme les autres balises \'h\' doivent avoir un \'margin:0\' m�me s\'ils ne sont pas trait�s comme des paragraphes ;');
$program_updates_1205[18]=array('0520','- les css sont pr�sent�s par cat�gories dans l\'�dition du design ;');
$program_updates_1205[19]=array('0521','- r�paration erreur utf8 des tickets ;
- r�paration erreur de format de la newsletter ;
- un bouton appara�t dans l\'admin rapide si une mise � jour est disponible ;
- le menu \'upload\' renvoie la liste des fichiers mis � jour ;');
$program_updates_1205[20]=array('0522','- r�forme des headers (32 fichiers affect�s) ;
- ajout du plugin \'addfonts\' qui permet d\'ajouter des typos trouv�es sur le web depuis la source css @font-face (phase 1) ;');
$program_updates_1205[21]=array('0523','- finalisation de \'addfonts\' : 
dans admin/fonts un menu renvoie vers le plugin,
le plugin import les typos dans le r�p�rtoire /fonts,
il cr�e un package .tar dans le r�pertoire utilisateur,
ensuite il faut faire un \'inject\' dans admin/fonts.
- ajout d\'un champ pour taper du texte dans l\'�diteur  font-face ;
- ajout d\'un \"new_from\" pour cr�er une classe css d\'apr�s une existante (pratique pour ajouter un :hover) ;
- possibilit� d\'�diter le nom de la classe ;
- mise � niveau du design par d�faut ;');
$program_updates_1205[22]=array('0524','- ajout d\'un composant \'copier-coller\' multiple et d\'un bouton \'supprimer\' (pour pas l�cher la souris !) ; la copie fonctionne beaucoup mieux que le bloc-notes en ajax, elle n\'est pas limit�e en quantit�, et les donn�es sont stock�es �ternellement dans le navigateur.');
$program_updates_1205[23]=array('0525','- r�paration erreur de fabrication de liens absolus des articles envoy�s par mail ;
- r�paration erreur de fabrication des images en plein-�cran ;
- les boutons \'copier\', \'coller\', \'supprimer\' (\'s�lection/dernier caract�re\' et \'connecteur\'), et \'s�lectionner tout\' sont ajout�s dans �diteur ;
- renommage Ascii des boutons de l\'�diteur ;
- correctif dans l\'�diteur externe (code plus propre) ;
- dans admin/css le bouton \'apply\' est mis en surbrillance par rapport � \'save\', impos� par un correctif permettant d\'obtenir les r�sultats de changement de largeurs imm�diatement en dev(save ne sert � rien, comme \'rebuild\' sauf si un changement a eu lieu de l\'ext�rieur ;
- am�lioration designs par d�faut ;');
$program_updates_1205[24]=array('0526','- pas de correcteur orthographique dans les formulaires de l\'admin ;
- relokage de admin.css ;
- mise en route de la fonctionnalit� de d�veloppement en ligne (admin/dev) ;
- liste des fonction �dit�es dans admin/dev (plus rapide de passer de l\'une � l\'autre) ;
- ajout de \'2prod\' qui copie les fichier dev en prod dev) ;
- correctif dans admin/tools ;(bouton dans l\'admin ;
- permutations diverses dans le g�n�rateur html permettant d\'obtenir un code plus a�r� ;

');
$program_updates_1205[25]=array('0527','- ajout du composant \'copier-coller\' dans le bloc-notes ;
- nouvelle pr�sentation des plugins, par cat�gories mixtes ;
');
$program_updates_1205[26]=array('0527','par convention les �l�ments \'h1\', \'h2\', \'h3\', \'h4\' doivent recevoir la valeur 0 pour l\'attribut margin : 
margin:0 0 0px 0;
au lieu de margin:0 0 16px 0; (hauteur d\'une ligne),
de fa�on � renvoyer des r�sultats comparables en utilisant ou non les balises p');
$program_updates_1205[27]=array('0528','ajout d\'une fonction javascript \'connector\', r�plique du noyau central :
- am�lioration du bouton d\'effacement des connecteurs, capable de prendre en compte une s�lection et ses it�rations ;
- tous les filtres d\'effacement deviennent capables de distinguer si �a doit op�rer sur l\'ensemble ou la partie s�lectionn�e du texte ;
- nouveau bloc de filtres nomm� \'del\', ce sont les filtres d\'effacements ;
- ajout de fonctions de commodit� msqlink() et ascii() ;');
$program_updates_1205[28]=array('0528','suppression de la restriction 48 \'icones_edition\', pas tr�s signifiante ;');
$program_updates_1205[29]=array('0529','finalisation la capacit� en javascript � situer les points d\'entr�e et sortie des connecteurs imbriqu�s');
$program_updates_1205[30]=array('0530','- am�liorations esth�tiques : �diteur externe, boutons standards, iconographie ;
- am�liorations pratiques : listes en ajax, �dition en ajax dans l\'�diteur msql (jonction avec l\'admin) ; ');
$program_updates_1205[31]=array('0530','- finalisation de la jonction entre l\'admin msql et msql dans l\'admin : l\'�dition peut se faire � la vol�e en ajax (�a marche !) ; 
- ajout de la restriction 48 : \'check_update\' pour emp�cher l\'appel du num�ro de version ;
- confort d\'utilisation du batch : popups �ph�m�res, �gronomie ;
- les dates sont supprim�es des titres ;');

?>