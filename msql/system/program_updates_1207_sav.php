<?php
//philum_microsql_program_updates_1207
$program_updates_1207["_menus_"]=array('day','text');
$program_updates_1207[1]=array('0701','introduction du connecteur \':book\' :
- reçoit en paramètre :
-- une ou plusieurs lignes de commande d\'articles ;
-- une liste d\'ID ;
- reçoit en option :
-- le titre du livre ;
-- 1=ordre numérique, 2= ordre inverse ;
-- un template ;
- création du template public \'book\' (appelé par défaut) ;
exemple :
[cat=public~nbdays=30,412 413 414§hello/2/book:book:on]

Pour les listes d\'ID il est possible d\'en créer en utilisant le plugin \'favs\' placé dans un module, qui propose d\'exporter la liste ;');
$program_updates_1207[2]=array('0702','- ajout d\'un assistant pour le connecteur \':book\' ;
- ajout d\'une aide contextuelle pour le script d\'appel d\'articles ;');
$program_updates_1207[3]=array('0703','- le .htaccess a été modifié pour supporter les commandes d\'actions d\'url de type \'/tag/appel/90/page/3\' ;
- support de l\'action \'plug/plugname/p1/p2\' (erreur) ;
- le constructeur de boutons de pages a été modifié en conséquence, donc la mise à jour du htaccess est obligatoire ;
- ajout d\'un éditeur pour le fichier \'.htaccess\' dans l\'admin ;
- activation du plugin \'htaccess\' lors de la mise à jour, une alerte dira si l\'action est permise par le serveur ;
- une disposition permet en terme général de faire figurer un plugin dans l\'admin, il suffit de la signaler les plugins dans \'system/admin_authes\' ;');
$program_updates_1207[4]=array('0704','- on peut appeler un plugin directement comme un connecteur (aurait dû y penser avant) : [param:newplugin] est équivalent à [newplugin§param:plug] pour appeler newplugin.php avec un param (mais beaucoup plus joli)
- finalisation de la console url : 
-- les modules sont appelés comme ça : /module/modulename/param/title/command/option ;
-- les bases msql : /msql/base/prefix/table ;
-- autolog : /log');
$program_updates_1207[5]=array('0705','- d\'autres idées pour le htaccess, encore modifié ;
- finalisation de \'book\' : stade service minimal fonctionnel ;');
$program_updates_1207[6]=array('0706','- finalisation de \'book\' : stade pas mal ;
- la fonction \'scroll\' ne se réfère plus à un css, et évite d\'afficher la (fatigante) barre de défilement ;
- la fonction curwidth_set() est dédiée à réduire la taille connue de la div courante en fonction des templates personnalisés ;');
$program_updates_1207[7]=array('0707','- le plugin \'book\' introduit un composant de défilement auto ;
- correctif art_mod : le nouveau scroller (sans scroller) nécessite que les largeurs soient explicites :  propagation de l\'information à travers la chaîne de fonctions ;
- correctif htaccess pour que les plugins passent par le hangar, de sorte à être appelables de l\'extérieur, rendant ainsi disponibles pour des iframes de nombreuses fonctions, envisageant ainsi le logiciel comme appartenant à un réseau plus vaste...');
$program_updates_1207[8]=array('0708','refonte du menu système (nouveau nom pour dire que tout passe par là) ;');
$program_updates_1207[9]=array('0709','- francisation (multinguisation) des menus de l\'admin ;
- l\'ensemble des filtres n\'a plus besoin que le document soit déjà enregistré pour être opérationnels (grâce à Amt) ;');
$program_updates_1207[10]=array('0710','- désormais tous les liens .pdf ouvrent une iframe dans une popup, l\'iframe dans la page n\'étant plus dispo par google.docs ;
- du coup le connecteur :pdf (ouverture sur place) rejoint momentanément la fonction de base (popup iframe) ;
- ajout d\'un bouton social \'iframe\' (restriction 54/template) pour proposer l\'intégration d\'un article dans une iframe ;
- petite réparation dans admin/share ;');
$program_updates_1207[11]=array('0711','- correctif htaccess (appel de pages de dossiers d\'articles et fonction \'rebuild\') ;
- ajout d\'un module système \'sysmenu\' qui permet d\'ajouter des items, qui appellent des plugins dans une popup ;');
$program_updates_1207[12]=array('0712','- correctif pour accéder aux connecteurs depuis une commande de modules (MenusJ), ce que l\'écriture semblait promettre : \"1234§3:pub:connector§Title,\"
(clic sur Title renvoie un connecteur qui possède ses propres paramètres et options)');
$program_updates_1207[13]=array('0713','- css par défaut (\'classic\') adapté pour obtenir un meilleur résultat quand on inverse les couleurs (fond noir lettres claires) ;
- le css par défaut affiche les indications qui permettent d\'annuler l\'activité des css globaux, parfois un peu excessifs pour les classes réservées au système ;');
$program_updates_1207[14]=array('0714','fête nationale !');
$program_updates_1207[15]=array('0715','- meilleure génération de liens absolus dans plug/rss1 (articles distants) ;
- ajout d\'une option \'article\' dans le module \'connector\' afin de faire considérer le module comme un article (balise article, classe panel justy) ;
- ajout du support des variables dans les css, de sorte à pouvoir spécifier des couleurs relatives, qui dépendent du jeu de couleur : #_2 renvoie la couleur 2 ;');
$program_updates_1207[16]=array('0716','- suppression des modules et connecteurs pub2 et pub3 (de la liste disponible, pas du traitement), maintenant le module et connecteur \'pub\' reçoit 5 paramètres, par défaut le lien simple, 1, 2, 3 le niveau de preview, et 4 utilise le template \'pub\' ;
- l\'appel d\'un module qui n\'aboutit nulle part va enquêter chez les connecteurs (procédure normale), et maintenant l\'option (4ième paramètre du module) est transmis aux connecteurs. (ainsi id///3:pub renvoie id§3:pub) ;
- adaptation au content de la taille affichée des images en url absolue lues lors d\'une importation directe (:web, :rss_read, etc...) ;');
$program_updates_1207[17]=array('0719','- réparation de l\'instauration des espaces insécables ;');
$program_updates_1207[18]=array('0720','- le connecteur \':comment\' est renommé \':polaroid\' (plus explicite, à condition de ne pas avoir modifié la classe \'blocktext\') ;
- ajout d\'un connecteur \':label\', appelé par le filtre \'img_label\' qui ajoute un bloc de la taille de la précédente image, dans une balise \'small\' (commentaire d\'image) ;');
$program_updates_1207[19]=array('0725','- ajout du filtre d\'importation \'delconn\' (ça manquait) et petit remaniement pour que le post-traitement choisisse d\'affecter l\'entièreté du texte ou un traitement par lignes ; les filtres de post-traitement sont dans les définitions d\'importation de sites ; Ainsi on peut supprimer des connecteurs ciblés.');
$program_updates_1207[20]=array('0726','amélioration de la publication des commentaires : 
- prévisualisation avant publication ;
- ajout du support de connecteur vidéo ;');
$program_updates_1207[21]=array('0726','correctif articles affiliés qui s\'affichent malgré l\'état de la restriction quand on n\'est pas logué');
$program_updates_1207[22]=array('0730','résolution des défauts d\'affichage des couleurs contradictoires dans les popups (qui est un mix des classes globales et des classes utilisateur, donc imprévisible)');
$program_updates_1207[23]=array('0731','la commande qui génère des requêtes (connecteur :article entre autres) peut recevoir un paramètre multiple pour la catégorie (sans quoi il était illogique d\'appeler deux catégories, car aucune réponse n\'est dans les deux) : \"~cat=categorie1&categorie2\"');

?>