<?php
//philum_microsql_program_updates_1512_sav
$r["_menus_"]=array('date','text');
$r[1]=array('1202','publication');
$r[2]=array('1203','- disjonction du titre depuis son param du module link (optique d\'éclaircissement des usage)
- ajout de la commande ajax pagup (full page)');
$r[3]=array('1204','nouveau système de tags 1/3');
$r[4]=array('1206','correctif gestionnaire restriction visibilité d\'articles');
$r[5]=array('1210','les vidéos ne seront plus lancées au chargement d\'une page (ça devenait trop lourd) ; apparition d\'un lien pour joindre directement l\'url (par défaut la vidéo s\'ouvre dans une popup)');
$r[6]=array('1211','- ajout d\'un capteur de miniatures de vidéos
- correctifs de modernisation');
$r[7]=array('1213','- meilleur résultat des recherches des tags (tri des abstractions)');
$r[8]=array('1214','- ajout du plugin twit, vraie API twitter');
$r[9]=array('1217','intégration de l\'Api twitter : 
- importation de twits via l\'interface
- détection des @utilisateurs
- possibilité de remonter le fil de discussion
- ajout/reconformation des connecteurs :twitter, :twitter_cached, et :poptwit ; ils savent reconnaitre un utilisateur (renvoie fil des twits) ou un twit ciblé par son id, potentiellement depuis son url.');
$r[10]=array('1218','- défilement continu dans l\'Api twitter
- réduction du poids de la requête sql des catégories d\'articles
- ajout d\'un gestionnaire connecté à l\'api pour tweeter des articles
- ajout d\'un gestionnaire des paramètres de connexion à l\'App Twitter créée par l\'utillisateur');
$r[11]=array('1219','- ajout d\'une itération sur l\'autocomplétion de tags (optimisation de la vitesse + recherche étendue dans le temps)');
$r[12]=array('1220','- ajout d\'un 9ième paramètre au protocole ajax destiné spécifiquement à rétroinjecter du javascript dans le header avant l\'arrivée des données : ');
$r[13]=array('1222','* 2 usages du 9ième paramètre ajax : 
- id : placer le js à récupérer dans un input hidden
- \'injectjs\' : récupère le code du plugin \'plug\' dans la fonction nommée \'plug\'_js();');
$r[14]=array('1223','le connecteur :video peut recevoir des liens vers des mp4 (ogg, etc...) ; utile pour les vidéos facebook, quand l\'extension est nooyée avant le paramètre');
$r[15]=array('1224','- correctif annulation enregistrement d\'articles ayant des titres trop longs
- correctif gestionnaire détection de vidéos (extensions ciblées)
- le navigateur timesystem affiche l\'année au lieu du nombre d\'années en arrière');
$r[16]=array('1229','instauration des nouveaux dispositifs de gestionnaire des tags (part 2/3) : nouvel éditeur de tags');
$r[17]=array('1231','- déroulé des articles plus rapides car nbarts plus rapide + usage de assoc
- affichage d\'article confié à l\'automate art_read_mecanics()');
$r[18]=array('1231','nouveau gestionnaire de tags (part 3/3) : 
- gestionnaire de titres d\'articles ; les templates ne reçoivent plus les utags (ils sont tous dans \"tags\")
- suppression des tags préparés dans une session
- gestionnaires des modules');

?>