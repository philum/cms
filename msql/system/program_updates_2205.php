<?php //msql/program_updates_2205
$r=["_menus_"=>[''],
"1"=>['0510','publication'],
"2"=>['0517','- correctif import liens yt contenant un espace
- correctif lien yt appelant le titre par le param �1
- ajout du support du niveau de priorit� de l\'article dans la recherche
- ajout du support de la longueur de l\'article dans la recherche'],
"3"=>['0523','- fix synchronisation clef/colonnes lors de l\'�dition de la config (d� aux limites du moteur ajax, les clefs devant �tre reconstruites par la logique)'],
"4"=>['0524','- ajout d\'un ajouteur en masse de tags d\'apr�s le nombre d\'occurrences (ex. ajouter tous les tags pr�sents plus de trois fois)
- ajout d\'un suppresseur en masse de tags d\'un articles (utile quand on efface un doublon)'],
"5"=>['0529','- correctif import tables contenant liens (qui peuvent traverser les colonnes)']];