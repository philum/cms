<?php
//philum_microsql_program_updates_1202
$program_updates_1202["_menus_"]=array('day','text');
$program_updates_1202[1]=array('0201',"correctifs sur le plugin 'share'");
$program_updates_1202[2]=array('0202',"ajout du module 'share' pour rendre publics les fichiers partagés");
$program_updates_1202[3]=array('0205',"correctif de l'empêcheur de faire des titres en majuscules pour supporter les noms composés ou apostrophés");
$program_updates_1202[4]=array('0209',"- correctif aller-retour vers hub par défaut quand ?id== ;
- conversion de 'https' en 'http' lors de l'import ; 
- ajout du support de '&sect' pour les liens qui contiennent un truc du genre '&section' que les entités html convertissent inexorablement en '§' qui est très mal venu ;
- destruction de deux sortes de demi-espaces qui renvoient des '?' après un import, mais il en reste d'autres ;
- importation des images php ;
- réécriture de la fonction 'auto_anchor' - le rendu privilégie l'usage des parenthèses au lieu des crochets, par soucis esthétique ;
- correction traitement entités html deu module Channel ;");
$program_updates_1202[5]=array('0211',"- ajout du fantastique module 'suggest' qui permet de proposer au visiteur de proposer des articles depuis leur Url, et de prévisualiser le contenu, comme dans google+ ;
- l'ajout d'une entrée prévient l'admin par mail ;");
$program_updates_1202[6]=array('0211',"correctif dans l'importateur html : l'image d'un lien qui pointe vers une image (souvent une vignette pointe vers une hd) ne renvoie que la grande image (ça le faisait déjà) et ne se fait plus leurrer par le texte additionnel (genre 'clic pour agrandir') lorsqu'il est bêtement posé dans la même balise de lien que la vignette ; dans ce cas le texte additionnel est supprimé, car on considère que le code html est impropre.");
$program_updates_1202[7]=array('0212','le module MenusJ peut produire des menus activables au survol de la souris si on met "1" en option');
$program_updates_1202[8]=array('0213',"un troisième type d'espace insécable et une entité html de plus correctement traitée par le système de contention d'erreurs (que les fonctions basiques ne prennent pas en charge)");

?>