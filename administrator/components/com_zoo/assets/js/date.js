/* Copyright (C) 2007 - 2011 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

(function(a){var b=function(){};a.extend(b.prototype,{name:"Calendar",options:{translations:[]},initialize:function(f,c){this.options=a.extend({},this.options,c);var d=this;f.delegate("img.zoo-calendar","click",function(){var e=a(this).prev("input");if(e.length){if(!a(this).data("initialized")){e.datepicker(a.extend(d.options.translations,{showOn:"button",dateFormat:a.datepicker.ISO_8601,constrainInput:false}));a(this).prevUntil("input").remove();a(this).data("initialized",true)}e.datepicker("show")}})}});
a.fn[b.prototype.name]=function(){var f=arguments,c=f[0]?f[0]:null;return this.each(function(){var d=a(this);if(b.prototype[c]&&d.data(b.prototype.name)&&c!="initialize")d.data(b.prototype.name)[c].apply(d.data(b.prototype.name),Array.prototype.slice.call(f,1));else if(!c||a.isPlainObject(c)){var e=new b;b.prototype.initialize&&e.initialize.apply(e,a.merge([d],f));d.data(b.prototype.name,e)}else a.error("Method "+c+" does not exist on jQuery."+b.name)})}})(jQuery);
