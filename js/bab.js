//babylon

function nl(){return "\n";}

function camera(d,ds,kb,sim){if(!ds)ds=100;
if(d==1)var camera=new BABYLON.UniversalCamera("UniversalCamera",new BABYLON.Vector3(0,0,0-ds),scene);
else if(d==2)var camera=new BABYLON.FreeCamera("camera1", new BABYLON.Vector3(0,ds/2,0-ds),scene);
else var camera=new BABYLON.ArcRotateCamera("Camera", -Math.PI/2, Math.PI/2, ds,BABYLON.Vector3.Zero(),scene);
if(sim){camera.applyGravity = true; camera.checkCollisions = true;}
if(kb){
camera.keysUp=[90];//Z
camera.keysDown=[83];//S
camera.keysLeft=[81];//Q
camera.keysRight=[68];}//D
camera.attachControl(canvas,true);
return camera;}

function light(r,g,b){
return new BABYLON.HemisphericLight("hemi",new BABYLON.Vector3(r,g,b),scene);}

var color=function(r,g,b,e,a,pw){
var d=new BABYLON.StandardMaterial("texture2",scene);
d.diffuseColor=new BABYLON.Color3(r,g,b); //d.alpha=0.3;
if(e)d.emissiveColor=new BABYLON.Color3(r,g,b);
if(a)d.alpha=a;
if(pw)d.specularPower=pw;
return d;}

function rgb(r,g,b){
    return color(r/255,g/255,b/255);}

var axis=function(sz){if(!sz)sz=100
var z=new BABYLON.Vector3.Zero(); 
var axisX=BABYLON.Mesh.CreateLines("axisX",[z,new BABYLON.Vector3(sz,0,0)],scene);
axisX.color=new BABYLON.Color3.Red;
var axisY=BABYLON.Mesh.CreateLines("axisY",[z,new BABYLON.Vector3(0,sz,0)],scene);
axisY.color=new BABYLON.Color3.Green;
var axisZ=BABYLON.Mesh.CreateLines("axisZ",[z,new BABYLON.Vector3(0,0,sz)],scene);
axisZ.color=new BABYLON.Color3.Blue;}

//label
var label=function(mesh,t){
var d=new BABYLON.GUI.Rectangle(mesh.name);
d.background="black"
d.height="16px";
d.alpha=0.5;
d.width="60px";
d.cornerRadius=20;
d.thickness=0;
d.linkOffsetY=30;
advancedTexture.addControl(d); 
d.linkWithMesh(mesh);
var text1=new BABYLON.GUI.TextBlock();
text1.text=t;
text1.color="white";
text1.fontSize="10px";
text1.paddingTop="2px";
d.addControl(text1);
return d;}

//GUI
var advancedTexture=new BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("ui1");
advancedTexture.layer.layerMask=2;

//display text
var panel=new BABYLON.GUI.StackPanel();
panel.width="440px";
panel.fontSize="14px";
panel.horizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
panel.verticalAlignment=BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
advancedTexture.addControl(panel);

function display_txt(txt){
var header=new BABYLON.GUI.TextBlock();
header.text=txt;
header.height="240px";
header.color="white";
header.textHorizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
header.textVerticalAlignment=BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
header.paddingTop="4px";
header.paddingLeft="4px";
panel.addControl(header);
return header;}
//var header=display_txt("hello\n");

var panel2=new BABYLON.GUI.StackPanel();
panel2.width="220px";
panel2.fontSize="14px";
panel2.horizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
panel2.verticalAlignment=BABYLON.GUI.Control.VERTICAL_ALIGNMENT_BOTTOM;
advancedTexture.addControl(panel2);

//screenshot
function screenshot(nm,w,h){if(!w)w=1600; if(!h)w=900; 
var bt=BABYLON.GUI.Button.CreateSimpleButton("but1", nm);
bt.width=0.1;
bt.height="20px";
bt.color="white";
bt.cornerRadius=2;
bt.background="black";
bt.horizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
bt.onPointerUpObservable.add(function(){
	//BABYLON.Tools.CreateScreenshot(engine,camera,800);
	BABYLON.Tools.CreateScreenshotUsingRenderTarget(engine,camera,{width:w,height:h,precision:6});});
panel.addControl(bt);}

//clicks
function action_out(mesh,target,attribut,property,speed){mesh.actionManager.registerAction(new BABYLON.InterpolateValueAction(BABYLON.ActionManager.OnPointerOutTrigger,target,attribut,property,speed));}
//bab_click_action(mesh,mesh,"scaling",new BABYLON.Vector3(1,1,1),150);

function action_over(mesh,target,attribut,property,speed){mesh.actionManager.registerAction(new BABYLON.InterpolateValueAction(BABYLON.ActionManager.OnPointerOverTrigger,target,attribut,property,speed));}
//bab_click_action(mesh,"scaling",new BABYLON.Vector3(1.1,1.1,1.1),150);
//bab_click_action(mesh.material,"emissiveColor",new BABYLON.Color3.White(),150);

function action_click(mesh,target,attribut,property,speed){mesh.actionManager.registerAction(new BABYLON.InterpolateValueAction(BABYLON.ActionManager.OnPointerOverTrigger,target,attribut,property,speed));}//,condition1
//bab_click_action(camera,"alpha",Math.PI/2-ad,600);
//bab_click_action(camera,"beta",Math.PI/2-dc,600);
//bab_click_action(camera,"radius",ds,600);
//bab_click_action(camera,"position",BABYLON.Vector3(x,y,z),600);//freecam
//bab_click_action(camera,"rotation.z",0,600);
//scene.debugLayer.show();

function godray(){
var light=new BABYLON.PointLight("Omni", new BABYLON.Vector3(0,0,0),scene);
var godrays=new BABYLON.VolumetricLightScatteringPostProcess('godrays',1,camera,null,50,BABYLON.Texture.BILINEAR_SAMPLINGMODE,engine,false);
godrays.mesh.material.diffuseTexture=new BABYLON.Texture('http://playground.babylonjs.com/textures/sun.png',scene,true,false,BABYLON.Texture.BILINEAR_SAMPLINGMODE);
godrays.mesh.material.diffuseTexture.hasAlpha=true;
godrays.mesh.position=new BABYLON.Vector3(0,0,0);
godrays.mesh.scaling=new BABYLON.Vector3(75,75,75);
light.position=godrays.mesh.position;
return light;}

function torusline(sz,ds,y){
var dots=[]; var x,y=0; var n=Math.PI*2*sz;
for(var i=0;i<n;i++){
	x=Math.sin(i/sz)*ds; z=Math.cos(i/sz)*ds;
	dots.push(new BABYLON.Vector3(x,y,z));}
return BABYLON.Mesh.CreateLines("torusline",dots,scene);}
//torusline(100,100,0);

//trigo
function xyz(ad,dc,ds){var pc=8;
var x=Math.round(Math.sin(ad)*Math.cos(dc)*ds,pc);//0-
var y=Math.round(Math.sin(dc)*ds,pc);//*Math.sin(dc)
var z=Math.round(Math.cos(ad)*ds,pc);
return {x:x,y:y,z:z};}

function xyz0(ad,dc,ds){var pc=8;
var x=Math.round(Math.sin(ad)*Math.cos(dc)*ds,pc);//0-
var y=Math.round(Math.sin(dc)*Math.cos(ad)*ds,pc);//*Math.sin(dc)
var z=Math.round(Math.cos(ad)*Math.cos(dc)*ds,pc);
return {x:x,y:y,z:z};}

