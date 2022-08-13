<?php //msql/program_updates_2201_sav
$r=["_menus_"=>[''],
"1"=>['0101','publication'],
"2"=>['0101','- correctifs admin msql dû à la réforme du moteur ajax'],
"3"=>['0102','- correctifs annuels de l\'installateur, cette fois il sera entièrement utf8/innodb
- fix qq deprecated de php 8.1'],
"4"=>['0103','- correctifs d\'implémentation de dn2 (transport, msql, plugs)
- correctifs php8.1'],
"5"=>['0104','- l\'ajout du param utf8=2 dans les défs d\'import permet d\'esquiver, au contraire, la formalisation utf8 en vue de passer par le parseur Dom (qui n\'existait pas avant et qui le fait très bien)'],
"6"=>['0105','- fix pb posé par l\'abandon graduel de l\'ancien read_msql au profit d\'un msql::row quand c\'est approprié
- rénovation de la détection infrarouge (on va dire) : le mode night garde en cache l\'heure de son déclenchement
- l\'importation de table entre serveurs passe par le dispositif json et abandonne le dispositif xml
- ajout du prmb \'origin\' qui cible en premier le serveur mirroir, puis le serveur philum sinon, pour la rénovation de tables publiques
- intégration de la conversion d\'iframes menant vers un lien raccourci conduisant à un embed de twit, pour en récupérer juste l\'id'],
"7"=>['0106','- correctif de l\'ancien embed_detect()/segment()/portion() qui deviennent un unique between() : sélection d\'une portion d\'une chaîne.
- fix pb import csv dns admin msql'],
"8"=>['0107','- réfection de pop : une grand nombre de fonction attachées ) conn sont déplacées dans mk
- les fonctions de pop, spe et ajxf qui servent aux \"apps\" (à l\'ancienne, nom du principe d\'appel de fonctions), sont isolées dans une classe \"apps\"'],
"9"=>['0108','- réfection de styl, qui devient un objet de ressources de /a
- suppression de systèmes d\'aides aux débutants antiques'],
"10"=>['0109','- correctifs styl
- réfection de taxonav, intégré à /b
- déplacement des fonctions communes de taxonomie dans md
- fix upload
- réfection de addjs et ajout de addcss, comme callbacks de ajax
- réfection de topology'],
"11"=>['0110','- introduction (avec succès) d\'un nouveau canal vers le moteur ajax : ce protocole à 5 types permettra de supplanter le protocole à 9 variables, et de cibler des fonctions normalisées à deux tableaux, les gets et les posts.
- ajout de bj() qui supplantera lj()
- réfection de la capture de types d\'inputs (js)
Note : on avait déjà tenté un protocole secondaire qui a échoué, en reprenant celui de Fractal. Ici il est légèrement amélioré, dans la mesure où il \'utilise que deux caractères réservés pour toute la gamme de cas de figures possibles.'],
"12"=>['0111','- correctifs dans styl afin de minimiser le support de routes de ajax
- réforme hidden()
- réfection de twits'],
"13"=>['0112','- réfection tweetfeeds
- fix twit::batch
- ajout elapsed_time()
- update searched et autres occurrences de app_
- chasse à autoclic() rendu obsolète'],
"14"=>['0113','- gros déplacement de fonctions pour soulager ajxf vers sav
- correctifs de addurlsav (rstr79)
- nettoyage obsolescences et fonctions caduques'],
"15"=>['0114','- nouveau gros déplacement de fonctions pour soulager ajxf, vers mbd (gain sensible de réactivité, triste de ne pas y avoir pensé avant)
- correctifs de l\'usage de post et de get comme lieu de stockage (c\'était très mal de faire cela)
- remove ajxf.php (adios, tu nous as accompagné depuis le début)'],
"16"=>['0115','- réparation de nombreux (100+) titres de vidéos qui ne montaient plus, réparation du serveur alternatif, passage de des cols tit et txt de qdw en utf8 (le reste suivra)
- création de l\'app funcs qui donne les occurrences des fonctions utilisées afin de répartir les charges et de minimiser les appels pour chaque ligne d\'activité
- réhabilitaion de chat, chatx, radio
- mise au banc de microsql, backup_msql
- nouveau gros déplacement de fonctions de boot, mod, meta, msql, adminx ;'],
"17"=>['0116','- réorganisation massive, phase 4 : soulagement de admin'],
"18"=>['0117','- réorganisation massive, phase 5 : soulagement de nombreux art, quelques plugins, création d\'une nouvelle division du travail
- nettoyages de masse'],
"19"=>['0118','- réorganisation massive, phase 6 : derniers soulagements possibles, hormis les vieux plugs ; création de core pour soutenir les fonctions propriétaires, en support de lib qui en est soulagé
- fix pb assez ancien d\'encodage des fichiers
- tests de répartition des charges'],
"20"=>['0119','- réorganisation massive, phase 7 : fin du nettoyage des fonctions inusitées (24 Ko au total depuis le début de l\'opération)
- début du nettoyage de ajax.php, qui consiste à réduire la charge utile à ce qui est strictement nécessaire pour tout appel ajax.'],
"21"=>['0120','- réorganisation massive, phase 8 : traitement du début de la deuxième partie des callbcks ajax
- remaniement du système des images en pagup (todo)
- gros paquet de remises à niveau de plugins'],
"22"=>['0121','- remaniement du moteur video
- réorganisation massive, phase 9 : presque fin de la deuxième partie des callbcks ajax
- paquet de remises à niveau de plugins'],
"23"=>['0121','Bilan provisoire :
à la presque fin du remaniement général, la vitesse des requêtes ajax a très sensiblement augmenté. On surveille le test du lancement d\'un article, passé de 100ms avant le début du process à 30ms actuellement.
Une fois que le process sera terminé, on passera sous Php8.1 qui est deux fois plus rapide...'],
"24"=>['0122','finalisation de la procédure générale de recalibration du logiciel, et du soulagement de ajax.php.
- les points d\'accès au desktop ont été rétablis en raison de leur facilité d\'écriture dans le logiciel, leur présence dans les tables utilisateur, et leur usage allégorique en tant que désignateur de pictos...
- d\'autres points d\'accès \"système\" sont également laissés.
- paquet de ramaniements de plugins, extermination des appels utilisant \"call\", et globalement chasse aux termes incongrument banaux.
- réfection du moteur de recherche avec $prm au lieu de $res (grosse gageure)
- réfection d\'une série de plugins du dossier um'],
"25"=>['0123','- fin de la réfection de search, suppression des usages malencontreux de get comme lieu de stockage provisoire des données
- réfection de finder, qui était plein de toiles d\'araignées, laissé inusité depuis longtemps. Un exemple de modernisation ratée, mais qui a été une étape évolutive décisive.
- rénovation des indicateurs ajax servant à appeler en deuxième instance les composants js et css d\'un app (exit injectjs à la dn9, js est en dn4)
- réfection de quelques plugins
- réfection de book, si cool qu\'utilisé dans une rstr141
- chasse au antiques popup() car depuis un bail elles sont déclenchées en amont'],
"26"=>['0124','- finitions de la réforme globale, étape 1/x, dite du limage des bordures, fix nombreuses erreurs, réfection de procédures oubliées
- réfection de 50% des plugs de um
- réfection du gestionnaire de modules et de sous-modules
- on a installé le sélecteur getbyid from fractal pour voir, qui permet de prioriser les cibles quand elles sont multiples'],
"27"=>['0125','- fix pb préservation de config dans la navigation de l\'Api en provenance des onglets faisant usage de modules (ouais, pas facile)
- fix pb de confusion de procédure afin de permettre aux connecteurs d\'appeler les objets associés (on a dit \"call\") ; les connecteurs ne cherchent plus de plugins antiques
- rénovation de l\'app tags, qui va renvoyer la liste des tags d\'une catégorie cette fois dans une popup et en utilisant les ressources système ; lifting de tag_clouds.
- fix problème de sélecteur de templates, qui occasionnait une curiosité dans les menus bubble'],
"28"=>['0126','- fix pb variés de la transmutation
- rénovation des plugs restants
- correctifs gestion des articles non publiés
- fix book
- ajout de gestionnaire d\'apps \'appjs\' spécifique pour injecter les js d\'une app (on avait préalablement fait muter le protocole injectjs en un simple prm4 \'js\')'],
"29"=>['0127','- peaufinages, finitions, résolution de conflits intérieurs
- transmutation des pugins de sci en apps
- ajout du gestionnaire d\'apps \'popup\', raccourci de \'ajax\'
- update des tables faisant anciennement référence à des plugs (maintenant ce sont des apps)
- ajout d\'un cache pour le mode night'],
"30"=>['0128','- ajout de la rstr142, permet d\'afficher les images depuis la source d\'origine
- finition des modes d\'affichages des images \'photo\' et \'overim\'
- finition des comportements des popups, dont les propriétés sont commandées depuis les agrégats appelés antérieurement
- finition du confort d\'affichage des books'],
"31"=>['0129','- remise en forme du flux rss
- ajout d\'une troisième méthode de capture rss, via le dom (la 2 via simpledom, la 1 en purestring) : meilleure gestion des encodages'],
"32"=>['0130','- amélioration de l\'étendue du lecteur de commentaires, pour permettre à l\'admin de trouver ceux qui sont dépubliés
- ajout de la rstr143 en complément de la 142 (image d\'origine) : permet de bloquer purement et simplement les images et de renvoyer un lien vers celle d\'origine (mode warrior)
- réparation des backups d\'articles
- correctif pour que :appbt appelle directement l\'app et non un connecteur, et que :appbt dénigre :bt, rendu obsolète
- mais du coup on ajoute un :connbt'],
"33"=>['0131','- amélioration du fabriquant de notes de bas de pages, pour supporter les insupportables \'easy-footnotes\' : il faut élaguer les propriétés contenant des balises, et rendre fonctionnel le fabriquant avec une moitié du travail déjà fait en input, l\'autre moitié étant logée dans un numlist.
- les posts ajax génèrent des /r
- fix css \'ascii\'
- nouveau protocole d\'autorisation de l\'allumage des apps en tant que connecteurs, à la mode Fractal, qui produit une grande économie et sécurité par restriction depuis les connecteurs.
- suppression de l\'antique système d\'appel par défaut des plugins et des connecteurs personnalisés en dernier recours des connecteurs. Des connecteurs spécifiques sont réclamés pour aller vers :basic ou :uconn.
- correctif create new table msql
- ajout de la rstr144, permet d\'activer les boutons de navigation entre articles dans une popup'],
"34"=>['0131','fin de la réforme globale du lustre 2022-2027.
Normalement on est bien contents là :)
- 40Ko de données ont été mises au bagne
- la poursuite des chaînes d\'actions a été rendue lisible
- les plugins ont été révoqués au profit des apps
- la répartition des charges a divisé par deux à quatre le temps d\'exécution (sans encore passer à php8)
- le moteur ajax a été entièrement réformé, restreint, et une deuxième voie a été ouverte pour les cas rares
- les nouveaux protocoles continueront à être déployés pour les recoins du logiciel et sa stabilisation.']];