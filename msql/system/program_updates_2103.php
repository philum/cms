<?php //msql/program_updates_2103
$r=["1"=>['0301','publication'],
"2"=>['0301','- rÃ©forme :msql : reÃ§oit tableÂ§row|col, compatible avec les options de traitement tableÂ§opt|opt2
- correctifs ::web sets sans id'],
"3"=>['0303','- ajout de l\'app meteo, branchÃ©e sur l\'api Fractal : http://logic.ovh/api/meteo/insee:75101
- ajout des pictos associÃ©es et d\'un modÃ¨le de correspondance entre les rÃ©fÃ©rences mÃ©tÃ©o et les pictos 
- (proposition d\'un nouveau type de classification mÃ©tÃ©orologique)'],
"4"=>['0305','- rÃ©forme de divb(), exit les paramstrings, conforme Ã  div() de Fractal
- rÃ©forme de la mÃ©thode de variables du templater vue
- correctifs des templates par dÃ©faut
- limitations d\'affichage de certaines options du template selon le niveau de preview'],
"5"=>['0306','- captation anonyme des images des commentaires (d\'aprÃ¨s leur nom d\'origine)
- amÃ©liorations de la classe msql'],
"7"=>['0307','- app msqlvue, permet d\'associer une vue Ã  une table msql
- app anagram, permet de chercher des mots Ã  partir de combinaisons de lettres
- rÃ©vision du conn :lj dans app svg'],
"6"=>['0308','- gestion des lunes dans l\'app meteo
- rstr134 : ibarts, ordre des articles enfants'],
"10"=>['0308','- passage Ã  mariadb 10.4 pour avoir le support json'],
"8"=>['0309','- ajout d\'un upload dans l\'Ã©diteur de commentaires
- ajout d\'une barre de progrÃ¨s pour les upload ajax en gÃ©nÃ©ral'],
"9"=>['0309','- correctif conn :msql (en-tÃªtes)
- correctifs objet web (pb d\'encodage)
- ajout d\'un export json Ã  msql'],
"11"=>['0311','- class maths : trigo, astro, 3d etc
- une tripotÃ©e de fonctions peu usitÃ©es quitte la lib pour se loger dans la classe maths'],
"14"=>['0312','- class maths : ajout de la fonction de calcul de distance entre deux Ã©toiles, via le moteur 3d trigonomÃ©trique'],
"12"=>['0313','- ajout de l\'app simbad, rÃ©cupÃ¨re les infos sur les Ã©toiles depuis http://simbad.u-strasbg.fr (comme ils n\'ont pas d\'api)'],
"13"=>['0314','- ajout de l\'app detectable (gÃ©nÃ©rique Ã  simbad), dÃ©tecte et convertit en tableau de variables les tableaux html d\'une page web, avec un sÃ©lecteur pour choisir lequel prendre'],
"16"=>['0317','- mise en service de la typo philum v19.4 (avec les pictos mÃ©tÃ©orologiques jour/nuit)'],
"15"=>['0321','- mise en place du plan de rÃ©forme du protocole ajax, pour dÃ©placer la var dn8 Ã  la var dn3, qui actuellement est unique et dÃ©place les vars reÃ§us de un cran ;
- rÃ©paration du multithread appliquÃ© Ã  dn8
- mise en place des Ã©lÃ©ments de rÃ©forme pour le polymultithread (appliquÃ© Ã  plusieurs vars de dn8, et dn3 dans le futur)
- extermination d\'un certain nombre de requÃªteurs ajax antiques, supplantÃ©s par le central.'],
"17"=>['0323','- rÃ©novation de codeline, le templateur ayant acquit une capacitÃ© de gestion de small-connecteurs : un appel Ã  ::call() effectue ces deux opÃ©rations distinctement, en vue du produire un contenu entiÃ¨rement en connecteurs (templates+contenus).
- rÃ©novation de vue, le small-templateur (eh oui Ã§a devient compliquÃ©), qui fonctionne par inclusion (connecteur :var). 
Beaucoup de similitudes entre les deux templateurs et les deux parseurs de connecteurs, restent Ã  unifier.'],
"19"=>['0324','- mÃ©nage de printemps, oÃ¹ les fonctions liÃ©es aux connecteurs qui ont peu de succÃ¨s sont relÃ©guÃ©es dans une class mk
- prÃ©paration en vue d\'isoler html2conn et conn2html dans des classes dÃ©diÃ©es, mais franchement on ne voit pas l\'intÃ©rÃªt
- renommage de format_txt vers conn2html parce que c\'est une bonne idÃ©e tant qu\'Ã  faire'],
"18"=>['0325','- amÃ©lioration du fonctionnement des listes (:numlist) pour Ãªtre compatible avec la conversion vers une liste de notes de bas de page'],
"20"=>['0326','- amÃ©lioration ummrenum, renvoie l\'identifiant artificiel d\'un article'],
"21"=>['0327','- amÃ©lioration du constructeur de notes de bas de pages, pour qu\'il ne prenne en compte que la derniÃ¨re sÃ©quence de :numlist quand il y en a plusieurs
- filtre de validitÃ© des urls lors de la conversion html2conn (parce qu\'il y en a qui mettent des pavÃ©s de texte aprÃ¨s le http)'],
"22"=>['0328','- dÃ©placements massifs de fonction moteur dans des classes dÃ©diÃ©es'],
"23"=>['0329','- amÃ©lioration de l\'import-export vers csv (utile pour traduire les tables d\'une traite) ; ajout de csv2array et array2csv (auxquel on ne fait pas appel, prÃ©fÃ©rant des solutions ad-hoc)
- modernisation d\'anciens plugins (msqedit et sÃ©rie des msq_), et suppression de deux, trop ancien, ainsi que du primitif \'editor\', crÃ©Ã© en 2002...
- requalification de msqlvue, pour remplace msqtemplates
- (semi) finalisation des dÃ©placements massifs ; tri.php est consacrÃ© aux traitement des chaÃ®nes et devient appelÃ© par dÃ©faut, en y dÃ©plaÃ§ant les fonctions de lib de traitement de chaÃ®nes (10ko)'],
"24"=>['0330','- fix qq pb dus aux prÃ©cÃ©dents chamboulements
- amÃ©liorations de l\'interface de pad
- introduction des connecteurs, et des balises :speech et :fact (discours et faits), :fact Ã©tant destinÃ© Ã  un dctionnaire des faits certains (ce qui est le destin d\'internet - et a Ã©tÃ© proposÃ© au w3c pour le html6)'],
"25"=>['0331','- rÃ©fection de l\'app stars (astronomie)']];