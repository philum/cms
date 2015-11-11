<?php
//philum_microsql_admin_restrictions
$r["_menus_"]=array('name','description');
$r[1]=array('commentaires','ouverture des commentaires au public');
$r[2]=array('mod�ration','mod�ration des commentaires (auth 4)');
$r[3]=array('champ temporel','syst�me de champ temporel (p�riodicit�), d\'apr�s param16');
$r[4]=array('tags','affiche des infos sur l\'article');
$r[5]=array('mode preview','affiche un article en mode \'preview\' (pub2)');
$r[6]=array('publicateur','qui a publi� l\'article');
$r[7]=array('date','affiche la date dans les pubs');
$r[8]=array('mode ajax','ouvre les pubs d\'articles dans une popup');
$r[9]=array('float img','option de d�tourage des images par d�faut');
$r[10]=array('auto parent','le nouvel article est apparent� � celui qui est en cours de lecture');
$r[11]=array('aussit�t publi�','le nouvel article est directement publi�');
$r[12]=array('imprimer','pager (page imprimable et affichable sur un mobile)');
$r[13]=array('balise p','utiliser les balises \'p\' ou \'br\' (\'br\' facilite la copie au format texte brut)');
$r[14]=array('nombre d\'articles','affiche le nombre d\'articles');
$r[15]=array('captcha','captcha');
$r[16]=array('miniature pleine','place les limites de l\'image � l\'ext�rieur de la miniature');
$r[17]=array('2 colonnes','article sur 2 colonnes (obsol�te, d�sactiv�, utiliser d�sormais css)');
$r[18]=array('d�finitions publiques','D�finitions d\'importation. Choisir la base \'public\' permet d\'obtenir une liste compl�t�e par les utilisateurs, avec le risque de perdre les enregistrements qu\'on y a faits. Choisir la base priv�e permet d\'y importer la base publique r�guli�rement et d\'informer la base publique des ajouts. (dans l\'�diteur 01L)');
$r[19]=array('_img1','injecte la variable _IMG (premi�re image, qui sert de miniature) dans le template avant son traitement, afin que Codeline puisse produire une miniature personnalis�e : [_IMG1�100/100:thumb]');
$r[20]=array('home','affiche le menu admin home');
$r[21]=array('zones restreintes','acc�s des pages r�serv� aux utilisateurs inscrits');
$r[22]=array('bots','ouvert aux robots');
$r[23]=array('priorit� de l\'article','niveau de priorit� de l\'article');
$r[24]=array('date','afficher la date de l\'article');
$r[25]=array('dur�e','lenght');
$r[26]=array('ID','afficher l\'ID de l\'article');
$r[27]=array('source url','afficher la source de l\'article');
$r[28]=array('ouvrir sur place','afficher le bouton \'Ouvrir\' en Ajax, quand l\'article est pr�sent� est en mode \'preview\'');
$r[29]=array('tags','afficher les tags de l\'article');
$r[30]=array('miniatures','afficher la miniature de l\'article');
$r[31]=array('retour','retour au contexte topologique de l\'article');
$r[32]=array('miniatures','afficher les miniatures dans les modules');
$r[33]=array('articles affili�s','afficher les articles affili�s � la suite de leur parent');
$r[34]=array('sauter bichs','d�truit les balises b, i, c, h, table en mode preview');
$r[35]=array('ouvrir scroll','l\'ouverture sur place d\'un article se fait dans une fen�tre scrollable (avec restriction 28 � ON)');
$r[36]=array('cat�gorie','afficher la cat�gorie des articles pr�sents dans les modules');
$r[37]=array('ouvrir popup','affiche l\'article dans une popup');
$r[38]=array('url explicite','utilise les URL explicites avec le titre au lieu de l\'id ; on peut aussi ne prendre qu\'une portion du titre dans /read/titre ; c\'est le plus r�cent trouv� qui s\'affichera');
$r[39]=array('d�filement continu','la navigation entre les pages se fait en ajax');
$r[40]=array('rss','article au format rss');
$r[41]=array('article entier','affiche l\'article en entier dans le d�roul� (pub3) ');
$r[42]=array('classes de tags','user_tables');
$r[43]=array('categorie','rappel de la cat�gorie � laquelle appartient un article');
$r[44]=array('facebook','export: Facebook');
$r[45]=array('twitter','export: Twitter');
$r[46]=array('stumble','export: Stumble');
$r[47]=array('envoyer article','propose au visiteur d\'envoyer l\'article par mail');
$r[48]=array('user','affiche le bouton login � tout le monde');
$r[49]=array('mots connus','Mots connus d�tect�s dans l\'article');
$r[50]=array('vues','nombre de vues d\'une page');
$r[51]=array('apps','ouvre le menu Apps au public');
$r[52]=array('favoris','boutons favoris');
$r[53]=array('enregistrer en ajax','enregistrer les articles en ajax');
$r[54]=array('date travel','affiche la date avec un lien vers timetravel');
$r[55]=array('template pubs','pubs d\'articles :
tente d\'abord d\'utiliser un template personnalis�, puis un template public, avant de retourner � celui par d�faut.');
$r[56]=array('home/hubs','menu des hubs');
$r[57]=array('nouvel article popup','affiche le nouvel article dans une popup');
$r[58]=array('code source','affiche le code source de l\'article (connecteurs)');
$r[59]=array('permalog','autorise les cookies pour rester logu� � long terme');
$r[60]=array('art mods','affiche les modules d\'articles au lancement (sinon ils sont disponibles depuis un bouton)');
$r[61]=array('apps par d�faut','inclue les apps syst�me aux apps utilisateur (dont celles pour le desktop)');
$r[62]=array('recherche �tendue','relance automatique une recherche ayant �chou� sur la plage temporelle suivante');
$r[63]=array('negcss','css invers�s automatiquement sur les mobiles Android');
$r[64]=array('bloquer blockquotes','n\'affiche pas le contenu des blocs en mode preview (2)');
$r[65]=array('template titles','titres de page :
tente d\'abord d\'utiliser un template personnalis�, puis un template public, avant de retourner � celui par d�faut.');
$r[66]=array('template tracks','commentaires : 
tente d\'abord d\'utiliser un template personnalis�, puis un template public, avant de retourner � celui par d�faut.');
$r[67]=array('template book','connecteur book : 
tente d\'abord d\'utiliser un template personnalis�, puis un template public, avant de retourner � celui par d�faut.');
$r[68]=array('nbimg','bouton vers catalogue des images de l\'article');
$r[69]=array('vertical','menu admin horizontal ou verticlal');
$r[70]=array('r�paration','corrige les d�finitions obsol�tes (ajoute 2ms au script)');
$r[71]=array('stats d\'article','graphique des visites d\'un articles');
$r[72]=array('cache html','g�n�re une page html des articles chaque 24 heures (attention en dev)');
$r[73]=array('autolog','reconnaissance par IP');
$r[74]=array('metasocial','affiche les meta title, description et image pour facebook et twitter (pas toujours utile)');
$r[75]=array('recherche','moteur de recherche');
$r[76]=array('batch','importation en masse d\'articles');
$r[77]=array('nbarts','nombre d\'articles');
$r[78]=array('parents','afficher articles parents dans le module page_titles');
$r[79]=array('addurl','ajout rapide d\'article au lieu du formulaire');
$r[80]=array('arts','menu d�roulant des articles en cache');
$r[81]=array('favs','plugin favoris');
$r[82]=array('langues','menu des langues d�tect�es');
$r[83]=array('ucom','console pour les modules (dev)');
$r[84]=array('timetravel','menu de voyage dans le temps');
$r[85]=array('desktop','d�marre des apps de type desk (affiche le bureau)');
$r[86]=array('track','ajoute commentaire');
$r[87]=array('miniature vide','permet d\'�galiser les colonnes');
$r[88]=array('template read','active un template d�di� au mode lecture');
$r[89]=array('meta','environnement meta de l\'article en cours');

?>