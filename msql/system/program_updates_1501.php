<?php //msql/program_updates_1501
$r=["_menus_"=>['date','text'],
"1"=>['0101','publication'],
"2"=>['0101','- correctifs comportement msql_read, boot des plugins, assistant de crÃ©ation de connecteurs
- correctifs liÃ©s Ã  de rÃ©cents correctifs... format d\'up-date
- les modules systÃ¨me desktop et apps sont devenus obsolÃ¨tes
- rÃ©glage fin du comportement de moteur de rendu des connecteurs, visant Ã  contrÃ´ler prÃ©cisÃ©ment les sauts de lignes (balises p vides inattendues) et les erreurs dÃ©coulant de ces contrÃ´les lors de l\'imbrication (pas moyen de faire autrement ou alors on fait rien !)'],
"3"=>['0103','- correctifs comportement de css_builder lors de l\'application d\'un css au module system design, et lors de la suppression d\'une def css'],
"4"=>['0107','- correctifs comportement des miniatures (loadÃ©es en preview=1) et du formulaire de commentaires'],
"5"=>['0108','rstr87: empty mini'],
"6"=>['0113','mise Ã  niveau de msq_link()'],
"7"=>['0114','- amÃ©lioration du sÃ©lecteur html-ajax (callback active, plus modulaire, plus usitÃ©)
- rstr10 (parent auto) est un peu dÃ©prÃ©ciÃ© : ajout de sÃ©lecteurs d\'articles parent
- les articles ayant des enfants s\'ouvrent en preview=2
- rstr35 est ajustable localement : contrÃ´le utilisateur de l\'Ã©tat de preview de l\'article'],
"8"=>['0115','- correctifs manager msql
- usage de stripslashes_b()
- ajout du connecteur :data, helloÂ§1:data ajoute hello Ã  la clef 1, et 1:msq_data revoie hello.
- ajout du connecteur :twit, affiche un twit et l\'enregistre comme data d\'article'],
"9"=>['0116','correctifs admin msql, gestion des tables ouvertes au public ; les tables publiques regroupent les tables utilisÃ©es par les plugin, ainsi incluses dans les maj'],
"10"=>['0117','- petit changement de protocole de microxml (on ne peut plus faire plus simple)
- fix error quand les apps publiques sont dÃ©sactivÃ©es'],
"11"=>['0118','- rÃ©paration dÃ©tection du module courant, dans le process de crÃ©ation de boutons de menu'],
"12"=>['0119','- petite rÃ©forme de la date : ymd.hi (simple point)
- remise Ã  niveau du bouton \'propose\' dans msql, intÃ©gration aux nouveaux composants (trÃ¨s pratique)
- amÃ©lioration du protocole de l\'url msql (murl) : base/(lang)/prefix_table_version-line|col
- fix pb sÃ©lecteur de version de table'],
"13"=>['0120','- rÃ©novation du notepad (fonctionnement, design)'],
"14"=>['0121','- correctif gestionnaire connecteur image linkÃ©e Ã  une image, renvoie la 2iÃ¨me dans une popup'],
"15"=>['0123','- rÃ©novation (interne) de l\'Ã©diteur principal
- module :pub rejoint connecteur :pub (avait Ã©tÃ© rendu obsolÃ¨te)
- (nouveau) connecteur :msql, va remplacer les autres Ã  terme, utilise une nouvelle manoeuvre
- correctif fonctionnement des sÃ©lecteurs ajax dans un viex formulaire en dur'],
"16"=>['0125','- rÃ©forme du chemin des plugins appelÃ©s de l\'extÃ©rieur'],
"17"=>['0126','- nouveau sÃ©lecteur ajax bubs, select_jb(), qui fonctionne via le moteur de bubbles : capable de recevoir des donnÃ©es ou des commandes vers des donnÃ©es ; capables de menus hiÃ©rarchiques, gestion UI system (triggers d\'affichage)'],
"18"=>['0127','- fix pb de stabilitÃ© des restrictions (nettoyage des anciennes)
- ajout d\'un autre nouveau type de menus bubble ajax, select_j(), avec sa classe dÃ©diÃ©e. passe par le moteur menuder_j, comme select_jb(), pour gÃ©nÃ©rer ses tableaux d\'aprÃ¨s des commandes'],
"19"=>['0128','- amÃ©lioration du systÃ¨me de flags, ajout des drapeaux de tous les pays, maj de la table associÃ©e, affichage dans la var \'lang\' des articles
- ajout du filtre \'mktable\', convertit csv en table
- ajout du support csv dans msql
'],
"20"=>['0129','- nombreux fixes dÃ»s aux gros changements rÃ©cents (root des plugs, propagation des mises Ã  jour)
- meilleure gestion des images d\'un lien (si c\'est une vignette, importe et affiche la grande)
- fix pb images dans tracks
- nouveau importateur secondaire d\'images qui demandent un header'],
"21"=>['0130','- on rebascule le pointeur de ligne de msql vers \':\' au lieu de \'-\', plus frÃ©quent dans les urls
- suppression expÃ©rimentale du devenu antique jc()
- fix pb article non publiÃ© s\'affiche dans les sous-articles
- indÃ©pendance des modules menus de la div menu 2/3 : modif css globaux
- amÃ©lioration ui de togpub 
- fix artmod->usertags'],
"22"=>['0131','- maintenance des commandes tabmods et menusJ du module artmod
- ajout d\'une recherche imbriquÃ©e article-thÃ¨mes-articles dans un menu \'seek\', via les bubs (sera plus facile d\'amener les articles liÃ©s Ã  un second ou troisiÃ¨me niveau de relations)']];