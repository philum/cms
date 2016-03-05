<?php
//philum_microsql_program_faq
$r["_menus_"]=array('question','answer');
$r[1]=array('supprimer un article','les différents niveaux de dissipation d\'un article sont :
- on peut le dépublier ;
- on peut le mettre dans une catégorie non publique (catégorie précédée d\'un \'_\' comme \'_system\') ;
- on peut l\'envoyer dans le répertoire \'_trash\' ;
- on peut réutiliser cet article, et changer sa date de création ;
- seuls les articles mis dans \'_trash\' peuvent être définitivement supprimés, ce qui occasionne un reflush de la base.');
$r[2]=array('problème d\'import d\'un article','Les échecs d\'importation sont devenus très rares.
10% des échecs sont dus à un article vraiment très long (équivalent de 2 heures de lecture),
10% à cause de caractères mal interprétés, ou non encodés (comme les <>),
10% une erreur dans le code d\'origine, que le navigateur sait outrepasser, provoque un blocage (mauvaise imbrication).
le plus souvent le serveur est refuse, tout simplement...

Les anciennes procédures peuvent parfois sauver des nouvelles : il suffit de copier le code source de la sélection et le convertir dans l\'éditeur externe, en spécifiant la source (pour informer les images), puis de coller le code correctement converti en connecteurs dans le nouvel article.');
$r[3]=array('lecteur mp3 ?','La présence d\'un lien \'.mp3\' dans l\'article fait automatiquement appel à un lecteur Flash très simple ; ex: [http://site.com/audio.mp3] ou des documents uploadés [audio.mp3]

Ici le point (.mp3) est considéré comme un connecteur. C\'est le cas aussi pour toutes les extensions vidéos (.flv, .mp4, etc...)

Le \'.swf\' peut être remplacé par un \':swf\' (deux points) pour appeler un connecteur qui permet d\'afficher le contenu dans une fenêtre en ajax.');
$r[4]=array('Articles de plus d\'un mois n\'apparaissent plus !','C\'est normal du point de vue du logiciel : par défaut le paramètre admin/params/nb_days (16) est à \'auto\' où la fréquence est de 50 articles par périodes (le cas d\'un journal périodique).

Cela signifie que la périodicité est choisie automatiquement (hebdo, mensuel, ...).

Le paramètre peut recevoir un nombre de jours (365) ou rester vide pour les garder tous, mais dans ce cas la recherche est plus longue. 

Activer le paramètre restrictions/time_system, permet d\'accéder aux anciens articles par un \'dig\' (creuser dans le temps) afin de ne pas nuire aux performances.');
$r[5]=array('Créer une catégorie ?','Les catégories sont une émergence : elles sont créées à la volée dans les méta de l\'article.

La présence des articles détermine celle des catégories qui leur sont associées. Ainsi il n\'est pas possible d\'afficher une catégorie vide.');
$r[6]=array('Comment obtenir des paragraphes ?','La restriction \'p_balise\' permet de générer des paragraphes à chaque double-saut de ligne.
Par défaut c\'est un système de saut de ligne html (br) qui est utilisé.');
$r[7]=array('Position des entrées dans le menu','Les menus ce sont autant de modules, et d\'office ils sont séparés par un saut de ligne, qu\'on peut annuler en cochant la case \'nobr\'.');
$r[8]=array('taille des miniatures','- manière simple : dans params : thumbnails_size (hauteur/largeur) ; il faut s\'assurer que les miniatures sont envoyées dans \'restrictions/content/thumbnails\'.  Puis \'rebuild_img\' permet de les reconstruire.

- manière avancée avec la variable _IMG1 : 
-- allumer la restriction IMG1 (envoie la variable au template)
-- dans builder/templates, spécifier une instruction \'[_IMG1§width/height:thumb]\' ; 
Intervenir dans les templates permet d\'afficher des articles en utilisant des templates différents (de celui par défaut), de façon à en avoir certains avec des grandes et d\'autres avec des petites miniatures.

- ponctuellement, on peut ajouter une info de dimensions dans [140/200§img.jpg], ou encore avec les connecteurs \':thumb\'. et \':mini\'');
$r[9]=array('stats','La base des stats a besoin d\'être \'flushée\' régulièrement (réorganisée déplacée et vidée). le fait de visiter les stats occasionne un reflush.
Un Cron peut appeler la page /plug/instat_reflush toutes les 24 heures par exemple.');
$r[10]=array('lien avec un objet','[users/philum/maj/installer.tar.gz§[ark§everaldo/128:icon]:url]');
$r[11]=array('logoff, reload, logout ???','6 niveaux de réinitialisation, de la plus légère à la plus totale :
- Home : aucune activité en cours
- reload hub : état du visiteur fraîchement arrivé sur la page (ouverture des sessions)
- reload cache, rebuild cache (ajax) : (frefresh) refabrique le cache des articles avant de les lancer
- logout : déconnexion classique
- logdown : efface toutes les sessions, sauf le nom hub en cours
- logoff : détruit toutes les sessions

et aussi :
login : connexion classique (cookie ou formulaire)
logon : connexion par IP');

?>