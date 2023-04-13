<?php //msql/program_updates_2201
$r=["_menus_"=>[''],
"1"=>['0101','publication'],
"2"=>['0101','- correctifs admin msql dÃ» Ã  la rÃ©forme du moteur ajax'],
"3"=>['0102','- correctifs annuels de l\'installateur, cette fois il sera entiÃ¨rement utf8/innodb
- fix qq deprecated de php 8.1'],
"4"=>['0103','- correctifs d\'implÃ©mentation de dn2 (transport, msql, plugs)
- correctifs php8.1'],
"5"=>['0104','- l\'ajout du param utf8=2 dans les dÃ©fs d\'import permet d\'esquiver, au contraire, la formalisation utf8 en vue de passer par le parseur Dom (qui n\'existait pas avant et qui le fait trÃ¨s bien)'],
"6"=>['0105','- fix pb posÃ© par l\'abandon graduel de l\'ancien read_msql au profit d\'un msql::row quand c\'est appropriÃ©
- rÃ©novation de la dÃ©tection infrarouge (on va dire) : le mode night garde en cache l\'heure de son dÃ©clenchement
- l\'importation de table entre serveurs passe par le dispositif json et abandonne le dispositif xml
- ajout du prmb \'origin\' qui cible en premier le serveur mirroir, puis le serveur philum sinon, pour la rÃ©novation de tables publiques
- intÃ©gration de la conversion d\'iframes menant vers un lien raccourci conduisant Ã  un embed de twit, pour en rÃ©cupÃ©rer juste l\'id'],
"7"=>['0106','- correctif de l\'ancien embed_detect()/segment()/portion() qui deviennent un unique between() : sÃ©lection d\'une portion d\'une chaÃ®ne.
- fix pb import csv dns admin msql'],
"8"=>['0107','- rÃ©fection de pop : une grand nombre de fonction attachÃ©es ) conn sont dÃ©placÃ©es dans mk
- les fonctions de pop, spe et ajxf qui servent aux \"apps\" (Ã  l\'ancienne, nom du principe d\'appel de fonctions), sont isolÃ©es dans une classe \"apps\"'],
"9"=>['0108','- rÃ©fection de styl, qui devient un objet de ressources de /a
- suppression de systÃ¨mes d\'aides aux dÃ©butants antiques'],
"10"=>['0109','- correctifs styl
- rÃ©fection de taxonav, intÃ©grÃ© Ã  /b
- dÃ©placement des fonctions communes de taxonomie dans md
- fix upload
- rÃ©fection de addjs et ajout de addcss, comme callbacks de ajax
- rÃ©fection de topology'],
"11"=>['0110','- introduction (avec succÃ¨s) d\'un nouveau canal vers le moteur ajax : ce protocole Ã  5 types permettra de supplanter le protocole Ã  9 variables, et de cibler des fonctions normalisÃ©es Ã  deux tableaux, les gets et les posts.
- ajout de bj() qui supplantera lj()
- rÃ©fection de la capture de types d\'inputs (js)
Note : on avait dÃ©jÃ  tentÃ© un protocole secondaire qui a Ã©chouÃ©, en reprenant celui de Fractal. Ici il est lÃ©gÃ¨rement amÃ©liorÃ©, dans la mesure oÃ¹ il \'utilise que deux caractÃ¨res rÃ©servÃ©s pour toute la gamme de cas de figures possibles.'],
"12"=>['0111','- correctifs dans styl afin de minimiser le support de routes de ajax
- rÃ©forme hidden()
- rÃ©fection de twits'],
"13"=>['0112','- rÃ©fection tweetfeeds
- fix twit::batch
- ajout elapsed_time()
- update searched et autres occurrences de app_
- chasse Ã  autoclic() rendu obsolÃ¨te'],
"14"=>['0113','- gros dÃ©placement de fonctions pour soulager ajxf vers sav
- correctifs de addurlsav (rstr79)
- nettoyage obsolescences et fonctions caduques'],
"15"=>['0114','- nouveau gros dÃ©placement de fonctions pour soulager ajxf, vers mbd (gain sensible de rÃ©activitÃ©, triste de ne pas y avoir pensÃ© avant)
- correctifs de l\'usage de post et de get comme lieu de stockage (c\'Ã©tait trÃ¨s mal de faire cela)
- remove ajxf.php (adios, tu nous as accompagnÃ© depuis le dÃ©but)'],
"16"=>['0115','- rÃ©paration de nombreux (100+) titres de vidÃ©os qui ne montaient plus, rÃ©paration du serveur alternatif, passage de des cols tit et txt de qdw en utf8 (le reste suivra)
- crÃ©ation de l\'app funcs qui donne les occurrences des fonctions utilisÃ©es afin de rÃ©partir les charges et de minimiser les appels pour chaque ligne d\'activitÃ©
- rÃ©habilitaion de chat, chatx, radio
- mise au banc de microsql, backup_msql
- nouveau gros dÃ©placement de fonctions de boot, mod, meta, msql, adminx ;'],
"17"=>['0116','- rÃ©organisation massive, phase 4 : soulagement de admin'],
"18"=>['0117','- rÃ©organisation massive, phase 5 : soulagement de nombreux art, quelques plugins, crÃ©ation d\'une nouvelle division du travail
- nettoyages de masse'],
"19"=>['0118','- rÃ©organisation massive, phase 6 : derniers soulagements possibles, hormis les vieux plugs ; crÃ©ation de core pour soutenir les fonctions propriÃ©taires, en support de lib qui en est soulagÃ©
- fix pb assez ancien d\'encodage des fichiers
- tests de rÃ©partition des charges'],
"20"=>['0119','- rÃ©organisation massive, phase 7 : fin du nettoyage des fonctions inusitÃ©es (24 Ko au total depuis le dÃ©but de l\'opÃ©ration)
- dÃ©but du nettoyage de ajax.php, qui consiste Ã  rÃ©duire la charge utile Ã  ce qui est strictement nÃ©cessaire pour tout appel ajax.'],
"21"=>['0120','- rÃ©organisation massive, phase 8 : traitement du dÃ©but de la deuxiÃ¨me partie des callbcks ajax
- remaniement du systÃ¨me des images en pagup (todo)
- gros paquet de remises Ã  niveau de plugins'],
"22"=>['0121','- remaniement du moteur video
- rÃ©organisation massive, phase 9 : presque fin de la deuxiÃ¨me partie des callbcks ajax
- paquet de remises Ã  niveau de plugins'],
"23"=>['0121','Bilan provisoire :
Ã  la presque fin du remaniement gÃ©nÃ©ral, la vitesse des requÃªtes ajax a trÃ¨s sensiblement augmentÃ©. On surveille le test du lancement d\'un article, passÃ© de 100ms avant le dÃ©but du process Ã  30ms actuellement.
Une fois que le process sera terminÃ©, on passera sous Php8.1 qui est deux fois plus rapide...'],
"24"=>['0122','finalisation de la procÃ©dure gÃ©nÃ©rale de recalibration du logiciel, et du soulagement de ajax.php.
- les points d\'accÃ¨s au desktop ont Ã©tÃ© rÃ©tablis en raison de leur facilitÃ© d\'Ã©criture dans le logiciel, leur prÃ©sence dans les tables utilisateur, et leur usage allÃ©gorique en tant que dÃ©signateur de pictos...
- d\'autres points d\'accÃ¨s \"systÃ¨me\" sont Ã©galement laissÃ©s.
- paquet de ramaniements de plugins, extermination des appels utilisant \"call\", et globalement chasse aux termes incongrument banaux.
- rÃ©fection du moteur de recherche avec $prm au lieu de $res (grosse gageure)
- rÃ©fection d\'une sÃ©rie de plugins du dossier um'],
"25"=>['0123','- fin de la rÃ©fection de search, suppression des usages malencontreux de get comme lieu de stockage provisoire des donnÃ©es
- rÃ©fection de finder, qui Ã©tait plein de toiles d\'araignÃ©es, laissÃ© inusitÃ© depuis longtemps. Un exemple de modernisation ratÃ©e, mais qui a Ã©tÃ© une Ã©tape Ã©volutive dÃ©cisive.
- rÃ©novation des indicateurs ajax servant Ã  appeler en deuxiÃ¨me instance les composants js et css d\'un app (exit injectjs Ã  la dn9, js est en dn4)
- rÃ©fection de quelques plugins
- rÃ©fection de book, si cool qu\'utilisÃ© dans une rstr141
- chasse au antiques popup() car depuis un bail elles sont dÃ©clenchÃ©es en amont'],
"26"=>['0124','- finitions de la rÃ©forme globale, Ã©tape 1/x, dite du limage des bordures, fix nombreuses erreurs, rÃ©fection de procÃ©dures oubliÃ©es
- rÃ©fection de 50% des plugs de um
- rÃ©fection du gestionnaire de modules et de sous-modules
- on a installÃ© le sÃ©lecteur getbyid from fractal pour voir, qui permet de prioriser les cibles quand elles sont multiples'],
"27"=>['0125','- fix pb prÃ©servation de config dans la navigation de l\'Api en provenance des onglets faisant usage de modules (ouais, pas facile)
- fix pb de confusion de procÃ©dure afin de permettre aux connecteurs d\'appeler les objets associÃ©s (on a dit \"call\") ; les connecteurs ne cherchent plus de plugins antiques
- rÃ©novation de l\'app tags, qui va renvoyer la liste des tags d\'une catÃ©gorie cette fois dans une popup et en utilisant les ressources systÃ¨me ; lifting de tag_clouds.
- fix problÃ¨me de sÃ©lecteur de templates, qui occasionnait une curiositÃ© dans les menus bubble'],
"28"=>['0126','- fix pb variÃ©s de la transmutation
- rÃ©novation des plugs restants
- correctifs gestion des articles non publiÃ©s
- fix book
- ajout de gestionnaire d\'apps \'appjs\' spÃ©cifique pour injecter les js d\'une app (on avait prÃ©alablement fait muter le protocole injectjs en un simple prm4 \'js\')'],
"29"=>['0127','- peaufinages, finitions, rÃ©solution de conflits intÃ©rieurs
- transmutation des pugins de sci en apps
- ajout du gestionnaire d\'apps \'popup\', raccourci de \'ajax\'
- update des tables faisant anciennement rÃ©fÃ©rence Ã  des plugs (maintenant ce sont des apps)
- ajout d\'un cache pour le mode night'],
"30"=>['0128','- ajout de la rstr142, permet d\'afficher les images depuis la source d\'origine
- finition des modes d\'affichages des images \'photo\' et \'overim\'
- finition des comportements des popups, dont les propriÃ©tÃ©s sont commandÃ©es depuis les agrÃ©gats appelÃ©s antÃ©rieurement
- finition du confort d\'affichage des books'],
"31"=>['0129','- remise en forme du flux rss
- ajout d\'une troisiÃ¨me mÃ©thode de capture rss, via le dom (la 2 via simpledom, la 1 en purestring) : meilleure gestion des encodages'],
"32"=>['0130','- amÃ©lioration de l\'Ã©tendue du lecteur de commentaires, pour permettre Ã  l\'admin de trouver ceux qui sont dÃ©publiÃ©s
- ajout de la rstr143 en complÃ©ment de la 142 (image d\'origine) : permet de bloquer purement et simplement les images et de renvoyer un lien vers celle d\'origine (mode warrior)
- rÃ©paration des backups d\'articles
- correctif pour que :appbt appelle directement l\'app et non un connecteur, et que :appbt dÃ©nigre :bt, rendu obsolÃ¨te
- mais du coup on ajoute un :connbt'],
"33"=>['0131','- amÃ©lioration du fabriquant de notes de bas de pages, pour supporter les insupportables \'easy-footnotes\' : il faut Ã©laguer les propriÃ©tÃ©s contenant des balises, et rendre fonctionnel le fabriquant avec une moitiÃ© du travail dÃ©jÃ  fait en input, l\'autre moitiÃ© Ã©tant logÃ©e dans un numlist.
- les posts ajax gÃ©nÃ¨rent des /r
- fix css \'ascii\'
- nouveau protocole d\'autorisation de l\'allumage des apps en tant que connecteurs, Ã  la mode Fractal, qui produit une grande Ã©conomie et sÃ©curitÃ© par restriction depuis les connecteurs.
- suppression de l\'antique systÃ¨me d\'appel par dÃ©faut des plugins et des connecteurs personnalisÃ©s en dernier recours des connecteurs. Des connecteurs spÃ©cifiques sont rÃ©clamÃ©s pour aller vers :basic ou :uconn.
- correctif create new table msql
- ajout de la rstr144, permet d\'activer les boutons de navigation entre articles dans une popup'],
"34"=>['0131','fin de la rÃ©forme globale du lustre 2022-2027.
Normalement on est bien contents lÃ  :)
- 40Ko de donnÃ©es ont Ã©tÃ© mises au bagne
- la poursuite des chaÃ®nes d\'actions a Ã©tÃ© rendue lisible
- les plugins ont Ã©tÃ© rÃ©voquÃ©s au profit des apps
- la rÃ©partition des charges a divisÃ© par deux Ã  quatre le temps d\'exÃ©cution (sans encore passer Ã  php8)
- le moteur ajax a Ã©tÃ© entiÃ¨rement rÃ©formÃ©, restreint, et une deuxiÃ¨me voie a Ã©tÃ© ouverte pour les cas rares
- les nouveaux protocoles continueront Ã  Ãªtre dÃ©ployÃ©s pour les recoins du logiciel et sa stabilisation.']];