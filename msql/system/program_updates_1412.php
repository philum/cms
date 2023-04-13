<?php //msql/program_updates_1412
$r=["_menus_"=>['date','text'],
"1"=>['1201','publication'],
"2"=>['1203','rÃ©vision rÃ©daction composants msql'],
"3"=>['1204','rÃ©fection de timetravel : (remarche), accessible depuis le menu admin'],
"4"=>['1205','amÃ©lioration du gestionnaire utags : diffÃ©renciation entre le terme prÃ©sentÃ© et le terme connu (pas de caractÃ¨res spÃ©ciaux dans l\'url)'],
"5"=>['1206','amÃ©lioration du systÃ¨me de titres (souvent affichÃ©s avant d\'Ãªtre connus) le module page_titles est surtout interne aux actions'],
"6"=>['1210','rÃ©novation de artmod : templates, css, rstr'],
"7"=>['1211','- abandon du module systÃ¨me popadmin (rendu interne avec tout un jeu de rstr)
- abandon de l\'Ã©diteur de largeurs du design
- rÃ©novation du desktop, qui se load avec une rstr'],
"8"=>['1212','rÃ©novation de artmod : templates, css, rstr'],
"9"=>['1213','ajout d\'une classe mysql (trÃ¨s pratique) et rÃ©novation de la classe msql'],
"10"=>['1215','rÃ©fection du modÃ¨le de plugin et de la classe msq'],
"11"=>['1216','- les subarticles trop nombreux sont mis en flow
- rÃ©fection du connecteur :pop : les donnÃ©es sont stockÃ©es plutÃ´t qu\'envoyÃ©es
- nouveau menu msql
- Ã©chec de l\'implantion des classes msql'],
"12"=>['1217','- les catÃ©gories prÃ©fixÃ©es d\'un underscore sont Ã©cartÃ©es du Load (sauf appel spÃ©cifique)
- amÃ©lioration du comportement d\'hÃ©ritage des modules (pour que le module pointÃ© prÃ©domine sur le prÃ©cÃ©dent qui Ã©tait d\'une condition moindre)
- rÃ©vision de verif_defcons (pas d\'approximation)
- ajout du support des bases msql dans le sÃ©lecteur ajax hidslct_j()
- ajout d\'un moteur de recherche msql'],
"13"=>['1218','- amÃ©nagement du systÃ¨me des titres
- ajout du plugin reader, pour offrir la home dans une iframe
- delfile sÃ©curisÃ© dans msql'],
"14"=>['1219','- ajout (et rÃ©fection) des plugs arts, read, reader (lecture externe), imtx et imgtxt
- ajout du bunton track dans les options d\'articles
- intÃ©gration dans _admin.css d\'Ã©lÃ©ments de msql
- rÃ©forme interne du pointage de lignes du dispositif msql (erreurs possibles)
- rÃ©novation du sÃ©lecteur de ligne libre aprÃ¨s un clonage de ligne'],
"15"=>['1222','- petite rÃ©vision des templates'],
"16"=>['1223','- petite rÃ©vision du moteur de recherche
- les tags ouvrent plutÃ´t des popups
- renommages '],
"17"=>['1224','- rÃ©paration du title des tags
- bub peut appeler des modules
- ajout du tri par colonnes dans msql
- fusion de 2 fonctions similaires as msq_copy
- msql_read reliftÃ©
- ajout de plug Ã  la lib des listes dÃ©roulantes'],
"18"=>['1225','- nombreux correctifs pour quand on n\'est pas loguÃ©...
(admin sql, login, comportement des connecteurs et plugins, etc..., fix issue changement de contexte)
- bug gÃ©nÃ©rÃ©s par les rÃ©centes rÃ©novations
- rÃ©paration comportement des connecteurs au noeud oÃ¹ il faut choisir entre conn public, privÃ©, plugin ou codeline (ou basic)
- rÃ©paration du rstr48 (login), dissociÃ© du rstr51(apps publiques)']];