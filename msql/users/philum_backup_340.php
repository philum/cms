<?php
//philum_microsql_philum_backup_340
$r["_menus_"]=array('val0');
$r[1]=array('Ajax est devenu indispensable au confort d\'utilisation du logiciel mais poss�de une limitation quant � la quantit� de donn�es qui peuvent �tre re�ues par XMLHttpRequest(), qui varie entre 2000 et 8000 caract�res.
C\'est suffisant pour la plupart des actions mais pas pour l\'enregistrement des articles. 

En l\'absence de solution d�j� existante il a fallu improviser�! Depuis l\'av�nement du ajax dans Philum il y a quatre ans on r�vait de pouvoir s\'affranchir de cette limitation.

[Modus operandi:b]

Pendant l\'ex�cution du code javascript, une commande ajax se projette dans une nouvelle ligne de temps ind�pendante de la premi�re de sorte que le script initial continue et se termine pendant que les donn�es sont envoy�es et re�ues (la transaction) afin d\'�tre r�-envoy�es en tant que r�sultat.

Le Ajax Multithread (AMT) part du constat de cette ind�pendance temporelle, car �a signifie aussi qu\'on peut d�marrer plusieurs actions ajax qui se d�rouleront en m�me temps, y compris l\'acc�s et l\'envoi de donn�es, de la m�me mani�re que le serveur g�re �galement l\'ouverture de plusieurs fichiers simultan�ment (c\'�tait une supposition). Ensuite il a fallu d�terminer le modus operandi, parmi les nombreux possibles, qui produit un r�sultat fonctionnel et fiable.

Les donn�es sont toutes envoy�es simultan�ment et num�rot�es, puis stock�es dans un variable de session.
Le fait qu\'on obtienne des valeurs n�gatives dans le cumul du temps prit pour chaque thread prouve bien que les transactions peuvent �tre simultan�es.

[Tests de vitesse:b]

Voici le temps �coul� en milliseconde (parfois n�gatif) entre chaque threads, avec � droite l\'heure d\'arriv�e: 

[1340637 699.4831
0.01182 699.495
0.01858 699.5135
0.00721 699.528
0.00684 699.5349
0.01047 699.5454
0.01695 699.5623
0.02801 699.5903
0.02804 699.6184
0.03185 699.6502
0.02822 699.6785
0.02847 699.7069
0.02730 699.7342
0.03194 699.7662
0.02803 699.7942
0.02789 699.8221
0.02866 699.8508
0.03193 699.8827
0.02786 699.9106
0.02788 699.9384
0.02100 699.9595�auto:table]
[= 0.43863201141357 s.:table]

On peut voir que le transfert de 22 threads de 2000 cars. (soit 43�546 car., soit 35 min.)  prend [0.44s:b], ce qui est tr�s satisfaisant.

Ensuite on obtient�: [131 threads in 3.6401 s:b]. (261 276 chars. / 201 min.)
et�: [392 threads in 11.2702 s.:b] (783 828 chars. / 603 min.) 
mais � partir de l� le serveur r�pond�: [Allowed memory size of 100663296 bytes exhausted (tried to allocate 406627 bytes):i]. La m�thode est donc fiable jusqu\'� la limite du serveur.

Dans l\'usage courant, l\'enregistrement est instantan�, bien plus rapide que le fading du rendu qui signale l\'activit�. C\'est ce qu\'on appelle un bon bond (technologique)�!

[Temporalit�:b]

D\'habitude seule l\'action d\'Ajax nous int�resse � partir de l\'embranchement temporel mais ici on a besoin que le script attende que les transactions soient toutes termin�es pour continuer son ex�cution, qui consiste ordonner les r�sultats log�s dans la variable de session (puisqu\'ils n\'arrivent pas forc�ment dans l\'ordre), � les sauvegarder et � afficher le rendu. Il est impossible de demander � un javascript d\'attendre un indicateur pour red�marrer (seule une alerte permet de le stopper de le continuer) et les techniques trouv�es sur le web ne tiennent pas compte du fait qu\'on veuille temporiser le retour du r�sultat d\'une fonction, ou alors elles sont un peu lourdes.

La premi�re m�thode avait consist� � temporiser largement la poursuite de l\'ex�cution du script de fa�on � pr�voir 99% des cas de figures, mais en plus de ne pas �tre fiable � 100%, on perd tout l\'avantage de la m�thode AMT, qui est sa supr�me vitesse.

Une fonction en attente de la poursuite du script est appel�e [n:i] fois par ajax � chaque fois qu\'une transaction s\'est termin�e avec succ�s, et lorsque [n:i] est �gal au nombre de threads, le script se termine.

[Influence structurelle:b]

- On a rendu obsol�tes les diff�rentes contentions qui permettaient de revenir � une sauvegarde par POST au-del� de 5000 caract�res ([on peut y revenir en activant la restriction \'save_in_ajax\' (53).:l]).
- Il a aussi fallu rendre le bouton \'[save:l]\' indisponible pendant la dur�e de l\'op�ration pour ne pas la saccager, y compris avec un malheureux double-clic (d� aux souris d�glingu�es�!). Et donc il a aussi fallu individualiser les boutons \'save\' et donner un moyen au script de les conna�tre, mais ce n\'est que le prix progr�s�!
- un outil nomm� \'last_saved\' a �t� ajout� en cas d\'erreur (improbable) de fa�on � r�cup�rer le les donn�es qui ont voulu �tre enregistr�es (log�es dans une variable locale, dans le navigateur).

[Conclusion:b]

Le confort d\'utilisation devient maximal, et toutes les transactions en ajax qui sont centralis�es par la fonction SaveJ passent automatiquement en mode multithread au-del� de 2136 caract�res, comme le bloc-notes ou la sauvegarde depuis l\'admin. L\'enregistrement des articles est quasi instantan� l� o� avant �a prenais plusieurs secondes (avec le premier syst�me de temporalit� par approximation), et encore avant il fallait recharger toute la page.

Il n\'y a d�sormais plus aucune limite � l\'utilisation de Ajax, et gr�ce au AMT les logiciels web vont de plus en plus ressembler aux logiciels de bureau, tout en �tant beaucoup volatiles d\'un point de vue �volutif.');

?>