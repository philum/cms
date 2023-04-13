<?php //msql/program_updates_1504
$r=["_menus_"=>['date','text'],
"1"=>['0401','publication'],
"2"=>['0402','- renommages massifs
- rÃ©vision de la table program_core et de son gÃ©nÃ©rateur, coreflush, pour une plus grande clartÃ© dans lÃ©diteur de code '],
"3"=>['0403','- fix pb reconnaissance des sessions des articles Ã  aspirer
- menu plug, renvoie les plugins publics (selon autorisations et propriÃ©taires)'],
"4"=>['0406','rÃ©forme structurelle des templates, vers une simplification : 
- suppression de lÃ©dition des titres seuls
- lenregistrement rÃ©affiche larticle complet
- suppression de art_read_d
- suppression de lid article (le css sappuie sur la balise section)
- lensemble des requÃªtes darticle en ajax passe par art_read_b
- le template article peut Ãªtre Ã©ditÃ© librement (la balise section est rendue extÃ©rieure au template)'],
"5"=>['0409','fix pb affichage des rÃ©sultats dÃ©taillÃ©s dune recherche'],
"6"=>['0427','- fix pb affichage de limage dun lien
- suppression de dispositifs antiques de root dimages
- dÃ©crassage : acte de mettre des simples au lieu des doubles quotes']];