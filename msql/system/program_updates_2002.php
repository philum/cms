<?php //msql/program_updates_2002
$r=["1"=>['0201','publication'],
"2"=>['0201','- nouveaux mimes, accessibles depuis pictos
- rÃ©solution confusion entre apps et app, qui devient appin
- module app devient appin
- conn :app devient :appin
- relÃ©gation des conn :plugbt et :plugin
- correctif poll_scores, calcul des demi-Ã©toiles'],
"3"=>['0202','- instauration de moods, attache une humeur aux articles, activÃ© par rstr119 et une option d\'articles
- rstr120 : switch menus admin bouton ou menu
- plus: function plug_name() rallie une app Ã  un plug
- sys : make_table->tabler
- sys : msqlink->msqbt
- correctifs typo philum17c'],
"4"=>['0203','- l\'app twit supporte les mp3
- le cache (du cache) est impactÃ© par les modifs des mÃ©ta
- amÃ©lioration plug proposal
- ajout du support d\'appel des apps (les plugs modernes) dans... euh... apps (le dispositif de commande d\'actions)'],
"5"=>['0204','- corrections / ajout de glyphes
- refonte du gestionnaire de membres, activation de la table members, patch auto
- ajout du support de recherche de mÃ©dias Ã  l\'Api (video, audio, pdf, twitter), supplante les modules associÃ©s video_playlist, audio_playlist, pdf_playlist et twit_playlist, dont le moteur est moteur associÃ© au rancard.
- ajout du module img_playlist'],
"6"=>['0205','- rÃ©forme gÃ©nÃ©rale structurelle (prÃ©paratifs)
- instauration d\'un autoload
- plus besoin de sÃ©parer les appels ajax dirigÃ©s vers une popup
- retrait des alias de conn :tw et :fig (faciliter le travail des recherches de mÃ©dias)
- ajout d\'un sous-menu de boutons dans l\'admin pour se passer des menus dÃ©roulants
- correctifs de vieux trucs de l\'admin
- renommage du procÃ©dÃ© Apps en Desktop pour laisser place aux vraies apps'],
"7"=>['0205','- rÃ©forme structure du dossier prog, on dÃ©place les choses inutiles dans des sous-dossiers
- correctif en consÃ©quence de dev2prod
- la mise Ã  jour supporte allÃ¨grement ces changements
- dÃ©placement des ustensiles de login dans une classe sÃ©parÃ©e (enfin)'],
"8"=>['0212','- la section \'social\' de l\'article est dÃ©localisÃ©e
- le param \'id\' de art_mod est remplacÃ© par l\'id en cours, Ã  destination des modules d\'articles.'],
"9"=>['0215','- dÃ©but de gÃ©nÃ©ralisation de la nouvelle refonte, favs, twit, tracks, web, citation, microarts, wiki, yandex et vue sont rapatriÃ©s dans le rÃ©pertoire (devenu) unique des classes subalternes
- l\'appendice d\'url /app/ renvoie spÃ©cialement vers ces choses'],
"10"=>['0216','- isolation de finder, bubs, rss'],
"11"=>['0217','- isolation de codeline, video
- correctif sÃ©lecteur (compliquÃ©) de templates, entre ceux par dÃ©faut, les personnalisÃ©s privÃ©s et publics, et un retour au prÃ©cÃ©dent en cas d\'absence
- la variable de template \'_auteurs\' (qui est un accommodement)  est rendue possible Ã  Ãªtre ignorÃ©e'],
"12"=>['0218','- correctifs liÃ©s Ã  la gestion des configs sans rstr3 (pas de champ temporel) dans le but d\'allÃ©ger le cache, au moment de l\'appel d\'Ã©lÃ©ments du desktop ou de modules.
- isolation de api, le moteur sql
- rÃ©novation de translate : crÃ©e un article de la langue spÃ©cifiÃ©e ou remplace celui spÃ©cifiÃ© par un de la langue courante'],
"13"=>['0221','- modifications d\'accÃ¨s :
/api/{com} renvoie une rÃ©ponse au sein du site
/apicom/{com} => appels depuis l\'extÃ©rieur
(mettre Ã  jour le htaccess)
- modification d\'accÃ¨s de rss et de vacuum
- rectifications de \'usage de call.php et app.php
- correctifs construction du json de l\'api'],
"14"=>['0222','- correctif erreur d\'affichage des articles impairs lors du dÃ©filement continu
- amÃ©lioration affichage en cas de nombreuses traductions d\'un article'],
"15"=>['0223','- introduction de xhtml, permet de convertir les connecteurs vers un format xthml et vice-versa ; utilisÃ© pour prÃ©server les paramÃ¨tres des connecteurs durant les traductions
- rÃ©fection de quelques pictos'],
"16"=>['0224','- prise en charge des notes de traduction et notes de webmaster lors de l\'importation'],
"17"=>['0225','- correctif dÃ©tection de prÃ©sence de dÃ©finitions d\'importation dÃ©diÃ©s au dom
- ajout du procÃ©dÃ© ajax json, capable de distribuer des rÃ©sultats sur la page en une fois ; ajout du support de cible multiples (usage de la virgule)
- rÃ©novation du contrÃ´leur json_r'],
"18"=>['0226','- ajout du connecteur :lang, qui permet d\'afficher un bloc de texte volatile traduit depuis sa langue originale ; volatile car n\'Ã©tant par rÃ©cupÃ©rable ; identifiÃ© par un md5 ; avec une admine de gestion de contenu
- ajout de rid(), renvoie un nombre alÃ©atoire prÃ©visible, par opposition Ã  randid() ; utile pour fixer le contenu rÃ©fÃ©rencÃ© par un md5 par :lang
- rÃ©fection de styl, suppression des antiques dispositifs prÃ©alables Ã  l\'apparition de msql'],
"19"=>['0227','- isolation par anticipation de la classe \'msql\' en vue d\'une distribution publique
- isolation de la classe \'json\' qui est un gestionnaire maison, low tech, minimaliste et ultra efficace
- amÃ©nagement des formulaires secondaires par la nouvelle fonction editarea()
- rÃ©fection de l\'exportation d\'article (permet de republier un article ancien)
- correctif importateur html, Ã©viter les pertes d\'espaces'],
"20"=>['0228','- retrait du contrÃ´le de longueur d\'article en cours de lecture par l\'admin, positionnÃ©e lors de l\'enregistrement/modification de l\'article
- rÃ©fection de sav.php, ajout d\'un contrÃ´leur de dÃ©tection de la langue
- application du nouveau dispositif ajax-json Ã  l\'Ã©diteur Wyg
- rÃ©fection du moteur ajax
- traduction de twits
- nouvelle variable de session lng, donne la langue explicite (lang donne la lange choisie incluant \'all\')'],
"21"=>['0229','- rÃ©novation du bouton \'back\', qui n\'est pas simple (incorporation de catpic mit en vitesse)
- rÃ©paration du projecteur/navigateur d\'images par dÃ©faut
- rÃ©novation de auotolang, permet de dÃ©finir pluri-rÃ©ciproquement les langues alternatives d\'un article (signale la nouvelle Ã  l\'ancienne et enquÃªte sur les accointances pour Ã©tendre les signalements). TrÃ¨s drÃ´le. Encore un bon mois.
- ajout de l\'app frequency, permet Ã  twit d\'avoir la frÃ©quence d\'une mention (etc.)']];