<?php
//philum_microsql_program_updates_1106

$program_updates_1106["_menus_"]=array('day','txt');
$program_updates_1106["1"]=array('110601',"rénovation des connecteurs vidéo pour qu'ils renvoie plutôt des iframe que des embed");
$program_updates_1106["2"]=array('110602',"- déplacement de fonctions pour optimiser les appels ;
- renommage / mise en conformité des plug-ins ;
- petites modifs sur le module twitter ;
- ajout d'une classe 'twitter' dans les css (faire un update dans css_builder pour l'ajouter) ;
- petits correctifs précédents mouvements sur les tickets ;");
$program_updates_1106["3"]=array('110603',"petites améliorations css_builder : 
- l'ajout de css ouvre directement l'édition au bon endroit (détection-déduction en cas de désynchronisation due à la suppression de classes);
- la position est désigné par les noms au lieu des numéros ;
- les tables sont réempilées automatiquement (pour éviter la désynchronisation)");
$program_updates_1106["4"]=array('110604',"mise à jour de jwplayer, le lecteur .flv prend désormais en charge les .mp4 (et .aac), et les lecteurs QuickTime, windowsmediavideo et real media sont (tout simplement) dépréciés. Les formats suivants ne sont plus supportés (ils n'ont jamais servi en huit ans !) : m4a .mov .mpg .wmv .asf .rmv .ram .rm");
$program_updates_1106["5"]=array('110605','réparation du système de fabrication des Sliders');
$program_updates_1106["6"]=array('110606',"les liens contenant une image et pointant vers une image se réduisent à l'image du lien (souvent la grande) afin de ne pas laisser une miniature dont le lien renvoie vers la grande image (ils sont obligés de faire ça car leur CMS ne gère pas les dimensions)");
$program_updates_1106["7"]=array('110607',"facilitation du bouton 'msql' dans l'éditeur externe : quand aucune définition d'importation de site n'est reconnue, ce bouton va créer l'entrée et afficher le formulaire où il n'y a plus qu'à les éditer (mais ça peut encore s'améliorer)");
$program_updates_1106["8"]=array('110608',"ajout du paramètre 'google' dans master_admin, qui accepte un identifiant google pour l'aide au référencement en produisant une balise meta 'google-site-verification'");
$program_updates_1106["9"]=array('110608','correctif des règles de transport pendant les opérations en ajax pour résoudre un problème de caractères interdits (règle global, puissante, appliquée partout)');
$program_updates_1106["10"]=array('110608',"amélioration du protocole de mise à jour du programme, pour les pages téléchargées une à une : bzcompress n'étant pas supporté par tous les serveurs, base64 est utilisé à la place (aurait dû y penser avant !)");
$program_updates_1106["11"]=array('110608',"ajout d'un plug-in 'sitemap' : signalé par le robot.txt, sans indication, renvoie la liste des sitemaps des hubs en tenant compte du nom de sous-domaine ; appelé avec la variable '?hub=x', renvoie le sitemap du hub, tenant compte de la date et du niveau de priorité donné par les tags 'Une' et 'Stay'");
$program_updates_1106["12"]=array('110609',"l'ajout d'ancres automatique rendu capable de mettre en conformité les références pour y appliquer ensuite les ancres");
$program_updates_1106["13"]=array('110609',"le rendu des recherches n'a plus à être présenté sous la forme qui sert à la recherche (respect de la casse) ; les mots recherchés par le moteur ou manuellement par la variable '&look=' font appel à la fonction str_detect(), dont le troisième argument, s'il est présent, ne renvoie pas les résultats dans lesquels aucune occurrence n'a été trouvée. ");
$program_updates_1106["14"]=array('110610',"les publiés de trackbacks par l'utilisateur ou par l'admin (qui démodère) font appel à la fonction user_mail_r() utilisée par tous les envois postaux en masse (newsletter, déploiement, alertes...) ce qui l'autorise désormais à informer les personnes ayant déjà participé à une discussion d'être informées de la publication d'un nouveau message.");
$program_updates_1106["15"]=array('110610',"mise en conformité avec html 5 notamment en utilisant la balise <article>, et en utilisant les classes 'entry' dans le template par défaut");
$program_updates_1106["16"]=array('110611',"améliorations fiabilité : 
- trackbacks : gestion des caractères spéciaux, adaptation de la largeur maximale des images/vidéos ;
- connecteur php : caractères interdits, affichage d'un overflow si nécessaire ça dépasse, correctifs utiles à highlight_string() (coloration syntaxique) ;
- galerie photo ajax : pas de clignotement entre les images ;
etc...
");
$program_updates_1106["17"]=array('110612',"ajout d'un éditeur dans le module 'connector' pour laisser plus d'amplitude à créer des objets uniques (la fonctionnalité étant puissante il fallait que cela se voit en ouvrant le module !)");
$program_updates_1106["18"]=array('110612',"nouveau dessin de l'admin, fonctions isolées pour être mieux joignable depuis la home dans le menu # :: penser à 'upload_admin-css'");
$program_updates_1106["19"]=array('110612',"correctifs et amélioration d’ergonomie dans l'admin microsql (reorder applique sort() si les clefs ne sont pas numériques)");
$program_updates_1106["20"]=array('110612',"création d'une table de référence pour les fonctions de lib : system/program_functions");
$program_updates_1106["21"]=array('110613',"amélioration substantielle du plug-in '[exec:b]' qui aide à tester du code en ligne (reçoit l'aide sur les fonctions), depuis que cette appli a découvert un nouveau débouché, la prog en ligne...");
$program_updates_1106["22"]=array('110614',"ajout du module [tab_mods:b] qui permet de consulter des modules signalés par des onglets.
Contrairement à MenusJ qui s'informe en temps réel sur l'état des données demandées, tab_mods utilise celles qui ont été chargées mais pas affichées.
Donc le chargement est plus long, mais son fonctionnement permet de n'afficher que les onglets pour lesquels un contenu a été trouvé.");
$program_updates_1106["23"]=array('110624',"échec d'une fourche évolutive dont on n'a répercuté que les aménagements :
- réformes de nominations
- rénovation de css_builder, plus précis : gestion des conditions
- bouton 'new_from'
- ajouts d'aides contextuelles
");
$program_updates_1106["24"]=array('110624',"ajout du javascript GNU/GPL 'live.js' qui permet de visualiser en temps réel les changements apportés aux classes css (dans css_builder, afficher les deux fenêtres côte à côte)");
$program_updates_1106["25"]=array('110625',"ajout de boutons de contrôle du mode d'enregistrement dans css_builder : afin de choisir d'enregistrer ou non les conditions ;
nouvelle fonction 'array_append' (pour les mises à jour, remplace array_combine_append)");
$program_updates_1106["26"]=array('110626',"augmentation de la portée de ajax dans css_builder : le css est éditable sur place dans le site (couleurs et classes). Si la session d'édition du design n'est pas active, ce sont les css publics qui sont affectés.");
$program_updates_1106["27"]=array('110628',"rénovation du module 'submenus' qui supplante l'onglet 'menus' dans l'admin : désormais on peut écrire des hiérarchies virtuelles dans chaque module, qui reçoit les moyens d'en générer et de les prévisualiser.
Pour l'utiliser il faut updater les css utilisateur et spécifiquement '#menuH ul li' (qui ne peut être réécrit par l'updater puisqu'il existe déjà), ainsi que les css de l'admin.");
$program_updates_1106["28"]=array('110630',"rénovation du module 'user_menus' :
- suppression des 11 restrictions qui servaient à le définir ;
- écriture d'un vrai module capable d'ordonner et renommer les liens");

?>