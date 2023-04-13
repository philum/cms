<?php //msql/program_updates_1906
$r=["1"=>['0601','publication'],
"2"=>['0602','- amÃ©lioration substantielle du systÃ¨me de maintenance backupim'],
"4"=>['0603','- backupim extradie les images orphelines dans /imgx
- les images ban_ passent de /img Ã  /imgb, les cods sont mos dans imgb/cod'],
"3"=>['0604','- rÃ©forme d\'une certaine somme d\'Ã©lÃ©ments du moteur html, en vue de simplification / harmonisation (maj critique, 72 fichiers impactÃ©s) : balise->bal (plus rapide), balb->bal, ancien bal->balb (rapide) + etc
- fix pb affichage du rapport de mise Ã  jour'],
"5"=>['0605','Ensemble de rÃ©formes de travail pour rendre signifiantes et opÃ©rationnelles les balises h, si utiles dans la conception d\'un texte structurÃ© : 
- ajout de l\'option d\'article \'plan\', encore inusitÃ©
- ajout du connecteur :plan, crÃ©e une table des matiÃ¨res d\'aprÃ¨s les balises h1, h2... h5
- rectification de la gestion des balises h dans l\'importateur : l\'unification vers une balise :h gÃ©nÃ©rique (=h2) est relÃ©guÃ©e au filtre \'clean-h\'
- les titres sont dÃ©sormais en h1 (anciennement h2)
- la balise :h par dÃ©faut revient Ã  h2 (anciennement h3)'],
"6"=>['0606','- ajout du dispositif gÃ©nÃ©rique taxonomy, utilisÃ© par le nouveau connecteur :plan, et destinÃ© Ã  remplacer de vieilles procÃ©dures hÃ©tÃ©rogÃ¨nes et peu usitÃ©es (issu de FractalFramework)
- le connecteur :plan peut recevoir un param et une option, p=titre, o=1 : numÃ©rotation topologique, sinon numÃ©rotation paragraphique
- ajout de la classe css globale .taxonomy'],
"7"=>['0607','correctifs form tracks non loguÃ©
- rÃ©forme de rss_art, qui abolit le rss au profit de l\'api ; sert Ã  appeler des articles philum sur d\'autres sites
- ajout des connecteur :frame et :underline, permettent d\'ajouter un cadre et un soulignement de couleur autour d\'un texte
- suppression d\'une sÃ©rie de connecteur u-(colors) au profit de :underline
- amÃ©lioration substantielle de l\'Ã©dition wyswyg en vue de devenir le mode d\'Ã©dition privilÃ©giÃ© : ajout d\'un bouton d\'activation dans la barre d\'admin, ajouut des boutons de titre et d\'ajout de lien, on peut enregistrer en cours d\'Ã©dition, enregistrement des images par glisser-dÃ©poser.'],
"8"=>['0610','- correctifs gestionnaire wyh'],
"9"=>['0611','moteur de recherche :
- ajout d\'un constructeur de commande d\'Api
- interfÃ©rence entre une commande Api et les paramÃ¨tres basiques cat et tag
api :
- ajout de la commande d\'Api \'random\', sÃ©lectionne un objet dans la commande
module :
- ajout du module \'cover\', revient Ã  un module \'api_arts\' avec une commande \'panel\' et un template \'cover\'.
- ajout du template \'cover\''],
"10"=>['0612','- finalisation du module api_chan
- correctif MenuJ pour choisir un toggle ou un bt
- ajout de connecteur :stabilo Ã  la place de :s
- ajout d\'une sÃ©rie complÃ¨te d\'Ã©moticones dans edit/ascii
- fix notices
- ajout d\'un contrÃ´le de l\'uniformisation des balises h, par dÃ©faut h1-h2-h3=>h2, h4-h5=>h4. Pour bypasser Ã§a, passer par les importateurs manuels (wyg, plugin txt)'],
"11"=>['0613','- finalisation du de l\'option d\'article \'plan\', permet d\'obtenir le plan d\'un article dans une popup et de naviguer facilement dans un texte trÃ¨s long
- ajout de l\'option d\'article \'password\', permet d\'affecter un mot de passe pour accÃ©der Ã  un article'],
"12"=>['0614','- ajout de \'test\', une machine de tests unitaires des modules et des connecteurs (parce que certains sont trÃ¨s vieux)'],
"13"=>['0616','- amÃ©lioration du bouton preview, permet maintenant de permuter entre deux mode d\'Ã©dition, connecteurs et wygzig'],
"14"=>['0617','- correctifs dans le nous testeur
- suppression des connecteur :floatright et :floatleft au profit de :float
- correctif du connecteur :slide (simplification) utilise l\'id de l\'article ou un titre'],
"15"=>['0618','- test unitaire de tous les connecteurs'],
"16"=>['0624','- ajout du plug oldconn, rechape (mÃ©thodiquement) les anciens connecteurs de faÃ§on Ã  s\'assurer Ã  avoir la rstr70 dÃ©sactivÃ©e
- ajout des connecteurs :red :blue :parm
- :r devient :red
- :s devient :stabilo
- :l evient :s'],
"17"=>['0626','- rÃ©fection de suggest, le plugin du suggestion d\'article permet maintenant d\'en Ã©diter un sur place, en plus de pouvoir en importer un depuis le web'],
"18"=>['0629','- delete() devient sqldel() au format fractal'],
"19"=>['0630','- fix pb d\'Ã©criture de vignettes de vidÃ©os dans le catalogue d\'images d\'un article qui provenait d\'autres articles, suite Ã  une mauvaise dÃ©tection de l\'Ã©xistence de cette vignette']];