<?php
//philum_microsql_program_updates_1112
$program_updates_1112["_menus_"]=array('day','text');
$program_updates_1112[1]=array('111201',"- bouton twitter envoie titre bien formaté
- modif template (bouton open float right)
- icônes non réécrites si dimensions inférieures à la celle des miniatures, dans l'inspecteur d’icônes, dans l'éditeur
- icônes accessibles depuis l'éditeur externe");
$program_updates_1112[2]=array('111202',"- une idée surgie soudainement a permit d'accélérer encore la vitesse du moteur de recherche de 1/3 sur les très gros volumes ;
- un choix prit permet de faire que les articles d'une catégorie prise comme condition pour un design particulier héritent de ce design (c'est plus drôle que l'inverse)");
$program_updates_1112[3]=array('111203',"introduction d'un plugin 'text' présenté par un post-it qui permet de prendre des notes à la volée");
$program_updates_1112[4]=array('111204','réforme du système des popup en ajax, progrès, fiabilité, précision... et révision des écritures devenues obsolètes (35 lignes de code supprimées)');
$program_updates_1112[5]=array('111205',"révision du viewer qui permet d'afficher une image trop grande en plein écran : le zoom est accessible avec la roulette sans avoir à se mettre en plein-écran.");
$program_updates_1112[6]=array('111207',"ajout d'un restriction à la possibilité d'étendre le contexte 'cat' dans 'art' nommée 'herit_cat' (20)");
$program_updates_1112[7]=array('111208',"réforme de la nomination de la priorité des articles : au début 'Une', puis ensuite 'Stay' étaient des nominations maladroites. La priorité des articles est désormais reconnue par les termes '*', '**', voire '***'. Au niveau du sitemap, rien ne change, aucun argument renvoie 1, '*' renvoie 5 et '**' renvoie 10.");
$program_updates_1112[8]=array('111208',"correctif d'un imbroglio avec le système de protection des caractères spéciaux lors des transactions javascript (souvent le trop simple est l'ennemi du fonctionnel)");
$program_updates_1112[9]=array('111209',"- ajout du module 'plug' qui sert à appeler un plugin, comme avec le connecteur ':plug'
- ajout du plugin 'favs' qui permet au visiteur de mémoriser une liste d'articles ;
- structure améliorée de l'intégration du plugin : un élément du plugin peut être ajouté aux options proposées par l'article, si la variable de session 'plgs' est utilisée.
- abolition de l'usage de 'display:block' dans les css:link (à part la déco, ça empêche trop de choses)");
$program_updates_1112[10]=array('111210',"- condamnation d'une clique de fonctions préhistoriques (10Ko), supplantées par les routines microsql, auxquelles font désormais référence les tables mails, rss et url ;
- réorganisation des menus de l'admin");
$program_updates_1112[11]=array('111211',"petites améliorations dans l'admin microsql : fonctionnements, aides, présentation");
$program_updates_1112[12]=array('111212',"intégration de l'éditeur de nouvelles définitions de sites dans l'éditeur d'articles (de façon un peu brutale), et d'un bouton 'edit' quand ces définitions existent, de façon à réaliser ces opérations sur place quand se présente le cas d'une importation d'article dont les définitions sont inexistantes. Elles sont créées à la volées, vierges, prêts à être éditées.");
$program_updates_1112[13]=array('111215',"ajout du support de priorité des articles, de façon à ne plus avoir à loger cette information parmi les tags. 
- la priorité se définit dans les méta de l'article
- le module 'articles' accepte un paramètre supplémentaire : 'priority=0-4' : 
A zéro l'article est hors-ligne, à 1 l'article est publié normalement, les trois niveaux supérieurs (2, 3, 4) confèrent une priorité de 5,7 et 10 dans sitemap.
- ajout du module 'priority_arts', param 0-4");
$program_updates_1112[14]=array('111216',"ajout du bouton 'img' dans l'éditeur d'articles, qui permet de :
- placer une image connue du portfolio dans l'article ;
- uploader une image
- importer une image depuis une url ");
$program_updates_1112[15]=array('111216',"ajout d'un gestionnaire de création de tableaux en ajax, beaucoup plus pratique que l'antique système d'alertes en série (30 lignes supprimées, 20 ajoutées) ;
usage: indiquer le nombre de colonnes et de lignes, remplir les cases, et 'insert'.");
$program_updates_1112[16]=array('111217',"l'assistant du connecteur :video désormais capable de recevoir l'url complète au lieu de l'ID (trop long à expliquer ce qu'est l'ID), l'ID est extrait et le connecteur inséré dans le texte");
$program_updates_1112[17]=array('111218',"- ajout param 4 et 5 dans SaveJ, 4 renvoie la value, 5 insert() le résultat (utilisé par l'assistant du connecteur video)
- réparation de l'assistant de rédaction de commande d'articles en série
- support de uftlatin dans js");
$program_updates_1112[18]=array('111218',"- ajout d'un gestionnaire de plugins (program_plugs), qui permet d'affecter des types de plugin, de façon à rendre disponibles ceux qui sont spécifiquement destinés à être utilisés par le connecteur ':plug'.
- index des types de plugins dans la table program_plugs_type ;
- types de plugin : 
external	call directly the page
system	used by software
plug	connector [value§param:plug]
module	used by module
plgbtn	added in options of each articles
callable	iframe src : /plug/index.php?call=plugin&p=param&o=option
server	client-server application
internal	php library
dev	php example");
$program_updates_1112[19]=array('111219',"- nouveaux boutons plus pratiques que le menu déroulant pour désigner la priorité d'un article ;
- nouveau patch 'priority' programmé pour le 111220 qui va convertir les *, **, et *** en niveau de priorité ;
- module 'board' réécrit pour faire apparaître les articles en fonction de leur niveau de priorité ;
- emplacement 'priority' dans l'article ;
- video_viewer capable de discerner le type de tri (cat, tag, priority) ;");
$program_updates_1112[20]=array('111220',"- popup déplaçable (dev) ;
- popup fixée à l'écran quand c'est pour afficher des images plein-écran (option d'appel ajax=1) ;
- ajout du connecteur 'popmsq', fonctionne comme 'poptxt' ou 'popread', renvoie le contenu d'une entrée msql dans une popup (permet d'afficher un contenu du calepin)
- petite réparation SliderJ qui n'arrivait pas à afficher la dernière image (ajout d'une marge d'erreur) ;");
$program_updates_1112[21]=array('111220',"réforme du commentaire d'images, ([img§txt]) renvoie désormais un simple lien vers l'image en popup, au lieu d'une image avec un commentaire. Pour commenter une image, c'est mieux d'utiliser le blockquote.");
$program_updates_1112[22]=array('111221',"- ajout du connecteur ':comment' qui permet d'ajouter un commentaire à une image : [img§txt:comment]
- le texte et l'image sont placés à l'intérieur d'un div de la largeur de l'image.
- utilise une nouvelle définition css 'blocktext'
- ajout de 'blocktext' dans le design par défaut");
$program_updates_1112[23]=array('111222',"- réparation connecteur :comment pour les images de taille intermédiaire ;
- réparation taille de l'image renvoyée en popup par un lien ;
- réapparition du bouton 'fermer' sur l'image en popup pour se sortir des erreurs possibles (impossibles en fait mais on sait jamais)
- le connecteur [--] ne renvoie plus de class='tabc', le hr se gère dans le css
- correctif tableaux : ne pas afficher de lignes vides ;
- ajout de tr et td au design par défaut (updater le design courant) ;
- petite amélioration import vidéo
- le connecteur :comment accepte de n'être pas lié à une image, dans ce cas il se souvient de la largeur de l'image précédente.");
$program_updates_1112[24]=array('111223',"- amélioration sliderJ pour permettre de reconstruire les tabbles en mode manuel ;
- correctif suppression des espaces indésirables dans l'interprétation des tableaux ;
- correctif détection sites philum dans l'auto-updater de définitions de sites ;
- les stats affichent le résultat de la recherche (avant il était dans le graphique mais disparaissait dans les graphiques trop denses)
- ajout du module 'stats' qui renvoie un histogramme");
$program_updates_1112[25]=array('111224',"- le connecteur 'articles' (qui renvoie vers le module du même nom) accepte trois paramètres en plus, de quoi utiliser un template personnalisé (on en a eu besoin pour pouvoir générer un texte au format spip)
- réinitialisation des sessions inattendues lors du passage d'un 'mod' à l'autre (mode GSM notamment)
- ajout d'une petite somme d’icônes en 16px");
$program_updates_1112[26]=array('111226',"- ajout d'un menu des variables existantes dans l'éditeur de templates
- réforme du nom 'textarea_1' qui était antique pour 'txtarea' (commodité de dev)
- ajout du plugin 'dev' visible dans admin/code (auth 7), permet de d'éditer le code php, et de sauvegarder des versions dans 'history' (version beta)");
$program_updates_1112[27]=array('111227',"- l'ajout de définitions à la volée n'affiche plus que la partie utile
- nettoyage javascript : fédération, suppressions et renommages
- fonction 'toggle' plus élaborée, sur le modèle SaveJ (qui est la star) et application à divers endroits");
$program_updates_1112[28]=array('111228',"- ajout du filtre 'lowcase' qui met le texte sélectionné en minuscules et la première lettre en majuscule
- accessibilité des menus dans le plugin 'dev' (admin/code)");
$program_updates_1112[29]=array('111229',"- refonte règles internes de transport en js
- mise en conformité des nouveaux protocoles dans le plugin 'dev'");

?>