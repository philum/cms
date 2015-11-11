<?php
//philum_microsql_program_updates_1504
$r["_menus_"]=array('date','text');
$r[1]=array('0401','publication');
$r[2]=array('0402','- renommages massifs
- révision de la table program_core et de son générateur',' coreflush',' pour une plus grande clarté dans léditeur de code ');
$r[3]=array('0403','- fix pb reconnaissance des sessions des articles à aspirer
- menu plug',' renvoie les plugins publics (selon autorisations et propriétaires)');
$r[4]=array('0406','réforme structurelle des templates',' vers une simplification : 
- suppression de lédition des titres seuls
- lenregistrement réaffiche larticle complet
- suppression de art_read_d
- suppression de lid article (le css sappuie sur la balise section)
- lensemble des requêtes darticle en ajax passe par art_read_b
- le template article peut être édité librement (la balise section est rendue extérieure au template)');
$r[5]=array('0409','fix pb affichage des résultats détaillés dune recherche');
$r[6]=array('0427','- fix pb affichage de limage dun lien
- suppression de dispositifs antiques de root dimages
- décrassage : acte de mettre des simples au lieu des doubles quotes');

?>