<?php
//philum_microsql_program_patches
$r["_menus_"]=array('function','explics');
$r[110614]=array('patch_mods','table \'_mods\' become \'_mods_1\' as specified in params/config/2 (css_builder can now impact differents tables of modules)');
$r[110428]=array('admin_design','update admin_css');
$r[110703]=array('patch_nobr','ajoute une nouvelle colonne \'nobr\' � la microtable mods ; (l\'ancienne est sauvegard�e)');
$r[111210]=array('patch_art_priority','r�ctifie les tags \'Une\' et \'Stay\' en \'*\' et \'**\'');
$r[111220]=array('patch_art_priority_2','convertit les tags *, ** et *** en un niveau de priorit� de l\'article');
$r[120712]=array('patch_htaccess','console url');
$r[130430]=array('patch_sql','optimisation des tables mysql : 18 changements sur 5 tables');
$r[130602]=array('patch_userart','suppression d\'un artefact (articles de la cat�gorie obsol�te \'user\') : renseigne la table \'users\', d�truit les entr�es de la table \'arts\', et d�truit les orphelins ');
$r[140615]=array('patch_sql_stats','mutation des tables de stats : _eye devient _ip, _stat est abandonn�e (contient les anciennes stats), _live est cr��e');
$r[150521]=array('patch_passwd','cryptage des mots de passes');

?>