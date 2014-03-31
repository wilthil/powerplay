(function($) {
 
    $.fn.parallax = function(options) {
 
        var windowHeight = $(window).height();
 
        // Establish default settings
        var settings = $.extend({
            speed        : 0.5
            
           
        }, options);
 
 
		var speed = $(this).parent().attr('data-parallax-speed');
        // Iterate over each object in collection
        return this.each( function() {
 
        	// Save a reference to the element
        	var $this = $(this);
 
        	// Set up Scroll Handler
        	$(document).scroll(function(){
 
    		        var scrollTop = $(window).scrollTop();
            	        var offset = $this.offset().top;
            	        var height = $this.outerHeight();
 
    			// Check if above or below viewport
			if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
				return;
			}
 
			var yBgPosition = Math.round((offset - scrollTop) * speed);
 
                        // Apply the Y Background Position to Set the Parallax Effect
    			$this.css('background-position', 'center ' + yBgPosition + 'px');
                
        	});
        });
    }
}(jQuery));


(function($){
    'use strict';	
    
    $.fn.edge = function() {
		var obj = this,
			scw = $('#wrapper').width();
	
			$(obj).css({'width': scw + 'px'});
			$(window).on('resize', function() {
				scw = $( '#wrapper' ).width();
				$(obj).css({'width': scw + 'px', 'height':'auto'});
			});
	};  
	
	
    $.fn.stickyNav = function() {
		var elem = this,
        stickyNavTop = $(this).offset().top;
      
	    var stick = function(){
	    	var scrollTop = $(window).scrollTop(); 
		    
		    if (scrollTop > stickyNavTop) {
		        $(elem).addClass('sticky');
		    } else {
		        $(elem).removeClass('sticky');
		    }
	    };
	      
	    stick();
	    
	    $(window).on('scroll', function() {
			stick();
		});
    };
    
    $.fn.dropdownCart = function() {
    
    	var obj = this,
	    	windowWidth = jQuery(window).width();
	    
	    if ( windowWidth >= 1000){ // Only on large screens
		   
		    $(obj).hover(function(){
				$(this).find('>a').addClass('active');
				$('#header-cart-widget').fadeIn();
			}, function(){
			 	$(this).find('>a').removeClass('active');
				$('#header-cart-widget').fadeOut();   	    
			});
		}  
    }
    
    $.fn.dropdownMenu = function() {
	    
	    var obj = this,
	    	windowWidth = jQuery(window).width();
	    
	    if ( windowWidth >= 1000){ // Only on large screens
		    
		    $(obj).superfish({
			    delay: 0,    
				animation:   {opacity:'show'},
				speed: 200,
				speedOut: 100,
			    cssArrows:     false
			    
		    });
		}  
    }

}( jQuery ));



(function ( $ ) {
 	
    'use strict';
    
   /* Resize handle */
 
    jQuery( window ).resize(function($){
    	
    	jQuery('#shopping-cart').dropdownCart();
    	jQuery('#primary-menu').dropdownMenu();
			
	});
	

    
    jQuery(document).ready(function($){
    
    	var pathname = window.location;
    	var wrapper = $('#wrapper');
    	//alert(pathname);
    
			
		
		$("#responsiveview").contents().find('html').addClass('hide-adminbar');	
		
		
		function hideAdminbar(){
			
			setTimeout(function() {
					$("#responsiveview").contents().find('html').addClass('hide-adminbar');	
			}, 1000);
		}
		/*
		$(document).on('click','#wp-admin-bar-screen-mobile-p a',function(){
		
			if ( wrapper.css('display') == 'none' ){
				
				$('#responsiveview').attr('data-id','320');
				$("#responsiveview").contents().find("#wpadminbar").hide();			
			}
					
			else {
				
				wrapper.hide('');
				$('body').prepend('<iframe id="responsiveview" data-id="320" src="'+pathname+'"></iframe>');
				$('#responsiveview').css({'height': $(window).height() - 40});	
				hideAdminbar();
			
			}
			return false;
		});
		
		
		$(document).on('click','#wp-admin-bar-screen-mobile-l a',function(){
		
			if( wrapper.css('display') == 'none' ){
				$('#responsiveview').attr('data-id','640');
				$("#responsiveview").contents().find("#wpadminbar").hide();
			}
			
			else {
				wrapper.hide();
				$('body').prepend('<iframe id="responsiveview" data-id="640" src="'+pathname+'"></iframe>');
				$('#responsiveview').css({'height': $(window).height() - 40});
				hideAdminbar();	
			}
			return false;
		});
		
		$(document).on('click','#wp-admin-bar-screen-tablet-p a',function(){
		
			if( wrapper.css('display') == 'none' ){
				$('#responsiveview').attr('data-id','768');
				$("#responsiveview").contents().find("#wpadminbar").hide();
			}
			
			else {
				wrapper.hide();
				$('body').prepend('<iframe id="responsiveview" data-id="768" src="'+pathname+'"></iframe>');
				$('#responsiveview').css({'height': $(window).height()- 40});
				
				hideAdminbar();
				
			}
			return false;
		});
		
		$(document).on('click','#wp-admin-bar-screen-tablet-l a',function(){
		
			if( wrapper.css('display') == 'none' ){
				$('#responsiveview').attr('data-id','1024');
				$("#responsiveview").contents().find("#wpadminbar").hide();
			}
			
			else {
				wrapper.hide();
				$('body').prepend('<iframe id="responsiveview" data-id="1024" src="'+pathname+'"></iframe>');
				$('#responsiveview').css({'height': $(window).height()- 40});
				hideAdminbar();
					
				
			}
			return false;
		});
		
		$(document).on('click','#wp-admin-bar-screen-desktop a',function(){
		
			wrapper.show();
			$('#responsiveview').remove();
		
			
			return false;
		});
		*/
		
        	
    	$('.parallax > div').parallax({ speed: 0.5 });
    		
		/* Make header sticky and resize */
    	//$('#header').stickyNav(); 
    	
    	/* Dropdown cart in header */
    	$('#shopping-cart').dropdownCart(); 
    	
    	/* Menu dropdown - superfish */
		$('#primary-menu').dropdownMenu();
    
		/* Expanding page-builder panel */
    	$('.panel-row-style-edge .panel-grid-cell').edge();
		
		/* Responsive video */
		$('#content').fitVids({ customSelector: 'iframe[src^="https://w.soundcloud.com"]'});
		$('#content').fitVids({ customSelector: 'iframe[src^="http://www.youtube.com"]'});
		$('#content').fitVids({ customSelector: 'iframe[src^="http://www.vimeo.com"]'});
		$(".video-wrapper").fitVids();
	
		/* Tooltip */
		$('.tip').tipr({'speed':'500','mode':'top'}); 
		
		/* Waypoint */
		
		//if($(window).width() > 568 ){ // Only animate on larger screens
			
			$('#post-title-wrapper h3, #post-content > .entry-content').animate({'opacity':'1'}, 500, 'swing');
			$('#post-content > .entry-content .panel, #post-content > .entry-content > ul, #post-content article').css({'position':'relative', 'bottom':'-20px'});
			$('#post-content .entry-content .panel, #post-content .entry-content > ul, #post-content article').waypoint(function() {
				$(this).animate({'opacity':'1', 'bottom':'0px'}, 600, 'swing');
			}, { offset: '100%' });
		//}
		
	   
	
	    
	    /* Toggle header search visiblity */
	  	$('#menu-open-search').toggle(function(){
				$('#header-search').slideDown('200');
				$(this).addClass('sfHover');
		}, function(){
				$('#header-search').slideUp('200');
				$(this).removeClass('sfHover');
		});
   
	    $("a[data-rel^='lightbox']").magnificPopup({
	  		type:'image',
	  		gallery:{enabled:true}
	  	});
    
    }); // End document ready


}( jQuery ));
    

jQuery(document).ready(function($){	
	
	
	$menu = $("#primary-menu");
	var linkText = $menu.parent().attr('data-name');
	$menu.prepend('<li id="close-sidebar-button" class="homelink"><a href="#"><span></span>' + linkText +'</a></li>');

	
	jQuery('#open-menu-mobile, #close-sidebar-button a').click(function(){
		
		$('#primary-nav-container').toggleClass('mobile-menu-visible');
		return false;
	});
	
	
	 jQuery('a.scrollto, .scrollto > a').click ( function(){
	  
	  	var homepage = window.location.href.replace(window.location.hash, '');
		var target = jQuery(this).attr('href');
		var newtarget = target.split("#")[1];
		var offset = jQuery('#'+ newtarget).offset();
		
		jQuery("html:not(:animated),body:not(:animated)").animate({ scrollTop: offset.top - 120}, 500 );
		
		return false;
		 
	  });
	  
	  
	  /* Fix for responsive mejs player bug width volume control breaking layout */
	  /*
	  var orig_width = $.fn.width;

		$.fn.width = function(){
		    var objClass = $(this).attr("class");
		
		    if (objClass == 'mejs-time-rail')
		    {
		        if (arguments.length)
		        {
		            arguments[0] = arguments[0] - 1;
		        }
		    }
		
		    var ret = orig_width.apply(this, arguments);
		
		    return ret;
		}*/
		
});





(function($){
    
    'use strict';

	var overlay, $this;
		
	$(function() {
		
	
	
		var linksToAnimate;
			
		$("#primary-menu li:has(ul)").each(function() {
			$this = $(this);
			$this.addClass("has-children");
			$this.find('> a').append('<span class="arrow right"></span>');
		});
		
		
		
		$("#primary-menu li ul").each(function() {
			$this = $(this);
			//var linkText = $this.prev('a').text();
			var linkText = $this.prev('a').text();
			var backLink = document.createElement("a");
			var backLinkLi = document.createElement("li");
			var backIcon = document.createElement('span');
			backIcon.appendChild(document.createTextNode(""));
			backLink.appendChild(backIcon);
			backLink.appendChild(document.createTextNode(linkText));
			backLinkLi.className = "backlink";
			backLinkLi.appendChild(backLink);
			$this.prepend(backLinkLi);
			
		});
		
		$(document).on("click", ".has-children > a > span.arrow", function(e) {
	
			//var eleA = $(this);
			//var eleUl = $(this).next();
			
			var eleA = $(this).parent();
			var eleUl = $(this).parent().next();
			
			
			linksToAnimate = eleA.parent().parent().find('>li>a');
			var wWidth = $(window).width();
			
				eleUl.transition({x: '0'});
				linksToAnimate.transition({x:'-100%'});
				
				e.preventDefault();
				
			
			
		});
		
		jQuery(".backlink a").click(function($) {
			$this = jQuery(this);
			var ulToAnimate = $this.parent().parent();
			linksToAnimate = $this.parent().parent().parent().parent().find('>li>a');
			
			ulToAnimate.transition({x:'100%'});
			linksToAnimate.transition({x:'0'});
			
		});
		
		 $("#commentform").clearFields();
				
	});

}( jQuery ));





/*!
 * jQuery Transit - CSS3 transitions and transformations
 * (c) 2011-2012 Rico Sta. Cruz <rico@ricostacruz.com>
 * MIT Licensed.
 *
 * http://ricostacruz.com/jquery.transit
 * http://github.com/rstacruz/jquery.transit
 */
(function(k){k.transit={version:"0.9.9",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:true,useTransitionEnd:false};var d=document.createElement("div");var q={};function b(v){if(v in d.style){return v}var u=["Moz","Webkit","O","ms"];var r=v.charAt(0).toUpperCase()+v.substr(1);if(v in d.style){return v}for(var t=0;t<u.length;++t){var s=u[t]+r;if(s in d.style){return s}}}function e(){d.style[q.transform]="";d.style[q.transform]="rotateY(90deg)";return d.style[q.transform]!==""}var a=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;q.transition=b("transition");q.transitionDelay=b("transitionDelay");q.transform=b("transform");q.transformOrigin=b("transformOrigin");q.transform3d=e();var i={transition:"transitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"};var f=q.transitionEnd=i[q.transition]||null;for(var p in q){if(q.hasOwnProperty(p)&&typeof k.support[p]==="undefined"){k.support[p]=q[p]}}d=null;k.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};k.cssHooks["transit:transform"]={get:function(r){return k(r).data("transform")||new j()},set:function(s,r){var t=r;if(!(t instanceof j)){t=new j(t)}if(q.transform==="WebkitTransform"&&!a){s.style[q.transform]=t.toString(true)}else{s.style[q.transform]=t.toString()}k(s).data("transform",t)}};k.cssHooks.transform={set:k.cssHooks["transit:transform"].set};if(k.fn.jquery<"1.8"){k.cssHooks.transformOrigin={get:function(r){return r.style[q.transformOrigin]},set:function(r,s){r.style[q.transformOrigin]=s}};k.cssHooks.transition={get:function(r){return r.style[q.transition]},set:function(r,s){r.style[q.transition]=s}}}n("scale");n("translate");n("rotate");n("rotateX");n("rotateY");n("rotate3d");n("perspective");n("skewX");n("skewY");n("x",true);n("y",true);function j(r){if(typeof r==="string"){this.parse(r)}return this}j.prototype={setFromString:function(t,s){var r=(typeof s==="string")?s.split(","):(s.constructor===Array)?s:[s];r.unshift(t);j.prototype.set.apply(this,r)},set:function(s){var r=Array.prototype.slice.apply(arguments,[1]);if(this.setter[s]){this.setter[s].apply(this,r)}else{this[s]=r.join(",")}},get:function(r){if(this.getter[r]){return this.getter[r].apply(this)}else{return this[r]||0}},setter:{rotate:function(r){this.rotate=o(r,"deg")},rotateX:function(r){this.rotateX=o(r,"deg")},rotateY:function(r){this.rotateY=o(r,"deg")},scale:function(r,s){if(s===undefined){s=r}this.scale=r+","+s},skewX:function(r){this.skewX=o(r,"deg")},skewY:function(r){this.skewY=o(r,"deg")},perspective:function(r){this.perspective=o(r,"px")},x:function(r){this.set("translate",r,null)},y:function(r){this.set("translate",null,r)},translate:function(r,s){if(this._translateX===undefined){this._translateX=0}if(this._translateY===undefined){this._translateY=0}if(r!==null&&r!==undefined){this._translateX=o(r,"px")}if(s!==null&&s!==undefined){this._translateY=o(s,"px")}this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var r=(this.scale||"1,1").split(",");if(r[0]){r[0]=parseFloat(r[0])}if(r[1]){r[1]=parseFloat(r[1])}return(r[0]===r[1])?r[0]:r},rotate3d:function(){var t=(this.rotate3d||"0,0,0,0deg").split(",");for(var r=0;r<=3;++r){if(t[r]){t[r]=parseFloat(t[r])}}if(t[3]){t[3]=o(t[3],"deg")}return t}},parse:function(s){var r=this;s.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(t,v,u){r.setFromString(v,u)})},toString:function(t){var s=[];for(var r in this){if(this.hasOwnProperty(r)){if((!q.transform3d)&&((r==="rotateX")||(r==="rotateY")||(r==="perspective")||(r==="transformOrigin"))){continue}if(r[0]!=="_"){if(t&&(r==="scale")){s.push(r+"3d("+this[r]+",1)")}else{if(t&&(r==="translate")){s.push(r+"3d("+this[r]+",0)")}else{s.push(r+"("+this[r]+")")}}}}}return s.join(" ")}};function m(s,r,t){if(r===true){s.queue(t)}else{if(r){s.queue(r,t)}else{t()}}}function h(s){var r=[];k.each(s,function(t){t=k.camelCase(t);t=k.transit.propertyMap[t]||k.cssProps[t]||t;t=c(t);if(k.inArray(t,r)===-1){r.push(t)}});return r}function g(s,v,x,r){var t=h(s);if(k.cssEase[x]){x=k.cssEase[x]}var w=""+l(v)+" "+x;if(parseInt(r,10)>0){w+=" "+l(r)}var u=[];k.each(t,function(z,y){u.push(y+" "+w)});return u.join(", ")}k.fn.transition=k.fn.transit=function(z,s,y,C){var D=this;var u=0;var w=true;if(typeof s==="function"){C=s;s=undefined}if(typeof y==="function"){C=y;y=undefined}if(typeof z.easing!=="undefined"){y=z.easing;delete z.easing}if(typeof z.duration!=="undefined"){s=z.duration;delete z.duration}if(typeof z.complete!=="undefined"){C=z.complete;delete z.complete}if(typeof z.queue!=="undefined"){w=z.queue;delete z.queue}if(typeof z.delay!=="undefined"){u=z.delay;delete z.delay}if(typeof s==="undefined"){s=k.fx.speeds._default}if(typeof y==="undefined"){y=k.cssEase._default}s=l(s);var E=g(z,s,y,u);var B=k.transit.enabled&&q.transition;var t=B?(parseInt(s,10)+parseInt(u,10)):0;if(t===0){var A=function(F){D.css(z);if(C){C.apply(D)}if(F){F()}};m(D,w,A);return D}var x={};var r=function(H){var G=false;var F=function(){if(G){D.unbind(f,F)}if(t>0){D.each(function(){this.style[q.transition]=(x[this]||null)})}if(typeof C==="function"){C.apply(D)}if(typeof H==="function"){H()}};if((t>0)&&(f)&&(k.transit.useTransitionEnd)){G=true;D.bind(f,F)}else{window.setTimeout(F,t)}D.each(function(){if(t>0){this.style[q.transition]=E}k(this).css(z)})};var v=function(F){this.offsetWidth;r(F)};m(D,w,v);return this};function n(s,r){if(!r){k.cssNumber[s]=true}k.transit.propertyMap[s]=q.transform;k.cssHooks[s]={get:function(v){var u=k(v).css("transit:transform");return u.get(s)},set:function(v,w){var u=k(v).css("transit:transform");u.setFromString(s,w);k(v).css({"transit:transform":u})}}}function c(r){return r.replace(/([A-Z])/g,function(s){return"-"+s.toLowerCase()})}function o(s,r){if((typeof s==="string")&&(!s.match(/^[\-0-9\.]+$/))){return s}else{return""+s+r}}function l(s){var r=s;if(k.fx.speeds[r]){r=k.fx.speeds[r]}return o(r,"ms")}k.transit.getTransitionValue=g})(jQuery);

/*
 * Salvattore 1.0.4 by @rnmp and @ppold
 * https://github.com/rnmp/salvattore
 */
!function(a,b){"object"==typeof exports?module.exports=b():"function"==typeof define&&define.amd?define("salvattore",[],b):a.salvattore=b()}(this,function(){window.matchMedia||(window.matchMedia=function(){"use strict";var a=window.styleMedia||window.media;if(!a){var b=document.createElement("style"),c=document.getElementsByTagName("script")[0],d=null;b.type="text/css",b.id="matchmediajs-test",c.parentNode.insertBefore(b,c),d="getComputedStyle"in window&&window.getComputedStyle(b,null)||b.currentStyle,a={matchMedium:function(a){var c="@media "+a+"{ #matchmediajs-test { width: 1px; } }";return b.styleSheet?b.styleSheet.cssText=c:b.textContent=c,"1px"===d.width}}}return function(b){return{matches:a.matchMedium(b||"all"),media:b||"all"}}}()),function(){if(window.matchMedia&&window.matchMedia("all").addListener)return!1;var a=window.matchMedia,b=a("only all").matches,c=!1,d=0,e=[],f=function(){clearTimeout(d),d=setTimeout(function(){for(var b=0,c=e.length;c>b;b++){var d=e[b].mql,f=e[b].listeners||[],g=a(d.media).matches;if(g!==d.matches){d.matches=g;for(var h=0,i=f.length;i>h;h++)f[h].call(window,d)}}},30)};window.matchMedia=function(d){var g=a(d),h=[],i=0;return g.addListener=function(a){b&&(c||(c=!0,window.addEventListener("resize",f,!0)),0===i&&(i=e.push({mql:g,listeners:h})),h.push(a))},g.removeListener=function(a){for(var b=0,c=h.length;c>b;b++)h[b]===a&&h.splice(b,1)},g}}(),function(){for(var a=0,b=["ms","moz","webkit","o"],c=0;c<b.length&&!window.requestAnimationFrame;++c)window.requestAnimationFrame=window[b[c]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[b[c]+"CancelAnimationFrame"]||window[b[c]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(b){var c=(new Date).getTime(),d=Math.max(0,16-(c-a)),e=window.setTimeout(function(){b(c+d)},d);return a=c+d,e}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)})}();var a=function(a,b){"use strict";var c={},d=[],e=function(a,b,c){a.dataset?a.dataset[b]=c:a.setAttribute("data-"+b,c)};return c.obtain_grid_settings=function(b){var c,d,e=a.getComputedStyle(b,":before"),f=e.getPropertyValue("content").slice(1,-1),g=f.match(/^\s*(\d+)(?:\s?\.(.+))?\s*$/);return g?(c=g[1],d=g[2],d=d?d.split("."):["column"]):(g=f.match(/^\s*\.(.+)\s+(\d+)\s*$/),d=g[1],c=g[2],c&&(c=c.split("."))),{numberOfColumns:c,columnClasses:d}},c.add_columns=function(a,d){for(var f,g=c.obtain_grid_settings(a),h=g.numberOfColumns,i=g.columnClasses,j=new Array(+h),k=b.createDocumentFragment(),l=h;0!==l--;)f="[data-columns] > *:nth-child("+h+"n-"+l+")",j.push(d.querySelectorAll(f));j.forEach(function(a){var c=b.createElement("div"),d=b.createDocumentFragment();c.className=i.join(" "),Array.prototype.forEach.call(a,function(a){d.appendChild(a)}),c.appendChild(d),k.appendChild(c)}),a.appendChild(k),e(a,"columns",h)},c.remove_columns=function(c){var d=b.createRange();d.selectNodeContents(c);var f=Array.prototype.filter.call(d.extractContents().childNodes,function(b){return b instanceof a.HTMLElement}),g=f.length,h=f[0].childNodes.length,i=new Array(h*g);Array.prototype.forEach.call(f,function(a,b){Array.prototype.forEach.call(a.children,function(a,c){i[c*g+b]=a})});var j=b.createElement("div");return e(j,"columns",0),i.filter(function(a){return!!a}).forEach(function(a){j.appendChild(a)}),j},c.recreate_columns=function(b){a.requestAnimationFrame(function(){c.add_columns(b,c.remove_columns(b))})},c.media_query_change=function(a){a.matches&&Array.prototype.forEach.call(d,c.recreate_columns)},c.get_css_rules=function(a){var b;try{b=a.sheet.cssRules||a.sheet.rules}catch(c){return[]}return b||[]},c.get_stylesheets=function(){return Array.prototype.concat.call(Array.prototype.slice.call(b.querySelectorAll("style[type='text/css']")),Array.prototype.slice.call(b.querySelectorAll("link[rel='stylesheet']")))},c.media_rule_has_columns_selector=function(a){for(var b,c=a.length;c--;)if(b=a[c],b.selectorText&&b.selectorText.match(/\[data-columns\](.*)::?before$/))return!0;return!1},c.scan_media_queries=function(){var b=[];a.matchMedia&&(c.get_stylesheets().forEach(function(d){Array.prototype.forEach.call(c.get_css_rules(d),function(d){d.media&&c.media_rule_has_columns_selector(d.cssRules)&&b.push(a.matchMedia(d.media.mediaText))})}),b.forEach(function(a){a.addListener(c.media_query_change)}))},c.next_element_column_index=function(a){var b,c,d,e=a.children,f=e.length,g=e.length-1;for(g;g>=0&&(c=e[g],d=c.children.length,!(0!==g&&b>d));g--){if(g+1===f){g=0;break}b=d}return g},c.create_list_of_fragments=function(a){for(var c=new Array(a),d=0;d!==a;)c[d]=b.createDocumentFragment(),d++;return c},c.append_elements=function(a,b){var d=a.children,e=d.length,f=c.create_list_of_fragments(e),g=c.next_element_column_index(a);b.forEach(function(a){f[g].appendChild(a),g===e-1?g=0:g++}),Array.prototype.forEach.call(d,function(a,b){a.appendChild(f[b])})},c.prepend_elements=function(a,d){var e=a.children,f=e.length,g=c.create_list_of_fragments(f),h=f-1;d.forEach(function(a){var b=g[h];b.insertBefore(a,b.firstChild),0===h?h=f-1:h--}),Array.prototype.forEach.call(e,function(a,b){a.insertBefore(g[b],a.firstChild)});for(var i=b.createDocumentFragment(),j=d.length%f;0!==j--;)i.appendChild(a.lastChild);a.insertBefore(i,a.firstChild)},c.register_grid=function(f){if("none"!==a.getComputedStyle(f).display){var g=b.createRange();g.selectNodeContents(f);var h=b.createElement("div");h.appendChild(g.extractContents()),e(h,"columns",0),c.add_columns(f,h),d.push(f)}},c.init=function(){var a=b.querySelectorAll("[data-columns]");Array.prototype.forEach.call(a,c.register_grid),c.scan_media_queries()},c.init(),{append_elements:c.append_elements,prepend_elements:c.prepend_elements,register_grid:c.register_grid}}(window,window.document);return a});

/* Tipr tooltip */
(function($){$.fn.tipr=function(options){var set=$.extend({"speed":200,"mode":"bottom"},options);return this.each(function(){var tipr_cont=".tipr_container_"+set.mode;$(this).hover(function(){var out='<div class="tipr_container_'+set.mode+'"><div class="tipr_point_'+set.mode+'"><div class="tipr_content">'+$(this).attr("data-tip")+"</div></div></div>";$(this).append(out);var w_t=$(tipr_cont).outerWidth();var w_e=$(this).width();var m_l=w_e/2-w_t/2 - 5;$(tipr_cont).css("margin-left",m_l+"px");$(this).removeAttr("title");
$(tipr_cont).fadeIn(set.speed)},function(){$(tipr_cont).remove()})})}})(jQuery);

/* Clearing form fields */
(function($){$.fn.clearFields=function(m){var y="oldValue";var z="changed";var t="true";var i="input[type=";var j="text]";var c="textarea";var v="password]";var a={'selector':'*','textFields':true,'textAreas':true,'passwordFields':true};var b={c:function(e){if(e.val().trim()==""){e.val(e.attr(y)).removeAttr(y).removeAttr(z);}else{e.attr(z,t);}},d:function(e){if(e.attr(z)!=t){e.attr(y,e.val()).val("");}},k:function(e){if(g!="*"){e=e.filter(g);}e.focus(function(){b.d($(this));}).blur(function(){b.c($(this));});}};var g;return this.each(function(){if(c){a=$.extend(a,m);}var d=a.textFields;var e=a.textAreas;var f=a.passwordFields;if(!(d||e||f)){return;}g=a.selector;if(d){b.k($(this).find(i+j));}if(f){b.k($(this).find(i+v));}if(e){b.k($(this).find(c));}});};})(jQuery);

/*
jQuery Waypoints - v2.0.3
Copyright (c) 2011-2013 Caleb Troughton
Dual licensed under the MIT license and GPL license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function(){var t=[].indexOf||function(t){for(var e=0,n=this.length;e<n;e++){if(e in this&&this[e]===t)return e}return-1},e=[].slice;(function(t,e){if(typeof define==="function"&&define.amd){return define("waypoints",["jquery"],function(n){return e(n,t)})}else{return e(t.jQuery,t)}})(this,function(n,r){var i,o,l,s,f,u,a,c,h,d,p,y,v,w,g,m;i=n(r);c=t.call(r,"ontouchstart")>=0;s={horizontal:{},vertical:{}};f=1;a={};u="waypoints-context-id";p="resize.waypoints";y="scroll.waypoints";v=1;w="waypoints-waypoint-ids";g="waypoint";m="waypoints";o=function(){function t(t){var e=this;this.$element=t;this.element=t[0];this.didResize=false;this.didScroll=false;this.id="context"+f++;this.oldScroll={x:t.scrollLeft(),y:t.scrollTop()};this.waypoints={horizontal:{},vertical:{}};t.data(u,this.id);a[this.id]=this;t.bind(y,function(){var t;if(!(e.didScroll||c)){e.didScroll=true;t=function(){e.doScroll();return e.didScroll=false};return r.setTimeout(t,n[m].settings.scrollThrottle)}});t.bind(p,function(){var t;if(!e.didResize){e.didResize=true;t=function(){n[m]("refresh");return e.didResize=false};return r.setTimeout(t,n[m].settings.resizeThrottle)}})}t.prototype.doScroll=function(){var t,e=this;t={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};if(c&&(!t.vertical.oldScroll||!t.vertical.newScroll)){n[m]("refresh")}n.each(t,function(t,r){var i,o,l;l=[];o=r.newScroll>r.oldScroll;i=o?r.forward:r.backward;n.each(e.waypoints[t],function(t,e){var n,i;if(r.oldScroll<(n=e.offset)&&n<=r.newScroll){return l.push(e)}else if(r.newScroll<(i=e.offset)&&i<=r.oldScroll){return l.push(e)}});l.sort(function(t,e){return t.offset-e.offset});if(!o){l.reverse()}return n.each(l,function(t,e){if(e.options.continuous||t===l.length-1){return e.trigger([i])}})});return this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}};t.prototype.refresh=function(){var t,e,r,i=this;r=n.isWindow(this.element);e=this.$element.offset();this.doScroll();t={horizontal:{contextOffset:r?0:e.left,contextScroll:r?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:r?0:e.top,contextScroll:r?0:this.oldScroll.y,contextDimension:r?n[m]("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return n.each(t,function(t,e){return n.each(i.waypoints[t],function(t,r){var i,o,l,s,f;i=r.options.offset;l=r.offset;o=n.isWindow(r.element)?0:r.$element.offset()[e.offsetProp];if(n.isFunction(i)){i=i.apply(r.element)}else if(typeof i==="string"){i=parseFloat(i);if(r.options.offset.indexOf("%")>-1){i=Math.ceil(e.contextDimension*i/100)}}r.offset=o-e.contextOffset+e.contextScroll-i;if(r.options.onlyOnScroll&&l!=null||!r.enabled){return}if(l!==null&&l<(s=e.oldScroll)&&s<=r.offset){return r.trigger([e.backward])}else if(l!==null&&l>(f=e.oldScroll)&&f>=r.offset){return r.trigger([e.forward])}else if(l===null&&e.oldScroll>=r.offset){return r.trigger([e.forward])}})})};t.prototype.checkEmpty=function(){if(n.isEmptyObject(this.waypoints.horizontal)&&n.isEmptyObject(this.waypoints.vertical)){this.$element.unbind([p,y].join(" "));return delete a[this.id]}};return t}();l=function(){function t(t,e,r){var i,o;r=n.extend({},n.fn[g].defaults,r);if(r.offset==="bottom-in-view"){r.offset=function(){var t;t=n[m]("viewportHeight");if(!n.isWindow(e.element)){t=e.$element.height()}return t-n(this).outerHeight()}}this.$element=t;this.element=t[0];this.axis=r.horizontal?"horizontal":"vertical";this.callback=r.handler;this.context=e;this.enabled=r.enabled;this.id="waypoints"+v++;this.offset=null;this.options=r;e.waypoints[this.axis][this.id]=this;s[this.axis][this.id]=this;i=(o=t.data(w))!=null?o:[];i.push(this.id);t.data(w,i)}t.prototype.trigger=function(t){if(!this.enabled){return}if(this.callback!=null){this.callback.apply(this.element,t)}if(this.options.triggerOnce){return this.destroy()}};t.prototype.disable=function(){return this.enabled=false};t.prototype.enable=function(){this.context.refresh();return this.enabled=true};t.prototype.destroy=function(){delete s[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};t.getWaypointsByElement=function(t){var e,r;r=n(t).data(w);if(!r){return[]}e=n.extend({},s.horizontal,s.vertical);return n.map(r,function(t){return e[t]})};return t}();d={init:function(t,e){var r;if(e==null){e={}}if((r=e.handler)==null){e.handler=t}this.each(function(){var t,r,i,s;t=n(this);i=(s=e.context)!=null?s:n.fn[g].defaults.context;if(!n.isWindow(i)){i=t.closest(i)}i=n(i);r=a[i.data(u)];if(!r){r=new o(i)}return new l(t,r,e)});n[m]("refresh");return this},disable:function(){return d._invoke(this,"disable")},enable:function(){return d._invoke(this,"enable")},destroy:function(){return d._invoke(this,"destroy")},prev:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e>0){return t.push(n[e-1])}})},next:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e<n.length-1){return t.push(n[e+1])}})},_traverse:function(t,e,i){var o,l;if(t==null){t="vertical"}if(e==null){e=r}l=h.aggregate(e);o=[];this.each(function(){var e;e=n.inArray(this,l[t]);return i(o,e,l[t])});return this.pushStack(o)},_invoke:function(t,e){t.each(function(){var t;t=l.getWaypointsByElement(this);return n.each(t,function(t,n){n[e]();return true})});return this}};n.fn[g]=function(){var t,r;r=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(d[r]){return d[r].apply(this,t)}else if(n.isFunction(r)){return d.init.apply(this,arguments)}else if(n.isPlainObject(r)){return d.init.apply(this,[null,r])}else if(!r){return n.error("jQuery Waypoints needs a callback function or handler option.")}else{return n.error("The "+r+" method does not exist in jQuery Waypoints.")}};n.fn[g].defaults={context:r,continuous:true,enabled:true,horizontal:false,offset:0,triggerOnce:false};h={refresh:function(){return n.each(a,function(t,e){return e.refresh()})},viewportHeight:function(){var t;return(t=r.innerHeight)!=null?t:i.height()},aggregate:function(t){var e,r,i;e=s;if(t){e=(i=a[n(t).data(u)])!=null?i.waypoints:void 0}if(!e){return[]}r={horizontal:[],vertical:[]};n.each(r,function(t,i){n.each(e[t],function(t,e){return i.push(e)});i.sort(function(t,e){return t.offset-e.offset});r[t]=n.map(i,function(t){return t.element});return r[t]=n.unique(r[t])});return r},above:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset<=t.oldScroll.y})},below:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset>t.oldScroll.y})},left:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset<=t.oldScroll.x})},right:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset>t.oldScroll.x})},enable:function(){return h._invoke("enable")},disable:function(){return h._invoke("disable")},destroy:function(){return h._invoke("destroy")},extendFn:function(t,e){return d[t]=e},_invoke:function(t){var e;e=n.extend({},s.vertical,s.horizontal);return n.each(e,function(e,n){n[t]();return true})},_filter:function(t,e,r){var i,o;i=a[n(t).data(u)];if(!i){return[]}o=[];n.each(i.waypoints[e],function(t,e){if(r(i,e)){return o.push(e)}});o.sort(function(t,e){return t.offset-e.offset});return n.map(o,function(t){return t.element})}};n[m]=function(){var t,n;n=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(h[n]){return h[n].apply(null,t)}else{return h.aggregate.call(null,n)}};n[m].settings={resizeThrottle:100,scrollThrottle:30};return i.load(function(){return n[m]("refresh")})})}).call(this);

/* Fitvids - responsive video */
(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null};if(!document.getElementById("fit-vids-style")){var r=document.createElement("div"),i=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0],s="&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";r.className="fit-vids-style";r.id="fit-vids-style";r.style.display="none";r.innerHTML=s;i.parentNode.insertBefore(r,i)}if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=e(this).find(t.join(","));r=r.not("object object");r.each(function(){var t=e(this);if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),r=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),i=n/r;if(!t.attr("id")){var s="fitvid"+Math.floor(Math.random()*999999);t.attr("id",s)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",i*100+"%");t.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto)

