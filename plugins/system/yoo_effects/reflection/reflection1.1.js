/*!
	reflection.js for mootools v1.33
	(c) 2006-2009 Christophe Beyls <http://www.digitalia.be>
	MIT-style license.
*/

Element.extend({
	reflect: function(options) {
		var img = this;
		if (img.getTag() == "img") {
			options = $extend({
				height: 1/3,
				opacity: 0.5
			}, options || {});

			img.unreflect();

			function doReflect() {
				var imageWidth = img.width, imageHeight = img.height, reflection, reflectionHeight, wrapper, context, gradient;
				reflectionHeight = Math.floor((options.height > 1) ? Math.min(imageHeight, options.height) : imageHeight * options.height);

				if (window.ie) {
					reflection = new Element("img", {src: img.src, styles: {
						width: imageWidth,
						height: imageHeight,
						marginBottom: reflectionHeight - imageHeight,
						filter: "flipv progid:DXImageTransform.Microsoft.Alpha(opacity=" + (options.opacity * 100) + ", style=1, finishOpacity=0, startx=0, starty=0, finishx=0, finishy=" + (reflectionHeight / imageHeight * 100) + ")"
					}});
				} else {
					reflection = new Element("canvas");
					if (!reflection.getContext) return;
					try {
						context = reflection.setProperties({width: imageWidth, height: reflectionHeight}).getContext("2d");
						context.save();
						context.translate(0, imageHeight-1);
						context.scale(1, -1);
						context.drawImage(img, 0, 0, imageWidth, imageHeight);
						context.restore();
						context.globalCompositeOperation = "destination-out";

						gradient = context.createLinearGradient(0, 0, 0, reflectionHeight);
						gradient.addColorStop(0, "rgba(255, 255, 255, " + (1 - options.opacity) + ")");
						gradient.addColorStop(1, "rgba(255, 255, 255, 1.0)");
						context.fillStyle = gradient;
						context.rect(0, 0, imageWidth, reflectionHeight);
						context.fill();
					} catch(e) {
						return;
					}
				}
				reflection.setStyles({display: "block", border: 0});

				wrapper = new Element(($(img.parentNode).getTag() == "a") ? "span" : "div").injectAfter(img).adopt(img, reflection);
				wrapper.className = img.className;
				wrapper.style.cssText = img._reflected = img.style.cssText;
				wrapper.setStyles({width: imageWidth, height: imageHeight + reflectionHeight, overflow: "hidden"});
				img.style.cssText = "display: block; border: 0px";
				img.className = "reflected";
			}

			if (img.complete) doReflect();
			else img.onload = doReflect;
		}

		return img;
	},

	unreflect: function() {
		var img = this, wrapper;
		img.onload = Class.empty;

		if (img._reflected !== undefined) {
			wrapper = img.parentNode;
			img.className = wrapper.className;
			img.style.cssText = img._reflected;
			img._reflected = undefined;
			wrapper.parentNode.replaceChild(img, wrapper);
		}

		return img;
	}
});

Elements.extend({
	reflect: function(options) {
		return this.forEach(function(el) {
			el.reflect(options);
		});
	},

	unreflect: function() {
		return this.forEach(function(el) {
			el.unreflect();
		});
	}
});

// AUTOLOAD CODE BLOCK (MAY BE CHANGED OR REMOVED)
window.addEvent("domready", function() {
	$$($$("img").filter(function(img) { return img.hasClass("reflect"); })).reflect({/* Put custom options here */});
});