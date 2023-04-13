<?php //msql/program_updates_1803
$r=["_menus_"=>['_menus_','date','text'],
"1"=>['0301','publication'],
"2"=>['0303','ajout du connecteur :papi (pop api) renvoie le bouton qui renvoie le connecteur :api'],
"3"=>['0305','ajout du connecteur :wiki, renvoie le contenu de wikipedia pour un mot dans une popup'],
"4"=>['0306','rÃ©novation du formulaire de commentaire pour Ã©viter les collisions avec les autres Ã©diteurs ouverts'],
"5"=>['0311','rÃ©paration de la signalisation des contextes particuliers des articles au moment de leur dÃ©roulÃ© depuis un appel exogÃ¨ne de l\'API (signalement de la langue par ex)'],
"6"=>['0314','introduction du terme et du dispositif asciicss : 
- table msql /system/edition/picto_2
- plugin gÃ©nÃ©rateur de css \'asciicss\', 
- feuille \'_ascii.css\'
- reconnaissance par la mises Ã  jour
- connecteur :ascii (Ã  partir de sa nomination)

De mÃªme que pour picto(), asciicss() permet d\'appeler un glyphe Ã  partir de sa dÃ©nomination.
269 glyphes sont reconnus.
(pour fÃªter l\'arrivÃ©e du printemps et des nouveaux ascii couleur, on anticipe une future standardisation de cet usage)'],
"7"=>['0314','- dÃ©placement du lecteur de radio dans un plugin
- confiscation du procÃ©dÃ© rendu obsolÃ¨te \'miniconn\'
- rÃ©forme du procÃ©dÃ© \'sconn\', rÃ©duit Ã  l\'essentiel pour servir Ã  l\'Ã©dition rapide d\'un article'],
"8"=>['0317','- ajout de la classe css globale \'sticky\' qui s\'applique au menu de mise en forme d\'un texte Ã©ditÃ© sur place en wyswyg (pour qu\'il reste Ã  l\'Ã©cran quand on scroll)
- correctif pour que menubub/overcat prenne en compte le paramÃ¨tre de niveau de privilÃ¨ge
- rectification du comportement des images prÃ©cÃ©dÃ©es d\'un texte, renvoie le texte avec un lien vers l\'image, puisque le contraire (img/txt) renvoie une balise \'figure\'
- favorisation lors de l\'import d\'article de l\'usage de la balise \'figure\', y compris sur les balises de dictionnaire (obsolÃ¨tes) dd,dt,dl.
- correctif confusion entre les connecteurs :s et :c (stabilo et css txtclr)
- ajout du bouton d\'Ã©dition \'quo\' (ajoute des guillemets typographiques)
- remplacement de quelques pictos par des ascii
- ajout d\'une gestion des traduction dans l\'Ã©diteur de mÃ©tas'],
"9"=>['0320','- ajout de la typo GlyphiconsHalfings, et du dispositif \'glyph\' (avec son connecteur :glyph), qui complÃ¨te \'icons\', \'pictos\', et \'ascii\' : beaux pictos bien fonctionnels pompÃ©s sur le site de pole-emploi'],
"10"=>['0321','- ajout de l\'option-utilisateur \'preview\', permet de supplanter le, et revenir au niveau de prÃ©visualisation des articles de l\'API.
- rÃ©vision de la nomination des langues, en conformitÃ© avec les conventions internationales'],
"11"=>['0324','- rÃ©novation du connecteur :jukebox, le lecteur flash antique est oubliÃ© et Ã  la place on met un joli sÃ©lecteur ajax de lecteur html5'],
"12"=>['0328','- le panneau ascii de l\'Ã©diteur ouvre vers un autre panneau des connecteur ascii
- rÃ©vision du systÃ¨me de mise en cache des options d\'articles, rendu individualisÃ© plutÃ´t que global (causait, au choix, selon la prÃ©sence ou l\'absence du cache, une erreur d\'attribution dans les fils, ou une absence d\'articles liÃ©s)'],
"13"=>['0329','- ajout de la picto-font \'oomo\''],
"14"=>['0330','- rÃ©vision 9.4 de la picto-font \'philum\''],
"15"=>['0331','- rÃ©vision 10.6 de la picto-font \'philum\', entiÃ¨rement rÃ©visÃ©e sur une grille multiple de puissance 2 ; ajout de nombreux glyphes (174 au total)']];