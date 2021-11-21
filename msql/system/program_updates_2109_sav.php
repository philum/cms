<?php //philum/msql/program_updates_2109_sav
$r=[1=>['0904','publication'],2=>['0911','ajout de treat_img en supplétif à treat_links dans conv'],3=>['0912','- correctif de msql_read vers msql::col
- ajout du conn :math et des balises associtées à matl.ml
- suppression du :svg et de :svgcode, qui devient :svg ; les .svg sont traités comme les images, et :svg fait appel au constructeur svg
- suggestions auto des defcons connues au moment où est proposé d\'ajouter une nouvelle définition d\'importation de contenu, d\'après une base des defs les plus usitées'],4=>['0912','- petite rénovation de l\'inusité lecteur xss
- la suggestion des defcons peut être appelée depuis l\'éditeur de définitions
- la reconnaissance de defcons étant obsolète (on utilise une codification du ciblage des balises), elle est remplacée par le nouveau dispositif known_defcons() (voir hier) : cette enquête occasionne directement un nouvel enregistrement. La consultation des pages externes peut être généralisée. C\'est cool. Todo : mise à jour des defs qui ne marchent pas
- fix pb inconnu d\'importation d\'images b64 sans faire exprès lors de la consultation de pages externes ; cette commodité est confisquée et confiée à l\'étape ultérieure, la lecture, qui connaît l\'id.
- ajout de la rstr139, réduit automatiquement les images >1000px'],5=>['0916','- réfection de starmap2'],6=>['0917','ajout des conn :
- bt : appelle un connecteur sur place (remplace la commodité conflictuelle qui consistait à rajouter §bt après le connecteur habituel)
- appbt :lien vers une app']];