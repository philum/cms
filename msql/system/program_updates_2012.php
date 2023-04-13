<?php //msql/program_updates_2012
$r=["1"=>['1202','publication'],
"2"=>['1205','amÃ©lioration des ancres, pour pallier aux sites qui font comme nous dÃ©sormais (easy_footnotes) ; capacitÃ© Ã  gÃ©rer plusieurs ancres similaires lors de la dÃ©tection ; prise en charge des ancres logÃ©es dans un numlist (c\'est pas bien de faire Ã§a)'],
"3"=>['1206','amÃ©lioration du gestionnaire de recherches sauvegardÃ©es, dans le contexte sans champ temporel, pour rÃ©duire la recherche aux rÃ©sultats inconnus'],
"4"=>['1207','on peut exporter ses favoris au format .epub'],
"5"=>['1214','- correctif xt() permettant le correctif des lien-img-youtube
- correctif refus d\'import d\'images svg/xml (Ã  affiner)
- ajout du connecteur :private
- export d\'article en epub (rstr130)
- export d\'une commande Api en epub via les favoris
- correctifs reliques de l\'ancien plug api'],
"6"=>['1215','- correctif zÃ©ro commentaire dans les options d\'articles
- correctif snifer download
- systÃ¨me de dÃ©tection de tags traduits en anglais, dans users_tags_2-8, permet de chercher des mots anglais mais d\'enregistrer des mots franÃ§ais pour le classement (truc longtemps attendu)'],
"7"=>['1216','- lien yt restent des liens (pas des embed)
- amÃ©lioration favoris (export html, conception)
- amÃ©lioration export fichier depuis Api (Ã©ligible pour une traduction)
- extension du champ nl Ã  :bubble_note et :toggle_note (substitut en cas d\'export)
- et donc ajout de la rstr131 : export html'],
"8"=>['1217','- amÃ©lioration toggle_div() (:toggle_text et :toggle_quote), html friendly
- suppression des connecteurs :jopen et :jconn, remplacÃ©s par :toggle_conn'],
"9"=>['1218','- amÃ©lioration relativement substantielle des rÃ©sultats des recherches enregistrÃ©es (usage de dispositifs existants plus performants, tri par quantitÃ©s, mise Ã  jour)'],
"10"=>['1224','- ajout du plug reduceim, accessible depuis les outils courants, rÃ©duit en masse les grosses images'],
"11"=>['1228','- correctif des liens sur-interprÃ©tÃ©s (provoquant une erreur grave d\'affichage) quand il contenaient des @ (initialement attriubÃ©s exclusivement aux mails)
- correctif du masque de la recherche, protection des caractÃ¨res rÃ©servÃ©s comme []'],
"12"=>['1231','- ajout du connecteur :transcrit, permet de transcrire les lettres d\'un texte en 36 Ã©quivalences ascii [Hello worldÂ§4:transcrit]']];