<?php //msql/program_updates_1608
$r=["_menus_"=>['date','text'],
"1"=>['0801','publication'],
"2"=>['0804','ajout d\'un patch pour pallier Ã  des bizarreries d\'encodages qui interviennent chez ovh (vps) quand, tous les 3 mois, Ã§a switch de serveur  //patch_utf8
- certains effets javascript basculent de escape Ã  unescape'],
"3"=>['0809','api twitter : - peut lire les retweets inclus dans le message- peut lire les gifs et les vidÃ©os, et les images sont sensibles aux dimensions fournies- peut lire les vidÃ©os- le dÃ©filement continu marche pour la lecture de la home'],
"4"=>['0812','api twitter : - ajout du support de dÃ©tection lors de l\'importation, l\'iframe renvoie un connecteur :twitter'],
"5"=>['0816','scalabilitÃ© (quand le vps change tout seul d\'encodage) ajout de dÃ©finitions (de sauts de lignes) au spectrum des transcodages'],
"6"=>['0822','correctif table js, interprÃ©tation des _'],
"7"=>['0901','modif fonctionnement de l\'antique dÃ©filement continu de sorte Ã  distinguer les div id des section id, de sorte Ã  conserver la section aprÃ¨s un reload aprÃ¨s une modif du titre']];