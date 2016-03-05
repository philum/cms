<?php
//philum_microsql_program_updates_1302
$r["_menus_"]=array('day','text');
$r[1]=array('0203','ajout de \'over-blog\' et \'wordpress\' dans les définitions génériques d\'importation ;');
$r[2]=array('0210','résurrection du composant \'2cols\', qui dépend de la rstr 17 de façon globale, et d\'un paramètre d\'article de façon locale ;');
$r[3]=array('0222','ajout d\'un composant pour l\'édition de l\'article parent, disponible dans les divers points d\'entrée d\'un article (rss, batch, admenu, édition) ;
tous ces points d\'entrée sont rendus sensibles à la config des restrictions (save in popup, autoparent, autopublish) ;');
$r[4]=array('0223','amélioration du batch :
- les sélecteurs de contexte de l\'article (catégorie et parent) s\'affichent lors de l\'importation ponctuelle ;
- on peut préparer la catégorie d\'un article avant le batch ;
- le résultat du batch utilise le module \'recents\' ;');
$r[5]=array('0224','réparation de la mise à jour auto des bases publiques du finder');
$r[6]=array('0225','icônes dans le menu Apps');
$r[7]=array('0226','les articles enregistrés n\'ont plus besoin d\'attendre le \'rebuild\' pour apparaître dans les résultats (c\'était un écueil du champ temporel) ');
$r[8]=array('0227','correctif prise en compte d\'un article fraîchement publié par le cache');
$r[9]=array('0228','la rstr art_mod (60) sert à désactiver les modules d\'articles dans une popup pour gagner en vitesse');
$r[10]=array('0229','rénovation du système d\'auto-reboot après fermeture de la session (après une heure sans activité) ;');

?>