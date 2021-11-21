/*star motor*/

scene.clearColor = new BABYLON.Color3(0.1,0.1,0.1);
var cam=0;//1
var camera=camera(cam);
//var camera2=camera(1);
//light(1,1,1);

//camera.applyGravity = true;
camera.checkCollisions = true;
camera.speed = 2;
//camera.angularSensibility = 1600;
//camera.keysUp = [90]; // Touche Z
//camera.keysDown = [83]; // Touche S
//camera.keysLeft = [81]; // Touche Q
//camera.keysRight = [68]; // Touche D;
scene.activeCamera.attachControl(canvas);
camera.attachControl(canvas, true);

var red=color(1,0,0);
var green=color(0,1,0);
var blue=color(0,0,1);
var yellow=color(1,1,0);
var orange=color(1,0.5,0);
var purple=color(0,0.5,1);
var white=color(1,1,1);
var gray=color(0.3,0.3,0.3);
var grey=color(0.5,0.5,0.5);
var silver=color(0.7,0.7,0.7);

axis();

var light=new BABYLON.PointLight("Omni",new BABYLON.Vector3(20,20,100),scene);
//Move the light with the camera
scene.registerBeforeRender(function(){light.position=camera.position;});

/**
 * app
 */

function rad2deg(d){return Math.round(180/Math.PI*d*100)/100;}
function rad2hr(d){var d=180/Math.PI*d; 
var ha=d/15; var h=Math.floor(ha);
var md=ha-h; var ma=md*60; m=Math.floor(ma);
var sd=ma-m; var sa=sd*60; s=Math.floor(sa);
if(h<10)h='0'+h; if(m<10)m='0'+m; if(s<10)m='0'+s; 
return h+"h"+m+"m"+s+"s";}

//click star
var clicstar=function(mesh,nm,ad,dc,ds,sp,hd,hip,pl){
    mesh.actionManager = new BABYLON.ActionManager(scene);
    mesh.actionManager.registerAction(new BABYLON.ExecuteCodeAction(BABYLON.ActionManager.OnLeftPickTrigger, (function(mesh){
        if(cam==1)var vy=scene.activeCamera.rotation.y;
        if(cam==0)var vy=scene.activeCamera.alpha+Math.PI*3/2;
        /*if(vy-Math.PI*2>ad)scene.activeCamera.alpha-=Math.PI*2;
        if(ad-Math.PI*2>vy)scene.activeCamera.alpha+=Math.PI*2;*/
        //mesh.actionManager.registerAction(new BABYLON.SetValueAction({ trigger: BABYLON.ActionManager.OnLeftPickTrigger, parameter: otherMesh }, mesh, "scaling", new BABYLON.Vector3(1.2, 1.2, 1.2)));
        //mesh.actionManager.registerAction(new BABYLON.InterpolateValueAction(BABYLON.ActionManager.OnLeftPickTrigger, camera, "alpha", Math.PI/2-ad, 1000));
		var adb=rad2hr(ad); var dcb=rad2deg(dc); if(dcb>0)dcb='+'+dcb; var hip2=''; var hd2='';
		if(hip)hip2='HIP'+hip; if(hd)hd2='HD'+hd;
        header.text=nm+" "+hip2+" "+hd2+' '+pl+nl()+adb+" "+dcb+"°"+nl()+"distance: "+ds+" Al"+nl()+"spectrum: "+sp;
    }).bind(this, mesh)));
	//addbt(nm,datas);
}

//star
function allstars(r,lbl){
//var s0=BABYLON.Mesh.CreateSphere("s0",10,1,scene); //s0.material=white;
//s0.setEnabled(false);//hide the original
for(var i=0;i<r.length;i++){//nm,ad,dc,ds,sz,x,y,z,clr
var nm=r[i][0]; var ad=r[i][1]; var dc=r[i][2]; var ds=r[i][3]; var sz=r[i][4]; var x=r[i][5];
var y=r[i][6]; var z=r[i][7]; var sp=r[i][9]; var hd=r[i][10]; var hip=r[i][11]; var pl=r[i][12]; 
//var crds=xyz(ad,dc,ds); var x=crds.x; var y=crds.y; var z=crds.z;
var clr=r[i][8];
var d=BABYLON.Mesh.CreateSphere("sphere",10,sz,scene);
//var d=new BABYLON.InstancedMesh(nm,s0);
//var d=s0.clone("sphere"); //d.scaling=new BABYLON.Vector3(sz,sz,sz);
d.position=new BABYLON.Vector3(x,y,z);
d.material=clr;
clicstar(d,nm,ad,dc,ds,sp,hd,hip,pl);
if(lbl && nm!='Sun')label(d,nm);}}

//welcome
var header=display_txt("StarMap3d"+nl()+"Datas from Hipparcos");

//vernal
var pverne=BABYLON.Mesh.CreateSphere("sphere",10,1,scene);
pverne.position=new BABYLON.Vector3(0,0,100);
label(pverne,"vernal");

//button
function addbt(nm,ad,dc,ds){var ra='';
for(i=0;i<datas.length;i++)if(datas[i][0]==nm)var ra=datas[i];
if(!ra)return;
var ad=ra[1]; var dc=ra[2]; var ds=ra[3];
var bt=BABYLON.GUI.Button.CreateSimpleButton("but1",nm);
bt.width=0.3; bt.height="20px"; bt.color="white";
bt.cornerRadius=2; bt.background="black";
bt.horizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
//bt.verticalAlignment=BABYLON.GUI.Control.VERTICTAL_ALIGNMENT_TOP;
bt.onPointerUpObservable.add(function(){
//freecam
if(cam==1){
    var coords=xyz(ad,dc,ds);
    camera.position.x=coords.x;
    camera.position.y=coords.y;
    camera.position.z=coords.z;
}
else{
    camera.alpha=Math.PI/2-ad;
    camera.beta=Math.PI/2-dc;
    camera.radius=ds*13;
    camera.setTarget(BABYLON.Vector3.Zero());
}
});
panel.addControl(bt);}

//panoptic
function pano(p){
if(p==0)nm="<-"; else nm="->";
var bt=BABYLON.GUI.Button.CreateSimpleButton("but1", nm);
bt.width = 0.2; bt.height = "16px";
bt.color = "white";
bt.cornerRadius = 2;
bt.background = "black";
bt.horizontalAlignment=BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
bt.onPointerUpObservable.add(function(){
  var val=Math.PI/24; if(p==0)val=0-val;
  camera.rotation.y+=val;});
panel.addControl(bt);}
//pano(0);pano(1);

function referential(){
var tor=torusline(10,100,0);
var tor2=tor.clone('t');
tor2.rotation.x=Math.PI/2;
}

/**
 * Datas
 * nm : nom
 * ad : ascension droite (radians)
 * dc : déclinaison (radians)
 * ds : distance
 * sz : size (diamètre)
 * x,y,z : coords
 * clr : couleur
 */