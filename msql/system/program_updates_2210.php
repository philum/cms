<?php //msql/program_updates_2210
$r=["_menus_"=>['date','text'],
"1"=>['1001','publication'],
"2"=>['1001','- les modules itÃ©ratifs sont bien plus plaisants Ã  l\'usage que les modules armÃ©s de sous-modules. Ce dispositif va Ãªtre retirÃ©.
- rÃ©habilitation de most-read, qui quitte l\'ancien protocole
- introduction de l\'option inline, contrairement Ã  cols elle affiche les blocs dans l\'ordre horizontal, c\'est plus prÃ©visible Ã  lire
- plusieurs modules sont condamnÃ©s Ã  court terme, jugÃ©s trop non-modulaires, et donc antiques
- suppression de l\'ancien dispositif art_mod (liÃ© aux articles courants) remplacÃ© par le module itÃ©ratif ARTMOD, avec son option \'tabs\''],
"3"=>['1002','- suppression des antiques val_to_mod et val_to_mod2, dont le rÃ´le est confiÃ© Ã  un jeu combinatoires avec le nouveau protocole connmod, mkmod etc.
- suppression des modules categories et categories2, et cat et catj deviennent \'categories\", en plus de \'category\' au singulier.
- suppression des tuyaux ajxlnk et ajxlnk2, supportÃ©s par callmod et playmod [oÃ¹ call et play dÃ©signent le but des donnÃ©es]
- l\'indicateur ajxlnk2 des modules de type line (condamnÃ©s) est remplacÃ© par un popmod
- suppression des processus de desk : ajxlnk, ajxlnk2, mod, module, remplacÃ©s par \'module\" : mÃ©canisme de call unifiÃ©
- bubs/adm_mod semble orphelin, mis en berne
'],
"4"=>['1002','- dans l\'admin, les boutons du menu ouvrent des popup, Ã§a donne de l\'air
- les vidÃ©os de plus de 100Mo dÃ©clenchent une conversion du format du lien, vers un connecteur spÃ©cialisÃ© qui Ã©vite l\'importation (:mp4 au lieu de .mp4)
- ajout d\'un convertisseur png2jpg Ã  l\'entrÃ©e des articles (des artistes), assumÃ© par la rstr147 ; et du bouton png2jpg (cleanup) dans l\'Ã©diteur de mÃ©tas. Les png sont convertis en jpg seulement si c\'est avantageux en terme de poids. Sioui, destruction de l\'original et propagation de la modif (article, deux catalogues et le cache), sinon, destruction du jpg.
- l\'ajout d\'articles dans le batch accepte des sÃ©ries de liens Ã  la ligne
- rÃ©paration de l\'Ã©mulateur de menusJ, bientÃ´t obsolÃ¨te (puisque Ã©mulÃ©), pour surligner les sÃ©lections. Le systÃ¨me de mise en cache du me sÃ©lectionnÃ© est abandonnÃ©.'],
"5"=>['1003','- rÃ©fection de l\'admin, isolation de processes, simplification, Ã©radication de vieilleries etc.
- nouveau menu admin alternatif (le premier est complet, le second est synthÃ©tique)
- introduction de l\'abstraction \'head\', qui permet d\'envoyer, en json, une suite d\'actions Ã  commettre sur les headers. Le but Ã©tait de permettre de lancer une multitude de modifs du header via des commandes en json. Sans succÃ¨s. Donc on reste Ã  une admin css qui active automatiquement le refresh, et qu\'il faut ensuite dÃ©sactiver manuellement.
- rÃ©forme scripturale de configmod (pas fini lol)'],
"6"=>['1004','- rssin est figÃ© sur la mÃ©thode 2
- rÃ©paration et mise en service de png2jpg en tant que rstr147. Ã§a marche bien. Les image importÃ©es sont de la plus petite taille possible.
- refonte de configmod (Ã§a a pirs trois jours), sur le modÃ¨le de art::titles(), lÃ  aussi en vidÃ©o : [https://www.youtube.com/watch?v=ZGc2fFVq7Vg]
- rÃ©paration impromptue du cache de sesmk2, prÃ©alablement bÃªtement inusitÃ© pour le cache des templates'],
"7"=>['1005','- suppression des modules : link, board, plan, hubs, menusJ, tab_mods, art_mode, collect_board, home_plan, arts_plan, see_hubs, user_menu, app_menu, msql_link, rub_taxo, br, hr, columns... dÃ©placÃ©s dans mdz (modules au rebus), pour un total de 12ko. Ces modules peuvent Ãªtre Ã©mulÃ©s avec d\'autres dispositifs.'],
"8"=>['1005','- correctif mini dirigÃ©es vers imgb au lieu de imgc
- ajout des dossiers css, bkg, ban dans imgb, et books, exec, dl, html, dl dans _datas, et modifs en consÃ©quences
- rÃ©fection du hangar Ã  submods, de toutes faÃ§ons tout ce principe va disparaÃ®tre
- rÃ©fection de addmod et confiscation de la mÃ©canique futile de catÃ©gories complexes \'whose_mod\'
- fix dÃ©placement de modules
- conversion de cur_div en une session de  classe
- dÃ©gazage massif du dispositif comline (submodules, assumÃ© dÃ©sormais par l\'itÃ©ration)'],
"9"=>['1006','- longue et pÃ©nible remise Ã  niveau vers une version stable, aprÃ¨s tous les changements rÃ©cents, jusqu\'Ã  arriver Ã  un stade oÃ¹ on pourra enfin faire ce qu\'on avait prÃ©vu de faire au dÃ©but
- rÃ©formes de ka jonction entre bubs et desk, comportement des sous-menus, rÃ©vision des tables d\'aprÃ¨s les nouveaux protocoles, etc.'],
"10"=>['1007','- deuxiÃ¨me journÃ©e de remise Ã  niveau des dÃ©rÃ©glages occasionnÃ©s par la mutation des protocoles, de modules et d\'appel des tables
- modj->categories
- todo: unifier les autres modules categories et crÃ©er  un constructeur de modules
- renommage des catÃ©gories de modules
- fix cohÃ©rence entre desk et bubs
- ajout d\'un playcontext (ce que fait le boot)
- fix suggestions de champs dans editmsql
- dÃ©placement des toggles de lib vers core, pour les associer aux autres (il y en a beaucoup de types)
- '],
"11"=>['1008','- fix addmod
- fix select()
- amÃ©lioration du gestionnaire de tags
- correctifs clusters
- modifs dans le moteur sql, qui doit Ãªtre capable de dÃ©duire s\'il faut une clause \'where\' (normalement toutes les Ã©critures doivent se faire sous forme de tableau, mais le logiciel Ã©tant ancien et dantesque, des patches sont autorisÃ©s)
- '],
"12"=>['1009','- fixs suite Ã  la modif du moteur sql, requÃªtes dans meta revues
- fix gestionnaire png2jpg, la verbose est dans le title de l\'image modifiÃ©e ou non, et l\'id est retournÃ©
- les menus des boutons d\'Ã©dition en lignes sont finalement moins pratiques qu\'en blocs
- correctif import iframes avec leur variables'],
"13"=>['1010','- synthÃ©tisation du boot dans une formule
- fixs divers
- rÃ©novation de sys, les Ã©lÃ©ments du boot sont concentrÃ©s en une seule fonction, le boot se fait en trois Ã©tapes dÃ©limitÃ©es'],
"14"=>['1011','- on a remis le menu dig sous le titre dans le module most-read, qui va disparaÃ®tre comme tous les modules de traitement d\'articles, du tri au rendu, qui passeront dÃ©sormais par le dispositif Api (todo)'],
"15"=>['1012','- ajout de la rstr148 webp2jpg, associÃ©e Ã  la rstr147 png2jpg
- fix pb de reboot via ajax
- ajout de l\'Ã©diteur de commande de apicom dans les modules qui en ont besoin (supplante ancien dispositif)'],
"16"=>['1013','- rÃ©paration du rÃ©cepteur de module, en attendant la mise Ã  jour des htaccess
- fix dÃ©tection des folders dans l\'affichage des icÃ´nes du desktop
- les listes sont dÃ©limitÃ©es dÃ©sormais par un simple saut de ligne (non deux)
- rÃ©novation de l\'index
- tentative ratÃ©e de crÃ©er le templater jst'],
"17"=>['1014','- fix load modules via desktop
- fix icons-img desktop bt
- rename module conn_playlist to playconn
- rename connector :apps to :dskbt
- ajout de la commande de l\'api \'classtag\', permet de remplacer le module du mÃªme nom (articles utilisant un type de tags)
- ajout de la commande api \'famous\', liste des articles dont les auteurs sont rÃ©pertoriÃ©s en ***
- la commande de l\'api \'cmd:panel\' permet dÃ©sormais de produire le mÃªme rÃ©sultat que le module spÃ©cialisÃ© \'api_arts\', utilisant une commande de module \'panel\'
- fix special order de l\'api \'mostread\'
- fix \'child_arts\' avec un s, \'parent_art\' au singulier'],
"18"=>['1014','- \"famous\", la nouvelle commande Api, produit un tri des articles publiÃ©s par des auteurs cent auteurs (ou toute autre classe de tags) qui sont les plus souvent les auteurs d\'articles de niveau 4 ou 5 (3* ou 4*).'],
"19"=>['1015','- rÃ©novation de apicom, utilisÃ© dans les constructeurs de commande d\'api
- ajout de la table system/edition_apicom'],
"20"=>['1015','- fix comportement des bulles de sÃ©lection via hidj
- amÃ©lioration goodarea(), qui s\'adapte en js Ã  la bonne hauteur
- ah oui lol, on a encore renommÃ© madm vers msqa, comme au dÃ©but, avant admq...
- ma::folderowner() permet de retrouver les parents de folders indiquÃ©s par erreur
- stripvideo (codeline) est ajoutÃ© Ã  rstr34 \"sauter bitch\", donc Ã§a va Ãªtre \"sauter bitchv\"'],
"21"=>['1016','- rÃ©forme de deductions() pour assumer la conscience de l\'Ã©tat communiquÃ© Ã  js, prÃ©sent dans ses(\'cond\')
- rÃ©forme de la native manie de fusionner les catÃ©gories et les Ã©tats Home et All (critique)
- nombreux fixs suite Ã  cette rÃ©forme de $frm
- confiscation de define_frm, assumÃ© par deductions()
- confiscatiion de subdomain et defo (antiques)'],
"22"=>['1017','- rÃ©paration d\'u bug opÃ©rant une boucle infinie, qu\'il a fallu 12h Ã  trouver ; le pb venait d\'une combinaison de changements (rÃ©duction des protections), associÃ©e Ã  une erreur de commande de l\'api'],
"23"=>['1018','- rÃ©forme de call, qui appelle la mÃ©thode call(), c\'est plus logique, que build(), qui appartient au contexte de l\'app. Impacts sur rss, apicom, etc. (le etc c\'est des bugs futurs)
- fix pb crÃ©Ã© inutilement de production de contenu json
- rÃ©paration de mirror_art
- fix edit config gÃ©nÃ©rale
- rÃ©paration de sitemap et de robots.txt
- conversion de la sÃ©rie bal() en tag()'],
"24"=>['1018','- finalisation de la capacitÃ© du module MENU Ã  impacter l\'Ã©tat de l\'historique et la barre d\'url, de faÃ§on bidirectionnelle : le bouton change l\'Ã©tat, et l\'Ã©tat (appel du lien fourni) sÃ©lectionne le bouton et affiche son rÃ©sultat.
- Les donnÃ©es des boutons sont dÃ©posÃ©es dans une variable js'],
"25"=>['1019','- fix mÃ©tÃ©o vide
- fix open css depuis le front
- mime(s) va dans core
- mysql dans c'],
"26"=>['1019','- fix erreurs bloquantes Ã  l\'insert img
- fix recherche d\'un float (comme 49.3)
- resserage de vis de la fonction good_rech()
- suppression d\'inutiles
- ajout de taga()
- delete ome imgico
- correctifs msqledit (on vire des aides)
- ajout atmo()'],
"27"=>['1020','- re-finalisation de la navigation par Ã©tats, de sorte Ã  : 1. rÃ©duire la base js, 2. prÃ©senter les commandes sur les boutons de SaveBg (seul de sa catÃ©gorie), 3. obtenir des liens uniquement faits de hashes (c\'est plus classe), suffisants pour joindre les modules associÃ©s.
= De cette maniÃ¨re le module \'menu\' consiste spÃ©cialement Ã  activer la navigation par Ã©tats
-- Du coup il faut que tout passe par des modules, d\'oÃ¹ le module \'Home\', qui appelle les modules du contexte \'home\'.
Ã§a marche bien :) Ã§a faisait longtemps qu\'on voulait faire Ã§a. NÃ©cessaire avant le reste de la supermutation en cours...'],
"28"=>['1020','- dÃ©placement de fonctions vers la console (on fait de la place)
- rÃ©organisation des fichiers, \"_\" = ressources, \"a\", \"b\", \"c\" les couches (constructeurs, assembleurs, apps). Ou : \"verbe, sujet, objet, complÃ©ment\".
- rÃ©forme du loader, tout passe par le module LOAD, du coup obligatoire, t rien ne peut Ãªtre lancÃ© d\'autre qu\'un module. (sauf l\'admin)
- fonction blocks dans mod, et fonction additionnelle de sÃ©lection du contenu, effacÃ©e, prise en charge par le loader
- rÃ©forme htaccess, de sorte Ã  confÃ©rer Ã  /art/ le rÃ´le de l\'url explicite, et Ã  /read/ (invisible) le rÃ´le de l\'id. On n\'envoie plus de module=Home, la page d\'accueil est la config vide. (todo: rÃ©viser les resets)
- fix comportement des Ã©tats (lors de la navigation ajax, entre articles, il ne fallait pas que l\'indic \"u\" tourne en boucle)'],
"29"=>['1021','- installation du principe de navigation fullstates (tout lien est en js), ne sera utilisÃ© qu\'aprÃ¨s avoir fixÃ© un design standard.
- installation du principe de dÃ©filement quantique (un [mouvement de molette] par article), qui nÃ©cessitera le nouveau design standard
- ajout du correcteur \'forcewebp2jpg\' pour les sources [francesoir] qui dÃ©guisent leur .webp en .jpg'],
"30"=>['1023','- construction d\'un nouveau design ordinaire (phase 1/n)
- catj renvoie des :category au lieu d\'autres :catj pour Ã©viter l\'itÃ©ration des div
- on peut spÃ©cifier des templates gÃ©nÃ©riques dans le bloc de modules \"system\" qui soient conditionnÃ©s
- le lecteur de templates priorise la recherche d\'un template dans le logiciel si rstr108 est inactif (user templates)
- les templates par dÃ©faut sont dans system/default_template, et plus en public
- la portÃ©e des templates est amÃ©liorÃ©e (ce paramÃ¨tre peut survenir n\'importe quand le long de la chaÃ®ne du global vers le local)
- prma fabrique aussi tmp'],
"31"=>['1024','- rÃ©vision css global, ajout de \'frames\'
- correctif double-lancement de la home, en dur et en js, on laisse celle en dur car on n\'est pas durs avec les moteurs
- introduction du concept hurl, associÃ© Ã  hj(), permet d\'avoir des liens en href qui sont en fait des liens dÃ©guisÃ©s en javascript, puisqu\'ils vont se gÃ©nÃ©raliser mais qu\'il faut informer les moteurs correctement
- uniformisation des diffÃ©rentes options (rstr) de fabrication des types de liens (url, jurl, popup, pagup, hurl) au travers d\'une balise de template \'title\' unique, dont le contenu est rÃ©glÃ© en amont. exit ainsi les connecteur de template :url et :jurl.
- introduction du concept de base sql relationnelle, confiant Ã  l\'index le soin de rÃ©fÃ©rencer les tables du dossier, dans le cas des templates'],
"32"=>['1024','- ajout de la rstr149 qui dÃ©termine si on prÃ©fÃ¨re utiliser les liens lh ou les liens html, dans les titres
- rÃ©vision ajustements de scrollRestoration dans window.history, pour que le passage d\'une page Ã  l\'autre soit suave et sans rebonds, mais arrive quand mÃªme en haut de la nouvelle page. (reste Ã  restaurer correctement le scroll de la page d\'origine)
- extension du principe lh() aux catÃ©gories
- fix le fait qu\'en passant par api_arts (api avec constructeurs spÃ©cialisÃ©s) on ait nbyp par dÃ©faut'],
"33"=>['1025','- les tÃ¢ches str sont placÃ©es dans une classe
- Ã©tude de faisabilitÃ© de l\'abandon d\'une procÃ©dure antique, palliÃ©e par un deuxiÃ¨me protocole du moteur ajax finalement pas usitÃ©
- suppression du module most_read (et most_read_stat), supplÃ©Ã©s par la commande order \'mostread\' de l\'arpi, et qui imposait une variable $tb Ã  mod_load ; en terme gÃ©nÃ©ral on va bannir les modules de type monobloc, ils ne doivent prodiguer que des donnÃ©es exploitables par l\'un ou l\'autre des processus existants'],
"34"=>['1025','- activer le param \'pop\' d\'un module permet de faire valser la variable de template de jurl Ã  purl dans les modules qui font appel Ã  une commande \"panel\" ; ceci afin de n\'utiliser qu\'un template pour deux usages'],
"35"=>['1026','- fix tweedfeed, qui va dans /c
- amÃ©liorations et ajustement de la navigation en mode fullstate ; loader un article en pleine page fusille les variables js, qui contiennent la navigation antÃ©rieure, qui doivent Ãªtre prÃ©sentes dans un root, sauf que la route un logiciel de conception est dÃ©finie par l\'utilisateur (mode auto-route), ce qui force Ã  ajouter une requÃªte, ce qui a finalement Ã©tÃ© Ã©vitÃ© en gardant un cadre Ã  l\'article.
- taxonav passe en fullstate'],
"36"=>['1027','- fix douloureux Ã  trouver de artlive2() que renvoyait une requÃªte Ã  formats mixtes, d\'oÃ¹ les duplications impromptues dans les rÃ©sultats de recherches lancÃ©es via l\'url
- laborieux succÃ¨s Ã  gÃ©nÃ©raliser la reconnaissance par le state de toute requÃªte url, pour retrouver la page initiale, lors du retour sur la navigation, dans le cas d\'un search via get par exemple
= la navigation par states implique qu\'on peut emprunter une route (root) dans les deux sens
- en l\'Ã©tat (Ã§a va changer) l\'appel d\'un article affecte le content, forcÃ©ment ; l\'appel d\'un contexte appelle la page.
- textarea() est le premier Ã  subir la modernisation qui consiste Ã  se comporter comme tag(), issu de fractal. Les microfonctions de facilitation seront abandonnÃ©es au profit de tableaux.']];