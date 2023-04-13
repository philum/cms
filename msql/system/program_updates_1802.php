<?php //msql/program_updates_1802
$r=["1"=>['0202','publication'],
"2"=>['0204','ajout de la restriction 108, permet d\'ouvrir la source dans une iframe dans une popup'],
"3"=>['0206','rÃ©novation du rendu du moteur de recherche : exit l\'ancien dÃ©coupeur de phrase qui faisait perdre la moitiÃ© des rÃ©sultats'],
"4"=>['0207','suppression du bouton \"par date\" dans le moteur de recherche,
ajout des boutons \"score\" (classement par le nombre de rÃ©sultats) et \"langue(s)\"'],
"5"=>['0208','amÃ©lioration de la gestion des auteurs :
- les auteurs sont Ã©ditables dans les mÃ©tas (pour les auth6)
- bouton de rÃ©cupÃ©ration du nom d\'auteur d\'un twit
- impossibilitÃ© de s\'inscrire avec un nom d\'auteur existant'],
"6"=>['0209','- ajout du plugin star, permet de faire des requÃªtes dans la base Hipparcos
- ajout du connecteur :app, permet d\'appeler le constructeur d\'une app. ex: [hd191408Â§1:star:app] appelle star::build($p,$o) = mÃ©thode pour s\'Ã©pargner l\'interface
- ajout du connecteur :search, permet d\'afficher un bouton qui ouvrira le rÃ©sultat d\'une recherche'],
"9"=>['0210','- rÃ©novation de la table et ajout d&#8217;icÃ´nes ascii (pour les maths), dans l\'Ã©diteur'],
"7"=>['0211','- rÃ©novation de certaines parties de l\'updateur
- le moteur de recherche accepte dÃ©sormais les dates'],
"8"=>['0212','- le moteur de recherche accepte dÃ©sormais les requÃªtes de l\'API
- ajout du module \'desktop_apps\', permet de rejoindre les dispositifs du desktop pour les afficher en tant que module (tout simplement)'],
"10"=>['0213','- ajout du connecteur \':tag\', permet de proposer un lien vers les rÃ©sultats d\'un tag'],
"11"=>['0216','- le compteur de visiteurs uniques est remaniÃ© pour renvoyer un rÃ©sultat plus vÃ©ridique, en ne cumulant pas les visiteurs uniques pour chaque jour mais en groupant le calcul sur l\'Ã©tendue temporelle de la mesure.'],
"12"=>['0219','- rÃ©paration du parseur xml rss, qui Ã©tait secouru par l\'ancien dispositif'],
"13"=>['0220','- rÃ©paration de petites imperfections de l\'encodage au moment de la transition paf javascript, qui affectaient les caractÃ¨res moldaves (Chi&#537;in&#259;u)'],
"14"=>['0222','- introduction du dispositif \'quote\', de la rstr109 globale et pontcuelle, et des comportements associÃ©s : permet de crÃ©er des commentaires attachÃ©s Ã  une portion de texte surlignÃ©e.'],
"15"=>['0227','- remaniement du dispositif \'quote\', de sorte Ã  ne l\'allumer que sur demande (c\'est un peut chiant sinon) et Ã  pouvoir accumuler les notes au long du mÃªme commentaire.'],
"_menus_"=>['date','text']];