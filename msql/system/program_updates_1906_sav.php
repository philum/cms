<?php //philum/microsql/program_updates_1906_sav
$r=[1=>['0601','publication'],2=>['0602','- am�lioration substantielle du syst�me de maintenance backupim'],4=>['0603','- backupim extradie les images orphelines dans /imgx
- les images ban_ passent de /img � /imgb, les cods sont mos dans imgb/cod'],3=>['0604','- r�forme d\'une certaine somme d\'�l�ments du moteur html, en vue de simplification / harmonisation (maj critique, 72 fichiers impact�s) : balise->bal (plus rapide), balb->bal, ancien bal->balb (rapide) + etc
- fix pb affichage du rapport de mise � jour'],5=>['0605','Ensemble de r�formes de travail pour rendre signifiantes et op�rationnelles les balises h, si utiles dans la conception d\'un texte structur� : 
- ajout de l\'option d\'article \'plan\', encore inusit�
- ajout du connecteur :plan, cr�e une table des mati�res d\'apr�s les balises h1, h2... h5
- rectification de la gestion des balises h dans l\'importateur : l\'unification vers une balise :h g�n�rique (=h2) est rel�gu�e au filtre \'clean-h\'
- les titres sont d�sormais en h1 (anciennement h2)
- la balise :h par d�faut revient � h2 (anciennement h3)'],6=>['0606','- ajout du dispositif g�n�rique taxonomy, utilis� par le nouveau connecteur :plan, et destin� � remplacer de vieilles proc�dures h�t�rog�nes et peu usit�es (issu de FractalFramework)
- le connecteur :plan peut recevoir un param et une option, p=titre, o=1 : num�rotation topologique, sinon num�rotation paragraphique
- ajout de la classe css globale .taxonomy'],7=>['0607','correctifs form tracks non logu�
- r�forme de rss_art, qui abolit le rss au profit de l\'api ; sert � appeler des articles philum sur d\'autres sites
- ajout des connecteur :frame et :underline, permettent d\'ajouter un cadre et un soulignement de couleur autour d\'un texte
- suppression d\'une s�rie de connecteur u-(colors) au profit de :underline
- am�lioration substantielle de l\'�dition wyswyg en vue de devenir le mode d\'�dition privil�gi� : ajout d\'un bouton d\'activation dans la barre d\'admin, ajouut des boutons de titre et d\'ajout de lien, on peut enregistrer en cours d\'�dition, enregistrement des images par glisser-d�poser.'],8=>['0610','- correctifs gestionnaire wyh'],9=>['0611','moteur de recherche :
- ajout d\'un constructeur de commande d\'Api
- interf�rence entre une commande Api et les param�tres basiques cat et tag
api :
- ajout de la commande d\'Api \'random\', s�lectionne un objet dans la commande
module :
- ajout du module \'cover\', revient � un module \'api_arts\' avec une commande \'panel\' et un template \'cover\'.
- ajout du template \'cover\''],10=>['0612','- finalisation du module api_chan
- correctif MenuJ pour choisir un toggle ou un bt
- ajout de connecteur :stabilo � la place de :s
- ajout d\'une s�rie compl�te d\'�moticones dans edit/ascii
- fix notices
- ajout d\'un contr�le de l\'uniformisation des balises h, par d�faut h1-h2-h3=>h2, h4-h5=>h4. Pour bypasser �a, passer par les importateurs manuels (wyg, plugin txt)'],11=>['0613','- finalisation du de l\'option d\'article \'plan\', permet d\'obtenir le plan d\'un article dans une popup et de naviguer facilement dans un texte tr�s long
- ajout de l\'option d\'article \'password\', permet d\'affecter un mot de passe pour acc�der � un article'],12=>['0614','- ajout de \'test\', une machine de tests unitaires des modules et des connecteurs (parce que certains sont tr�s vieux)'],13=>['0616','- am�lioration du bouton preview, permet maintenant de permuter entre deux mode d\'�dition, connecteurs et wygzig'],14=>['0617','- correctifs dans le nous testeur
- suppression des connecteur :floatright et :floatleft au profit de :float
- correctif du connecteur :slide (simplification) utilise l\'id de l\'article ou un titre'],15=>['0618','- test unitaire de tous les connecteurs'],16=>['0624','- ajout du plug oldconn, rechape (m�thodiquement) les anciens connecteurs de fa�on � s\'assurer � avoir la rstr70 d�sactiv�e
- ajout des connecteurs :red :blue :parm
- :r devient :red
- :s devient :stabilo
- :l evient :s'],17=>['0626','- r�fection de suggest, le plugin du suggestion d\'article permet maintenant d\'en �diter un sur place, en plus de pouvoir en importer un depuis le web'],18=>['0629','- delete() devient sqldel() au format fractal'],19=>['0630','- fix pb d\'�criture de vignettes de vid�os dans le catalogue d\'images d\'un article qui provenait d\'autres articles, suite � une mauvaise d�tection de l\'�xistence de cette vignette']];