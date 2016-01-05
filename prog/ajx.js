//philum_ajax
var wait=0; reloadart=100;
var cutat=2000;//AMT buffer
var clp=[];
if(typeof fixpop==='undefined')var fixpop=0;
if(typeof fulpop==='undefined')var fulpop=0;

function AJAX(a_sURL,a_sDiv,act){
	if(a_sURL!=undefined)this.m_sURL=a_sURL;
	if(a_sDiv!=undefined)this.m_sDiv=a_sDiv;
	if(act!=undefined)this.a_ct=act; else this.a_ct=0;
	if(this.m_Request!=undefined){this.m_Request.abort(); delete this.m_Request;}
	this.m_Request=this.createReqestObject();
	var m_This=this;
	this.m_Request.onreadystatechange=function(){m_This.handleResponse();}
	this.m_Request.open("POST",this.m_sURL,true);
	this.m_Request.send(null);}
	
AJAX.prototype.m_sURL=undefined;
AJAX.prototype.m_sDiv=undefined;
AJAX.prototype.m_Request=undefined;

AJAX.prototype.createReqestObject=function(){var req;
	try{req=new XMLHttpRequest();}//all
	catch (error){try{req=new ActiveXObject("Microsoft.XMLHTTP");}//IE
		catch (error){try{req=new ActiveXObject("Msxml2.XMLHTTP");}//IE
			catch (error){req=false;}}}
	return req;}

//0-1:fading 2:nofading 4-7:value 5:insert 6:insert-close 7:popup newart 8:multithread 
//9: newart 10:confirm ok 11:select text 13:track 14:addiv 16:addcss 17:addjs 18:rebond 
//3:loading 7:reload/save 9:reload 12:reload, 15:repos 19:unhide 20:toggle btn 21:autoscroll
AJAX.prototype.handleResponse=function(){
	var here=this.m_sDiv.substr(0,4);
	if(this.m_Request.readyState==4){wait=0;
		if(this.m_Request.status=="200"){
			var content=getbyid(this.m_sDiv);
			var res=this.m_Request.responseText;
			if(this.m_sDiv=='popup')popub(res,this.a_ct);
			else if(this.m_sDiv=='bubble')bubble(res,this.a_ct);
			else if(this.m_sDiv=='togbub')togbub(res,this.a_ct);
			else if(this.m_sDiv=='pagup')pagup(res,this.a_ct);
			else if(this.a_ct<2 && here!='chat' && here!='twit'){
				content.innerHTML=res; opac(100,this.m_sDiv);}
				//Timer('opac',this.m_sDiv,10,100,4);
			else if(this.a_ct==4||this.a_ct==7||this.a_ct==9)content.value=res;
			else if(this.a_ct==5)insert(stripslashes(ajxget(res,1)));
			else if(this.a_ct==6){insert(res); Close('popup');}
			else if(this.a_ct==8)amt_ending();//setTimeout('',100)
			else if(this.a_ct==10){content.innerHTML='ok';
				setTimeout(function(){Hide(this.m_sDiv)},2000);}
			else if(this.a_ct==11){content.innerHTML=res;
				window.setSelectionRange(this.m_sDiv,res.length,res.length);}
			else if(this.a_ct==13)addiv(this.m_sDiv,res,1);//before
			else if(this.a_ct==14)addiv(this.m_sDiv,res,0);
			else if(this.a_ct==16)addcss(res);
			else if(this.a_ct==17)addjs('',res,1);
			else if(this.a_ct==18)SaveJc(res);
			else if(this.a_ct==20)active_b(this.m_sDiv,res);
			else if(this.a_ct=='self')window.location=document.URL;
			else if(this.a_ct=='url')window.location=res;
			else if(this.a_ct=='repl')mozWrap(res,'','','repl');
			else if(this.a_ct=='exec')eval(res);
			else if(res && content!='undefined')content.innerHTML=res;
			//
			if(res.substr(0,6)=="logon:")window.location="/?id="+res.substr(7)+'&rl==';
			else if(this.a_ct==3||this.a_ct==7||this.a_ct==9)waitclose(this.m_sDiv);
			if(this.a_ct==7){var read=getbyid('socket').value;
				if(typeof(curid)!='undefined')Close('popup');
				if(read>0)SaveJ('popup_popart__3_'+read+'_3_1');
				else SaveJ('popup_addArt____1');}
			else if(this.a_ct==9){var read=getbyid('socket').value;
				if(read>0)read='/?read='+read; if(read)window.location=read;}
			else if(this.a_ct==12)popb(curid);
			else if(this.a_ct==15)poprepos();//||this.a_ct==3
			else if(this.a_ct==19)content.style.display='block';
			else if(this.a_ct==21)autoscroll(content);
			else if(this.a_ct==22){var read=getbyid('sckmd').value; 
				if(read>0)setTimeout(function(){SaveJ('popup_module___'+read)},1000);}
			//if(this.onDraw!=undefined)this.onDraw();
		return res;}
		else{	
			if(this.onError!=undefined){
				this.onError({status:this.m_Request.status,
				statusText:this.m_Request.statusText});}}
		delete this.m_Request;}
	else if(wait==0){wait=1;//wait
		if((this.a_ct==3||this.a_ct==7||this.a_ct==9||this.a_ct==15) && wait)
			waitmsg(this.m_sDiv);
		if(this.a_ct<2 && this.m_sDiv!='popup' && this.m_sDiv!='bubble')
			opac(10,this.m_sDiv);}
	//else if(wait==1){setTimeout(function(){this.m_Request.abort(); delete this.m_Request;},10000);}}
	}

AJAX.prototype.handleAbort=function(){
	this.m_Request.abort(); delete this.m_Request;
}

function getbyid(id){return document.getElementById(id);}

function addEvent(obj,event,func){if(obj!=undefined)obj.addEventListener(event,func,true);}

//setInterval
function Timer(func,id,start,end,t){var timer=0;
	if(typeof id==='undefined' || id=='')return; 
	if(start>end){for(i=start;i>=end;i--){timer++; curi=i;
		x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}
	else if(start<end){for(i=start;i<=end;i++){timer++;
		x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}}

function opac(op,id){getbyid(id).style.opacity=(op/100);}
function resiz(op,id){getbyid(id).style.height=op+'px';}
function slide(op,id){getbyid(id).style.marginLeft=op+'px';}
function isNumber(n){return (n>=0||n<0);}

function setit(d,e){popw=getbyid(e);
	if(typeof(popw)!='undefined')popw.style.backgroundColor='#'+d;}
function colorwheel(div,a){var rgb=new Array;
	var arr=[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f']; //if(a)arr=arr.reverse();
	for(i=0;i<arr.length;i++){rgb=String(arr[i])+String(arr[i])+'7777';
		setTimeout(function(){setit(rgb,div)},160*i);}}
function waitmsg(div){
	var popw=getbyid('popw');
	if(div && div!='popup' && div!='socket')var dv=getbyid(div);
	var loadn='<a onclick="Hide(\'popw\');">Loading...</a>';//t
	if(dv!=undefined){dv.innerHTML=loadn;} else{popw.innerHTML=loadn; colorwheel('popw');
	popw.style.display='block'; popw.style.position='fixed'; popw.className='loading';
	var l=(innerSizes('w')-100)/2; var t=((innerSizes('h')-10)/2)-16;
	popw.style.left=l+'px'; popw.style.top=t+'px'; popw.style.zIndex=popz;}}
function waitclose(div){Close('popw'); Hide('popw');}
	//if(div && div!='popup' && div!='socket')Close(div);else{}

function jurl(){return '/ajax.php?callj=';}
function escapb(val){return ajxget(escape(val));}
function addslashes(val){var val=clean_entity(/\"/g,'\\"',val);
	return clean_entity(/\'/g,'\\\'',val);}
function stripslashes(val){var val=clean_entity(/\\"/g,'"',val);
	return clean_entity(/\\'/g,'\'',val);}
function strreplace(rep,by,val){return val.split(rep).join(by);}
var repl=function(rep,by){return this.split(rep).join(by);}
function clean_entity(a,b,v){var vn=v.split(a); var nb=vn.length;
	for(var i=0;i<nb;i++){var v=v.replace(a,b);} return v;}
function ajxget(val,n){
	var arr=['?','%3F','*',"\'","'",'%26sect','&','_','#','+','=','+','.',':','/','%u'];
	var arb=['(qmark)','(qmark)','(star)','(aslash)','(quote)','(sect)','(and)','*','(diez)','(add)','(equal)','(add)','(dot)','(ddot)','(slash)','(pu)'];//'(dquote)',
	if(n){for(var i=0;i<arr.length;i++){val=strreplace(arb[i],arr[i],val);}}//decode
	else{for(var i=0;i<arr.length;i++){val=strreplace(arr[i],arb[i],val);}}
	return val;}
function undefine(d){return typeof d==='undefined'?'':d;}
function undefiner(d){for(i=0;i<d.length;i++){if(typeof d[i]==='undefined')d[i]='';} 
	return d;}

function innerSizes(p){
	var h=parseInt(window.innerHeight); var w=parseInt(window.innerWidth);
	if(p=='h')return h; else if(p=='w')return w; else return {w:w,h:h};}

function poph(popu,pageup){
	popu.style.maxHeight=''; var adjust=60; var sz=innerSizes();
	var ha=sz.h; var hb=popu.offsetHeight;
	if(hb>ha){popu.style.maxHeight=(pageup==1?'100vh':(ha-adjust)+'px'); 
		popu.style.overflowY='scroll';}
	else{popu.style.overflowY='visible';}
	popu.style.maxWidth='';
	var wa=sz.w; var wb=popu.offsetWidth;
	if(wb>wa){popu.style.maxWidth=(pageup==1?'100vw':wa+'px'); 
		popu.style.overflowX='auto';}
	else popu.style.overflowX='visible';}

function poprepos(){//popnb;
	var popu=getbyid('popu'+curid); poph(popu);
	var popup=getbyid('pop'+curid);
	var pos=ppos(popu,0); popup.style.left=pos.x; popup.style.top=pos.y;}

function pagrepos(){
	var popup=getbyid('pop'+curid);
	var popa=getbyid('popa'+curid);
	var popu=getbyid('popu'+curid); //poph(popu);
	popup.style.left=0; popup.style.top=0;
	popup.style.maxWidth='100%'; 
	popup.style.height='100%';
	var div=popup.getElementsByTagName('div');
	div[0].style.maxWidth='100%'; 
	//popu.style.maxHeight='100vh';
	popu.style.maxHeight='calc(100vh - '+(popa.offsetHeight+8)+'px)';
	}

function autoscroll(popu){var p=getPosition(popu); var ha=innerSizes('h');
		if(p.y+p.h>ha){popu.style.maxHeight=(ha-p.y-10)+'px'; popu.style.overflowY='scroll'; popu.style.overflowX='hidden';}}
	
function bpos(id,nb,p){//bubblepop
	var bt=getbyid(id); var pos=getPosition(bt); 
	var bl=getbyid(nb); var pob=getPosition(bl);
	var px=pos.x+bt.offsetWidth; var py=pos.y;
	var wa=innerSizes('w'); var ha=innerSizes('h');
	if(px+pob.w>wa)px=wa-pob.w; if(py+pob.h>ha)py=ha-pob.h;
	if(py+pob.h>ha){bl.style.maxHeight=(ha-py-20)+'px'; bl.style.overflowY='auto';}
	if(p){px=pos.x; py=pos.y+bt.offsetHeight;}
	if(px<0)px=0; if(py<0)py=0;
	return {x:px,y:py};}

function ppos(popu,decal){
	var sw=innerSizes('w'); var w=popu.offsetWidth; var l=(sw-w)/2-20;
	var sh=innerSizes('h'); var h=popu.offsetHeight; var t=(sh-h)/2-20; 
	if(l+decal+w>sw)decal=0; var px=(l>0?l:0)+decal; if(px<10)px=0;
	if(t+decal+h>sh)decal=0; var py=(t>10?t:10)+decal;	
	if(fixpop==1){var px=px+window.pageXOffset; var py=py+window.pageYOffset;}
	return {x:px+'px', y:py+'px'};}

function popf(popup){
	popup.style.width='100%'; popup.style.height='100%';
	return {x:0,y:0};}

function popub(res,act){popnb+=1; var nb=popnb; var ab,as='';
	var content=getbyid('popup');
	var decal=(content.childNodes.length)*10; if(act=='photo')var decal=0;
	var popup=document.createElement('div');
	popup.id='pop'+nb; popup.style.position='fixed';
	addEvent(popup,'mousedown',function(){zindex(nb)});
	popup.innerHTML=res;
	content.appendChild(popup); zindex(nb);
	var popa=getbyid('popa');
	addEvent(popa,'mousedown',function(event){start_drag(event,nb)});
	var popu=getbyid('popu'); poph(popu);//before ppos
	if(act>100)var pos=bpos('bt'+act,'pop'+nb,0);
	else if(!isNumber(act) && act.substr(0,4)=='bpop'){
		var ab=1; var pos=bpos('btpop'+act,nb,1);}
	else if(!isNumber(act) && act.substr(0,2)=='bt'){
		var ab=0; var pos=bpos(act,'pop'+nb,0); 
		clpop('','pop'+nb); popa.style.display='none'; var as=1;}
	//else if(fulpop)var pos=popf(popup);
	else var pos=ppos(popu,decal);
	popup.style.left=pos.x; popup.style.top=pos.y;
	if(fixpop==1 || ab)popup.style.position='absolute';
	if(as)autoscroll(popu);
	popa.id='popa'+nb; popu.id='popu'+nb;}

function popb(nb){//reload
	var popup=getbyid('pop'+nb);
	addEvent(popup,'mousedown',function(){zindex(nb)});
	var popa=getbyid('popa');
	addEvent(popa,'mousedown',function(event){start_drag(event,nb)});
	var popu=getbyid('popu'); 
	popa.id='popa'+nb; popu.id='popu'+nb;
	poprepos();}

function pagup(res,method){popnb+=1; var nb=popnb;
	var content=getbyid('popup');
	var popup=document.createElement('div');
	popup.id='pop'+nb; popup.style.position='fixed';
	popup.innerHTML=res; 
	content.appendChild(popup); zindex(nb);
	var popu=getbyid('popu');
	poph(popu,1);//before ppos
	popup.style.left=0; popup.style.top=0;
	popup.style.right=0; popup.style.bottom.top=0;
	popu.id='popu'+nb;
	pagrepos();
}

function bubpos(bub,id,li,liul){var indic=id.substr(0,1);// || indic=='e'
	if(indic=='d'){var tw=innerSizes('w'); var left=li.offsetLeft; 
		bub.style.top=li.parentNode.offsetTop+li.parentNode.offsetHeight+0;
		if(liul[0])var wei=liul[0].offsetHeight; else var wei=bub.offsetHeight;
		if(left+wei>tw)left=tw-wei-li.parentNode.offsetLeft; bub.style.left=left;}
	else{var th=innerSizes('h'); var top=li.offsetTop; var lih=li.parentNode.offsetTop;
		bub.style.left=li.offsetLeft+li.offsetWidth;
		if(liul[0])var hei=liul[0].offsetHeight; else var hei=bub.offsetHeight;
		if(top+hei>th){top=th-hei-lih; if(top<0)top=0; 
			bub.style.maxHeight=(th-top)+'px'; bub.style.overflowY='auto';}
		bub.style.top=top;}}

function bubopac(op,id){var li=getbyid(id);
	var liul=li.getElementsByTagName("ul"); liul[0].style.opacity=(op/100);}

function bubble(res,id){clbub(1,'');//onclickout //// clpop('','bb'+id);
	var li=getbyid('bb'+id); li.style.zIndex=popz+1;
	var liul=li.getElementsByTagName("ul"); 
	var bub=document.createElement('ul');
	if(id.substr(0,1)=='c')bub.className='nob';
	if(li.className=='act'){li.className=''; closechild(li);}
	else{active_list_bubble(li.parentNode); //li.className='act';
		bub.style.position='absolute';
		if(liul[0]){popz+=1;//aex
			liul[0].style.display='block'; liul[0].style.zIndex=popz; liul[0].innerHTML=res;}
		else{bub.innerHTML=res;
			li.appendChild(bub); (li.parentNode).style.zIndex=popz;}
		//Timer('bubopac','bb'+id,10,100,2); //bubopac(100,'bb'+id); 
		bubpos(bub,id,li,liul);}}

function togbub(res,id){popnb+=1; popz+=100; clpop('','pub'+id);
	var div=getbyid('bt'+id); var pid='pop'+popnb; var pos=get_dim(div);
	var bub=document.createElement('div'); bub.innerHTML=res; bub.style.zIndex=popz;
	bub.className='popup'; bub.style.position='absolute'; //bub.style.maxWidth='440px';
	bub.style.padding='4px'; bub.style.marginRight='4px'; bub.id='pub'+id;
	div.appendChild(bub); bub.style.left='0px';
	var pob=getPosition(bub); bub.style.top=(pos.y+pos.h+2)+'px';
	if(pos.x+pob.w>innerSizes('w'))bub.style.left=(pos.x+pos.w-pob.w)+'px';
	else bub.style.left=pos.x+'px';}

//SaveJ
function SaveJb(a,b){SaveJ(a); //var t=typeof laps==='undefined'?500:laps;
	setTimeout(function(){SaveJ(b)},laps||1000);}
function SaveJc(val){var dn=val.split(";");
	for(i=0;i<dn.length;i++)if(dn[i])setTimeout('SaveJ("'+dn[i]+'")',100*i);}
function revert(){//alert(localStorage['revert']);
	getbyid('txtarea').value=localStorage['revert'];}
function SaveJtim(j){if(typeof x!='undefined')clearTimeout(x);
	x=setTimeout(function(){SaveJ(j)},500);}//open bub
function clbubtim(e){if(typeof xc!='undefined')clearTimeout(xc); 
	xc=setTimeout(function(){closebub(e)},5000);}//close bub

//AMT
function btn_saving(id,n){btn=getbyid(id);
	if(n==0){btsav=btn.innerHTML; btn.className='txtsmall'; btn.innerHTML='saving...';
		x=setTimeout(function(){btn_saving(id,2)},4000);}
	else if(n==2){setTimeout(function(){btn_saving(id,1)},1500); reloadart+=100;
		btn.innerHTML='error'; btn.className='txtyl';}
	else{btn.innerHTML=btsav; btn.className=''; clearInterval(x);}}

function amt_ending(){rs=rs+1;
	if(dn[2]=='memtmp')var dn2='memtmp_'; else var dn2=''; //alert(na+'-'+rs);
	if(na==rs){//if Amt at last
		if(dn[8]){if(dn[8].indexOf('memtmp')!=-1)var opt='&res='+(dn[8]);
			else var opt='&res='+SaveJm(dn[8]);}
		var url=jurl()+dn[1]+"_"+dn2+dn[4]+"_"+dn[5]+"_"+dn[6]+"_"+dn[7]+opt;
		var ajax=new AJAX(url,dn[0],dn[3]); btn_saving(bt,1);
		if(dn[3]=='x')Close("popup");
		if(dn[3]=='xx')setTimeout(function(){Close('popup')},1500);
		if(dn[3]=='xd')setTimeout(function(){Close(dn[0])},1500);}}

function multithread(id,ix){
	var op=getbyid(id); 
	var opt=op.value; if(opt==undefined)var opt=op.innerHTML;
	localStorage['revert']=opt;
	na=Math.ceil(opt.length/cutat); if(!na)na=1; //localStorage['na']=na;
	for(i=0;i<na;i++){var opb=escapb(opt.substr((i*cutat),cutat));
		var ajax=new AJAX('../plug/memtmp.php?nb='+i+'&callj='+opb,'socket',ix);}
	return na;}

function SaveJT(){
	if(dn[3].substr(0,2)=='id')bt=bt+dn[dn[3].substr(2)]; btn_saving(bt,0);
	na=multithread(dn[2],8); dn[2]='memtmp'; laps=(na*reloadart);}

//multipass
function SaveJm(arr){
	var vn=arr.split("|"); var nm="";
	for(i=0;i<vn.length;i++){var tar=ajxget(vn[i],1); var prfx=vn[i].substr(0,3);
		if(tar){var val=getbyid(tar);
			if(prfx=='chk'){if(val.checked) var src="yes"; else var src=val.value;}
			else if(prfx=='sdx'){var dc=getbyid(tar);
				var src=dc.options[dc.selectedIndex].value;}
			else if(prfx=='cnt')var src=escape(val.innerHTML);
			else if(val!=null)var src=escape(val.value);
			if(src=='undefined')var src=escape(val.innerHTML);
			if(src!=undefined){if(src.length>cutat){btn_saving(bt,0);//stext
				na=multithread(tar,8); var src='memtmp';}}
			var src=ajxget(src);}
		else var src='';
		if(src==undefined)src='';
		var nm=nm+src+'_';}
	dn[8]='&res='+nm;//amt
return nm;}

//SaveJ
function SaveJ(val){//target_app_amt_close_val1_val2_val3_val4_multival_injectjs
	var opt=''; var tp=''; var pp=''; laps=0; rs=0; na=0; bt='bts'; 
	dn=val.split("_");
	if(dn[3]=='3x' || dn[3]=='3xx' || dn[3]=='4x' || dn[3]=='5x'){
		var tp=dn[3].substr(0,1); dn[3]=dn[3].substr(1);}
	else if(dn[3]!='pop'|'x'|'xx'|'xd'|'tg')var tp=dn[3];
	if(dn[0]=='pop'){dn[0]='pop'+curid; var tp=12;}
	if(dn[0]=='popup')pp='&popup==';
	if(dn[2]){var op=getbyid(dn[2].replace('*','_')); var opt=escape(op.value); 
		if(opt=='undefined' || dn[2]=='txtareb')var opt=escape(op.innerHTML);
		if(opt.length>cutat)return SaveJT();
		var opt=ajxget(opt)+'_';}//'&res='+
	for(i=4;i<8;i++){if(dn[i])var opt=opt+dn[i]+'_'; else var opt=opt+'_';}
	if(dn[7]=='autosize'||dn[1]=='msql')var opt=opt+'&sz='+innerSizes('w')+"-"+innerSizes('h');
	if(dn[8])var opt=opt+'&res='+SaveJm(dn[8]);
	var URL=jurl()+dn[1]+'_'+opt+pp;
	if(!na)var ajax=new AJAX(URL,dn[0].replace('*','_'),tp);
	if(dn[3]=='pop')Close('pop');
	if(dn[3]=='y')window.location=dn[4];
	if(dn[3]=='x')Close('popup');
	if(dn[3]=='xb')cltog(dn[2]);
	if(dn[3]=='jx'){Close('popup'); jumpvalue(dn[4]+'_'+dn[5]);}
	if(dn[3]=='xx')setTimeout(function(){Close('popup')},1500);
	if(dn[3]=='xd')setTimeout(function(){Close(dn[0])},1500);
	if(dn[3]=='tg'){var op=active(dn[2]); if(op==0)Close(dn[0]);}
	if(dn[9]){
		if(dn[9]=='injectjs')var ajax=new AJAX(jurl()+'plug_'+dn[4]+'_'+dn[4]+'*js','',17);
		else if(dn[9]){var retro=getbyid(dn[9]).value; 
			if(retro!='undefined')addjs('',retro,1);}}}
	
//saves
function SaveBb(val){var dn=val.split("_");//admin_config_mod
	var ajax=new AJAX(jurl()+val,dn[0]+dn[1]);}

function preload(){var images=new Array();
	for(i=0;i<preload.arguments.length;i++){images[i]=new Image();
		images[i].src=preload.arguments[i];}}
function galtimer(val){SaveBb(val);
	setTimeout(function(){galtimer(val)},1000);}

function SaveBbd(val){dn=val.split("_"); laps=0; rs=0; bt='popw'; na='';
	var nm=escape(getbyid('trkname').value);
	var ml=escape(getbyid('trkmail').value);
	var sb=getbyid('trkscr').value;
	var sc=getbyid('trkscrvrf').value;
	var msg=getbyid('txtarea').value;
	var sb=sb.substr(2,2)+sb.substr(0,2);
	if(sb!=sc)SaveJ('popup_plup___tracks_track*errors_1');
	else if(!nm)SaveJ('popup_plup___tracks_track*errors_2');
	else if(!msg)SaveJ('popup_plup___tracks_track*errors_3');
	else if(parseInt(dn[1])>1){//tracks
		SaveJ(dn[0]+dn[1]+'_tracks_txtarea_13_'+dn[1]+'_'+nm+'_'+ml); Close('popup');}
	else SaveJ('pop_tracks_txtarea_13_'+dn[1]+'_'+nm+'_'+ml);}

function SaveBbc(p,nm){var msx=getbyid('msgx'+p);
	SaveJ('chtx'+p+'_plug__13_chatxml_chatxsav_'+p+'_'+nm+'&res='+escapb(msx.innerHTML));
	msx.innerHTML='';}

function SaveBe(val){var dn=val.split("_");//used by tools editor
	var ajax=new AJAX(jurl()+val,"popup");}

function SaveBf(val){//photo
	var dn=val.split("_"); var w=dn[2]; var h=dn[3];
	var sw=innerSizes('w'); var sh=innerSizes('h');
	var py=window.pageYOffset; //var px=window.pageXOffset; 
	var URL=jurl()+dn[0]+"_"+dn[1]+"_"+w+"_"+h+"_"+sw+'-'+sh+'-'+py+'-'+dn[4];
	var ajax=new AJAX(URL,'popup','photo');}

function SaveD(val){var dn=val.split("_");//chat/twit
	var URL=jurl()+dn[1]+'_'+dn[2]+'_'+dn[3]+'_'+dn[4]; //alert(dn[2]);
	var ajax=new AJAX(URL,dn[0],2); if(dn[0]=='content')Close("popup");}

//multipass
function SaveR(val,arr){
	var dn=val.split("_"); vn=arr.split("|"); var nm="";
	for(i=0;i<vn.length;i++){if(vn[i]!=''){
		var src=escape(getbyid(vn[i]).value);
		var nm=nm+'_'+ajxget(src);}}
	var URL=jurl()+val+'&res='+nm; 
	//if(dn[3]=='new'||dn[3]=='add')var cp=22; else 
	var cp=2;
	var ajax=new AJAX(URL,dn[0]+dn[1],cp);
	if(dn[3]=='del'||dn[3]=='new'||dn[3]=='sav'||dn[3]=='add')Close('popup');}

function SaveTits(id,ids,re){var dn=ids.split('|'); var get='';
for(i=0;i<dn.length;i++){var val=getbyid(dn[i]+id).value;
	var get=get+'&'+dn[i]+'='+escapb(val);} Close("popup");
var ajax=new AJAX(jurl()+'titsav_'+id+'_'+re+get,id);}

//import-edit
function SaveI(val){
	var src=ajxget(getbyid(val).value);
	if(src=='' || src.indexOf('.')!=-1)return;
	var URL=jurl()+val+'&res='+src;
	var ajax=new AJAX(URL,'txtarea',4);
	var ajax=new AJAX(URL+'&ti==','suj1',4);
	var ajax=new AJAX(jurl()+'call_ajxf-tri_urledt_'+src,'urledt');}
function SaveIt(){setTimeout(function(){SaveI("urlsrc")},2000);}
function SaveIb(id){//import-save_in_place
	var src=getbyid("urlsrc").value;//.replace('http://','')
	var URL=jurl()+'urlsrc&res='+ajxget(src)+"&import="+id+'&nobr=';
	var ajax=new AJAX(URL,'txtarea',1);
	Close("popup");}
function SaveIe(src){var pub=''; var pib=''; //addurl_fastmenu+batch+rss
	if(src && src.substr(0,4)!='http')return;
	var pub=getbyid('addpub').value;
		var op=getbyid('addop').value;
	if(src){var cat=getbyid('batchcat').value;//desactivated
		var pib=getbyid('batchib').value;}
	else{var src=getbyid("addsrc").value; src=ajxget(escape(src));
		var pib=getbyid('addib').value;
		var cat=getbyid('addsrt').value;}
	inform_field('addsrc','adb');
	if(src)SaveJ('popup_call___spe-ajxf_newartcat_'+src);
	else var ajax=new AJAX(jurl()+'addurlsav_'+src+'_'+ajxget(cat)+'_'+pub+'_'+pib,'socket',op?7:9);}
function SaveIeb(){setTimeout(function(){SaveIe()},1500);}
function SaveIec(src,cat,cid,cib,x,suj){//save from rss
	if(!cat && cid)var cat=escapb(getbyid(cid).value);
	if(!cat){SaveJ('popup_call__'+x+'_spe-ajxf_newartcat_'+src+'_'+suj); return;}
	if(cib)var ib=getbyid(cib).value; else var ib='';
	var ajax=new AJAX(jurl()+'addurlsav_'+src+'_'+cat+'_1_'+ib,'socket',7);}
function SaveW(nd){SaveJ('art'+nd+'_convhtml_art'+nd+'');}//wwig

function inform_field(id,di){
	var g='document.getElementById'; getbyid(id).value='loading...';
	setTimeout(g+'("'+id+'").value="";',700);
	if(di){clbub(0,'');
		setTimeout(g+'("'+di+'").parentNode.style.display="none";',1000);
		setTimeout(g+'("'+di+'").parentNode.parentNode.className="";',1100);}}

function Search2(){
	var src=ajxget(getbyid('search').value);
	var dig=getbyid('srdig').value;
	var bol=getbyid('srbol').value;
	var ord=getbyid('srord').value;
	var tit=getbyid('srtit').value;
	var cat=ajxget(getbyid('srcat').value);
	var tag=ajxget(getbyid('srtag').value);
	var cll=src+'_'+dig+'_'+bol+'-'+ord+'-'+tit+'&res='+cat+(tag?'_'+tag:'');
	var ajax=new AJAX(jurl()+'search_'+cll,'popup',3);
	Close('popup');}
function Search(old,id){
	var ob=getbyid(id); if(ob!=null)var src=escape(ob.value);
	if(!src||src.length<3)return;
	if(src!=old){if(!old)return SearchT(id); else return;}//paste
	if(src){inform_field(id,(id=='srchb'?'ada':''));
		var ajax=new AJAX(jurl()+'search_'+ajxget(src),'popup',3);}}
function SearchT(id){var ob=getbyid(id); 
	if(ob!=null)var old=escape(ob.value); else var old='';
	setTimeout(function(){Search(old,id)},1000);}

function sjtimb(old,id,j){
	var ob=getbyid(id); if(ob!=null)var src=escape(ob.value);
	if(!src||src.length<=3)return;
	if(src!=old){if(!old)return sjtime(id,j); else return;}//paste
	if(src)SaveJ(j);}
function sjtime(id,j){var ob=getbyid(id); 
	if(ob!=null)var old=escape(ob.value); else var old='';
	setTimeout(function(){sjtimb(old,id,j)},1000);}

function autocomp_call(old){
	var cur=getbyid('inp'+rid).value; 
	if(cur!=old||cur.length<3)return;
	var ajax=new AJAX(jurl()+'slctag_'+vn[0]+'_'+vn[1]+'_'+cur,'slct'+rid,2);}
function autocomp(val){vn=val.split('_'); rid=vn[1]+vn[0];
	var old=getbyid('inp'+rid).value;
	if(old=='')getbyid('slct'+rid).innerHTML='';
	setTimeout(function(){autocomp_call(old)},500);}

//keyPressEnter
function checkEnter(e,frm){var character;
		if(e && e.which){e=e; characterCode=e.which;}
		else{e=event; characterCode=e.keyCode;}	
	if(characterCode==13){document.forms[frm].submit(); return false;}
	else return true;}

function login(id){var mail="";
	var usr=document.forms[id]['user'].value;
	var pass=document.forms[id]['pass'].value;
	var cook=getbyid('cook').value;
	if(id=="create_hub")var mail=document.forms[id]['mail'].value;
	var URL=jurl()+'login_'+usr+"_"+pass+"_"+mail+"_"+cook;
	var ajax=new AJAX(URL,"valid");}

function Close(val){
	if(val=='popup' && curid){getbyid('popup').removeChild(getbyid('pop'+curid)); curid=0;}
	else if(val){if(val=='pop')val='popup'; getbyid(val).innerHTML='';}}
function Remove(val){var e=getbyid(val); if(e){var a=e.parentNode; if(a)a.removeChild(e);}}
function Hide(val){getbyid(val).style.display='none';}

/* --menus-- */	
function jumpMenuCat(n,nb,e){
	var add=e.form.elements['cat'+n+nb].options[e.form.elements['cat'+n+nb].selectedIndex].value;
	getbyid("frm"+n+nb).form.elements['cat'+n].value=add;}
	
function jumpMenuTags(n,nb,e){
	var deb=getbyid("frm"+n+nb).form.elements['cat'+n].value;
	var add=e.form.elements['cat'+n+nb].options[e.form.elements['cat'+n+nb].selectedIndex].value;
	if(deb){var ret=deb+', '+add;} else if(add) var ret=add;
	if(add)getbyid("frm"+n+nb).form.elements['cat'+n].value=ret;}
	
function jumpMenu_insert(e){//styls
	var add=e.options[e.selectedIndex].value;
	insert(add);}//utils.js

function jumpslct(val,e){
	var add=e.options[e.selectedIndex].value;
	getbyid(val).value=add;}
	
function jumpMenu_text(val){var dn=val.split("_");//
	if(dn[2]){var va=getbyid(dn[0]).value;
		if(va && va!=' '){var va=va+(dn[2]!=1?dn[2]:'')+dn[1];} else{var va=dn[1];}} 
	else {var va=dn[1];}
	getbyid(dn[0]).value=ajxget(va,1);}

function jumpvalue(val){var dn=val.split("_"); getbyid(dn[0]).value=ajxget(dn[1],1);}//escape
function jumphtml(val){var dn=val.split("_"); getbyid(dn[0]).innerHTML=dn[1];}
function transvalue(to){var tx=getbyid('txtarea').value; getbyid(to).value=tx;}
function insert_value(to,id){insert_b(getbyid(id).value,to);}
function strcount(id){var ob=getbyid(id).value; var to=getbyid('strcount'); to.innerHTML=ob.length;}
