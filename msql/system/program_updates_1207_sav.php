<?php
//philum_microsql_program_updates_1207
$program_updates_1207["_menus_"]=array('day','text');
$program_updates_1207[1]=array('0701','introduction du connecteur \':book\' :
- re�oit en param�tre :
-- une ou plusieurs lignes de commande d\'articles ;
-- une liste d\'ID ;
- re�oit en option :
-- le titre du livre ;
-- 1=ordre num�rique, 2= ordre inverse ;
-- un template ;
- cr�ation du template public \'book\' (appel� par d�faut) ;
exemple :
[cat=public~nbdays=30,412 413 414�hello/2/book:book:on]

Pour les listes d\'ID il est possible d\'en cr�er en utilisant le plugin \'favs\' plac� dans un module, qui propose d\'exporter la liste ;');
$program_updates_1207[2]=array('0702','- ajout d\'un assistant pour le connecteur \':book\' ;
- ajout d\'une aide contextuelle pour le script d\'appel d\'articles ;');
$program_updates_1207[3]=array('0703','- le .htaccess a �t� modifi� pour supporter les commandes d\'actions d\'url de type \'/tag/appel/90/page/3\' ;
- support de l\'action \'plug/plugname/p1/p2\' (erreur) ;
- le constructeur de boutons de pages a �t� modifi� en cons�quence, donc la mise � jour du htaccess est obligatoire ;
- ajout d\'un �diteur pour le fichier \'.htaccess\' dans l\'admin ;
- activation du plugin \'htaccess\' lors de la mise � jour, une alerte dira si l\'action est permise par le serveur ;
- une disposition permet en terme g�n�ral de faire figurer un plugin dans l\'admin, il suffit de la signaler les plugins dans \'system/admin_authes\' ;');
$program_updates_1207[4]=array('0704','- on peut appeler un plugin directement comme un connecteur (aurait d� y penser avant) : [param:newplugin] est �quivalent � [newplugin�param:plug] pour appeler newplugin.php avec un param (mais beaucoup plus joli)
- finalisation de la console url : 
-- les modules sont appel�s comme �a : /module/modulename/param/title/command/option ;
-- les bases msql : /msql/base/prefix/table ;
-- autolog : /log');
$program_updates_1207[5]=array('0705','- d\'autres id�es pour le htaccess, encore modifi� ;
- finalisation de \'book\' : stade service minimal fonctionnel ;');
$program_updates_1207[6]=array('0706','- finalisation de \'book\' : stade pas mal ;
- la fonction \'scroll\' ne se r�f�re plus � un css, et �vite d\'afficher la (fatigante) barre de d�filement ;
- la fonction curwidth_set() est d�di�e � r�duire la taille connue de la div courante en fonction des templates personnalis�s ;');
$program_updates_1207[7]=array('0707','- le plugin \'book\' introduit un composant de d�filement auto ;
- correctif art_mod : le nouveau scroller (sans scroller) n�cessite que les largeurs soient explicites :  propagation de l\'information � travers la cha�ne de fonctions ;
- correctif htaccess pour que les plugins passent par le hangar, de sorte � �tre appelables de l\'ext�rieur, rendant ainsi disponibles pour des iframes de nombreuses fonctions, envisageant ainsi le logiciel comme appartenant � un r�seau plus vaste...');
$program_updates_1207[8]=array('0708','refonte du menu syst�me (nouveau nom pour dire que tout passe par l�) ;');
$program_updates_1207[9]=array('0709','- francisation (multinguisation) des menus de l\'admin ;
- l\'ensemble des filtres n\'a plus besoin que le document soit d�j� enregistr� pour �tre op�rationnels (gr�ce � Amt) ;');
$program_updates_1207[10]=array('0710','- d�sormais tous les liens .pdf ouvrent une iframe dans une popup, l\'iframe dans la page n\'�tant plus dispo par google.docs ;
- du coup le connecteur :pdf (ouverture sur place) rejoint momentan�ment la fonction de base (popup iframe) ;
- ajout d\'un bouton social \'iframe\' (restriction 54/template) pour proposer l\'int�gration d\'un article dans une iframe ;
- petite r�paration dans admin/share ;');
$program_updates_1207[11]=array('0711','- correctif htaccess (appel de pages de dossiers d\'articles et fonction \'rebuild\') ;
- ajout d\'un module syst�me \'sysmenu\' qui permet d\'ajouter des items, qui appellent des plugins dans une popup ;');
$program_updates_1207[12]=array('0712','- correctif pour acc�der aux connecteurs depuis une commande de modules (MenusJ), ce que l\'�criture semblait promettre : \"1234�3:pub:connector�Title,\"
(clic sur Title renvoie un connecteur qui poss�de ses propres param�tres et options)');
$program_updates_1207[13]=array('0713','- css par d�faut (\'classic\') adapt� pour obtenir un meilleur r�sultat quand on inverse les couleurs (fond noir lettres claires) ;
- le css par d�faut affiche les indications qui permettent d\'annuler l\'activit� des css globaux, parfois un peu excessifs pour les classes r�serv�es au syst�me ;');
$program_updates_1207[14]=array('0714','f�te nationale !');
$program_updates_1207[15]=array('0715','- meilleure g�n�ration de liens absolus dans plug/rss1 (articles distants) ;
- ajout d\'une option \'article\' dans le module \'connector\' afin de faire consid�rer le module comme un article (balise article, classe panel justy) ;
- ajout du support des variables dans les css, de sorte � pouvoir sp�cifier des couleurs relatives, qui d�pendent du jeu de couleur : #_2 renvoie la couleur 2 ;');
$program_updates_1207[16]=array('0716','- suppression des modules et connecteurs pub2 et pub3 (de la liste disponible, pas du traitement), maintenant le module et connecteur \'pub\' re�oit 5 param�tres, par d�faut le lien simple, 1, 2, 3 le niveau de preview, et 4 utilise le template \'pub\' ;
- l\'appel d\'un module qui n\'aboutit nulle part va enqu�ter chez les connecteurs (proc�dure normale), et maintenant l\'option (4i�me param�tre du module) est transmis aux connecteurs. (ainsi id///3:pub renvoie id�3:pub) ;
- adaptation au content de la taille affich�e des images en url absolue lues lors d\'une importation directe (:web, :rss_read, etc...) ;');
$program_updates_1207[17]=array('0719','- r�paration de l\'instauration des espaces ins�cables ;');
$program_updates_1207[18]=array('0720','- le connecteur \':comment\' est renomm� \':polaroid\' (plus explicite, � condition de ne pas avoir modifi� la classe \'blocktext\') ;
- ajout d\'un connecteur \':label\', appel� par le filtre \'img_label\' qui ajoute un bloc de la taille de la pr�c�dente image, dans une balise \'small\' (commentaire d\'image) ;');
$program_updates_1207[19]=array('0725','- ajout du filtre d\'importation \'delconn\' (�a manquait) et petit remaniement pour que le post-traitement choisisse d\'affecter l\'enti�ret� du texte ou un traitement par lignes ; les filtres de post-traitement sont dans les d�finitions d\'importation de sites ; Ainsi on peut supprimer des connecteurs cibl�s.');
$program_updates_1207[20]=array('0726','am�lioration de la publication des commentaires : 
- pr�visualisation avant publication ;
- ajout du support de connecteur vid�o ;');
$program_updates_1207[21]=array('0726','correctif articles affili�s qui s\'affichent malgr� l\'�tat de la restriction quand on n\'est pas logu�');
$program_updates_1207[22]=array('0730','r�solution des d�fauts d\'affichage des couleurs contradictoires dans les popups (qui est un mix des classes globales et des classes utilisateur, donc impr�visible)');
$program_updates_1207[23]=array('0731','la commande qui g�n�re des requ�tes (connecteur :article entre autres) peut recevoir un param�tre multiple pour la cat�gorie (sans quoi il �tait illogique d\'appeler deux cat�gories, car aucune r�ponse n\'est dans les deux) : \"~cat=categorie1&categorie2\"');

?>