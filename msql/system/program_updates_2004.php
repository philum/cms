<?php //philum/msql/program_updates_2004
$r=[1=>['0402','publication'],2=>['0403','les traductions disponibles sont rendues visibles d\'office, plut�t que de n\'�tre sollicit�es que par le contexte de la langue utilisateur'],3=>['0404','r�forme graduelle de msql, pour distinguer les appels entre :
::read (tout, opt menu et row), array 2D
::arr (opt menu et o=colonne), array 1D verticale
::row (opt combine), array 1D horizontale
::val, string'],4=>['0405','r�forme graduelle de msql, phase 2/3 :
- entonnoir de modif_vars vers msql::modif (env. 70 occurrences)
- alignement fonctionnel de msql::modif
- suppression de modif_vars, msql_modif, msql_modif_vars, msq_dump (vers msql::dump), et les tr�s antiques read_vars et save_vars.
pas de push avant plus de d�bug'],5=>['04010','- version 18 de la picto philum, 370 glyphes, class�s par familles'],6=>['04011','- version 18.1 de la picto philum, 388 glyphes'],7=>['04012','- correctif fonctionnement de l\'app wiki, rattach�e au nouveau process de s�lection via le dom (n\'est plus ind�pendant des defcons)
- petite r�novation de la gestion des ancres, d�tection d\'ancres qui font comme nous (int�gration de contenu), am�lioration de la mise en forme
- r�novation de l\'app xss, qui donne la liste des articles d\'une page d\'accueil'],8=>['04013','- correctif import rss
- quelques pictos en plus ou remplac�s
- correctif app wiki
- am�lioration substantielle du fonctionnement du s�lecteur de mode de tri des commentaires, selon l\'ordre des articles ou des commentaire. Plus rapide. Petit moteur de recherche en dev.
- am�lioration description d\'article via delconn()'],9=>['04014','- am�lioration de la suppression d\'images, qui affecte le champ catalogue, en plus de la liste des images, de sorte � pouvoir d\'enregistrer les m�tas, afin de voir appara�tre le changement sur la page
- version 18.2 des pictos : 600 glyphes'],10=>['04015','- r�paration absence de protect_url() des cat�gories
- r�paration du module gallery, qui en avait bien besoin ; remplac� par img_playlist, mais toujours utile quand m�me'],11=>['04018','- modif mode d\'affichage de la description des vid�os
- r�paration de match_vdir(), qui trie les apps par r�pertoire, et laissait passer une exception (terme r�current dans les it�rations).'],12=>['04019','- pictos version 18.3, ajouts et modifs'],13=>['04024','- d�localisation des codes crypt�s de transport'],14=>['04025','- ajout de subtostr() dans la lib'],15=>['04026','- am�nagements pour recevoir catid
- rstr123, active catid'],16=>['04027','- ajout de l\'outil dump2array dans txt
- rstr124 : special for dev
- ajout module most_polled, renvoie un tri en fonction du nombre de \'fav\', \'like\', \'poll\', \'mood\') affect�s � un article (sans �valuer la qualit�, juste le nombre), depuis qdf'],17=>['04028','- ajout du module catj, permet de naviguer rapidement entre les cat�gories
- ajout de quelques pictos dans la font philum'],18=>['04029','- ajout sqlsavup() et sqlup2()
- ajout du module score_datas, renvoie un tri en fonction des scores affect�s � un article depuis d\'autres processus (valeurs simples dans qdd)
- ajout du module special_poll, permet de faire des votes par jugement sp�cialis�s
- ajout du module quality_stats, permet de combiner des votes pour renvoyer une note globale (dev)
- am�lioration du comportement de poll et de mood'],19=>['04030','- prmb8 (config) : logo d\'apr�s un picto
- ajout du gestionnaire \'poll\' dans l\'api, permet de trier les r�sultats selon les diff�rentes sortes de votes d\'articles
- ajout de l\'app score, permet de juguler un tri selon diff�rents param�tres m�diam�triques']];