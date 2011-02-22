/* Copyright (C) 2007 - 2011 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

(function(a){var c=function(){};a.extend(c.prototype,{name:"BrowseTags",options:{msgSave:"Save",msgCancel:"Cancel"},initialize:function(e,d){this.options=a.extend({},this.options,d);var b=this;this.input=e;e.find("span.edit-tag a").bind("click",function(){var f=a(this);b.removePanel();f.hide();var h=a("<span>").addClass("edit-tag-panel").insertAfter(f);a('<input class="text" type="text" name="new">').val(f.text()).appendTo(h).focus().bind("keydown",function(g){if(g.which==13){g.stopPropagation();
b.submit()}if(g.which==27){g.stopPropagation();b.removePanel()}});a('<input type="hidden" name="old">').val(f.text()).appendTo(h);a("<button>").addClass("save").text(b.options.msgSave).appendTo(h).bind("click",function(){b.submit()});a("<a>").addClass("cancel").text(b.options.msgCancel).appendTo(h).bind("click",function(){b.removePanel()})})},removePanel:function(){this.input.find("span.edit-tag-panel").each(function(){a(this).parent().find("a").show();a(this).remove()})},submit:function(){this.input.find('input[name="task"]').val("update");
this.input.submit()}});a.fn[c.prototype.name]=function(){var e=arguments,d=e[0]?e[0]:null;return this.each(function(){var b=a(this);if(c.prototype[d]&&b.data(c.prototype.name)&&d!="initialize")b.data(c.prototype.name)[d].apply(b.data(c.prototype.name),Array.prototype.slice.call(e,1));else if(!d||a.isPlainObject(d)){var f=new c;c.prototype.initialize&&f.initialize.apply(f,a.merge([b],e));b.data(c.prototype.name,f)}else a.error("Method "+d+" does not exist on jQuery."+c.name)})}})(jQuery);
(function(a){var c=function(){};a.extend(c.prototype,{name:"Tag",options:{url:"index.php?option=com_zoo&controller=item",startText:"Add new tag",emptyText:"No Results"},initialize:function(e,d){this.options=a.extend({},this.options,d);var b=this,f={},h;this.tagArea=e;this.tagInput=e.find('input[type="text"]');this.tagInput.autosuggest({allowDuplicates:false,inputName:"tags[]",prefill:this.tagInput.val()!=this.tagInput.attr("placeholder")?this.tagInput.val():"",source:function(g,j){var i=g.term;if(i in
f)j(f[i]);else h=a.getJSON(b.options.url+"&format=raw&task=loadtags",{tag:i},function(k,m,l){f[i]=k;l===h&&j(k)})}}).bind("keydown",function(g){switch(g.which){case 13:g.preventDefault();b.tagInput.autosuggest("addItem",b.tagInput.val())}}).placeholder();e.delegate("div.tag-cloud a","click",function(){b.tagInput.autosuggest("addItem",a(this).text());b.tagInput.trigger("blur.placeholder")})}});a.fn[c.prototype.name]=function(){var e=arguments,d=e[0]?e[0]:null;return this.each(function(){var b=a(this);
if(c.prototype[d]&&b.data(c.prototype.name)&&d!="initialize")b.data(c.prototype.name)[d].apply(b.data(c.prototype.name),Array.prototype.slice.call(e,1));else if(!d||a.isPlainObject(d)){var f=new c;c.prototype.initialize&&f.initialize.apply(f,a.merge([b],e));b.data(c.prototype.name,f)}else a.error("Method "+d+" does not exist on jQuery."+c.name)})}})(jQuery);