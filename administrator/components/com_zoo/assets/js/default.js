/* Copyright (C) 2007 - 2011 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

	// add submenu css classes
	$('#submenu li').addClass(function() {
		return 'item' + ($(this).index() + 1);
	});

	// add auto submit
	$('select.auto-submit').bind('change', function(){
		$('form[name="adminForm"]').submit();
	});

	// stripe tables
	$('table.stripe tbody tr').addClass(function(i, cls) {
		return (i % 2) ? 'even' : 'odd';
	});

	// check all/single
	var all   = $('input.check-all');
	var check = $('input[name="cid[]"]');
	var count = $('input[name="boxchecked"]');

	all.bind('click', function(e) {
		var value = $(this).attr('checked');
		check.attr('checked', function(i, attr) { return value; });
		count.val(check.filter(':checked').length);
	});

	check.bind('click', function(e) {
		var value = parseInt(count.val());
		count.val($(this).attr('checked') ? value + 1 : value - 1);
	});

	// add task event
	$('form[name=adminForm] table tr a[rel^="task-"]').bind('click', function(e) {
		e.preventDefault();

		var form = $('form[name="adminForm"]');
		var id 	 = $(this).closest('tr').find('input[name="cid[]"]').val();

		$('input[name="task"]', form).val($(this).attr('rel').replace(/task-/, ''));
		form.append('<input type="hidden" name="cid" value="' + id + '" />');
		form.submit();
	});

	// add parameter accordion
	$('#parameter-accordion').accordionMenu({ mode: 'slide', display: 0 });

	// catch submit event and remove placeholder values
	$.each(['apply', 'save', 'saveandnew'], function(i, task) {		
		var button = $('#toolbar-' + task + ' a');
		if (button.length) {
			var submittask = button.attr('onclick').toString().replace(/\n*/gi, '').replace(/.*submitbutton\(['|"](.*)['|"]\).*/g, '$1');
			button.removeAttr('onclick').bind('click', function(event) {
				var triggerEvent = jQuery.Event('validate.adminForm');
				$(this).trigger(triggerEvent);
				if (!triggerEvent.isDefaultPrevented()) {
					$('form[name=adminForm]').find('.placeholder:text').val('');
					submitbutton(submittask);
				}
			});
		}
	});

	// Message
	$.Message = function(data, erroronly) {
		var options = $.parseJSON(data);

		// show notify
		if (options) {
			if (options.group == 'info') {
				if (erroronly) return;
				$.pnotify({
					pnotify_title: options.title,
					pnotify_text: options.text,
					pnotify_type: "notice"
				});
				return;
			} else if (options.group == 'error'){
				$.pnotify({
					pnotify_title: options.title,
					pnotify_text: options.text,
					pnotify_type: "error",
					pnotify_hide: false
				});
				return;
			}
		}

		// redirect on error
		window.location = 'index.php';
	};

	// add zoo string methods
	$.String = {};
	$.String.tidymap  = {"[\xa0\u2002\u2003\u2009]": " ", "\xb7": "*", "[\u2018\u2019]": "'", "[\u201c\u201d]": '"', "\u2026": "...", "\u2013": "-", "\u2014": "--", "\uFFFD": "&raquo;"};
	$.String.special  = ['\'', 'À','à','Á','á','Â','â','Ã','ã','Ä','ä','Å','å','A','a','A','a','C','c','C','c','Ç','ç','Č','č','D','d','Ð','d', 'È','è','É','é','Ê','ê','Ë','ë','E','e','E','e', 'G','g','Ì','ì','Í','í','Î','î','Ï','ï', 'L','l','L','l','L','l', 'Ñ','ñ','N','n','N','n','Ò','ò','Ó','ó','Ô','ô','Õ','õ','Ö','ö','Ø','ø','o','R','r','R','r','Š','š','S','s','S','s', 'T','t','T','t','T','t','Ù','ù','Ú','ú','Û','û','Ü','ü','U','u', 'Ÿ','ÿ','ý','Ý','Ž','ž','Z','z','Z','z', 'Þ','þ','Ð','ð','ß','Œ','œ','Æ','æ','µ'];
	$.String.standard = ['-', 'A','a','A','a','A','a','A','a','Ae','ae','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d', 'E','e','E','e','E','e','E','e','E','e','E','e','G','g','I','i','I','i','I','i','I','i','L','l','L','l','L','l', 'N','n','N','n','N','n', 'O','o','O','o','O','o','O','o','Oe','oe','O','o','o', 'R','r','R','r', 'S','s','S','s','S','s','T','t','T','t','T','t', 'U','u','U','u','U','u','Ue','ue','U','u','Y','y','Y','y','Z','z','Z','z','Z','z','TH','th','DH','dh','ss','OE','oe','AE','ae','u'];
	$.String.slugify  = function (txt) {

		txt = txt.toString();
		$.each($.String.tidymap, function(key, value) {txt = txt.replace(new RegExp(key, 'g'), value);});

		$.each($.String.special, function(i, ch) {txt = txt.replace(new RegExp(ch, 'g'), $.String.standard[i]);});

		return $.trim(txt).replace(/\s+/g,'-').toLowerCase().replace(/[^\u0370-\u1FFF\u4E00-\u9FAFa-z0-9\-]/g,'').replace(/[-]+/g, '-').replace(/^[-]+/g, '').replace(/[-]+$/g, '');

	};

});