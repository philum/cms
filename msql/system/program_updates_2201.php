<?php //msql/program_updates_2201
$r=["_menus_"=>[''],
"1"=>['0101','publication'],
"2"=>['0101','- correctifs admin msql d� � la r�forme du moteur ajax'],
"3"=>['0102','- correctifs annuels de l\'installateur, cette fois il sera enti�rement utf8/innodb
- fix qq deprecated de php 8.1'],
"4"=>['0103','- correctifs d\'impl�mentation de dn2 (transport, msql, plugs)
- correctifs php8.1'],
"5"=>['0104','- l\'ajout du param utf8=2 dans les d�fs d\'import permet d\'esquiver, au contraire, la formalisation utf8 en vue de passer par le parseur Dom (qui n\'existait pas avant et qui le fait tr�s bien)'],
"6"=>['0105','- fix pb pos� par l\'abandon graduel de l\'ancien read_msql au profit d\'un msql::row quand c\'est appropri�
- r�novation de la d�tection infrarouge (on va dire) : le mode night garde en cache l\'heure de son d�clenchement
- l\'importation de table entre serveurs passe par le dispositif json et abandonne le dispositif xml
- ajout du prmb \'origin\' qui cible en premier le serveur mirroir, puis le serveur philum sinon, pour la r�novation de tables publiques
- int�gration de la conversion d\'iframes menant vers un lien raccourci conduisant � un embed de twit, pour en r�cup�rer juste l\'id'],
"7"=>['0106','- correctif de l\'ancien embed_detect()/segment()/portion() qui deviennent un unique between() : s�lection d\'une portion d\'une cha�ne.
- fix pb import csv dns admin msql'],
"8"=>['0107','- r�fection de pop : une grand nombre de fonction attach�es ) conn sont d�plac�es dans mk
- les fonctions de pop, spe et ajxf qui servent aux \"apps\" (� l\'ancienne, nom du principe d\'appel de fonctions), sont isol�es dans une classe \"apps\"'],
"9"=>['0108','- r�fection de styl, qui devient un objet de ressources de /a
- suppression de syst�mes d\'aides aux d�butants antiques'],
"10"=>['0109','- correctifs styl
- r�fection de taxonav, int�gr� � /b
- d�placement des fonctions communes de taxonomie dans md
- fix upload
- r�fection de addjs et ajout de addcss, comme callbacks de ajax
- r�fection de topology'],
"11"=>['0110','- introduction (avec succ�s) d\'un nouveau canal vers le moteur ajax : ce protocole � 5 types permettra de supplanter le protocole � 9 variables, et de cibler des fonctions normalis�es � deux tableaux, les gets et les posts.
- ajout de bj() qui supplantera lj()
- r�fection de la capture de types d\'inputs (js)
Note : on avait d�j� tent� un protocole secondaire qui a �chou�, en reprenant celui de Fractal. Ici il est l�g�rement am�lior�, dans la mesure o� il \'utilise que deux caract�res r�serv�s pour toute la gamme de cas de figures possibles.'],
"12"=>['0111','- correctifs dans styl afin de minimiser le support de routes de ajax
- r�forme hidden()
- r�fection de twits'],
"13"=>['0112','- r�fection tweetfeeds
- fix twit::batch
- ajout elapsed_time()
- update searched et autres occurrences de app_
- chasse � autoclic() rendu obsol�te'],
"14"=>['0113','- gros d�placement de fonctions pour soulager ajxf vers sav
- correctifs de addurlsav (rstr79)
- nettoyage obsolescences et fonctions caduques'],
"15"=>['0114','- nouveau gros d�placement de fonctions pour soulager ajxf, vers mbd (gain sensible de r�activit�, triste de ne pas y avoir pens� avant)
- correctifs de l\'usage de post et de get comme lieu de stockage (c\'�tait tr�s mal de faire cela)
- remove ajxf.php (adios, tu nous as accompagn� depuis le d�but)'],
"16"=>['0115','- r�paration de nombreux (100+) titres de vid�os qui ne montaient plus, r�paration du serveur alternatif, passage de des cols tit et txt de qdw en utf8 (le reste suivra)
- cr�ation de l\'app funcs qui donne les occurrences des fonctions utilis�es afin de r�partir les charges et de minimiser les appels pour chaque ligne d\'activit�
- r�habilitaion de chat, chatx, radio
- mise au banc de microsql, backup_msql
- nouveau gros d�placement de fonctions de boot, mod, meta, msql, adminx ;'],
"17"=>['0116','- r�organisation massive, phase 4 : soulagement de admin'],
"18"=>['0117','- r�organisation massive, phase 5 : soulagement de nombreux art, quelques plugins, cr�ation d\'une nouvelle division du travail
- nettoyages de masse'],
"19"=>['0118','- r�organisation massive, phase 6 : derniers soulagements possibles, hormis les vieux plugs ; cr�ation de core pour soutenir les fonctions propri�taires, en support de lib qui en est soulag�
- fix pb assez ancien d\'encodage des fichiers
- tests de r�partition des charges'],
"20"=>['0119','- r�organisation massive, phase 7 : fin du nettoyage des fonctions inusit�es (24 Ko au total depuis le d�but de l\'op�ration)
- d�but du nettoyage de ajax.php, qui consiste � r�duire la charge utile � ce qui est strictement n�cessaire pour tout appel ajax.'],
"21"=>['0120','- r�organisation massive, phase 8 : traitement du d�but de la deuxi�me partie des callbcks ajax
- remaniement du syst�me des images en pagup (todo)
- gros paquet de remises � niveau de plugins'],
"22"=>['0121','- remaniement du moteur video
- r�organisation massive, phase 9 : presque fin de la deuxi�me partie des callbcks ajax
- paquet de remises � niveau de plugins'],
"23"=>['0121','Bilan provisoire :
� la presque fin du remaniement g�n�ral, la vitesse des requ�tes ajax a tr�s sensiblement augment�. On surveille le test du lancement d\'un article, pass� de 100ms avant le d�but du process � 30ms actuellement.
Une fois que le process sera termin�, on passera sous Php8.1 qui est deux fois plus rapide...'],
"24"=>['0122','finalisation de la proc�dure g�n�rale de recalibration du logiciel, et du soulagement de ajax.php.
- les points d\'acc�s au desktop ont �t� r�tablis en raison de leur facilit� d\'�criture dans le logiciel, leur pr�sence dans les tables utilisateur, et leur usage all�gorique en tant que d�signateur de pictos...
- d\'autres points d\'acc�s \"syst�me\" sont �galement laiss�s.
- paquet de ramaniements de plugins, extermination des appels utilisant \"call\", et globalement chasse aux termes incongrument banaux.
- r�fection du moteur de recherche avec $prm au lieu de $res (grosse gageure)
- r�fection d\'une s�rie de plugins du dossier um'],
"25"=>['0123','- fin de la r�fection de search, suppression des usages malencontreux de get comme lieu de stockage provisoire des donn�es
- r�fection de finder, qui �tait plein de toiles d\'araign�es, laiss� inusit� depuis longtemps. Un exemple de modernisation rat�e, mais qui a �t� une �tape �volutive d�cisive.
- r�novation des indicateurs ajax servant � appeler en deuxi�me instance les composants js et css d\'un app (exit injectjs � la dn9, js est en dn4)
- r�fection de quelques plugins
- r�fection de book, si cool qu\'utilis� dans une rstr141
- chasse au antiques popup() car depuis un bail elles sont d�clench�es en amont'],
"26"=>['0124','- finitions de la r�forme globale, �tape 1/x, dite du limage des bordures, fix nombreuses erreurs, r�fection de proc�dures oubli�es
- r�fection de 50% des plugs de um
- r�fection du gestionnaire de modules et de sous-modules
- on a install� le s�lecteur getbyid from fractal pour voir, qui permet de prioriser les cibles quand elles sont multiples'],
"27"=>['0125','- fix pb pr�servation de config dans la navigation de l\'Api en provenance des onglets faisant usage de modules (ouais, pas facile)
- fix pb de confusion de proc�dure afin de permettre aux connecteurs d\'appeler les objets associ�s (on a dit \"call\") ; les connecteurs ne cherchent plus de plugins antiques
- r�novation de l\'app tags, qui va renvoyer la liste des tags d\'une cat�gorie cette fois dans une popup et en utilisant les ressources syst�me ; lifting de tag_clouds.
- fix probl�me de s�lecteur de templates, qui occasionnait une curiosit� dans les menus bubble'],
"28"=>['0126','- fix pb vari�s de la transmutation
- r�novation des plugs restants
- correctifs gestion des articles non publi�s
- fix book
- ajout de gestionnaire d\'apps \'appjs\' sp�cifique pour injecter les js d\'une app (on avait pr�alablement fait muter le protocole injectjs en un simple prm4 \'js\')'],
"29"=>['0127','- peaufinages, finitions, r�solution de conflits int�rieurs
- transmutation des pugins de sci en apps
- ajout du gestionnaire d\'apps \'popup\', raccourci de \'ajax\'
- update des tables faisant anciennement r�f�rence � des plugs (maintenant ce sont des apps)
- ajout d\'un cache pour le mode night'],
"30"=>['0128','- ajout de la rstr142, permet d\'afficher les images depuis la source d\'origine
- finition des modes d\'affichages des images \'photo\' et \'overim\'
- finition des comportements des popups, dont les propri�t�s sont command�es depuis les agr�gats appel�s ant�rieurement
- finition du confort d\'affichage des books'],
"31"=>['0129','- remise en forme du flux rss
- ajout d\'une troisi�me m�thode de capture rss, via le dom (la 2 via simpledom, la 1 en purestring) : meilleure gestion des encodages'],
"32"=>['0130','- am�lioration de l\'�tendue du lecteur de commentaires, pour permettre � l\'admin de trouver ceux qui sont d�publi�s
- ajout de la rstr143 en compl�ment de la 142 (image d\'origine) : permet de bloquer purement et simplement les images et de renvoyer un lien vers celle d\'origine (mode warrior)
- r�paration des backups d\'articles
- correctif pour que :appbt appelle directement l\'app et non un connecteur, et que :appbt d�nigre :bt, rendu obsol�te
- mais du coup on ajoute un :connbt'],
"33"=>['0131','- am�lioration du fabriquant de notes de bas de pages, pour supporter les insupportables \'easy-footnotes\' : il faut �laguer les propri�t�s contenant des balises, et rendre fonctionnel le fabriquant avec une moiti� du travail d�j� fait en input, l\'autre moiti� �tant log�e dans un numlist.
- les posts ajax g�n�rent des /r
- fix css \'ascii\'
- nouveau protocole d\'autorisation de l\'allumage des apps en tant que connecteurs, � la mode Fractal, qui produit une grande �conomie et s�curit� par restriction depuis les connecteurs.
- suppression de l\'antique syst�me d\'appel par d�faut des plugins et des connecteurs personnalis�s en dernier recours des connecteurs. Des connecteurs sp�cifiques sont r�clam�s pour aller vers :basic ou :uconn.
- correctif create new table msql
- ajout de la rstr144, permet d\'activer les boutons de navigation entre articles dans une popup'],
"34"=>['0131','fin de la r�forme globale du lustre 2022-2027.
Normalement on est bien contents l� :)
- 40Ko de donn�es ont �t� mises au bagne
- la poursuite des cha�nes d\'actions a �t� rendue lisible
- les plugins ont �t� r�voqu�s au profit des apps
- la r�partition des charges a divis� par deux � quatre le temps d\'ex�cution (sans encore passer � php8)
- le moteur ajax a �t� enti�rement r�form�, restreint, et une deuxi�me voie a �t� ouverte pour les cas rares
- les nouveaux protocoles continueront � �tre d�ploy�s pour les recoins du logiciel et sa stabilisation.']];