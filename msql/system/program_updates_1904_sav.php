<?php //philum/microsql/program_updates_1904_sav
$r=[1=>['0401','publication'],2=>['0407','introduction de xss, plugin permettant de capter le dom des flux des sites qui n\'ont pas (la bonne id�e d\'avoir) de flux rss'],3=>['0407','am�lioration du rss_input, rendu capable d\'interpr�ter correctement des flux en forme d\'objets'],4=>['0415','ajout des connecteurs :
- :toggle_quote, permet d\'ouvrir sur place un contenu invisible dans une blockquote
- :note, affiche sur place un contenu laiss� invisible dans le texte
- bubble_note, affiche une bulle utilisant ajax, en laissant le contenu invisible dans le code source

en suppl�ment des connecteurs similaires :
- :toggle : affiche un contenu sur place dans une div (cas d\'une sous-partie d\'article)
- :pop : affiche un contenu dans une popup, via ajax (invisible dans la source)
- :bubble (rien � voir) sert � appeler une proc�dure de menus bubble'],5=>['0417','correctif htaccess et comportement associ� permettant de joindre un \"dig=all\" (scan temporel complet) sur les cat�gories utilisateur de tags (user_tags), sans provoquer d\'erreur lors du des appels suivants (vieille erreur)'],6=>['0418','ajout du support d\'importation de l\'attribut srcset de img'],7=>['0420','correctif gestionnaire de clefs d\'api twitter'],8=>['0423','correctif interpr�tation des images locales � url entier (full url) - pour qu\'elles redeviennent locales'],9=>['0423','- Ajout du support de quatre natures de requ�tes � l\'Api : 
-- les tags utilisateurs (utag ou n] du jeton)
-- folder : articles d\'un r�pertoire virtuel
-- related : articles li�s
-- relatedby : r�f�rences
-- ajout du module \'folder\' (r�pertoires virtuels) qui renvoie la liste des titres
- mise � niveau des appendices du s�lecteur de menus connus, et du gestionnaire apicom pour exploiter les r�pertoires virtuels'],11=>['0424','- perfectionnement du gestionnaire de bool�ens dans le moteur de recherche'],10=>['0425','- ajout de l\'Api vacuum, permet � des requ�tes ext�rieures de profiter du dispositif d\'aspiration de contenu de Philum, en remplacement de la regrett�e Api Mercury
- am�lioration du gestionnaire le lecture mp4 : supporte les liens
- ajout du connecteur :mp4 : supporte un lien qui renvoie une popup
- fix pb et r�novation du producteur rss
- am�lioration gestionnaire :list, supporte le s�parateur de colonnes \'|\''],12=>['0430','- correctifs application isol�e for�ant une surcharge (goodroot)
- correctif scan_txt, supporte les pages html
- correctif sitemap
- ajout d\'une entr�e pour les plugins externalis�s (acc�s direct au build)
- r�novation du gestionnaire de hubs'],13=>['0430','- ajout du dispositif tweetfeed, permet, comme la newsletter, d\'envoyer p�riodiquement un fil d\'articles, d�finit par une bloc de modules, contenant un ou des modules \'api_arts\', de l\'envoyer via l\'api twitter']];