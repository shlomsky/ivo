/**
* YOOslider Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/
var YOOslider=new Class({initialize:function(a,b,c){this.setOptions({layout:"vertical",itemstyle:"height",sizeSmall:100,sizeNormal:150,sizeFull:200,transition:Fx.Transitions.Expo.easeOut},c);var e=this;this.wrapper=$(a);this.items=$$(b);this.fx=new Fx.Elements(this.items,{wait:false,duration:600,transition:this.options.transition});if(this.options.layout!="vertical")this.options.itemstyle="width";this.options.sizeSmall=Math.round(this.options.sizeNormal-(this.options.sizeFull-this.options.sizeNormal)/
(this.items.length-1));this.items.each(function(d,f){d.addEvent("mouseenter",function(){e.itemFx(d,f)})});this.wrapper.addEvent("mouseleave",this.wrapperFx.bind(this))},wrapperFx:function(){var a={};this.items.each(function(b,c){a[c]=this.itemStyle(b.getStyle(this.options.itemstyle).toInt(),this.options.sizeNormal);b.removeClass("active")},this);this.fx.start(a)},itemFx:function(a,b){var c={};c[b]=this.itemStyle(a.getStyle(this.options.itemstyle).toInt(),this.options.sizeFull);a.addClass("active");
this.items.each(function(e,d){if(b!=d){var f=e.getStyle(this.options.itemstyle).toInt();if(f!=this.options.sizeSmall)c[d]=this.itemStyle(f,this.options.sizeSmall);e.removeClass("active")}},this);this.fx.start(c)},itemStyle:function(a,b){return this.options.layout=="vertical"?{height:[a,b]}:{width:[a,b]}}});YOOslider.implement(new Options);