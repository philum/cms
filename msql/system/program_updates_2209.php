<?php //msql/program_updates_2209
$r=["_menus_"=>['date','text'],
"1"=>['0901','publication'],
"2"=>['0901','- mise au rancart de la clique de fonctions mysql de la lib, qui se situe dans l\'objet sql, hormis quelques alias restants'],
"3"=>['0902','- remplacement des dispositifs nÃ©vrosÃ©s de where dans sql par ceux, Ã©lÃ©gants, de fractal'],
"4"=>['0908','- ajout de la rstr145, permet d\'inverser le rÃ´le des connecteurs lors de l\'enregistrement des mÃ©dias. L\'absence de restriction laisse les mÃ©dias externes sauf s\'ils sont dotÃ©s (jeu de mot) de double dots (:). Active, la rstr aspire toutes les vidÃ©os sauf celles qui sont \"dottÃ©es\" (.mp4=>:mp4)'],
"5"=>['0909','- l\'Ã©numÃ©rateur peut prendre en compte des articles \"bis\"
- le moteur des apps (systÃ¨me d\'activation d\'actions) prend en charge la nouvelle colonne \"context\", comme les modules, qui limite la portÃ©e des objets au contexte [home,art,art,etc...]
- ajout de la rstr146, permet de limiter la portÃ©e du desktop Ã  la Home'],
"6"=>['0910','- les connecteurs antiques rss_art et rss_read (utilisant xml) sont remplacÃ©s par api_read, pour l\'instant implicitement vers un autre site philum.'],
"7"=>['0910','- correctif rÃ©affichage du nombre de pages dans le rÃ©sultat de l\'api quand on active une option qui change le nombre de rÃ©sultats (normalement en cache)
- introduction du dispositif swapbt, permet de faire un bouton dont l\'alternative s\'affiche au survol'],
"8"=>['0910','- un des callers pÃ©riphÃ©riques de l\'Api fait usage du principe json, comme le premier paramÃ¨tre qui reÃ§oit la commande, le deuxiÃ¨me reÃ§oit les modifications apportÃ©es Ã  la commande initiale. Ceci, Ã  la place d\'une liste interminable de variables additionnelles.'],
"9"=>['0913','- amÃ©lioration des rÃ©sultats de recherches complexes qui passent pas l\'Api, sensÃ©e savoir faire Ã§a, mais pas aussi spÃ©cialisÃ©e que le moteur de recherche dÃ©diÃ© : on peut creuser les recherches et cibler un titre d\'article.
- drame de la suppression des artefacts dÃ©suets : ajxg() et decuri() - on va voir l\'impact, api::callj passe par call2()
- mise en conformitÃ© d\'un lot de vieux plugs (25)
- expÃ©rience : suppression du forÃ§age qui consiste Ã  passer par utf8 dans les transactions ajax'],
"10"=>['0914','- Ã©limination des derniers artifices du joncteur \'app\', personne ne sait ce que Ã§a veut dire, mais c\'est la fin d\'une Ã©poque (servait Ã  appeler une app, alors que dÃ©sormais tout est une app)
- Ã©limination de l\'artefact \'pfunc\' qui permettait de joindre une masse de donnÃ©es d\'un plugin (pclass existe toujours)
- extermination, il semble, de tous les Ã©lÃ©ments du dispsitif, dÃ©sormais obsolÃ¨tes, \"plug\". On dit plus les plugs, mais les apps.
Reste encore Ã  unifier les \'apps\', nom donnÃ© aux boutons, avec les modules, pour faire disparaÃ®tre la confusion.'],
"11"=>['0916','- discernement entre l\'antique bal() et le from ff tag(), le premier consacrÃ© aux strings et le second aux params en forme de tableaux, afin d\'allÃ©ger la construction des tags, qui le mÃ©rite bien.
- amenuisement de la panoplie de fonctions quasi-redondantes vers input(), inputb() et les cons&oelig;urs divers lÃ©gitimes'],
"12"=>['0917','- suppression de l\'antique autoclic() et jholder(), pris en charge depuis longtemps par placeholder (mais Ã§a existait d\'avant)
- autres rÃ©formes des inputs, visant Ã  augmenter la rÃ©solution de la dÃ©finition des limites d\'usage
- reforme de microxml, qui a failli disparaÃ®tre mais il est encore lÃ  (api xml oldschool)
- correctifs des erreurs engendrÃ©es par la mutation de 68 instances du nouveau ljb()'],
"13"=>['0919','- comob de art::titles ; un comob consiste Ã  distinguer les commandes des objets ; en live : [https://www.youtube.com/watch?v=sKqkCKKXbv4]'],
"14"=>['0919','- Ã©limination des artefacts artopt et artag, remaniement de metart(), mk::lastup(), renommages, notamment styl->sty'],
"15"=>['0920','- suppression d\'artefacts \'plug\' dans apps
- suppression du point d\'entrÃ©e du dÃ©funt dispositif multipass (saveJ)
- expansion des nouveaux inputs sur les vieux
- concentration des processus auxiliaires vers les classiques, de faÃ§on Ã  Ã©liminer l\'hÃ©tÃ©rogÃ©nÃ©itÃ© de savetits, toggle() (processus j)
- rÃ©novation de savetits et calendar
- l\'indicateur \'k\' permet d\'envoyer en ajax via post les noms des clefs'],
"16"=>['0921','- rÃ©fection du panneau metas
- correctif prise en compte du niveau de permission d\'un article ; rÃ©daction d\'une sÃ©rie de niveaux de permissions publiques
- chasse Ã  une entitÃ© invisible qui laissait des sauts de lignes additionnels
- sÃ©paration du preview pour permettre aux autres process d\'en profiter
- tests de hacking et rÃ©demptions
- del2 sÃ©curisÃ© pour les process critiques
- affectation de img1 dÃ¨s le save (vignettes en cache)'],
"17"=>['0922','- fix enregistrement et dÃ©tection des traductions
- fix postreat png2jpg
- correctif parser de commande sql
- fix rss output- indicateur k dans la commabde ajax : permet de fournir le nom des clefs, habituellement signalÃ©es Ã  titre informatif dans un get, sans utilitÃ©'],
"18"=>['0923','- grosse gabegie de perte de config : amÃ©lioration du systÃ¨me de maintenance ; usage salvateur du nouvel indicateur \'k\' de ajax
- Ã©limination des artefacts plugin()
- rÃ©duction drastique du nombre de caractÃ¨res protÃ©gÃ©s dans le moteur ajax, destinÃ© Ã  ne recevoir que des paramÃ¨tres internes, le reste est en post'],
"19"=>['0924','- autre grosse gabegie de parallÃ©lisme entre la dev locale et la dev online
- rÃ©novation de la classe d\'installation des tables additionnelles (pas une bonne idÃ©e d\'avoir des tables prÃ©fixÃ©es et surnommÃ©es de surcroÃ®t)
- correctifs msqa
- fix en-tÃªtes json'],
"20"=>['0925','- suppression des derniÃ¨res portes \'plug\'
- fix ban searched num
- fix messagerie perso (dont Ã  l\'admin)
- rÃ©vision des tickets (inutiles)'],
"21"=>['0926','- patauge pour prÃ©parer le nouveau board qui remplacera la console
- apps devient desk
- mise Ã  jour des dÃ©fs des desks, suppression de raccourcis dans ajax
- fix search by post'],
"22"=>['0927','- nouveau point d\'accÃ¨s aux modules, au format connecteurs [p=1,t=titleÂ§btn:module]
- renommage des entrÃ©es build et batch
- suppression en passant des artefactes reqp() et plugin(), et des htaccess associÃ©s
- renommage de l\'entrÃ©e htaccess context=>page
- le nouveau board recevra des modules au format conn et construira des pages'],
"23"=>['0927','- nouveau point d\'accÃ¨s aux modules,
la plus ancienne Ã  la plus rÃ©cente Ã©criture fonctionnent :

//ouvre unmodule
[365:stats:module]
[p:365,m:stats:module:no]

//ouvre un bouton vers le module
[365,tg:popupÂ§bt:stats:module:no]
[m:stats,p:365,bt:btn,tg:popup:module:no]

avec :
m:module
p:param
t:title
c:context
d:disposition
...
tg:target

(au lieu de les avoir dans des params en chaÃ®ne comme p/t/c/d)

Il a Ã©tÃ© certifiÃ© que les params en chaÃ®ne sont rÃ©servÃ©s au systÃ¨me, et les params nommÃ©s Ã  l\'utilisateur.'],
"24"=>['0928','- nombreux correctifs dans la console de l\'admin
- application de la nouvelle porte des modules aux connecteurs
- introduction des modules MENU et ARTMODS, qui se comportent comme BLOCK
- nouveau comportement des modules-maÃ®tres (en majuscules) : peuvent contenir d\'autres modules itÃ©rativement
=> les modules MenusJ et art_mod pourront Ãªtre remplacÃ©s par le nouveau dispositif, plus lisible.
todo: faire pareil avec les menubub et autres modules d\'apps (devenu desk)
todo: faire marcher le dispositif
done: on peut placer des blocks dans des blocks pour crÃ©er une structure html'],
"25"=>['0929','- rÃ©habilitation de toute la chaÃ®ne applicative de comline, sensÃ©e disparaÃ®tre avec lles blocks rÃ©cursifs, mais quand mÃªme avant de la dÃ©brancher on veut juste, pour voir, la faire marcher avec les connmods (connecteurs appelant des modules).
- conversion de la colonne \'nobr\' des modules, inusitÃ©e, en \'bt\', pour activer nativement un bouton qui conduit au module. Cette commande peut ensuite Ãªtre activÃ©e par le logiciel ou l\'admin (3 entrÃ©es). (conversion sur toutes les tables, normalement on devrait faire un patch mais bon hein)'],
"26"=>['0930','- mise en fonctionnement du nouveau module itÃ©ratif MENU, de sorte qu\'il se comporte comme menusJ.
- installation de la clique de conversions entre les modules Ã©cris sous forme de connecteurs, de tableaux-systÃ¨mes et de tableaux Ã  clefs. Prise en charge des deux Ã©critures, celle du connecteur [p:a,t:bÂ§bt:module] et celle en provenance des modules : [m:module,p:a,t:b,bt:1], oÃ¹ le bt est tirÃ© du title.
- l\'effacement d\'un module itÃ©ratif enclenche une confirmation de l\'effacement de tous les modules associÃ©s.
- adaptation, pour l\'autre module contenant des sous-modules virtuels, comme menusJ (les modules itÃ©ratifs contiennent des modules objectifs), des branchements aux dispositifs posÃ©s.
- quelques fixs sur l\'app twit, veille sur le cache, correctifs'],
"27"=>['0930','exceptionnellement, la version 2210 est retardÃ©e de quelques jours le temps stabiliser les mutations opÃ©rÃ©es.']];