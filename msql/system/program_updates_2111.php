<?php //msql/program_updates_2111
$r=["_menus_"=>[''],
"1"=>['1101','publication'],
"2"=>['1104','le serveur devenant subitement extrÃªmement pataud ; on unifie les requÃªtes aux options d\'articles et aux langues (sans effet, mais c\'est une amÃ©lioration)'],
"3"=>['1111','le serveur est redevenu fluide'],
"4"=>['1119','- usage de natural join
- indexation des msg dans api (gain de vitesse notable)'],
"5"=>['1120','- ajout de plusieurs variables de capture de profiles tw
- fix pb absorption img b64
- not fix pb img avec des faux-accents surencodÃ©s (europalestine est injoignable via un quelconque bot)'],
"6"=>['1123','- petite rÃ©fection de \'compare\' dans admsql
- ajout de \'additions\' et \'average\' dans les outils de l\'admin msql, permettent de faire des calculs sur une colonne'],
"7"=>['1125','- ajout du support des markdown (https://www.markdownguide.org/basic-syntax) qui sont vraiment nuls comparÃ© aux connecteurs ; sert Ã  produire des fichier .md
(on note quand mÃªme quelques idÃ©es des connecteurs rÃ©utilisÃ©es dans les markdown, tels la gestion des lignes et des listes)'],
"8"=>['1125','- ajout du param \'lg\' dans l\'Api, qui permet de prÃ©fÃ©rer une traduction si elle existe (Ã  la diffÃ©rence du param \'lang\' qui sert Ã  sÃ©lectionner les articles d\'une langue spÃ©cifique) ; grosse man&oelig;uvre trÃ¨s rapidement accomplie grÃ¢ce Ã  la souplesse de l\'architecture du logiciel, il faut le noter.']];