<?php //philum/msql/program_updates_2103
$r=[1=>['0301','publication'],2=>['0301','- r�forme :msql : re�oit table�row|col, compatible avec les options de traitement table�opt|opt2
- correctifs ::web sets sans id'],3=>['0303','- ajout de l\'app meteo, branch�e sur l\'api Fractal : http://logic.ovh/api/meteo/insee:75101
- ajout des pictos associ�es et d\'un mod�le de correspondance entre les r�f�rences m�t�o et les pictos 
- (proposition d\'un nouveau type de classification m�t�orologique)'],4=>['0305','- r�forme de divb(), exit les paramstrings, conforme � div() de Fractal
- r�forme de la m�thode de variables du templater vue
- correctifs des templates par d�faut
- limitations d\'affichage de certaines options du template selon le niveau de preview'],5=>['0306','- captation anonyme des images des commentaires (d\'apr�s leur nom d\'origine)
- am�liorations de la classe msql'],7=>['0307','- app msqlvue, permet d\'associer une vue � une table msql
- app anagram, permet de chercher des mots � partir de combinaisons de lettres
- r�vision du conn :lj dans app svg'],6=>['0308','- gestion des lunes dans l\'app meteo
- rstr134 : ibarts, ordre des articles enfants'],10=>['0308','- passage � mariadb 10.4 pour avoir le support json'],8=>['0309','- ajout d\'un upload dans l\'�diteur de commentaires
- ajout d\'une barre de progr�s pour les upload ajax en g�n�ral'],9=>['0309','- correctif conn :msql (en-t�tes)
- correctifs objet web (pb d\'encodage)
- ajout d\'un export json � msql'],11=>['0311','- class maths : trigo, astro, 3d etc
- une tripot�e de fonctions peu usit�es quitte la lib pour se loger dans la classe maths'],14=>['0312','- class maths : ajout de la fonction de calcul de distance entre deux �toiles, via le moteur 3d trigonom�trique'],12=>['0313','- ajout de l\'app simbad, r�cup�re les infos sur les �toiles depuis http://simbad.u-strasbg.fr (comme ils n\'ont pas d\'api)'],13=>['0314','- ajout de l\'app detectable (g�n�rique � simbad), d�tecte et convertit en tableau de variables les tableaux html d\'une page web, avec un s�lecteur pour choisir lequel prendre'],16=>['0317','- mise en service de la typo philum v19.4 (avec les pictos m�t�orologiques jour/nuit)'],15=>['0321','- mise en place du plan de r�forme du protocole ajax, pour d�placer la var dn8 � la var dn3, qui actuellement est unique et d�place les vars re�us de un cran ;
- r�paration du multithread appliqu� � dn8
- mise en place des �l�ments de r�forme pour le polymultithread (appliqu� � plusieurs vars de dn8, et dn3 dans le futur)
- extermination d\'un certain nombre de requ�teurs ajax antiques, supplant�s par le central.'],17=>['0323','- r�novation de codeline, le templateur ayant acquit une capacit� de gestion de small-connecteurs : un appel � ::call() effectue ces deux op�rations distinctement, en vue du produire un contenu enti�rement en connecteurs (templates+contenus).
- r�novation de vue, le small-templateur (eh oui �a devient compliqu�), qui fonctionne par inclusion (connecteur :var). 
Beaucoup de similitudes entre les deux templateurs et les deux parseurs de connecteurs, restent � unifier.'],19=>['0324','- m�nage de printemps, o� les fonctions li�es aux connecteurs qui ont peu de succ�s sont rel�gu�es dans une class mk
- pr�paration en vue d\'isoler html2conn et conn2html dans des classes d�di�es, mais franchement on ne voit pas l\'int�r�t
- renommage de format_txt vers conn2html parce que c\'est une bonne id�e tant qu\'� faire'],18=>['0325','- am�lioration du fonctionnement des listes (:numlist) pour �tre compatible avec la conversion vers une liste de notes de bas de page'],20=>['0326','- am�lioration ummrenum, renvoie l\'identifiant artificiel d\'un article'],21=>['0327','- am�lioration du constructeur de notes de bas de pages, pour qu\'il ne prenne en compte que la derni�re s�quence de :numlist quand il y en a plusieurs
- filtre de validit� des urls lors de la conversion html2conn (parce qu\'il y en a qui mettent des pav�s de texte apr�s le http)'],22=>['0328','- d�placements massifs de fonction moteur dans des classes d�di�es'],23=>['0329','- am�lioration de l\'import-export vers csv (utile pour traduire les tables d\'une traite) ; ajout de csv2array et array2csv (auxquel on ne fait pas appel, pr�f�rant des solutions ad-hoc)
- modernisation d\'anciens plugins (msqedit et s�rie des msq_), et suppression de deux, trop ancien, ainsi que du primitif \'editor\', cr�� en 2002...
- requalification de msqlvue, pour remplace msqtemplates
- (semi) finalisation des d�placements massifs ; tri.php est consacr� aux traitement des cha�nes et devient appel� par d�faut, en y d�pla�ant les fonctions de lib de traitement de cha�nes (10ko)'],24=>['0330','- fix qq pb dus aux pr�c�dents chamboulements
- am�liorations de l\'interface de pad
- introduction des connecteurs, et des balises :speech et :fact (discours et faits), :fact �tant destin� � un dctionnaire des faits certains (ce qui est le destin d\'internet - et a �t� propos� au w3c pour le html6)'],25=>['0331','- r�fection de l\'app stars (astronomie)']];