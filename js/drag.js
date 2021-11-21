//philum_drag

dragDrop={
	keyHTML:'',
	initialMouseX:undefined,
	initialMouseY:undefined,
	startX:undefined,
	startY:undefined,
	draggedObject:undefined,
	initElement:function(element){
		if(typeof element=='string')
			element=document.getElementById(element);
		element.onmousedown=dragDrop.startDragMouse;
		element.innerHTML+=dragDrop.keyHTML;
		var links=element.getElementsByTagName('a');
		var lastLink=links[links.length-1];
		lastLink.relatedElement=element;
		lastLink.onclick=dragDrop.startDragKeys;
	},
	startDragMouse:function(e){
		dragDrop.startDrag(this);
		var evt=e||window.event;
		dragDrop.initialMouseX=evt.clientX;
		dragDrop.initialMouseY=evt.clientY;
		addEventSimple(document,'mousemove',dragDrop.dragMouse);
		addEventSimple(document,'mouseup',dragDrop.releaseElement);
		return false;
	},
	startDrag:function(obj){
		if(dragDrop.draggedObject)
			dragDrop.releaseElement();
		dragDrop.startX=obj.offsetLeft;
		dragDrop.startY=obj.offsetTop;
		dragDrop.draggedObject=obj;
	},
	dragMouse:function(e){
		var evt=e||window.event;
		var dX=evt.clientX-dragDrop.initialMouseX;
		var dY=evt.clientY-dragDrop.initialMouseY;
		dragDrop.setPosition(dX,dY);
		return false;
	},
	setPosition:function(dx,dy){
		dragDrop.draggedObject.style.left=dragDrop.startX+dx+'px';
		dragDrop.draggedObject.style.top=dragDrop.startY+dy+'px';
	},
	releaseElement:function(){
		removeEventSimple(document,'mousemove',dragDrop.dragMouse);
		removeEventSimple(document,'mouseup',dragDrop.releaseElement);
		removeEventSimple(document,'keypress',dragDrop.dragKeys);
		removeEventSimple(document,'keypress',dragDrop.switchKeyEvents);
		removeEventSimple(document,'keydown',dragDrop.dragKeys);
		dragDrop.draggedObject=null;
	}
}
function addEventSimple(obj,evt,fn){
	if(obj.addEventListener)obj.addEventListener(evt,fn,false);
	else if(obj.attachEvent)obj.attachEvent('on'+evt,fn);
}
function removeEventSimple(obj,evt,fn){
	if(obj.removeEventListener)obj.removeEventListener(evt,fn,false);
	else if(obj.detachEvent)obj.detachEvent('on'+evt,fn);
}

//dragDrop.initElement('popup');