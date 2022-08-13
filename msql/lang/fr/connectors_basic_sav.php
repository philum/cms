<?php //philum/microsql/connectors_basic_sav
$r=["_menus_"=>['description'],"conn"=>['détection : url, image ou média (jpg,mp3,mp4,flv...)'],"url"=>['[url§text] applique une Url au texte sélectionné'],"art"=>['Pointe vers un article : 
- [1234:art] renvoie un bouton vers l\'article avec son titre
- [1234§titre:art] assoie le bouton à un titre
- [titre:art] : trouve l\'article dans la langue courante'],"img"=>['image'],"web"=>['Affiche la description d\'une page web'],"video"=>['vidéo'],"twitter"=>['Api Twitter :
- [123456789:twitter] renvoie un twit
- [text§search:twitter] résultat d\'une recherche
- [123456789§thread:twitter] fil d\'une discussion (en remontant)'],"h"=>['balise h3 (titres)'],"b"=>['balise bold (gras)'],"i"=>['balise em (italique)'],"u"=>['balise u (souligné)'],"s"=>['css \'stabilo\''],"r"=>['texte rouge'],"k"=>['balise strike (barré)'],"l"=>['balise small (petit)'],"center"=>['aligné au centre'],"right"=>['aligné à droite'],"table"=>['- colonnes : | ou virgules
- lignes : ¬ ou saut de ligne
- headers : §1'],"msql"=>['Renvoie les données d\'une table : 
[hub_table_(version)-(key)|(row)§option:microsql] ;
Options : pop, read, conn, last, count, graph, form, tmp'],"list"=>['liste avec puces (pour chaque saut de ligne)'],"q"=>['bloc de citation'],"nh"=>['note de bas de page'],"--"=>['ligne horizontale'],"nbsp"=>['espace insécable'],"quo"=>['guillemets'],"qo"=>['balise guillemets'],"select"=>['sélectionner tout'],"copy"=>['copier'],"paste"=>['coller'],"deline"=>['réduction sauts de lignes'],"delconn"=>['supprimer connecteur'],"findconn"=>['sélectionne connecteur'],"del"=>['effacer'],"nl"=>['à la ligne']];