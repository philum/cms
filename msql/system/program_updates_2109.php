<?php //msql/program_updates_2109
$r=["1"=>['0904','publication'],
"2"=>['0911','ajout de treat_img en supplÃ©tif Ã  treat_links dans conv'],
"3"=>['0912','- correctif de msql_read vers msql::col
- ajout du conn :math et des balises associtÃ©es Ã  matl.ml
- suppression du :svg et de :svgcode, qui devient :svg ; les .svg sont traitÃ©s comme les images, et :svg fait appel au constructeur svg
- suggestions auto des defcons connues au moment oÃ¹ est proposÃ© d\'ajouter une nouvelle dÃ©finition d\'importation de contenu, d\'aprÃ¨s une base des defs les plus usitÃ©es'],
"4"=>['0912','- petite rÃ©novation de l\'inusitÃ© lecteur xss
- la suggestion des defcons peut Ãªtre appelÃ©e depuis l\'Ã©diteur de dÃ©finitions
- la reconnaissance de defcons Ã©tant obsolÃ¨te (on utilise une codification du ciblage des balises), elle est remplacÃ©e par le nouveau dispositif known_defcons() (voir hier) : cette enquÃªte occasionne directement un nouvel enregistrement. La consultation des pages externes peut Ãªtre gÃ©nÃ©ralisÃ©e. C\'est cool. Todo : mise Ã  jour des defs qui ne marchent pas
- fix pb inconnu d\'importation d\'images b64 sans faire exprÃ¨s lors de la consultation de pages externes ; cette commoditÃ© est confisquÃ©e et confiÃ©e Ã  l\'Ã©tape ultÃ©rieure, la lecture, qui connaÃ®t l\'id.
- ajout de la rstr139, rÃ©duit automatiquement les images >1000px'],
"5"=>['0916','- rÃ©fection de starmap2'],
"6"=>['0917','ajout des conn :
- bt : appelle un connecteur sur place (remplace la commoditÃ© conflictuelle qui consistait Ã  rajouter Â§bt aprÃ¨s le connecteur habituel)
- appbt :lien vers une app']];