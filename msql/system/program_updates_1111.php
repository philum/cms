<?php //msql/program_updates_1111
$r=["_menus_"=>['day','text'],
"1"=>['111110','ajout d\'un bouton qui permet de choisir la chronologie des articles affiliÃ©s Ã  un article parent'],
"2"=>['111118','amÃ©lioration du confort de la visionneuse flash \'Slider\''],
"3"=>['111119','correctifs dÃ©tection de l\'ID des vidÃ©os youtube et dailymotion'],
"4"=>['111119','amÃ©lioration commoditÃ© de batch_import, permet d\'ajouter des url en sÃ©rie, avant de les importer en sÃ©rie'],
"5"=>['111124','rÃ©novation de \'model.php\', le modÃ¨le de plugins, pour une meilleure comprÃ©hension'],
"6"=>['111124','ajout du plugin \'superpoll\' qui permet de voter des propositions :
- ne nÃ©cessite aucun login (ouvert au visiteur) ;
- permet d\'ajouter des entrÃ©es en plus des propositions ;
- rÃ©ordonne les entrÃ©es les plus votÃ©es ;
- interdit les votes multiples mais permet de changer son vote ;
- fonctionne en mode autonome (dans une iframe sur n\'importe quelle page) : appeler plug/index.php?call=superpoll&p=1 oÃ¹ 1 est l\'ID de la table ;
- autorise la crÃ©ation de nouvelles tables Ã  la volÃ©e ;
- entiÃ¨rement en ajax ;
- propose le code et le flux xml des rÃ©sultats (open data)
'],
"7"=>['111125','index.php peut dÃ©sormais servir Ã  appeler des plugins avec les variables ?call=plugin&param=&opt= (deux options), de faÃ§on Ã  les rendre utilisable hors contexte, notamment lors d\'un appel depuis l\'extÃ©rieur dans une iframe'],
"8"=>['111125','nouveau connecteur :video, qui remplace les connecteurs spÃ©cialisÃ©s de chaque provider (youtube, dailymotion, google, ted, livestream), Ã©tant donnÃ© que leur format est dÃ©tectable'],
"9"=>['111126','amÃ©nagements de fiabilitÃ© du nouveau connecteur :video ;
(les paramÃ¨tres optionnels qui apparaissent parfois sont supprimÃ©s, les providers ne faisant aucun effort de conformitÃ© il faut s\'adapter Ã  de nombreux cas de figure)'],
"10"=>['111130','introduction du module \'video_viewer\' qui recrute toutes les vidÃ©os (avec le connecteur \':video\') des articles  publics (en cache) et les propose dans une fenÃªtre qui permet de naviguer de l\'une Ã  l\'autre (viewer) ;
- le param permet d\'opÃ©rer un tri selon un ou plusieurs tags
'],
"11"=>['111130','amÃ©lioration substantielle du moteur de recherche : 
- capable de choisir la mÃ©thode selon le ratio optimal entre les titres Ã©ligibles et les titres testables ; dans certains cas il vaut mieux que les Ã©ligibles soit utilisÃ©s dans la requÃªte sql, mais elle supporte mal les grosses requÃªtes. L\'optimisation permet dÂaccÃ©lÃ©rer certaines requÃªtes de 2000% (0,4s contre 11 secondes), mais cette disposition ralentit fortement (38s au lieu de 15) quand le ratio est de 0.1, ce qui justifie de garder l\'ancienne mÃ©thode dans ces cas.
- une meilleure Ã©criture sql occasionne une autre accÃ©lÃ©ration qui peut atteindre 1000% sur 10000 titres inspectÃ©s (7s contre 15) ;
- ajout de la case Ã  cocher \'boolean\', qui renvoie tous les rÃ©sultats pour chaque mot'],
"12"=>['111201','- ajout d\'un design par dÃ©faut nommÃ© \'monoblog\' (colonne unique, simplicitÃ©, efficacitÃ© !) ;
- le template par dÃ©faut ajoute l\'ID \'article\' dans la balise \'article\', ce qui permet de le cerner graphiquement ;
- la table \'design\' dans \'users\' permet d\'associer une table \'mods\' associÃ©e, pour ne pas avoir Ã  reconstruire les largeurs ;
- rÃ©novation du design classic_3_gsm, et de sa table mods associÃ©e']];