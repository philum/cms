<?php //msql/program_updates_1904
$r=["1"=>['0401','publication'],
"2"=>['0407','introduction de xss, plugin permettant de capter le dom des flux des sites qui n\'ont pas (la bonne idÃ©e d\'avoir) de flux rss'],
"3"=>['0407','amÃ©lioration du rss_input, rendu capable d\'interprÃ©ter correctement des flux en forme d\'objets'],
"4"=>['0415','ajout des connecteurs :
- :toggle_quote, permet d\'ouvrir sur place un contenu invisible dans une blockquote
- :note, affiche sur place un contenu laissÃ© invisible dans le texte
- bubble_note, affiche une bulle utilisant ajax, en laissant le contenu invisible dans le code source

en supplÃ©ment des connecteurs similaires :
- :toggle : affiche un contenu sur place dans une div (cas d\'une sous-partie d\'article)
- :pop : affiche un contenu dans une popup, via ajax (invisible dans la source)
- :bubble (rien Ã  voir) sert Ã  appeler une procÃ©dure de menus bubble'],
"5"=>['0417','correctif htaccess et comportement associÃ© permettant de joindre un \"dig=all\" (scan temporel complet) sur les catÃ©gories utilisateur de tags (user_tags), sans provoquer d\'erreur lors du des appels suivants (vieille erreur)'],
"6"=>['0418','ajout du support d\'importation de l\'attribut srcset de img'],
"7"=>['0420','correctif gestionnaire de clefs d\'api twitter'],
"8"=>['0423','correctif interprÃ©tation des images locales Ã  url entier (full url) - pour qu\'elles redeviennent locales'],
"9"=>['0423','- Ajout du support de quatre natures de requÃªtes Ã  l\'Api : 
-- les tags utilisateurs (utag ou n] du jeton)
-- folder : articles d\'un rÃ©pertoire virtuel
-- related : articles liÃ©s
-- relatedby : rÃ©fÃ©rences
-- ajout du module \'folder\' (rÃ©pertoires virtuels) qui renvoie la liste des titres
- mise Ã  niveau des appendices du sÃ©lecteur de menus connus, et du gestionnaire apicom pour exploiter les rÃ©pertoires virtuels'],
"11"=>['0424','- perfectionnement du gestionnaire de boolÃ©ens dans le moteur de recherche'],
"10"=>['0425','- ajout de l\'Api vacuum, permet Ã  des requÃªtes extÃ©rieures de profiter du dispositif d\'aspiration de contenu de Philum, en remplacement de la regrettÃ©e Api Mercury
- amÃ©lioration du gestionnaire le lecture mp4 : supporte les liens
- ajout du connecteur :mp4 : supporte un lien qui renvoie une popup
- fix pb et rÃ©novation du producteur rss
- amÃ©lioration gestionnaire :list, supporte le sÃ©parateur de colonnes \'|\''],
"12"=>['0430','- correctifs application isolÃ©e forÃ§ant une surcharge (goodroot)
- correctif scan_txt, supporte les pages html
- correctif sitemap
- ajout d\'une entrÃ©e pour les plugins externalisÃ©s (accÃ¨s direct au build)
- rÃ©novation du gestionnaire de hubs'],
"13"=>['0430','- ajout du dispositif tweetfeed, permet, comme la newsletter, d\'envoyer pÃ©riodiquement un fil d\'articles, dÃ©finit par une bloc de modules, contenant un ou des modules \'api_arts\', de l\'envoyer via l\'api twitter']];