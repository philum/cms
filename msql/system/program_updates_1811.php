<?php //msql/program_updates_1811
$r=["1"=>['1101','publication'],
"2"=>['1102','reconditionnement du bouton \'reimport\' de sorte qu\'il prenne en charge le remplacement du contenu par un nouvel import (fonction qui Ã©tait cachÃ©e dans le sous-menu tools de l\'Ã©diteur), mais ici, dans l\'Ã©diteur de mÃ©tas.'],
"3"=>['1110','rÃ©paration de l\'itÃ©ration du \'dig\' du moteur de recherche qui se faisait intercepter par les recherches enregistrÃ©es'],
"4"=>['1111','rÃ©fection de l\'index des plugins, qui devait prendre en charge les sous-rÃ©pertoires, ce qui a imposÃ© 3 nouvelles fonctions du noyau, 2 importÃ©es de tlex et une scandir_r(), en prÃ©vision de l\'abandon de explore()'],
"5"=>['1117','- rÃ©novation du systÃ¨me de backups d\'articles
- amorce de virage de systÃ¨me d\'encodage, les pictos  ascii s\'affichent correctement'],
"6"=>['1119','- correctifs logiques d\'encodages ; la version de labo 100% utf8 marche'],
"7"=>['1120','- ajout du plugin feed, garant du transport de donnÃ©es entre serveurs'],
"8"=>['1121','- youtube ayant dÃ©cidÃ© ce matin de bannir les og, dÃ©sormais les infos sur la vidÃ©os sont rÃ©cupÃ©rÃ©s \"Ã  la main\" ; ajout d\'un build_youtube dans l\'app web'],
"9"=>['1130','- rÃ©novation d\'un systÃ¨me de backup rapide']];