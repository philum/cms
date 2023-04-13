<?php //msql/program_updates_1606
$r=["_menus_"=>['date','text'],
"1"=>['0601','publication'],
"2"=>['0601','- ajout des options csslink, jslink, csscode, jscode au connecteur headers
- les rÃ©sultats de menubub sont mis en cache
- les favs incluent les articles visitÃ©s
- ajout de la commande icons dans plusieurs modules
- fix pb condition de module support ajx
- le menu cond des modules transporte la valeur courante
- ajout d\'un bouton edit dans le preview d\'article avant import, qui renvoie l\'Ã©diteur afin d\'Ã©diter avant import'],
"3"=>['0602','- rÃ©novation du plugin suggest, ajout d\'un Ã©diteur intermÃ©diaire de l\'article proposÃ© Ã  la publication
- rÃ©habilitation du connecteur :video : par dÃ©faut, ne renvoyait qu\'un lien + miniature + bouton popup. (avant, renvoyait le player, et Â§1 le bt popup). maintenant Â§1 renvoie le player, et Â§440/320 permet de dÃ©finir les dimensions'],
"4"=>['0603','- correctif gestionnaire d\'Ã©dition par cellule de msql
- rÃ©novation et dÃ©placement dans le plug mail des fonctions d\'envoi de mail'],
"5"=>['0604','- patch mysql, 3 colonnes supprimÃ©es dans la table des commentaires
- ajout du module app_popup : renvoie une app dans une popup au lancement
- ajout du param 12 dans les modules : popup, fait apparaÃ®tre un module dans une popup au lancement'],
"6"=>['0606','- ajout de l\'option de module popapi : poue les modules de type lin (ancÃªtre des apps, fabrique des tableaux de donnÃ©es destinÃ©es Ã  fabriquer des liens), l\'option popapi renvoie un lien qui ouvre dans une popup, l\'api avec la requÃªte courante ; convertie les menus rendus par des modules en menus de type desktop'],
"7"=>['0607','- ajout de l\'App toposlides, permet de faire des slides topologiques'],
"8"=>['0611','- fix pb mise en cache d\'articles datant d\'avant 1970
- mise au rebut de sqlimit, continue, rstr53, tout ce qui permettait de revenir Ã  l\'antique mÃ©thode POST pour l\'enregistrement des articles
- en passant on vire un sleep(1) qui Ã©tait lÃ  depuis longtemps (au reload d\'article aprÃ¨s un save)'],
"9"=>['0615','- fix pb lang undefined des articles importÃ©s d\'un autre hub
- fix pb miniatures css, prend la plus grande image de l\'article en-dessous de 4000px de large (pb mÃ©moire)
- intÃ©gration typos google en dur dans les face-fonts (open sans, lato, merriweather, oswald, raleway, roboto)'],
"10"=>['0616','- la commande \'last\' du moteur de recherche renvoie le dernier article publiÃ©
- le tableau de commande Api est placÃ© dans une popup
- ajout d\'un gÃ©nÃ©rateur de titre de la commande Api'],
"11"=>['0620','- dans l\'Ã©diteur d\'import d\'articles, ajout d\'un bouton vers le dÃ©tecteur de dÃ©finitions pour faciliter leur mise Ã  jour'],
"12"=>['0621','- ajout de recognize_defcon() suite Ã  verif_defcon() et avant known_defoncs, qui dÃ©duit les defcons inconnus'],
"13"=>['0623','- save_tits_j() requÃªteur utilisant atmrup()
- rÃ©novation de la standardisation des titres pour avoir les majuscules voulues
- rÃ©forme du capteur xml rss, pour intercaler l\'utf8_decode_b(), et recevoir des flux aux langages exotiques
- mise en conformitÃ© avec les rss en https (certains interdisent les http normaux, maintenant !)'],
"14"=>['0625','- amÃ©lioration Ã©criture de toposlides
- les utags sont sans limite temporelle, et implantÃ©s dans l\'api
- les dÃ©finitions des pictos sont confiÃ©s Ã  _pictos.css'],
"15"=>['0627','- petite rÃ©novation du module Banner, p=image autre que celle dÃ©finie comme banniÃ¨re par dÃ©faut, o=hauteur'],
"16"=>['0628','- ajout du l\'app slides (utilise une table msql)
- ajout du connecteur slides (crÃ©e une table Ã  partir des donnÃ©es du connecteur, puis appelle l\'app avec l\'id de l\'article, auquel est associÃ© la table)'],
"17"=>['0629','- les options de modules utilisent le mÃªme sÃ©parateur que les params (l\'espace au lieu de |)
- l\'option template des sub-modules est rendue opÃ©rationnelle, Ã  l\'occasion de 
- l\'ajout d\'un template pubart_b, qui utilise conjointement une miniature de 200 et une largeur de colonne par dÃ©faut de 200 (pubs d\'articles avec grande miniature)']];