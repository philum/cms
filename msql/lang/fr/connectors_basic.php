<?php //msql/connectors_basic
$r=["_menus_"=>['description'],
"conn"=>['détection : url, image ou média (jpg,mp3,mp4,flv...)'],
"url"=>['[url§text] applique une Url au texte sélectionné'],
"img"=>['image'],
"video"=>['vidéo (youtube etc.)'],
"iframe"=>['iframe'],
"h"=>['big'],
"b"=>['gras (bold)'],
"i"=>['italique'],
"u"=>['souligné (underline)'],
"k"=>['barré (strike)'],
"s"=>['petit (small)'],
"q"=>['bloc de citation'],
"list"=>['liste avec puces (pour chaque saut de ligne)'],
"nh"=>['note de bas de page'],
"web"=>['Affiche la description d\'une page web'],
"twitter"=>['Api Twitter :
- [123456789:twitter] renvoie un twit
- [text§search:twitter] résultat d\'une recherche
- [123456789§thread:twitter] fil d\'une discussion (en remontant)'],
"art"=>['Pointe vers un article : 
- [1234:art] renvoie un bouton vers l\'article avec son titre
- [1234§titre:art] assoie le bouton à un titre
- [titre:art] : trouve l\'article dans la langue courante'],
"msql"=>['Renvoie les données d\'une table : 
[hub_table_(version)-(key)|(row)§option:microsql] ;
Options : pop, read, conn, last, count, graph, form, tmp'],
"table"=>['- colonnes : | ou virgules
- lignes : ¬ ou saut de ligne
- headers : §1'],
"center"=>['aligné au centre'],
"right"=>['aligné à droite'],
"--"=>['ligne horizontale'],
"nbsp"=>['espace insécable'],
"quo"=>['guillemets typographiques'],
"qu"=>['balise guillemets'],
"select"=>['sélectionner tout'],
"copy"=>['copier'],
"paste"=>['coller'],
"deline"=>['réduction sauts de lignes'],
"delconn"=>['supprimer connecteur'],
"findconn"=>['sélectionne connecteur'],
"del"=>['effacer'],
"nl"=>['à la ligne']];