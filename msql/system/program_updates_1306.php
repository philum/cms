<?php
//philum_microsql_program_updates_1306
$r["_menus_"]=array('day','text');
$r[1]=array('0601','nouveau menu ajax dans l\'admin msql');
$r[2]=array('0602','suppression d\'un archa�sme (artefact) qui freinait les requ�tes Sql (identification du propri�taire d\'un hub anciennement log�e dans la table des articles) : ajout du patch \'patch_userart\' (130602) - il est un peu violent');
$r[3]=array('0603','rstr 72 : ajout d\'un syst�me de mise en cache html des articles : les pages s\'affichent en 0.046s');
$r[4]=array('0604','correctif \'last_art\' capable d\'enqu�ter pour trouver un param�tre occasionnellement non fourni (influe grandement sur les performances du boot)');
$r[5]=array('0609','r�novation de l\'installateur : typos, dossiers, htaccess, css par d�faut...
ajout du fichier vps.txt d�crivant toute la d�marche pour installer philum dans un VPS (svp en fran�ais...)');
$r[6]=array('0612','r�habilitation du plugin \'migration\' qui transporte les dossiers img, users, et msql d\'un serveur � l\'autre');
$r[7]=array('0613','r�ctification des champs temporel (time system), espac�s de 1 an (au lieu d\'une progression exponentielle, qui causait des remous lors des recherches portant sur 4 ans...)');
$r[8]=array('0615','- r�novation du syst�me de cache du flux rss
- r�paration de la gestion des sous-domaines du syst�me de boot');
$r[9]=array('0618','- confiscation d\'un acien protocole devenu obsol�te dans les plugins (le get \'plug\'=1)
- petite r�paration des stats d\'articles (image qui bypasse le cache)');
$r[10]=array('0619','encore un correctif de la gestion des sous-domaines, dans le cas particulier o� ils ne sont pas utilis�s...');

?>