<?php //philum/msql/program_updates_2012_sav
$r=[1=>['1202','publication'],2=>['1205','am�lioration des ancres, pour pallier aux sites qui font comme nous d�sormais (easy_footnotes) ; capacit� � g�rer plusieurs ancres similaires lors de la d�tection ; prise en charge des ancres log�es dans un numlist (c\'est pas bien de faire �a)'],3=>['1206','am�lioration du gestionnaire de recherches sauvegard�es, dans le contexte sans champ temporel, pour r�duire la recherche aux r�sultats inconnus'],4=>['1207','on peut exporter ses favoris au format .epub'],5=>['1214','- correctif xt() permettant le correctif des lien-img-youtube
- correctif refus d\'import d\'images svg/xml (� affiner)
- ajout du connecteur :private
- export d\'article en epub (rstr130)
- export d\'une commande Api en epub via les favoris
- correctifs reliques de l\'ancien plug api'],6=>['1215','- correctif z�ro commentaire dans les options d\'articles
- correctif snifer download
- syst�me de d�tection de tags traduits en anglais, dans users_tags_2-8, permet de chercher des mots anglais mais d\'enregistrer des mots fran�ais pour le classement (truc longtemps attendu)'],7=>['1216','- lien yt restent des liens (pas des embed)
- am�lioration favoris (export html, conception)
- am�lioration export fichier depuis Api (�ligible pour une traduction)
- extension du champ nl � :bubble_note et :toggle_note (substitut en cas d\'export)
- et donc ajout de la rstr131 : export html'],8=>['1217','- am�lioration toggle_div() (:toggle_text et :toggle_quote), html friendly
- suppression des connecteurs :jopen et :jconn, remplac�s par :toggle_conn'],9=>['1218','- am�lioration relativement substantielle des r�sultats des recherches enregistr�es (usage de dispositifs existants plus performants, tri par quantit�s, mise � jour)'],10=>['1224','- ajout du plug reduceim, accessible depuis les outils courants, r�duit en masse les grosses images'],11=>['1228','- correctif des liens sur-interpr�t�s (provoquant une erreur grave d\'affichage) quand il contenaient des @ (initialement attriub�s exclusivement aux mails)
- correctif du masque de la recherche, protection des caract�res r�serv�s comme []'],12=>['1231','- ajout du connecteur :transcrit, permet de transcrire les lettres d\'un texte en 36 �quivalences ascii [Hello world�4:transcrit]']];