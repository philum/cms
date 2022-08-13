<?php //philum/microsql/program_updates_1904_sav
$r=[1=>['0401','publication'],2=>['0407','introduction de xss, plugin permettant de capter le dom des flux des sites qui n\'ont pas (la bonne idée d\'avoir) de flux rss'],3=>['0407','amélioration du rss_input, rendu capable d\'interpréter correctement des flux en forme d\'objets'],4=>['0415','ajout des connecteurs :
- :toggle_quote, permet d\'ouvrir sur place un contenu invisible dans une blockquote
- :note, affiche sur place un contenu laissé invisible dans le texte
- bubble_note, affiche une bulle utilisant ajax, en laissant le contenu invisible dans le code source

en supplément des connecteurs similaires :
- :toggle : affiche un contenu sur place dans une div (cas d\'une sous-partie d\'article)
- :pop : affiche un contenu dans une popup, via ajax (invisible dans la source)
- :bubble (rien à voir) sert à appeler une procédure de menus bubble'],5=>['0417','correctif htaccess et comportement associé permettant de joindre un \"dig=all\" (scan temporel complet) sur les catégories utilisateur de tags (user_tags), sans provoquer d\'erreur lors du des appels suivants (vieille erreur)'],6=>['0418','ajout du support d\'importation de l\'attribut srcset de img'],7=>['0420','correctif gestionnaire de clefs d\'api twitter'],8=>['0423','correctif interprétation des images locales à url entier (full url) - pour qu\'elles redeviennent locales'],9=>['0423','- Ajout du support de quatre natures de requêtes à l\'Api : 
-- les tags utilisateurs (utag ou n] du jeton)
-- folder : articles d\'un répertoire virtuel
-- related : articles liés
-- relatedby : références
-- ajout du module \'folder\' (répertoires virtuels) qui renvoie la liste des titres
- mise à niveau des appendices du sélecteur de menus connus, et du gestionnaire apicom pour exploiter les répertoires virtuels'],11=>['0424','- perfectionnement du gestionnaire de booléens dans le moteur de recherche'],10=>['0425','- ajout de l\'Api vacuum, permet à des requêtes extérieures de profiter du dispositif d\'aspiration de contenu de Philum, en remplacement de la regrettée Api Mercury
- amélioration du gestionnaire le lecture mp4 : supporte les liens
- ajout du connecteur :mp4 : supporte un lien qui renvoie une popup
- fix pb et rénovation du producteur rss
- amélioration gestionnaire :list, supporte le séparateur de colonnes \'|\''],12=>['0430','- correctifs application isolée forçant une surcharge (goodroot)
- correctif scan_txt, supporte les pages html
- correctif sitemap
- ajout d\'une entrée pour les plugins externalisés (accès direct au build)
- rénovation du gestionnaire de hubs'],13=>['0430','- ajout du dispositif tweetfeed, permet, comme la newsletter, d\'envoyer périodiquement un fil d\'articles, définit par une bloc de modules, contenant un ou des modules \'api_arts\', de l\'envoyer via l\'api twitter']];