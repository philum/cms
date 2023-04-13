<?php //msql/program_updates_2108
$r=["1"=>['0801','publication'],
"2"=>['0812','l\'option Â§1 dans :iframe permet de la contenir dans un bouton'],
"3"=>['0814','correctif del_inclusive, qui transformait les \'week-end\' en \'weeknd\''],
"4"=>['0817','correctif erreur d\'interprÃ©tation dÃ»e au fait que les gens utilisent des images dans des liens vers des images dans une figure, qui provoquait un dÃ©doublement de la mention figcaption. L\'erreur Ã©tait dans la capacitÃ© du dÃ©tecteur d\'image Ã  tenir compte des liens vers des images. Donc is_image() obtient la propriÃ©tÃ© de concerner ces types de donnÃ©es.'],
"5"=>['0819','ajout d\'un nouvel usage du param 4 de la disposition de dom::del, utilisÃ© dans les jumps de l\'import (x, del, clean) :
- :at:img:del : oÃ¹ on del l\'attribut at des img
- ::noscript:x : oÃ¹ on Ã©radique la balise noscript
- :src:img:clean : oÃ¹ on nettoie une balise img pour n\'en laisser que l\'attribut src
L\'ajout barbare d\'attributs Ã  rallonge provoque des problÃ¨mes, notamment quand certains d\'eux contiennent des balises html, qui sont interprÃ©tÃ©es en prioritÃ©, cassant l\'objet dans lequel elles se trouvent.'],
"6"=>['0819','ajout d\'un nouvel usage du param 4 de la disposition de dom::detect, utilisÃ© ors de l\'import :
- cl:at:tg:1 oÃ¹ (comme d\'hab) class, attribut, tag sont ciblÃ©s, et le param 4 \"1\" qui cible la premiÃ¨re occurrence (ou la 2 ou la 3)'],
"7"=>['0819','ajout du support d\'articles importÃ©s directement au format json, avec les clefs title, content, date, author (svp)'],
"8"=>['0820','- :twitter supporte l\'option Â§thread (comme twapi, mais c\'est plus pratique ici)
- ajout de :twusr, renvoie un tableau des utilisateurs twitter, sÃ©parÃ©s par une virgule, qu\'on utilise l\'id ou le screen_name ; le tableau est mis en cache'],
"9"=>['0822','- ajout de l\'option Â§twusr:msql qui sert Ã  lire une table issue d\'un recueil d\'utilisateurs de twitter
- ajout de l\'outil intersect dans l\'admin msql, permet de trouver les Ã©lÃ©ments communs Ã  plusieurs tables (,)'],
"10"=>['0823','- correctif rÃ©action de l\'api aprÃ¨s la vie des cookies
- ajout de export_csv dans admin msql
- export csv attachÃ© aux tables'],
"11"=>['0826','- correctif Ã©tendue du thread de twits jusqu\'au twit d\'oÃ¹ part la recherche (il s\'arrÃªtait avant en croyant que c\'Ã©tait intelligent de le faire)
- rÃ©forme du distributeur de ascii unicode (lÃ , y\'a tout)']];