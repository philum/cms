//svg//http://pilatinfo.org/routines/alerte.htm

function svg(evt){
	}

function cree_rectangle(evt){
svgdoc=evt.target.ownerDocument;
node=svgdoc.createElementNS("http://www.w3.org/2000/svg","g");
node.setAttributeNS(null,"id","affiche");
ou=evt.target;
ou.appendChild(node);
node=svgdoc.createElementNS("http://www.w3.org/2000/svg","rect");
node.setAttributeNS(null,"x","50");node.setAttributeNS(null,"y","50");
node.setAttributeNS(null,"width","100");node.setAttributeNS(null,"height","50");
node.setAttributeNS(null,"fill","red");
ou=svgdoc.getElementById("affiche");
ou.appendChild(node);}

function cree_texte(evt){
svgdoc=evt.target.ownerDocument;
var node=svgdoc.createElementNS("http://www.w3.org/2000/svg","text");
node.setAttributeNS(null,"x","50");
node.setAttributeNS(null,"y","50");
node.setAttributeNS(null,"text-anchor","middle");
node.setAttributeNS(null,("font-size","25"));
node.setAttributeNS(null,("font-family","Arial"));
node.setAttributeNS(null,("fill","red"));
var texte=svgdoc.createTextNode("tra la la");
node.appendChild(texte);
ou=evt.target;
ou.appendChild(node);}

function alerte(evt){
var objet=evt.target;
var large=objet.getAttributeNS(null,"width");
alert("Largeur du rectangle:"+large)}

function cree_event(evt){
svgdoc=evt.target.ownerDocument;
var node=svgdoc.createElementNS("http://www.w3.org/2000/svg","rect");
node.setAttributeNS(null,"x","50");
node.setAttributeNS(null,"y","50");
node.setAttributeNS(null,"width","100");
node.setAttributeNS(null,"height","50");
node.setAttributeNS(null,"fill","red");
node.addEventListener("mousemove",alerte,false);
var ou=svgdoc.getElementById("affiche");
ou.appendChild(node)}

/*function change_attribut(evt){
var objet=evt.target;
objet.setAttributeNS(null,"width","200");
objet.setAttributeNS(null,"height","80");
objet.setAttributeNS(null,"fill","red")}*/

function change_texte(evt){
svgdoc=evt.target.ownerDocument;
var objet=svgdoc.getElementById("texte");
var child=objet.firstChild;
child.data="Bravo ...";}

function zoom(evt){
var svgdoc=evt.target.ownerDocument;
var obj=svgdoc.getElementById("objet");
obj.setAttribute("transform","matrix(2 0 0 2 100 75)");}

function normal(evt){
var svgdoc=evt.target.ownerDocument;
var obj=svgdoc.getElementById("objet");
obj.setAttribute("transform","matrix(1 0 0 1 100 75)");}


function clone_objet(evt){
if(evt.detail==2){
svgdoc=evt.target.ownerDocument;
n += 1;
var objet=svgdoc.getElementById("rectangle");
var  newnode=objet.cloneNode(false);
newnode.setAttributeNS(null,"x",100+10*n);
newnode.setAttributeNS(null,"y",100+10*n);
newnode.setAttributeNS(null,"fill","blue")
var  contents=svgdoc.getElementById('affiche');
contents.appendChild(newnode)}}

//
alertes=new Array("LightGrey","black","yellow","red",14,"Arial",150,100,250,150);
chaines=new Array("Vous allez changer","les attributs du rectangle","Je confirme");
var accord=false,nb_chaines=0;

function alerte(evt){
svgdoc=evt.target.ownerDocument;
node=svgdoc.createElementNS("http://www.w3.org/2000/svg","rect");
node.setAttribute("id","fenetre");
node.setAttribute("x",alertes[6]);node.setAttribute("y",alertes[7]);
node.setAttribute("width",alertes[8]);node.setAttribute("height",alertes[9]);
style="fill:"+alertes[0]+";stroke:"+alertes[1];
node.setAttribute("style",style);
ou=svgdoc.getElementById("affichage");
ou.appendChild(node);
nb_chaines=chaines.length-1;
for(i=0;i<nb_chaines;i++)
{node=svgdoc.createElementNS("http://www.w3.org/2000/svg","text");node.setAttribute("id","invite"+i.toString(10));
node.setAttribute("x",alertes[6]+alertes[8]*0.5);node.setAttribute("y",alertes[7]+(i+1)*alertes[4]*1.5);
node.setAttribute("text-anchor","middle");node.setAttribute("font-size",alertes[4]);
node.setAttribute("font-family",alertes[5]);node.setAttribute("fill",alertes[3]);
texte=svgdoc.createTextNode(chaines[i]);
node.appendChild(texte);ou=svgdoc.getElementById("affichage");
ou.appendChild(node)};
node=svgdoc.createElementNS("http://www.w3.org/2000/svg","rect");
node.setAttribute("id","oui1");
node.setAttribute("x",alertes[6]+alertes[8]/4);node.setAttribute("y",alertes[7]+alertes[9]-10-alertes[4]*1.5);
node.setAttribute("width",alertes[8]/2);node.setAttribute("height",alertes[4]*1.5);
style="fill:"+alertes[2]+";stroke:"+alertes[1];
node.setAttribute("style",style);
node.addEventListener("click",efface,false);
ou=svgdoc.getElementById("affichage");ou.appendChild(node);
node=svgdoc.createElementNS("http://www.w3.org/2000/svg","text");node.setAttribute("id","oui2");
node.setAttribute("x",alertes[6]+alertes[8]/2);
node.setAttribute("y",alertes[7]+alertes[9]-15);
node.setAttribute("text-anchor","middle");node.setAttribute("font-size",alertes[4]);
node.setAttribute("font-family",alertes[5]);node.setAttribute("fill",alertes[3]);
node.setAttribute("pointer-events","none");
texte=svgdoc.createTextNode(chaines[nb_chaines]);
node.appendChild(texte);
ou=svgdoc.getElementById("affichage");
ou.appendChild(node);
ou=svgdoc.getElementById("affichage");
ou.appendChild(node);}

function efface(evt){svgdoc=evt.target.ownerDocument;nb_chaines=chaines.length-1;
objet=svgdoc.getElementById("fenetre");
contents=svgdoc.getElementById("affichage");contents.removeChild(objet);
for(i=1;i<=2;i++){objet=svgdoc.getElementById("oui"+i.toString(10));
contents=svgdoc.getElementById("affichage");contents.removeChild(objet)};
for(i=0;i<nb_chaines;i++){objet=svgdoc.getElementById("invite"+i.toString(10));
contents=svgdoc.getElementById("affichage");
contents.removeChild(objet)};
change_attribut(evt)}

function change_attribut(evt){svgdoc=evt.target.ownerDocument;
objet=svgdoc.getElementById("rectangle");
objet.setAttribute("width","200");objet.setAttribute("height","80");
objet.setAttribute("fill","red")}