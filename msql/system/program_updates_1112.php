<?php //msql/program_updates_1112
$r=["_menus_"=>['day','text'],
"1"=>['111201','- bouton twitter envoie titre bien formatÃ©
- modif template (bouton open float right)
- icÃ´nes non rÃ©Ã©crites si dimensions infÃ©rieures Ã  la celle des miniatures, dans l\'inspecteur d\'icÃ´nes, dans l\'Ã©diteur
- icÃ´nes accessibles depuis l\'Ã©diteur externe'],
"2"=>['111202','- une idÃ©e surgie soudainement a permit d\'accÃ©lÃ©rer encore la vitesse du moteur de recherche de 1/3 sur les trÃ¨s gros volumes ;
- un choix prit permet de faire que les articles d\'une catÃ©gorie prise comme condition pour un design particulier hÃ©ritent de ce design (c\'est plus drÃ´le que l\'inverse)'],
"3"=>['111203','introduction d\'un plugin \'text\' prÃ©sentÃ© par un post-it qui permet de prendre des notes Ã  la volÃ©e'],
"4"=>['111204','rÃ©forme du systÃ¨me des popup en ajax, progrÃ¨s, fiabilitÃ©, prÃ©cision... et rÃ©vision des Ã©critures devenues obsolÃ¨tes (35 lignes de code supprimÃ©es)'],
"5"=>['111205','rÃ©vision du viewer qui permet d\'afficher une image trop grande en plein Ã©cran : le zoom est accessible avec la roulette sans avoir Ã  se mettre en plein-Ã©cran.'],
"6"=>['111207','ajout d\'un restriction Ã  la possibilitÃ© d\'Ã©tendre le contexte \'cat\' dans \'art\' nommÃ©e \'herit_cat\' (20)'],
"7"=>['111208','rÃ©forme de la nomination de la prioritÃ© des articles : au dÃ©but \'Une\', puis ensuite \'Stay\' Ã©taient des nominations maladroites. La prioritÃ© des articles est dÃ©sormais reconnue par les termes \'*\', \'**\', voire \'***\'. Au niveau du sitemap, rien ne change, aucun argument renvoie 1, \'*\' renvoie 5 et \'**\' renvoie 10.'],
"8"=>['111208','correctif d\'un imbroglio avec le systÃ¨me de protection des caractÃ¨res spÃ©ciaux lors des transactions javascript (souvent le trop simple est l\'ennemi du fonctionnel)'],
"9"=>['111209','- ajout du module \'plug\' qui sert Ã  appeler un plugin, comme avec le connecteur \':plug\'
- ajout du plugin \'favs\' qui permet au visiteur de mÃ©moriser une liste d\'articles ;
- structure amÃ©liorÃ©e de l\'intÃ©gration du plugin : un Ã©lÃ©ment du plugin peut Ãªtre ajoutÃ© aux options proposÃ©es par l\'article, si la variable de session \'plgs\' est utilisÃ©e.
- abolition de l\'usage de \'display:block\' dans les css:link (Ã  part la dÃ©co, Ã§a empÃªche trop de choses)'],
"10"=>['111210','- condamnation d\'une clique de fonctions prÃ©historiques (10Ko), supplantÃ©es par les routines microsql, auxquelles font dÃ©sormais rÃ©fÃ©rence les tables mails, rss et url ;
- rÃ©organisation des menus de l\'admin'],
"11"=>['111211','petites amÃ©liorations dans l\'admin microsql : fonctionnements, aides, prÃ©sentation'],
"12"=>['111212','intÃ©gration de l\'Ã©diteur de nouvelles dÃ©finitions de sites dans l\'Ã©diteur d\'articles (de faÃ§on un peu brutale), et d\'un bouton \'edit\' quand ces dÃ©finitions existent, de faÃ§on Ã  rÃ©aliser ces opÃ©rations sur place quand se prÃ©sente le cas d\'une importation d\'article dont les dÃ©finitions sont inexistantes. Elles sont crÃ©Ã©es Ã  la volÃ©es, vierges, prÃªts Ã  Ãªtre Ã©ditÃ©es.'],
"13"=>['111215','ajout du support de prioritÃ© des articles, de faÃ§on Ã  ne plus avoir Ã  loger cette information parmi les tags. 
- la prioritÃ© se dÃ©finit dans les mÃ©ta de l\'article
- le module \'articles\' accepte un paramÃ¨tre supplÃ©mentaire : \'priority=0-4\' : 
A zÃ©ro l\'article est hors-ligne, Ã  1 l\'article est publiÃ© normalement, les trois niveaux supÃ©rieurs (2, 3, 4) confÃ¨rent une prioritÃ© de 5,7 et 10 dans sitemap.
- ajout du module \'priority_arts\', param 0-4'],
"14"=>['111216','ajout du bouton \'img\' dans l\'Ã©diteur d\'articles, qui permet de :
- placer une image connue du portfolio dans l\'article ;
- uploader une image
- importer une image depuis une url '],
"15"=>['111216','ajout d\'un gestionnaire de crÃ©ation de tableaux en ajax, beaucoup plus pratique que l\'antique systÃ¨me d\'alertes en sÃ©rie (30 lignes supprimÃ©es, 20 ajoutÃ©es) ;
usage: indiquer le nombre de colonnes et de lignes, remplir les cases, et \'insert\'.'],
"16"=>['111217','l\'assistant du connecteur :video dÃ©sormais capable de recevoir l\'url complÃ¨te au lieu de l\'ID (trop long Ã  expliquer ce qu\'est l\'ID), l\'ID est extrait et le connecteur insÃ©rÃ© dans le texte'],
"17"=>['111218','- ajout param 4 et 5 dans SaveJ, 4 renvoie la value, 5 insert() le rÃ©sultat (utilisÃ© par l\'assistant du connecteur video)
- rÃ©paration de l\'assistant de rÃ©daction de commande d\'articles en sÃ©rie
- support de uftlatin dans js'],
"18"=>['111218','- ajout d\'un gestionnaire de plugins (program_plugs), qui permet d\'affecter des types de plugin, de faÃ§on Ã  rendre disponibles ceux qui sont spÃ©cifiquement destinÃ©s Ã  Ãªtre utilisÃ©s par le connecteur \':plug\'.
- index des types de plugins dans la table program_plugs_type ;
- types de plugin : 
external	call directly the page
system	used by software
plug	connector [valueÂ§param:plug]
module	used by module
plgbtn	added in options of each articles
callable	iframe src : /plug/index.php?call=plugin&p=param&o=option
server	client-server application
internal	php library
dev	php example'],
"19"=>['111219','- nouveaux boutons plus pratiques que le menu dÃ©roulant pour dÃ©signer la prioritÃ© d\'un article ;
- nouveau patch \'priority\' programmÃ© pour le 111220 qui va convertir les *, **, et *** en niveau de prioritÃ© ;
- module \'board\' rÃ©Ã©crit pour faire apparaÃ®tre les articles en fonction de leur niveau de prioritÃ© ;
- emplacement \'priority\' dans l\'article ;
- video_viewer capable de discerner le type de tri (cat, tag, priority) ;'],
"20"=>['111220','- popup dÃ©plaÃ§able (dev) ;
- popup fixÃ©e Ã  l\'Ã©cran quand c\'est pour afficher des images plein-Ã©cran (option d\'appel ajax=1) ;
- ajout du connecteur \'popmsq\', fonctionne comme \'poptxt\' ou \'popread\', renvoie le contenu d\'une entrÃ©e msql dans une popup (permet d\'afficher un contenu du calepin)
- petite rÃ©paration SliderJ qui n\'arrivait pas Ã  afficher la derniÃ¨re image (ajout d\'une marge d\'erreur) ;'],
"21"=>['111220','rÃ©forme du commentaire d\'images, (imgÂ§txt) renvoie dÃ©sormais un simple lien vers l\'image en popup, au lieu d\'une image avec un commentaire. Pour commenter une image, c\'est mieux d\'utiliser le blockquote.'],
"22"=>['111221','- ajout du connecteur \':comment\' qui permet d\'ajouter un commentaire Ã  une image : [imgÂ§txt:comment ]
- le texte et l\'image sont placÃ©s Ã  l\'intÃ©rieur d\'un div de la largeur de l\'image.
- utilise une nouvelle dÃ©finition css \'blocktext\'
- ajout de \'blocktext\' dans le design par dÃ©faut'],
"23"=>['111222','- rÃ©paration connecteur :comment pour les images de taille intermÃ©diaire ;
- rÃ©paration taille de l\'image renvoyÃ©e en popup par un lien ;
- rÃ©apparition du bouton \'fermer\' sur l\'image en popup pour se sortir des erreurs possibles (impossibles en fait mais on sait jamais)
- le connecteur [--] ne renvoie plus de class=\'tabc\', le hr se gÃ¨re dans le css
- correctif tableaux : ne pas afficher de lignes vides ;
- ajout de tr et td au design par dÃ©faut (updater le design courant) ;
- petite amÃ©lioration import vidÃ©o
- le connecteur :comment accepte de n\'Ãªtre pas liÃ© Ã  une image, dans ce cas il se souvient de la largeur de l\'image prÃ©cÃ©dente.'],
"24"=>['111223','- amÃ©lioration sliderJ pour permettre de reconstruire les tabbles en mode manuel ;
- correctif suppression des espaces indÃ©sirables dans l\'interprÃ©tation des tableaux ;
- correctif dÃ©tection sites philum dans l\'auto-updater de dÃ©finitions de sites ;
- les stats affichent le rÃ©sultat de la recherche (avant il Ã©tait dans le graphique mais disparaissait dans les graphiques trop denses)
- ajout du module \'stats\' qui renvoie un histogramme'],
"25"=>['111224','- le connecteur \'articles\' (qui renvoie vers le module du mÃªme nom) accepte trois paramÃ¨tres en plus, de quoi utiliser un template personnalisÃ© (on en a eu besoin pour pouvoir gÃ©nÃ©rer un texte au format spip)
- rÃ©initialisation des sessions inattendues lors du passage d\'un \'mod\' Ã  l\'autre (mode GSM notamment)
- ajout d\'une petite somme dÂicÃ´nes en 16px'],
"26"=>['111226','- ajout d\'un menu des variables existantes dans l\'Ã©diteur de templates
- rÃ©forme du nom \'textarea_1\' qui Ã©tait antique pour \'txtarea\' (commoditÃ© de dev)
- ajout du plugin \'dev\' visible dans admin/code (auth 7), permet de d\'Ã©diter le code php, et de sauvegarder des versions dans \'history\' (version beta)'],
"27"=>['111227','- l\'ajout de dÃ©finitions Ã  la volÃ©e n\'affiche plus que la partie utile
- nettoyage javascript : fÃ©dÃ©ration, suppressions et renommages
- fonction \'toggle\' plus Ã©laborÃ©e, sur le modÃ¨le SaveJ (qui est la star) et application Ã  divers endroits'],
"28"=>['111228','- ajout du filtre \'lowcase\' qui met le texte sÃ©lectionnÃ© en minuscules et la premiÃ¨re lettre en majuscule
- accessibilitÃ© des menus dans le plugin \'dev\' (admin/code)'],
"29"=>['111229','- refonte rÃ¨gles internes de transport en js
- mise en conformitÃ© des nouveaux protocoles dans le plugin \'dev\''],
"30"=>['111230','- le plugin \'dev\' mÃ©morise les pages ouvertes (ainsi que leur rÃ©pertoire) tandis que les fonctions utilisÃ©es sont listÃ©es dans le menu \'history\' ;
- connecteurs \'table\', \'table1\' et \'table2\' (1=en-tÃªte, 2=lignes diffÃ©renciÃ©es)
- relookings divers (chat, css, tableaux)
- bug connu : la largeur de colonne retourne Ã  \'content\' (par dÃ©faut) et y reste aprÃ¨s l\'usage d\'un \'MenusJ\' (incapable de connaÃ®tre son contexte Ã  cause de son indÃ©pendance fonctionnelle) ;'],
"31"=>['111231','- nettoyages dus aux prÃ©cÃ©dentes mutations, suppression de \'_mbr\' (rÃ©pertoire et rÃ©fÃ©rences dans le css, remplacÃ© par \'shadows\'), aides contextuelles ;
- finalement le connecteur microsql ne renvoie plus de tableau hors de la lecture de l\'article ;
- rÃ©novation des css, anciens inspirÃ©s de nouveaux ;
- correctif liÃ© au renouveau de la fonction tri_rqt (beaucoup de modules y font rÃ©fÃ©rence, fait des tri dans les articles en cache) ;']];