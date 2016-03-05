<?php
//philum_microsql_program_updates_1105

$program_updates_1105["_menus_"]=array('day','txt');
$program_updates_1105["1"]=array('110501',"système de sauvegardes multiples d'un article : ajout de l'onglet 'backup' (dans l'édition d'articles) qui propose 'backup', 'restore' et 'delete', valable pour chacune des sauvegardes d'un articles, qui sont d'un nombre illimité.
Initiation d'une nouvelle architecture pour dépasser certains problèmes de ajax (impossibilité de modifier un document qu'on a modifié !)");
$program_updates_1105["2"]=array('110501',"amélioration du filtre automatique 'clean_punct' (qui applique les règles typographiques) : désormais capable d'interpréter le texte pour réparer les guillemets précédés et suivis d'un espace (la règle c'est pas d'espaces à l'intérieur des guillemets)");
$program_updates_1105["3"]=array('110502',"ajout du support des Font-faces : 
- sélection de 87 typos (.eot, .woff, .otf et même .ttf) qui soient web, gratuites et supportent les accents) ;
- ajout d'un sélecteur avec prévisualisation de typos dans css_builder ;
C'est une révolution, le web ne sera plus jamais comme avant !");
$program_updates_1105["4"]=array('110502',"ajout d'un sélecteur rapide de balises css qui permette de s'y habituer rapidement ;");
$program_updates_1105["5"]=array('110503',"amélioration de fiabilité pour css_builder (sélection automatique des tables courantes quand on change de Hub) ; ajout d'un menu de sélection des tables de modules");
$program_updates_1105["6"]=array('110503','sélection de 1200 typos libres de droits pour font-face, dans les 3 formats (web, explorer et mobiles)');
$program_updates_1105["7"]=array('110504',"faire éviter qu'un tag sélectionné n'envoie un résultat alors qu'on le déséctionne à la dernière seconde...");
$program_updates_1105["8"]=array('110504',"auto-dig_tags : s'il n'y a pas assez de tags pour le menus 'see_also_tags' (le seul à ne se référer qu'à la table du cache), la recherche s'approfondit dans le temps jusqu'aux 20 derniers articles");
$program_updates_1105["9"]=array('110504',"retour à la première version de Filters (édition d'articles) : le texte traité est toujours celui en mémoire et il ne faut pas le modifier pour que ça marche ; l'autre version permettait de le modifier et de faire se succéder les filtres, mais ajax ne prend pas en charge les documents longs ; pour éviter la confusion, une seule règle est conservée");
$program_updates_1105["10"]=array('110504',"réparation pour que l'envoi par mail et le déploiement d'un article l'envoie en entier");
$program_updates_1105["11"]=array('110504',"réparation activation bouton de menu 'link' pour les catégories");
$program_updates_1105["12"]=array('110504','variable $sbdm dans _connectx pour interdire les sous-domaines quand un site est appelé par une Url propriétaire');
$program_updates_1105["13"]=array('110504',"sophistication du module see_also-tags et see_also-usertags pour qu'il profite puisse produire des 'pubs' (titre+img) ou des articles, incluant un template ponctuel");
$program_updates_1105["14"]=array('110504',"connecteur 'form' peut recevoir un 'button' pour nommer le bouton d'envoi");
$program_updates_1105["15"]=array('110504',"ajout du support de nom de catégorie dans le module 'tag_arts' et 'usertag_arts' de sorte à... obtenir les articles ayant pour tag le nom de la rubrique en cours.
Cela permet la génération de catégories floues !");
$program_updates_1105["16"]=array('110505','amélioration substantielle du sélecteur de typos : sélection par catégories, par famille, par accents et par favoris, affichage des tailles, toutes ces options étant commutatives');
$program_updates_1105["17"]=array('110505',"ajout d'une centaines de typos de la famille 'myfonts.com'");
$program_updates_1105["18"]=array('110506',"création d'une nouvelle base de données microsql 'server' destinée à concerner tous les hubs d'un site sans pour autant être affecté par les mises à jour (contrairement à 'system'");
$program_updates_1105["19"]=array('110506',"sophistication du fonctionnement des typos : elles sont référencées dans une table publique qui arrive dans 'system/edition_typos', puis cette table doit être copiée dans 'server/edition_typos' depuis le nouvel onglet dans admin/builders/fonts ; passer par là permet d'informer la table en fonction des polices présentes sur le serveur et d'alimenter la table avec des typos qui appartiennent seulement à l'utilisateur.");
$program_updates_1105["20"]=array('110507',"prise en compte des vidéo flv lors du transport d'article entre deux sites philum ; correctif sur l'import en passant par 'rss1' : un nouvel indicateur d'option de lecteure 'nlb' ('nl' pour newsletter sert à produire des url absolues) 'nlb' fait la même chose mais spécifie que l'article est en mode 'preview=full' ;");
$program_updates_1105["21"]=array('110508',"ajout d'un sélecteur qui permet de choisir la condition à affecter à un nouveau module, afin d'éviter d'avoir à le faire après coup, car la condition en cours n'est pas forcément celle à laquelle on destine le nouveau module");
$program_updates_1105["22"]=array('110508',"renommage des connecteurs :binvalues et :graph en msql_bin et msql_graph ; création d'un gestionnaire pour sélectionner la base d'après des syntaxes qui peuvent être confuses (le 4ième élément peut être une ligne ou un indicateur) ; création des connecteurs :msql_html et :msql_count, le premier pour renvoyer un rendu html des connecteurs qui sont dans les données de la table, le second, juste pour renvoyer le nombre d'objets de la table (très utile !)");
$program_updates_1105["23"]=array('110508',"ajout d'une distinction élémentaire permettant de considérer des signes < et > comme n'étant pas les objets d'une balise, au moment de l'importation");
$program_updates_1105["24"]=array('110509',"ajout d'un champ de post-traitement des articles nommé 'linenolink' : 'del-link' était capable de suprimer un lien contenant des caractères attendus, 'linenolink' est capable de supprimer un lien inattendu en conservant le contenant à un numéro de ligne connu. (les noms des auteurs d'articles sont parfois liés à une page sans aucun intérêt)");
$program_updates_1105["25"]=array('110509',"ajout du support font-face qui permet d'affecter la nouvelle définition à une classe css existante, plutôt que d'avoir à aller ouvrir un panneau et y coller manuellement le nom de la typo");
$program_updates_1105["26"]=array('110510',"abandon de la classe 't' (titres) lors de l'importation au profit des h2, h3 (c'est très important que la mise en forme soit confiée à html et que les css ne servent qu'à la pagination)");
$program_updates_1105["27"]=array('110512',"apparition de 'radio', système de lecture audio par playliste administrée dans une base microsql :
- construction de la playliste d'après un répertoire ;
- redimensionnable ;
- exportable ;
- algorithmes déductifs ; 
- défilement auto ;
- support d'information connexe à chaque fichier audio (texte, images) ;
- ergonomique ;");
$program_updates_1105["28"]=array('110512',"rétroinjection de nouvelles avancées techniques dans 'jukebox' : défilement auto amélioré (fonction infinie), scroller remanié (pureté de l'écriture)");
$program_updates_1105["29"]=array('110515',"fonction array_flip_b qui fabrique les index (array_flip de php écrase les index identiques) ;
function array_keys_r qui vide une colonne d'un tableau multidimensionnel (array_keys de php ne prend pas en compte les tableaux multidimensionnels) ;
fonction commune (librairie) de recherche de table microsql ;");
$program_updates_1105["30"]=array('110516',"ajout du connecteur 'ted.com' dans l'onglet 'medias'");
$program_updates_1105["31"]=array('110517','ajout de 400 typos, minutieusement classées');
$program_updates_1105["32"]=array('110518','amélioration de la gestion des typos : possibilité de les classer sur place et de créer des catégories, moteur de recherche, petites réparations');
$program_updates_1105["33"]=array('110519',"intervention dans 'treat_links' pour qu'il soit capable (lors de l'importation d'article) de conserver le contenu d'un lien de type javascript (où donc, rien n'est à prendre en compte)");
$program_updates_1105["34"]=array('110520',"amélioration présentation du menu admin ; apparition d'un embryon de menu de gestion de l'admin sur place pour accéder rapidement aux fonctions courantes, comme la console, newsletter, restrictions, space_disk, hubs et css");
$program_updates_1105["35"]=array('110521',"renommage des catégories des modules qui servent à n'afficher que celles qui sont compatibles avec le type de bloc de modules ; réaffectation de certaines devenues entre temps capables d'être affichées à d'autres endroits");
$program_updates_1105["36"]=array('110522',"le module 'best_arts' est renommé 'most_read' (il faut mettre à jour la console) ; 'most_read' est plus puissant, capable de prendre en paramètre le nombre de jours et le nombre d'articles du rendu, et capable de les faire s'assembler par le tronc logiciel central, avec les commandes habituelles (scroll, cols ou articles)");
$program_updates_1105["37"]=array('110523',"rénovation du connecteur 'rsstwitter' qui est renommé 'twitter' : ne demande en paramètre que le mot-clef au lieu du flux rss entier, et le flux est rafraîchi toutes les 5 secondes ; 
- ajout du module 'twitter' qui relaie le connecteur du même nom mais en laissant la possibilité  de régler manuellement les paramètres, la commande 'scroll' et l'option 'autorefresh'");
$program_updates_1105["38"]=array('110524',"le module 'twitter' étant désormais capable de se rafraîchir toutes les n secondes :
ajout du plug-in 'twitter' qui ne fait que reprendre les fonctions existantes de 3 pages, de sortes à n'appeler que 9Ko à chaque appel au lieu de 113Ko.
Sur notre serveur, le test a montré que le temps de chargement était de 1/100 de seconde par tranche de 40Ko.");
$program_updates_1105["39"]=array('110524',"ajout du connecteur html 'code' (balise)");
$program_updates_1105["40"]=array('110524','amélioration du lecteur twitter : conformité des liens @ et # (hashtags), modification du template twitter ;');
$program_updates_1105["41"]=array('110524',"admin/update offre désormais aux utilisateurs de niveau 6 d'être tenu informé des mises à jour");
$program_updates_1105["42"]=array('110525',"les nouveaux commentaires sont signalés à l'admin par mail");
$program_updates_1105["43"]=array('110525',"les rédacteurs (niveau 3) ne peuvent plus modifier leur article une fois qu'il a été publié par un utilisateur de niveau >4");
$program_updates_1105["44"]=array('110525','les rédacteurs reçoivent par mail les commentaires à leur article');
$program_updates_1105["45"]=array('110525','les rédacteurs reçoivent un mail de confirmation quand leur article a été publié (qui dépend de la langue, éditable dans msql/lang/?/help_txts/published_art)');
$program_updates_1105["46"]=array('110525',"remise à niveau du bouton 'twitter', qui permet de faire circuler un article (twitter ayant changé son fonctionnement)");
$program_updates_1105["47"]=array('110526',"possibilité d'appeler des connecteurs :/n (où n est un nombre) en plus de :/2 et :/3 (largeur de colonne par rapport au bloc courant) ;
rénovation de :2cols et :3cols (texte sur plusieurs colonnes) pour accepter les petits textes (sans sauts de lignes)
suppression des classes htab et htab 3 ;");
$program_updates_1105["48"]=array('110527',"meilleure gestion des ancres non reconnues : préparation des données pour application du filtre 'auto_anchors'");
$program_updates_1105["49"]=array('110528','ajout du support de transport groupé : les fichiers multiples sont stockés en .tar.gz et décompactés à leur arrivée ;
désormais le transport des typos par updates est disponibles (aux formats .woff, .oet et .svg)');
$program_updates_1105["50"]=array('110529',"correctif d'éradication des apostrophes typographiques ;
gestion globale des systèmes de protection des caractères joker de mysql (dont les apostrophes)");
$program_updates_1105["51"]=array('110529',"empêcher l'affichage des colonnes en mode preview");
$program_updates_1105["52"]=array('110530',"- les transports de fichiers se font au format .gz : gain de fiabilité et de vitesse lors des mises à jour ;
- la fonction 'update_all' transporte les fichiers récents au format GNU .tar.gz : la mise a jour du logiciel peut devenir entièrement automatique");
$program_updates_1105["53"]=array('110531',"mise à niveau de l'installaeur avec les nouveaux protocoles de transport de données : l'ensemble du logiciel se télécharge sur le serveur d'une traite.");

?>