<?php
//philum_microsql_program_updates_1306
$r["_menus_"]=array('day','text');
$r[1]=array('0601','nouveau menu ajax dans l\'admin msql');
$r[2]=array('0602','suppression d\'un archaïsme (artefact) qui freinait les requêtes Sql (identification du propriétaire d\'un hub anciennement logée dans la table des articles) : ajout du patch \'patch_userart\' (130602) - il est un peu violent');
$r[3]=array('0603','rstr 72 : ajout d\'un système de mise en cache html des articles : les pages s\'affichent en 0.046s');
$r[4]=array('0604','correctif \'last_art\' capable d\'enquêter pour trouver un paramètre occasionnellement non fourni (influe grandement sur les performances du boot)');
$r[5]=array('0609','rénovation de l\'installateur : typos, dossiers, htaccess, css par défaut...
ajout du fichier vps.txt décrivant toute la démarche pour installer philum dans un VPS (svp en français...)');
$r[6]=array('0612','réhabilitation du plugin \'migration\' qui transporte les dossiers img, users, et msql d\'un serveur à l\'autre');
$r[7]=array('0613','réctification des champs temporel (time system), espacés de 1 an (au lieu d\'une progression exponentielle, qui causait des remous lors des recherches portant sur 4 ans...)');
$r[8]=array('0615','- rénovation du système de cache du flux rss
- réparation de la gestion des sous-domaines du système de boot');

?>