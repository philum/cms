<?php
//philum_microsql_program_faq
$r["_menus_"]=array('question','answer');
$r[1]=array('supprimer un article','les diff�rents niveaux de dissipation d\'un article sont :
- on peut le d�publier ;
- on peut le mettre dans une cat�gorie non publique (cat�gorie pr�c�d�e d\'un \'_\' comme \'_system\') ;
- on peut l\'envoyer dans le r�pertoire \'_trash\' ;
- on peut r�utiliser cet article, et changer sa date de cr�ation ;
- seuls les articles mis dans \'_trash\' peuvent �tre d�finitivement supprim�s, ce qui occasionne un reflush de la base.');
$r[2]=array('probl�me d\'import d\'un article','Les �checs d\'importation sont devenus tr�s rares.
10% des �checs sont dus � un article vraiment tr�s long (�quivalent de 2 heures de lecture),
10% � cause de caract�res mal interpr�t�s, ou non encod�s (comme les <>),
10% une erreur dans le code d\'origine, que le navigateur sait outrepasser, provoque un blocage (mauvaise imbrication).
le plus souvent le serveur est refuse, tout simplement...

Les anciennes proc�dures peuvent parfois sauver des nouvelles : il suffit de copier le code source de la s�lection et le convertir dans l\'�diteur externe, en sp�cifiant la source (pour informer les images), puis de coller le code correctement converti en connecteurs dans le nouvel article.');
$r[3]=array('lecteur mp3 ?','La pr�sence d\'un lien \'.mp3\' dans l\'article fait automatiquement appel � un lecteur Flash tr�s simple ; ex: [http://site.com/audio.mp3] ou des documents upload�s [audio.mp3]

Ici le point (.mp3) est consid�r� comme un connecteur. C\'est le cas aussi pour toutes les extensions vid�os (.flv, .mp4, etc...)

Le \'.swf\' peut �tre remplac� par un \':swf\' (deux points) pour appeler un connecteur qui permet d\'afficher le contenu dans une fen�tre en ajax.');
$r[4]=array('Articles de plus d\'un mois n\'apparaissent plus !','C\'est normal du point de vue du logiciel : par d�faut le param�tre admin/params/nb_days (16) est � \'auto\' o� la fr�quence est de 50 articles par p�riodes (le cas d\'un journal p�riodique).

Cela signifie que la p�riodicit� est choisie automatiquement (hebdo, mensuel, ...).

Le param�tre peut recevoir un nombre de jours (365) ou rester vide pour les garder tous, mais dans ce cas la recherche est plus longue. 

Activer le param�tre restrictions/time_system, permet d\'acc�der aux anciens articles par un \'dig\' (creuser dans le temps) afin de ne pas nuire aux performances.');
$r[5]=array('Cr�er une cat�gorie ?','Les cat�gories sont une �mergence : elles sont cr��es � la vol�e dans les m�ta de l\'article.

La pr�sence des articles d�termine celle des cat�gories qui leur sont associ�es. Ainsi il n\'est pas possible d\'afficher une cat�gorie vide.');
$r[6]=array('Comment obtenir des paragraphes ?','La restriction \'p_balise\' permet de g�n�rer des paragraphes � chaque double-saut de ligne.
Par d�faut c\'est un syst�me de saut de ligne html (br) qui est utilis�.');
$r[7]=array('Position des entr�es dans le menu','Les menus ce sont autant de modules, et d\'office ils sont s�par�s par un saut de ligne, qu\'on peut annuler en cochant la case \'nobr\'.');
$r[8]=array('taille des miniatures','- mani�re simple : dans params : thumbnails_size (hauteur/largeur) ; il faut s\'assurer que les miniatures sont envoy�es dans \'restrictions/content/thumbnails\'.  Puis \'rebuild_img\' permet de les reconstruire.

- mani�re avanc�e avec la variable _IMG1 : 
-- allumer la restriction IMG1 (envoie la variable au template)
-- dans builder/templates, sp�cifier une instruction \'[_IMG1�width/height:thumb]\' ; 
Intervenir dans les templates permet d\'afficher des articles en utilisant des templates diff�rents (de celui par d�faut), de fa�on � en avoir certains avec des grandes et d\'autres avec des petites miniatures.

- ponctuellement, on peut ajouter une info de dimensions dans [140/200�img.jpg], ou encore avec les connecteurs \':thumb\'. et \':mini\'');
$r[9]=array('stats','La base des stats a besoin d\'�tre \'flush�e\' r�guli�rement (r�organis�e d�plac�e et vid�e). le fait de visiter les stats occasionne un reflush.
Un Cron peut appeler la page /plug/instat_reflush toutes les 24 heures par exemple.');
$r[10]=array('lien avec un objet','[users/philum/maj/installer.tar.gz�[ark�everaldo/128:icon]:url]');
$r[11]=array('logoff, reload, logout ???','6 niveaux de r�initialisation, de la plus l�g�re � la plus totale :
- Home : aucune activit� en cours
- reload hub : �tat du visiteur fra�chement arriv� sur la page (ouverture des sessions)
- reload cache, rebuild cache (ajax) : (frefresh) refabrique le cache des articles avant de les lancer
- logout : d�connexion classique
- logdown : efface toutes les sessions, sauf le nom hub en cours
- logoff : d�truit toutes les sessions

et aussi :
login : connexion classique (cookie ou formulaire)
logon : connexion par IP');

?>