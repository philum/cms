<?php //philum/microsql/program_updates_1803_sav
$r=["_menus_"=>['_menus_','date','text'],1=>['0301','publication'],2=>['0303','ajout du connecteur :papi (pop api) renvoie le bouton qui renvoie le connecteur :api'],3=>['0305','ajout du connecteur :wiki, renvoie le contenu de wikipedia pour un mot dans une popup'],4=>['0306','r�novation du formulaire de commentaire pour �viter les collisions avec les autres �diteurs ouverts'],5=>['0311','r�paration de la signalisation des contextes particuliers des articles au moment de leur d�roul� depuis un appel exog�ne de l\'API (signalement de la langue par ex)'],6=>['0314','introduction du terme et du dispositif asciicss : 
- table msql /system/edition/picto_2
- plugin g�n�rateur de css \'asciicss\', 
- feuille \'_ascii.css\'
- reconnaissance par la mises � jour
- connecteur :ascii (� partir de sa nomination)

De m�me que pour picto(), asciicss() permet d\'appeler un glyphe � partir de sa d�nomination.
269 glyphes sont reconnus.
(pour f�ter l\'arriv�e du printemps et des nouveaux ascii couleur, on anticipe une future standardisation de cet usage)'],7=>['0314','- d�placement du lecteur de radio dans un plugin
- confiscation du proc�d� rendu obsol�te \'miniconn\'
- r�forme du proc�d� \'sconn\', r�duit � l\'essentiel pour servir � l\'�dition rapide d\'un article'],8=>['0317','- ajout de la classe css globale \'sticky\' qui s\'applique au menu de mise en forme d\'un texte �dit� sur place en wyswyg (pour qu\'il reste � l\'�cran quand on scroll)
- correctif pour que menubub/overcat prenne en compte le param�tre de niveau de privil�ge
- rectification du comportement des images pr�c�d�es d\'un texte, renvoie le texte avec un lien vers l\'image, puisque le contraire (img/txt) renvoie une balise \'figure\'
- favorisation lors de l\'import d\'article de l\'usage de la balise \'figure\', y compris sur les balises de dictionnaire (obsol�tes) dd,dt,dl.
- correctif confusion entre les connecteurs :s et :c (stabilo et css txtclr)
- ajout du bouton d\'�dition \'quo\' (ajoute des guillemets typographiques)
- remplacement de quelques pictos par des ascii
- ajout d\'une gestion des traduction dans l\'�diteur de m�tas'],9=>['0320','- ajout de la typo GlyphiconsHalfings, et du dispositif \'glyph\' (avec son connecteur :glyph), qui compl�te \'icons\', \'pictos\', et \'ascii\' : beaux pictos bien fonctionnels pomp�s sur le site de pole-emploi'],10=>['0321','- ajout de l\'option-utilisateur \'preview\', permet de supplanter le, et revenir au niveau de pr�visualisation des articles de l\'API.
- r�vision de la nomination des langues, en conformit� avec les conventions internationales'],11=>['0324','- r�novation du connecteur :jukebox, le lecteur flash antique est oubli� et � la place on met un joli s�lecteur ajax de lecteur html5'],12=>['0328','- le panneau ascii de l\'�diteur ouvre vers un autre panneau des connecteur ascii
- r�vision du syst�me de mise en cache des options d\'articles, rendu individualis� plut�t que global (causait, au choix, selon la pr�sence ou l\'absence du cache, une erreur d\'attribution dans les fils, ou une absence d\'articles li�s)'],13=>['0329','- ajout de la picto-font \'oomo\''],14=>['0330','- r�vision 9.4 de la picto-font \'philum\''],15=>['0331','- r�vision 10.6 de la picto-font \'philum\', enti�rement r�vis�e sur une grille multiple de puissance 2 ; ajout de nombreux glyphes (174 au total)']];