<?php //philum/microsql/program_updates_1803_sav
$r=["_menus_"=>['_menus_','date','text'],1=>['0301','publication'],2=>['0303','ajout du connecteur :papi (pop api) renvoie le bouton qui renvoie le connecteur :api'],3=>['0305','ajout du connecteur :wiki, renvoie le contenu de wikipedia pour un mot dans une popup'],4=>['0306','rénovation du formulaire de commentaire pour éviter les collisions avec les autres éditeurs ouverts'],5=>['0311','réparation de la signalisation des contextes particuliers des articles au moment de leur déroulé depuis un appel exogène de l\'API (signalement de la langue par ex)'],6=>['0314','introduction du terme et du dispositif asciicss : 
- table msql /system/edition/picto_2
- plugin générateur de css \'asciicss\', 
- feuille \'_ascii.css\'
- reconnaissance par la mises à jour
- connecteur :ascii (à partir de sa nomination)

De même que pour picto(), asciicss() permet d\'appeler un glyphe à partir de sa dénomination.
269 glyphes sont reconnus.
(pour fêter l\'arrivée du printemps et des nouveaux ascii couleur, on anticipe une future standardisation de cet usage)'],7=>['0314','- déplacement du lecteur de radio dans un plugin
- confiscation du procédé rendu obsolète \'miniconn\'
- réforme du procédé \'sconn\', réduit à l\'essentiel pour servir à l\'édition rapide d\'un article'],8=>['0317','- ajout de la classe css globale \'sticky\' qui s\'applique au menu de mise en forme d\'un texte édité sur place en wyswyg (pour qu\'il reste à l\'écran quand on scroll)
- correctif pour que menubub/overcat prenne en compte le paramètre de niveau de privilège
- rectification du comportement des images précédées d\'un texte, renvoie le texte avec un lien vers l\'image, puisque le contraire (img/txt) renvoie une balise \'figure\'
- favorisation lors de l\'import d\'article de l\'usage de la balise \'figure\', y compris sur les balises de dictionnaire (obsolètes) dd,dt,dl.
- correctif confusion entre les connecteurs :s et :c (stabilo et css txtclr)
- ajout du bouton d\'édition \'quo\' (ajoute des guillemets typographiques)
- remplacement de quelques pictos par des ascii
- ajout d\'une gestion des traduction dans l\'éditeur de métas'],9=>['0320','- ajout de la typo GlyphiconsHalfings, et du dispositif \'glyph\' (avec son connecteur :glyph), qui complète \'icons\', \'pictos\', et \'ascii\' : beaux pictos bien fonctionnels pompés sur le site de pole-emploi'],10=>['0321','- ajout de l\'option-utilisateur \'preview\', permet de supplanter le, et revenir au niveau de prévisualisation des articles de l\'API.
- révision de la nomination des langues, en conformité avec les conventions internationales'],11=>['0324','- rénovation du connecteur :jukebox, le lecteur flash antique est oublié et à la place on met un joli sélecteur ajax de lecteur html5'],12=>['0328','- le panneau ascii de l\'éditeur ouvre vers un autre panneau des connecteur ascii
- révision du système de mise en cache des options d\'articles, rendu individualisé plutôt que global (causait, au choix, selon la présence ou l\'absence du cache, une erreur d\'attribution dans les fils, ou une absence d\'articles liés)'],13=>['0329','- ajout de la picto-font \'oomo\''],14=>['0330','- révision 9.4 de la picto-font \'philum\''],15=>['0331','- révision 10.6 de la picto-font \'philum\', entièrement révisée sur une grille multiple de puissance 2 ; ajout de nombreux glyphes (174 au total)']];