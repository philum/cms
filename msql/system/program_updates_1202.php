<?php
//philum_microsql_program_updates_1202
$r["_menus_"]=array('day','text');
$r[1]=array('0201','correctifs sur le plugin \'share\'');
$r[2]=array('0202','ajout du module \'share\' pour rendre publics les fichiers partagés');
$r[3]=array('0205','correctif de l\'empêcheur de faire des titres en majuscules pour supporter les noms composés ou apostrophés');
$r[4]=array('0209','- correctif aller-retour vers hub par défaut quand ?id== ;
- conversion de \'https\' en \'http\' lors de l\'import ; 
- ajout du support de \'& sect\' pour les liens qui contiennent un truc du genre \'& section\' que les entités html convertissent inexorablement en \'§\' qui est très mal venu ;
- destruction de deux sortes de demi-espaces qui renvoient des \'?\' après un import, mais il en reste d\'autres ;
- importation des images php ;
- réécriture de la fonction \'auto_anchor\' - le rendu privilégie l\'usage des parenthèses au lieu des crochets, par soucis esthétique ;
- correction traitement entités html deu module Channel ;');
$r[5]=array('0211','- ajout du fantastique module \'suggest\' qui permet de proposer au visiteur de proposer des articles depuis leur Url, et de prévisualiser le contenu, comme dans google+ ;
- l\'ajout d\'une entrée prévient l\'admin par mail ;');
$r[6]=array('0211','correctif dans l\'importateur html : l\'image d\'un lien qui pointe vers une image (souvent une vignette pointe vers une hd) ne renvoie que la grande image (ça le faisait déjà) et ne se fait plus leurrer par le texte additionnel (genre \'clic pour agrandir\') lorsqu\'il est bêtement posé dans la même balise de lien que la vignette ; dans ce cas le texte additionnel est supprimé, car on considère que le code html est impropre.');
$r[7]=array('0212','le module MenusJ peut produire des menus activables au survol de la souris si on met \"1\" en option');
$r[8]=array('0213','- un troisième type d\'espace insécable et une entité html de plus correctement traitée par le système de contention d\'erreurs (que les fonctions basiques ne prennent pas en charge) ;
- \'.jpeg\' converti en \'.jpg\' durant l\'importation ;');
$r[9]=array('0224','- petits correctifs lors de l\'importation (système de contention d\'erreurs)
- l\'import depuis \'tools/vacuum\' enregistre directement le résultat (avant il n\'était que proposé à l\'enregistrement)');
$r[10]=array('0227','- petits correctifs lors de l\'appel en ajax pour les caractères non supportés ;
- suppression des tirets-longs dans le système de contention (non supportés en ajax) ;
- ouvrir/fermer un article qui comporte une vidéo de supprime plus l\'instruction \'clear:left\' ;
- le filtre de post-traitement après import \'del-link\' permet de supprimer les liens non désirés (de façon radicale et grossière), par exemple pour les sites qui ont la stupide idée de mettre un lien vers la définition de chaque mot utilisé, comme futura-sciences et le monde, depuis peu');

?>