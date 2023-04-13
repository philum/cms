<?php //msql/program_updates_1109
$r=["_menus_"=>['day','txt'],
"1"=>['110901','ajout du composant Flash \'viewer\' qui est appelÃ© lors de l\'affichage d\'une image en popup: permet de passer en plein Ã©cran, zoomer et naviguer dans l\'image'],
"2"=>['110902','ajout du connecteur \':pdf\' qui ouvre un lecteur PDF'],
"3"=>['110902','amÃ©lioration de embed_p : h3, table, blockquote, ul, li et div n\'engendrent plus de balise p impromptues (que le navigateur ignore)'],
"4"=>['110903','rÃ©vision de procÃ©dure (retour Ã  celle d\'il y a deux semaines!) le connecteur \':codeline\' est supprimÃ© puisque ses apparats suffisent Ã  faire le job (donc tout va bien, le codeline est parfaitement compatible avec les connecteurs)'],
"5"=>['110904','application de rÃ©visions de p_balise, de maniÃ¨re Ã  conserver un contenu neutre pendant les itÃ©rations jusqu\'au traitement en sortie : les retour Ã  la ligne simple sont respectÃ©s quelle que soit le traitement subi'],
"6"=>['110904','changement radical mais avec peu d\'effets observÃ©s, du fonctionnement du dÃ©compacteur de connecteurs, et de la gestion de ses emplacements (intervertis pour plus de clartÃ© dans le code) : valueÂ§param:connector, et par dÃ©faut la donnÃ©es Ã  gauche est considÃ©rÃ©e comme value\' (et comme \'param\' en basic) ce qui peut produire \'valueÂ§1/2/3:connector\' - c\'est seulement pour les connecteurs auto (.swf) que la dimension s\'Ã©crit Ã  gauche : \'w/hÂ§name.swf\''],
"7"=>['110905','pour de multiples modules MenusJ sur une page, aucun ne doit Ãªtre en cache, donc cette option est supprimÃ©e ;
le paramÃ¨tre nbdays de \'articles\' s\'enrichit : 1-7 signifie de 1 Ã  7 jours'],
"8"=>['110906','ajout d\'un Ã©diteur de scripts de modules, pour les modules \'MenusJ\' et \'tab_mods\', et le connecteur \':ajax\' qui reÃ§oit en paramÃ¨tre la mÃªme instruction.'],
"9"=>['110907','ajout d\'une restriction 15 pour rendre optionnel le captcha des commentaires'],
"10"=>['110907','amÃ©liorations graphiques'],
"11"=>['110912','unification en tronc commun des requÃªtes ajax'],
"12"=>['110912','profonde rÃ©vision du codeline basic qui va supporter les variables non dÃ©clarÃ©es, rendre les connecteurs \"objets\", et capable d\'utiliser les fonctions du Core.'],
"13"=>['110912','ajout d\'une prÃ©visualisation et d\'un sÃ©lecteur des fonctions du Core dans l\'Ã©diteur d\'objets tels que les templates, les connetceurs et les modules utilisateur'],
"14"=>['110913','certification du codeline basic, un langage diffÃ©rent du codeline (qui sert Ã  la pagination) orientÃ© \"machine\" (qui peut Ãªtre gÃ©nÃ©rÃ© par une). Sa forme a Ã©tÃ© revue en profondeur, l\'Ã©norme bond en avant Ã©tant dÃ» au fait que Ã§a permette une rÃ©elle programmation en utilisant des tableaux de donnÃ©es, et surtout en accÃ©dant Ã  une centaine de fonctions qui appartiennent au noyau de philum'],
"15"=>['110913','on peut tester le codeline sur place sans avoir Ã  l&#146;enregistrer
arrivÃ©e des menus \'core\' et \'preview\''],
"16"=>['110914','les connecteurs utilisateur ont la propriÃ©tÃ© d\'Ãªtre des inserts si ils ne sont appliquÃ©s Ã  aucun texte sÃ©lectionnÃ© (Ã§a facilite l\'usage qui consiste Ã  insÃ©rer une note rÃ©currente)'],
"17"=>['110914','on peut sÃ©lectionner les bases publiques ou privÃ©es quand on Ã©dite les connecteurs ou modules personnalisÃ©s'],
"18"=>['110915','intÃ©gration du clbasic ;
ajout de boutons d\'Ã©dition pour le clbasic ;
bouton \'make_public\' pour publier des connecteurs'],
"19"=>['110916','clbasic capable de sauver des rÃ©sultats dans des variables et de les restituer dans des commandes'],
"20"=>['110917','ajout du connecteur \':articles\', qui reproduit le module \'articles\' qui est trÃ¨s puissant. 
retire l\'article en cours des rÃ©sultats de la requÃªte.'],
"21"=>['110917','le bouton du connecteur \'module\' profite du nouvel Ã©diteur d\'appel Ã  distance des modules'],
"22"=>['110917','petite rÃ©novation des tables des connecteurs'],
"23"=>['110918','Ã©diteur msql coupe les tables par pages'],
"24"=>['110918','mise Ã  jour table program_core (179 functions)'],
"25"=>['110919','ajout de l\'onglet \'connecteurs\' dans l\'Ã©diteur codeline'],
"26"=>['110919','suppression des connecteurs :pub1, pub2 et pub3, dÃ©sormais :pub supporte ces options [IDÂ§4:pub] renvoie un simple lien ; ils restent opÃ©rationnels le temps d\'entrer en dÃ©suÃ©tude'],
"27"=>['110920','ajout d\'un moyen d\'Ã©diter le contenu d\'un article bloquant : les articles qui font appel Ã  eux-mÃªmes ou Ã  leur parent dans leur contenu peuvent bloquer l\'affichage ; dans ce cas on peut dÃ©sormais Ã©diter l\'article au format brut dans l\'admin'],
"28"=>['110920','ajout de l\'aide Ã  l\'Ã©dition des scripts mis en paramÃ¨tre au module (et au connecteur) \':articles\'. la rÃ©daction du script renvoie ensuite vers l\'Ã©diteur de rÃ©daction du module'],
"29"=>['110920','finalisation des Ã©diteurs de scripts de modules (correctifs, mise en conformitÃ© : les modules successifs sont sÃ©parÃ©s par un \',\' et plus par un \'|\''],
"30"=>['110921','amÃ©lioration du module twitter pour qu\'il affiche l\'image de la tÃªte des gens qui parlent'],
"31"=>['110921','la simulation de la pagination de la console des modules a Ã©tÃ© revue'],
"32"=>['110925','ajout du support livestream dans les vidÃ©os : indiquer juste le nom de la chaÃ®ne'],
"33"=>['110925','remise Ã  niveau du lecteur de modules utilisateur pour joindre cbasic();
un module public nommÃ© \'streams\' permet de joindre une chaÃ®ne livestream dans un module'],
"34"=>['110926','par Ã©conomie le sÃ©lecteur dÃ©signe comme miniature la premiÃ¨re image de la liste (et ne cherche plus les suivantes), ce qui permet de n\'avoir aucune miniature Ã  l\'article si on place un Ã©lÃ©ment vide au dÃ©but de la liste : \'//image...\' ;
par surprise, l\'aspirateur d\'image mettait les png en jpg ce qui provoquait des problÃ¨mes de construction de miniatures'],
"35"=>['110927','google.video, youtobe, dailymotion et livestream sont reconnus et renvoie directement la syntaxe de vidÃ©o dÃ©jÃ  rÃ©digÃ©e ; on peut ajouter des vidÃ©os en un clic (import)']];