<?php
//philum_microsql_program_updates_1111
$program_updates_1111["_menus_"]=array('day','text');
$program_updates_1111[1]=array('111110',"ajout d'un bouton qui permet de choisir la chronologie des articles affili�s � un article parent");
$program_updates_1111[2]=array('111118',"am�lioration du confort de la visionneuse flash 'Slider'");
$program_updates_1111[3]=array('111119',"correctifs d�tection de l'ID des vid�os youtube et dailymotion");
$program_updates_1111[4]=array('111119',"am�lioration commodit� de batch_import, permet d'ajouter des url en s�rie, avant de les importer en s�rie");
$program_updates_1111[5]=array('111124',"r�novation de 'model.php', le mod�le de plugins, pour une meilleure compr�hension");
$program_updates_1111[6]=array('111124',"ajout du plugin 'superpoll' qui permet de voter des propositions :
- ne n�cessite aucun login (ouvert au visiteur) ;
- permet d'ajouter des entr�es en plus des propositions ;
- r�ordonne les entr�es les plus vot�es ;
- interdit les votes multiples mais permet de changer son vote ;
- fonctionne en mode autonome (dans une iframe sur n'importe quelle page) : appeler plug/index.php?call=superpoll&p=1 o� 1 est l'ID de la table ;
- autorise la cr�ation de nouvelles tables � la vol�e ;
- enti�rement en ajax ;
- propose le code et le flux xml des r�sultats (open data)
");
$program_updates_1111[7]=array('111125',"index.php peut d�sormais servir � appeler des plugins avec les variables ?call=plugin&param=&opt= (deux options), de fa�on � les rendre utilisable hors contexte, notamment lors d'un appel depuis l'ext�rieur dans une iframe");
$program_updates_1111[8]=array('111125','nouveau connecteur :video, qui remplace les connecteurs sp�cialis�s de chaque provider (youtube, dailymotion, google, ted, livestream), �tant donn� que leur format est d�tectable');
$program_updates_1111[9]=array('111126',"am�nagements de fiabilit� du nouveau connecteur :video ;
(les param�tres optionnels qui apparaissent parfois sont supprim�s, les providers ne faisant aucun effort de conformit� il faut s'adapter � de nombreux cas de figure)");
$program_updates_1111[10]=array('111130',"introduction du module 'video_viewer' qui recrute toutes les vid�os (avec le connecteur ':video') des articles  publics (en cache) et les propose dans une fen�tre qui permet de naviguer de l'une � l'autre (viewer) ;
- le param permet d'op�rer un tri selon un ou plusieurs tags
");
$program_updates_1111[11]=array('111130',"am�lioration substantielle du moteur de recherche : 
- capable de choisir la m�thode selon le ratio optimal entre les titres �ligibles et les titres testables ; dans certains cas il vaut mieux que les �ligibles soit utilis�s dans la requ�te sql, mais elle supporte mal les grosses requ�tes. L'optimisation permet d�acc�l�rer certaines requ�tes de 2000% (0,4s contre 11 secondes), mais cette disposition ralentit fortement (38s au lieu de 15) quand le ratio est de 0.1, ce qui justifie de garder l'ancienne m�thode dans ces cas.
- une meilleure �criture sql occasionne une autre acc�l�ration qui peut atteindre 1000% sur 10000 titres inspect�s (7s contre 15) ;
- ajout de la case � cocher 'boolean', qui renvoie tous les r�sultats pour chaque mot");
$program_updates_1111[12]=array('111201',"- ajout d'un design par d�faut nomm� 'monoblog' (colonne unique, simplicit�, efficacit� !) ;
- le template par d�faut ajoute l'ID 'article' dans la balise 'article', ce qui permet de le cerner graphiquement ;
- la table 'design' dans 'users' permet d'associer une table 'mods' associ�e, pour ne pas avoir � reconstruire les largeurs ;
- r�novation du design classic_3_gsm, et de sa table mods associ�e");

?>