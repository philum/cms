<?php //msql/program_updates_2001
$r=["1"=>['0101','publication'],
"2"=>['0103','- ajout du support de format d\'arrays Ã  la mode json dans msql (compatibilitÃ© d\'Ã©changes manuels de donnÃ©es avec Fractal)'],
"3"=>['0105','- rÃ©habilitation du recap manuel d\'articles (vieux connecteurs)
- amÃ©lioration de sql_inner()
- correctif api dig inconnu
- amÃ©lioration du module \'connectors\'
- correctif classeur par sources (inclue l\'extension de domaine)'],
"4"=>['0108','- remaniement du design par dÃ©faut (meilleur agencement des objets de la page)
- remaniement du module art_mod et de sa restriction (qui affiche le module associÃ© Ã  l\'article dans un bouton)
- ajout du module child_arts'],
"5"=>['0109','- version 17 de la picto philum, 279 glyphes + quelques correctifs'],
"6"=>['0110','- ajout du module parent_art'],
"7"=>['0110','- ajout du support de l\'usage du Dom (Ã  un niveau optionnel) dans le dispositif defcon. Pour cibler des zones html on peut utiliser (outre le point de reconnaissance en brut, qui est peu fiable), une zone de ciblage html selon la norme xss (dÃ©veloppÃ©e ici) : poperty:attribut:tag'],
"8"=>['0110','- ajout de la colonne jump div Ã  Defcons : \'permet d\'Ã©liminer des div dans le content'],
"9"=>['0112','- correctif encodage des donnÃ©es proposÃ©es Ã  tw et fb
- correctif proposition de trad
- la capture de donnÃ©es de youtube utilise par le nouveau domsys'],
"10"=>['0113','- tests rÃ©forme du transducteur html2conn'],
"11"=>['0114','- amÃ©liorations de l\'api twitter (3 timelines distinctes, home, user et mentions)'],
"12"=>['0115','- rÃ©novation de batch_preview
- ajout du module vacuum, permet de joindre le moteur d\'aspiration de page
- amÃ©nagement de microarts (affichage par pages)
- ajout du connecteur plugbt, permet d\'afficher un bouton qui appelle un plugin
- ajout (a posteriori, oubli) du connecteur :look, permet de joindre un article en surlignant un terme'],
"13"=>['0116','- correctifs lecteur vidÃ©o
- correctifs pb d\'encodage url des images et vidÃ©os
- correctif image vignette video interne
- rÃ©novation de la table ascii'],
"14"=>['0117','- amÃ©lioration du navigateur de commentaires, par date et par pages
- correctif gestionnaire poptwit
- modif infos sur les commentaires (suppression de l\'usage de la boite mail interne)
- amÃ©lioration du navigateur temporel (affichage limitÃ© au contexte)
- affichage du terme \'admin\' au lieu du nom du hum dans les commentaires'],
"15"=>['0118','- correctif dÃ©tection images au format webp
- correctif nosql json, nommÃ© db'],
"16"=>['0119','- correctif images au format webp (pd de size)
- correctif peu glorieux du bouton d\'Ã©dition url
- ajout du menu meta \'hub\''],
"17"=>['0120','- ajout du plug citation : affiche une entrÃ©e de la table citation (1,2,3)'],
"18"=>['0121','- correctifs et amÃ©nagement d\'intÃ©rieur (plugs txt, apicom depuis l\'admin)
- correctif nouveau systÃ¨me d\'ajout en masse dans msql
- ajout d\'un gestionnaire de catÃ©gorisation du commentaire, et d\'un autre pour changer le nom de son auteur'],
"19"=>['0122','- les liens twitter sont taritÃ©s par poptwit
- correctif classement des articles affiliÃ©s en nombre insuffisants
- correctifs api twitter
- le conn :twitapi devient :twapi
- l\'utilisateur twitter affiche une banniÃ¨re (utiliser :twapi avec Â§stream pour ses publications)
- le conn antique :poptwit est supprimÃ©
- poptwit() renvoie une ban ou un serach selon le contenu'],
"20"=>['0123','- les trois status des commentaires sont 1=normal, 2=question, 3=solution, avec des couleurs associÃ©es, et des termes multilingues.'],
"21"=>['0124','- instauration de nmx(), permet de confectionner des messages systÃ©miques (remplace les nms() consÃ©cutifs)
- nouvel Ã©tat de track : solution (commentaire, question, rÃ©ponse, solution)
- petite rÃ©novation de apicom
- instauration de la capacitÃ© pour Tracks de rÃ©pondre rÃ©cursivement Ã  des messages (laissÃ© invisible)'],
"22"=>['0125','- ajout d\'un \"lire la suite\" sur les commentaires
- correctif dÃ©tection des liens inutiles (link &cong; txt) [Ã©gal et Ã  peu prÃ¨s Ã©gal)]
- correctif redondance findroot()
- rÃ©novation du gestionnaire db
- suppression de l\'antique lecteur jwplayer
- ajout de getvid, appelÃ© par :vid, permet d\'aspirer des vidÃ©os (rÃ©usage du dossier video)'],
"23"=>['0126','- rÃ©forme de l\'usage des colonnes de tracks, rÃ©vision critique, patch 200126 : frm=>ib, suj=>lg, frm=private message, suj=\'\'
- le module tracks s\'arroge la compÃ©tence de classer les rÃ©sultats selon l\'ordre des articles ou selon l\'ordre des commentaires
- nouvelle compÃ©tence des connecteurs, servant Ã  gÃ©nÃ©raliser le choix d\'un affichage  d\'un connecteur dans un bouton, et Ã  dÃ©barrasser les connecteurs de ce particularisme. On peut dÃ©sormais Ã©crire [pÂ§o:cÂ§b] oÃ¹ b est e nom du bouton, param, option et conn restant Ã  leur place. Et en se dÃ©barrassant de predlink (antique) Ã§a va plus vite :)'],
"24"=>['0127','- rÃ©forme de la nouvelle compÃ©tence des connecteurs pour la gÃ©nÃ©raliser encore Ã  n\'importe quel connecteur, en plus des plugins. (genre d\'idÃ©e qu\'on aurait pu avoir depuis le dÃ©but, mais c\'est Ã§a le job)
- rÃ©novation de suggest, le plug qui sert Ã  proposer des articles
- maintenance page d\'accueil de philum.fr'],
"25"=>['0128','- rÃ©forme de la mise en dev et de la fonction prog
- prÃ©paratifs pour des futures classes
- le dossier plug/._datas va dans /data
- le dossier plug/_old va dans _old/msql'],
"26"=>['0129','- rÃ©novation du plug ascii, plus easy to use
- ajout du plus cursive, permet de convertir des caractÃ¨res en Ã©quivalents Ã  diffÃ©rents points de l\'ascii (petit encryptage), et dÃ©cryptage auto.
- ajout d\'un autoload pour les apps de plug et modif de leur physionomie (en accord avec Fractal)
- rÃ©novation de systÃ¨me de vote \'poll\', utilise 5 Ã©toiles au lieu de 2 smileys ; placÃ© dans les apps ;
- rÃ©novation de fav_edt et poll_edt, consomme moins de ressources ;
- rÃ©novation de l\'usage des pictos : bookmark, like, poll
- correctif dans favs : affichage des articles votÃ©s'],
"27"=>['0130','- ajout de 20 gyphes et midification de quelques autres dans la typos philum, version 17b'],
"28"=>['0131','- rÃ©forme des polls, qui dÃ©sormais prennent en charge les likes, les favs, les agree, et les autres futurs modes de classements utilisateur : patch 200131, modif nom de table poll->favs, ajout du dispositif poll dans art, suppression du plug poll, ajout d\'une charge de donnÃ©e des articles \'art_favs\' ; prÃ©cÃ©demment les donnÃ©es utilisateur Ã©taient confondues avec les donnÃ©es systÃ¨me, de art_opts.']];