<?php //msql/program_updates_1207
$r=["_menus_"=>['day','text'],
"1"=>['0701','introduction du connecteur \':book\' :
- reÃ§oit en paramÃ¨tre :
-- une ou plusieurs lignes de commande d\'articles ;
-- une liste d\'ID ;
- reÃ§oit en option :
-- le titre du livre ;
-- 1=ordre numÃ©rique, 2= ordre inverse ;
-- un template ;
- crÃ©ation du template public \'book\' (appelÃ© par dÃ©faut) ;
exemple :
[cat=public~nbdays=30,412 413 414Â§hello/2/book:book:on]

Pour les listes d\'ID il est possible d\'en crÃ©er en utilisant le plugin \'favs\' placÃ© dans un module, qui propose d\'exporter la liste ;'],
"2"=>['0702','- ajout d\'un assistant pour le connecteur \':book\' ;
- ajout d\'une aide contextuelle pour le script d\'appel d\'articles ;'],
"3"=>['0703','- le .htaccess a Ã©tÃ© modifiÃ© pour supporter les commandes d\'actions d\'url de type \'/tag/appel/90/page/3\' ;
- support de l\'action \'plug/plugname/p1/p2\' (erreur) ;
- le constructeur de boutons de pages a Ã©tÃ© modifiÃ© en consÃ©quence, donc la mise Ã  jour du htaccess est obligatoire ;
- ajout d\'un Ã©diteur pour le fichier \'.htaccess\' dans l\'admin ;
- activation du plugin \'htaccess\' lors de la mise Ã  jour, une alerte dira si l\'action est permise par le serveur ;
- une disposition permet en terme gÃ©nÃ©ral de faire figurer un plugin dans l\'admin, il suffit de la signaler les plugins dans \'system/admin_authes\' ;'],
"4"=>['0704','- on peut appeler un plugin directement comme un connecteur (aurait dÃ» y penser avant) : [param:newplugin] est Ã©quivalent Ã  [newpluginÂ§param:plug] pour appeler newplugin.php avec un param (mais beaucoup plus joli)
- finalisation de la console url : 
-- les modules sont appelÃ©s comme Ã§a : /module/modulename/param/title/command/option ;
-- les bases msql : /msql/base/prefix/table ;
-- autolog : /log'],
"5"=>['0705','- d\'autres idÃ©es pour le htaccess, encore modifiÃ© ;
- finalisation de \'book\' : stade service minimal fonctionnel ;'],
"6"=>['0706','- finalisation de \'book\' : stade pas mal ;
- la fonction \'scroll\' ne se rÃ©fÃ¨re plus Ã  un css, et Ã©vite d\'afficher la (fatigante) barre de dÃ©filement ;
- la fonction curwidth_set() est dÃ©diÃ©e Ã  rÃ©duire la taille connue de la div courante en fonction des templates personnalisÃ©s ;'],
"7"=>['0707','- le plugin \'book\' introduit un composant de dÃ©filement auto ;
- correctif art_mod : le nouveau scroller (sans scroller) nÃ©cessite que les largeurs soient explicites :  propagation de l\'information Ã  travers la chaÃ®ne de fonctions ;
- correctif htaccess pour que les plugins passent par le hangar, de sorte Ã  Ãªtre appelables de l\'extÃ©rieur, rendant ainsi disponibles pour des iframes de nombreuses fonctions, envisageant ainsi le logiciel comme appartenant Ã  un rÃ©seau plus vaste...'],
"8"=>['0708','refonte du menu systÃ¨me (nouveau nom pour dire que tout passe par lÃ ) ;'],
"9"=>['0709','- francisation (multinguisation) des menus de l\'admin ;
- l\'ensemble des filtres n\'a plus besoin que le document soit dÃ©jÃ  enregistrÃ© pour Ãªtre opÃ©rationnels (grÃ¢ce Ã  Amt) ;'],
"10"=>['0710','- dÃ©sormais tous les liens .pdf ouvrent une iframe dans une popup, l\'iframe dans la page n\'Ã©tant plus dispo par google.docs ;
- du coup le connecteur :pdf (ouverture sur place) rejoint momentanÃ©ment la fonction de base (popup iframe) ;
- ajout d\'un bouton social \'iframe\' (restriction 54/template) pour proposer l\'intÃ©gration d\'un article dans une iframe ;
- petite rÃ©paration dans admin/share ;'],
"11"=>['0711','- correctif htaccess (appel de pages de dossiers d\'articles et fonction \'rebuild\') ;
- ajout d\'un module systÃ¨me \'sysmenu\' qui permet d\'ajouter des items, qui appellent des plugins dans une popup ;'],
"12"=>['0712','- correctif pour accÃ©der aux connecteurs depuis une commande de modules (MenusJ), ce que l\'Ã©criture semblait promettre : \"1234Â§3:pub:connectorÂ§Title,\"
(clic sur Title renvoie un connecteur qui possÃ¨de ses propres paramÃ¨tres et options)'],
"13"=>['0713','- css par dÃ©faut (\'classic\') adaptÃ© pour obtenir un meilleur rÃ©sultat quand on inverse les couleurs (fond noir lettres claires) ;
- le css par dÃ©faut affiche les indications qui permettent d\'annuler l\'activitÃ© des css globaux, parfois un peu excessifs pour les classes rÃ©servÃ©es au systÃ¨me ;'],
"14"=>['0714','fÃªte nationale !'],
"15"=>['0715','- meilleure gÃ©nÃ©ration de liens absolus dans plug/rss1 (articles distants) ;
- ajout d\'une option \'article\' dans le module \'connector\' afin de faire considÃ©rer le module comme un article (balise article, classe panel justy) ;
- ajout du support des variables dans les css, de sorte Ã  pouvoir spÃ©cifier des couleurs relatives, qui dÃ©pendent du jeu de couleur : #_2 renvoie la couleur 2 ;'],
"16"=>['0716','- suppression des modules et connecteurs pub2 et pub3 (de la liste disponible, pas du traitement), maintenant le module et connecteur \'pub\' reÃ§oit 5 paramÃ¨tres, par dÃ©faut le lien simple, 1, 2, 3 le niveau de preview, et 4 utilise le template \'pub\' ;
- l\'appel d\'un module qui n\'aboutit nulle part va enquÃªter chez les connecteurs (procÃ©dure normale), et maintenant l\'option (4iÃ¨me paramÃ¨tre du module) est transmis aux connecteurs. (ainsi id///3:pub renvoie idÂ§3:pub) ;
- adaptation au content de la taille affichÃ©e des images en url absolue lues lors d\'une importation directe (:web, :rss_read, etc...) ;'],
"17"=>['0719','- rÃ©paration de l\'instauration des espaces insÃ©cables ;'],
"18"=>['0720','- le connecteur \':comment\' est renommÃ© \':polaroid\' (plus explicite, Ã  condition de ne pas avoir modifiÃ© la classe \'blocktext\') ;
- ajout d\'un connecteur \':label\', appelÃ© par le filtre \'img_label\' qui ajoute un bloc de la taille de la prÃ©cÃ©dente image, dans une balise \'small\' (commentaire d\'image) ;'],
"19"=>['0725','- ajout du filtre d\'importation \'delconn\' (Ã§a manquait) et petit remaniement pour que le post-traitement choisisse d\'affecter l\'entiÃ¨retÃ© du texte ou un traitement par lignes ; les filtres de post-traitement sont dans les dÃ©finitions d\'importation de sites ; Ainsi on peut supprimer des connecteurs ciblÃ©s.'],
"20"=>['0726','amÃ©lioration de la publication des commentaires : 
- prÃ©visualisation avant publication ;
- ajout du support de connecteur vidÃ©o ;'],
"21"=>['0726','correctif articles affiliÃ©s qui s\'affichent malgrÃ© l\'Ã©tat de la restriction quand on n\'est pas loguÃ©'],
"22"=>['0729','rÃ©solution des dÃ©fauts d\'affichage des couleurs contradictoires dans les popups (qui est un mix des classes globales et des classes utilisateur, donc imprÃ©visible)'],
"23"=>['0730','la commande qui gÃ©nÃ¨re des requÃªtes (connecteur :article entre autres) peut recevoir un paramÃ¨tre multiple pour la catÃ©gorie (sans quoi il Ã©tait illogique d\'appeler deux catÃ©gories, car aucune rÃ©ponse n\'est dans les deux) : \"~cat=categorie1|categorie2\"'],
"24"=>['0731','- ajout du paramÃ¨tre \'list\' comme commande de requÃªtes, permet d\'appeler des articles ciblÃ©s : ~list=123|124|125...
- rÃ©surrection du plugin xmlbook, permet de fabriquer le fichier xml qui va dans indesign Ã  partir d\'une liste d\'articles, qui peut en plus Ãªtre appelÃ©e par une commande de requÃªte.']];