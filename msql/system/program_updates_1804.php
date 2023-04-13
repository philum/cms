<?php //msql/program_updates_1804
$r=["1"=>['0401','publication'],
"2"=>['0404','changelog de la picto-font philum en version 11 (188 glyphes)'],
"3"=>['0405','mutation de la rstr53 (save in ajax, obsolÃ¨te car dÃ©finitif) en \'default lang\', dÃ©tecte la langue du navigateur.'],
"4"=>['0406','rÃ©forme architecturale du systÃ¨me des langues, abandon de l\'antique usage du rÃ©glage par dÃ©faut et des tables jointes (entraÃ®nant des requÃªtes difficiles) en ajoutant une colonne dÃ©diÃ©e. 
Le moteur de recherche prend en compte les langues, exclusives ou inclusives, par dÃ©faut ou \"Ã©trangÃ¨re\"'],
"5"=>['0407','- ajout du module \'article\' (bÃªte et simple)
- correctifs dans le gestionnaire du module \'link\'
- ajout du bouton d\'Ã©dition pour le connecteur \'pub\', sensibilisÃ© Ã  la langue courante'],
"6"=>['0410','- correctifs suite Ã  la mutation du systÃ¨me de langues (api et search)
- rÃ©fection de searched (recherches enregistrÃ©es)
- modifs dans la picto-font \'philum\' v12.36 (ajout de 4 glyphes et correctifs de 2)'],
"7"=>['0411','- rÃ©fection de vieux dispositifs pour des balises devenues obsolÃ¨tes
- amÃ©lioration du support vidÃ©o et audio
- correctifs gestionnaire de traductions
- rÃ©novation de :callin renommÃ© :toggle'],
"8"=>['0412','- rÃ©fection profonde du dispositif yandex, calquÃ© sur l\'extraordinaire et magnifique dispositif \'voc\' de tlex.fr : l\'ensemble des contenus sont gÃ©rÃ©s par une table multilingue globale (table des contenus). Prospectivement, toutes les portions de site peuvent Ãªtre traduites, dans toutes les langues. Les commentaires sont multilingues.'],
"9"=>['0416','- ajout du support Deepl pour la traduction'],
"11"=>['0419','- amÃ©lioration du support des langues (tables msql)'],
"10"=>['0420','- ajout de la compÃ©tence de traduction pour les commentaires (la table \'tracks\' est renommÃ©e \'trk\')'],
"_menus_"=>['_menus_','date','text']];