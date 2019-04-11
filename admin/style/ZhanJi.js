var vipcp={
	OpenHistory : function(t,lid){
		
		vipcp.dialog.simple({
			type    : 'userDialog',
			lock    : true,
			move    : true,
			title   : '加载中...',
			content : '<iframe id="userIFrame" src="/User/History.asp?lotid='+t+'&UserID='+lid+'" width="100%" height="100%" scrolling="no" frameborder="0"></iframe>',	
			title   : '<iframe id="userIFrame" src="/User/History.asp?u=Title&lotid='+t+'&UserID='+lid+'" width="500" height="100%" scrolling="no" frameborder="0"></iframe>',
			width   : 700,
			height  : 520
		});
	},
	openRole : function(){}
};
(function(){var ss=document.getElementsByTagName('script');var src=ss[ss.length - 1].src;vipcp.webRoot=src.indexOf('webRoot=')==-1 ?'':src.substring(src.indexOf('webRoot=')+8);})();
$.extend($.browser,{
	screen : function(){
		var s = $.browser.msie ?
			{w:document.documentElement.clientWidth,h:document.documentElement.clientHeight} : ($.browser.opera ?
			{w:Math.min(window.innerWidth, document.body.clientWidth),h:Math.min(window.innerHeight, document.body.clientHeight)} :
			{w:Math.min(window.innerWidth, document.documentElement.clientWidth),h:Math.min(window.innerHeight, document.documentElement.clientHeight)});
		s.left = document.documentElement.scrollLeft || document.body.scrollLeft;
		s.top = document.documentElement.scrollTop || document.body.scrollTop;
		s.sw = document.documentElement.scrollWidth || document.body.scrollWidth;
		s.sh = document.documentElement.scrollHeight || document.body.scrollHeight;
		return s;
	}
});
$.extend($.fn,{
	emp  : function(){
		return this[0]==null;
	},
	isVisible : function(){
		return this.css('display')!='none';
	},
	center : function(){
		var oh=this.outerHeight(),ow=this.outerWidth(), s = $.browser.screen();
		var c = {top:(s.h -oh)/2+s.top,left:(s.w -ow)/2 + s.left};
		this.css(c)
		return c;
	},
	ele : function(){
		return this[0];
	},
	revClass : function(c1,c2){var remCls = c1.split(',');var obj = this;$(remCls).each(function(i,v){obj.removeClass(v);});obj.addClass(c2);return this;},
	hasClass : function(cls){return $(this).attr('class').indexOf(cls)!=-1;return this;},
	ajaxForm : function(semantic){
		var a=[];
		if(this.length===0){return a;}
		var form=this[0];
		var els = semantic ? form.getElementsByTagName('*') : form.elements;
		if(!els){return a;}
		var i,j,n,v,el,max,jmax;
		for(i=0, max=els.length; i < max; i++) {
			el = els[i];
			n = el.name;
			if (!n){
				continue;
			}
			if (semantic && form.clk && el.type == "image") {
				// handle image inputs on the fly when semantic == true
				if(!el.disabled && form.clk == el) {
					a.push({name: n, value: $(el).val()});
					a.push({name: n+'.x', value: form.clk_x}, {name: n+'.y', value: form.clk_y});
				}
				continue;
			}

			v = $.fieldValue(el, true);
			if (v && v.constructor == Array) {
				for(j=0, jmax=v.length; j < jmax; j++) {
					a.push({name: n, value: v[j]});
				}
			}
			else if (v !== null && typeof v != 'undefined') {
				a.push({name: n, value: v});
			}
		}

		if (!semantic && form.clk) {
			// input type=='image' are not found in elements array! handle it here
			var $input = $(form.clk), input = $input[0];
			n = input.name;
			if (n && !input.disabled && input.type == 'image') {
				a.push({name: n, value: $input.val()});
				a.push({name: n+'.x', value: form.clk_x}, {name: n+'.y', value: form.clk_y});
			}
		}
		return a;

	}
});
/* 对话框 */
vipcp.dialog={
	boxs      : {},
	create   : function(op){
		op = $.extend({
			type    :   'box',
			buttons :   []
		},op);
		if(this.boxs[op.type])return this.boxs[op.type];
		var config=this.boxs[op.type]={};
		var t1 = $('<label></label>');
		var t2 = $('<span></span>');
		var t = $('<h1></h1>').append(t1).append(t2);
        t = $('<td class="titm"></td>').append(t);
        t = $('<tr></tr>').append($('<td></td>')).append(t).append($('<td></td>'));
        t = $('<table cellspacing="0" cellpadding="0" border="0" width="100%"></table>').append(t);


		var c = $('<div class="tc_box_con"></div>');
		var body = $('<td style="background:url(/Images/Public/tit_rep.gif);background: none repeat scroll 0 0 #"></td>').append(t).append(c);

        if(op.buttons.length>0){
			var b = $('<div class="bottom"></div>');
			var buttons = [];
			$(op.buttons).each(function(i,v){
				buttons[i] = $('<input type="button" class="button" value="'+v+'">');
				b.append(buttons[i]);
				b.append(' ');
			});
			body.append(b);
			this.boxs[op.type]['buttons'] = buttons;
		}
//		var o = $('<div class="dialog"></div>').append(body);
//        var boxMidr = $('<div class="tc_box_mid"><div class="tc_box_midl"></div></div>').append(body).append($('<div class="tc_box_midr"></div>'));
        var boxMidr = $('<table cellspacing="0" cellpadding="0" border="0" width="100%"></table>').append(
            $('<tr><td class="w8"></td></tr>').append(body).append($('<td class="w8"></td>'))
        );
        var o = $('<div class="tc_box"><div class="tc_box_top"></div></div>').append(boxMidr).append($('<div class="tc_box_bot"></div>'));
		o.appendTo(document.body);
		this.boxs[op.type].obj = $(o);
		this.boxs[op.type].title = t1;
		this.boxs[op.type].content = c;
		this.boxs[op.type].close = t2;
		return this.boxs[op.type];
		/*
		<div id="dialog">
			<div class="body" style="width:350px;">
				<h1><label>网页对话框...</label><span></span></h1>
				<div style="height:100px;"></div>
				<div class="bottom">
					<input type="button" class="button" value="确定"/> <input type="button" class="button" value="取消"/>
				</div>
			</div>
		</div>*/
	},
	/*自定义提示信息box
	 *@param type    提示框类型alert|confirm
	 *@param title   提示框标题
	 *@param content 提示内容
	 *@param width   提示框宽度
	 *@param move    是否可以拖动true|false
	 *@param lock    是否锁屏true|false
	 *@param scroll  内容超出滚动
	 *@param before  加载之前事件回调
	 *@param load    加载中事件回调
	 *@param enterFunc    回车事件回调
	 *@param buttons array[
	 	@value   按钮文字
		@handle  当点击处理function]
	 */
	simple : function(op){
		var self = this;
		op = $.extend({
			type    : 'BOX',
			title   : '提示信息',
			content : '',
			width   : 400,
			move    : false,
			lock    : false,
			scroll  : true,
			before  : $.noop,
			load    : $.noop,
			enterFunc : function(){vipcp.dialog.close(op.type);	},
			escFunc : function(){vipcp.dialog.close(op.type);}
		},op);
		//call before function
		op.before();

		//create base box HTML
		var buttons = [],butFunc = [];
		$(op.buttons).each(function(i,n){
			buttons.push(n.value);
			butFunc.push(n.handle||$.noop);
		});
		var o = this.create({type:op.type,buttons:buttons});
		o.lock = op.lock;

		//update Info
		o.title.html(op.title);
		if(typeof(op.content)=='object'||op.content.indexOf('#')==0)
		{
			op.content=$(op.content);
			o.restore=op.content.clone(true);
			o.content.html(op.content.html());
			op.content.remove();
		}
		else
			o.content.html(op.content);
		o.obj.css('width',op.width);
		if(op.height){
			var mh = op.height - 65;
			if(!op.scroll){
				o.content.css({
					height    : mh,
					overflow  : 'hidden'
				});
			}else{
				o.content.css({
					height    : mh,
					maxHeight : mh+1,
					overflow  : 'auto'
				});
			}
		}

		//bind Event
		o.close.unbind('click');
		o.close.bind({
			click : function(){
				vipcp.dialog.close(op.type);
			}
		});
		$(o.buttons).each(function(i,n){
			n.unbind('click');
			n.click(function(){butFunc[i](o);});
		});
		if(o.buttons&&o.buttons.length>0){
			$(document.body).unbind('keydown');
			$(document.body).bind('keydown',function(event){
				if(event.keyCode==27){op.escFunc();vipcp.dialog.close(op.type);}
				if(event.keyCode==13){op.enterFunc();vipcp.dialog.close(op.type);}
			});
		}

		//align center
		o.obj.center();
		if(op.move){if(!vipcp.draggable)return alert('vipcp.draggable 插件未加载');vipcp.draggable(o.obj.find('h1'),o.obj);}
		if(op.lock){if(!vipcp.lock)return alert('vipcp.lock 插件未加载');vipcp.lock.show();}
		o.obj.show();
		o.obj.focus();

		//call loaded function
		op.load(o);

	},
	close : function(op){
		var c = 0,op=typeof(op)=='string' ? this.boxs[op] : op;
		for(var k in this.boxs){
			if(this.boxs[k].lock){
				if(this.boxs[k].obj.isVisible())
					c++;
			}
		}
		if(op){op.obj.hide();}
		if(c<=1){vipcp.lock.hide();}
		if(op.restore){op.restore.appendTo(document.body);}
	},
	confirm : function(op){
		if(op.buttons){
			$(op.buttons).each(function(i,v){
				if(!v.handle){
					v.handle=function(o){vipcp.dialog.close(o);}
				}
			});
		}
	}
};

/* 拖动 */
vipcp.draggable=function(obj,dragObj){
	dragObj = dragObj || obj;
	var obj = $(obj);
	var dragObj = $(dragObj);
	if(!dragObj)return;
	obj.css('cursor','move');
	var pos,h=this,o=$(document);
	var oh = dragObj.outerHeight();
	var ow = dragObj.outerWidth();
	obj.mousedown(function(event){
		if(h.setCapture)h.setCapture();
		pos = {
			top  : dragObj.position().top,
			left : dragObj.position().left
		};
		pos = {
			top   :	 event.clientY  - pos.top,
			left  :  event.clientX  - pos.left
		};
		o.mousemove(function(event){
			try{
				if (window.getSelection) {
					window.getSelection().removeAllRanges();
				} else {
					document.selection.empty();
				}
			}catch(e){}
			var s = $.browser.screen();
			var maxTop = s.sh;
			var maxLeft = s.sw;
			var top = Math.max(event.clientY-pos.top,0);
			var left = Math.max(event.clientX-pos.left,0);
			dragObj.css({top:Math.min(top,maxTop-oh),left:Math.min(left,maxLeft-ow)});
		});
		o.mouseup(function(event){
			if(h.releaseCapture)h.releaseCapture();
			o.unbind('mousemove');
			o.unbind('mouseup');
		});
	});
};

/* cookie */
vipcp.cookie={
	get : function(name){if(document.cookie==null){alert("没有document.cookie无法操作Cookie");return;}var tmpDate=document.cookie;var tmpStart=tmpDate.indexOf(name+"=");if(tmpStart==-1){return null;}tmpStart+=name.length+1;var tmpEnd=tmpDate.indexOf(";",tmpStart);if(tmpEnd==-1){return decodeURI(tmpDate.substring(tmpStart))};return decodeURI(tmpDate.substring(tmpStart,tmpEnd));},
	set : function(name,value,expires,path,domain,secure){if(document.cookie==null){alert("没有document.cookie无法操作Cookie");return;}var tmpCookie=name+"="+encodeURI(value);if(expires!=null){tmpCookie+=";expires="+expires.toGMTString();}if(path!=null){tmpCookie+=";path="+path;}if(domain!=null){tmpCookie+=";domain="+domain;}if(secure!=null){tmpCookie+=";secure="+secure;}document.cookie=tmpCookie;},
	remove : function(name,path,domain){if(document.cookie==null){alert("没有document.cookie无法操作Cookie");return;}var tmpCookie=name+"=null;expires="+new Date(new Date().getTime()-1000000000000).toGMTString();if(path!=null){tmpCookie+=";path="+path;}if(domain!=null){tmpCookie+=";domain="+domain;}document.cookie=tmpCookie;},
	clear : function(path,domain){if(document.cookie==null){alert("没有document.cookie无法操作Cookie");return;}var tmpCookie=document.cookie.split(";");var tmpName;for(var i=0;i<tmpCookie.length;i++){tmpName=tmpCookie[i].split("=")[0].strip();Cookie.remove(tmpName,path,domain);}}
};

/* 滚动 */
vipcp.marquee={
	text : function(options){
		this.options = $.extend({
			direction : 'marginTop',
			speed     : 500,
			amount    : 20,
			interval  : 3000,
			mouse     : true,
			object    : null
		},options);
	}
};
$.extend(vipcp.marquee.text.prototype,{
	start : function(){
		this.options.object = $(this.options.object);
		this.options.id = setInterval($.proxy(function(){this.doStart()},this),this.options.interval);
		if(this.options.mouse){
			this.options.object.bind({
				mouseover : $.proxy(function(){clearInterval(this.options.id);},this),
				mouseout  : $.proxy(function(){
					this.options.id = setInterval($.proxy(function(){this.doStart()},this),this.options.interval);
				},this)
			});
		}
	},
	doStart : function(){
		var c1 = {},c2={},op=this.options;
		c1[op.direction] =  '-'+op.amount+'px';
		c2[op.direction] =  '0px';
		op.object.find("*:first").animate(c1,op.speed,function(){$(this).css(c2).appendTo(op.object);});
	},
	stop   : function(){
		clearInterval(this.options.id);
	}
});

/* 锁屏 */
vipcp.lock={
	source     : null,
	initialize : function(op){
		var s = $.browser.screen();
		op = op || {w : s.sw,h : s.sh,t : 0,l : 0};
		if(!this.o){
			this.o = $(document.createElement("div"));
			this.o.attr('id','vipcp.lock');
			this.o.css({
				background : '#000',
				width      : op.w,
				height     : op.h,
				position   : 'absolute',
				top	       : op.t,
				left       : op.l,
				zIndex     : 1000,
				opacity    : 0.06,
				filter     : 'Alpha(opacity=6)',
				display    : 'none'
			});
			this.o.appendTo(document.body);
		}else{
			this.o.css({
				width      : op.w,
				height     : op.h,
				top	       : op.t,
				left       : op.l
			});
		}
	},
	show : function(obj){
		this.source=obj;
		var op = !obj ? null : {
			w : $(obj).outerWidth(),
			h : $(obj).outerHeight(),
			t : $(obj).position().top,
			l : $(obj).position().left
		};
		this.initialize(op);
		this.o.fadeIn(300);
	},
	hide : function(){
		if(this.o)this.o.hide();
	}
};
