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
		    
		    if (scrollTop > stickyNavTop + 28) {
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
		
		
        	
    	$('.parallax > div').parallax({ speed: 0.5 });
    		
		/* Make header sticky and resize */
    	$('#header').stickyNav(); 
    	
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
		$('#post-title-wrapper h3, #post-content > .entry-content').animate({'opacity':'1'}, 500, 'swing');
		$('#post-content > .entry-content .panel, #post-content > .entry-content > ul, #post-content article').css({'position':'relative', 'bottom':'-20px'});
		$('#post-content .entry-content .panel, #post-content .entry-content > ul, #post-content article').waypoint(function() {
			$(this).animate({'opacity':'1', 'bottom':'0px'}, 600, 'swing');
		}, { offset: '100%' });
		
		
	   
	
	    
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

// Foggy, v1.1
//
// Description: jQuery plugin for blurring page elements
// Homepage:    http://nbartlomiej.github.com/foggy
// Author:      nbartlomiej@gmail.com

(function(a){a.fn.foggy=function(b){var c={opacity:.8,blurRadius:2,quality:16,cssFilterSupport:true};var d={opacity:1,blurRadius:0};var e;if(b==false){e=a.extend(c,d)}else{e=a.extend(c,b)}var f=function(a,b,c,d){this.content=a;this.position=b;this.offset=c;this.opacity=d};f.prototype.render=function(b){a("<div/>",{html:this.content,"class":"foggy-pass-"+this.position}).css({position:this.position,opacity:this.opacity,top:this.offset[0],left:this.offset[1]}).appendTo(b)};var g=function(a){this.radius=a};g.prototype.includes=function(a,b){if(Math.pow(a,2)+Math.pow(b,2)<=Math.pow(this.radius,2)){return true}else{return false}};g.prototype.points=function(){var a=[];for(var b=-this.radius;b<=this.radius;b++){for(var c=-this.radius;c<=this.radius;c++){if(this.includes(b,c)){a.push([b,c])}}}return a};var h=function(a,b){this.element=a;this.settings=b};h.prototype.calculateOffsets=function(b,c){var d=a.grep((new g(b)).points(),function(a){return a[0]!=0||a[1]!=0});var e;if(d.length<=c){e=d}else{var f=d.length-c;var h=[];for(var i=0;i<f;i++){h.push(Math.round(i*(d.length/f)))}e=a.grep(d,function(b,c){if(a.inArray(c,h)>=0){return false}else{return true}})}return e};h.prototype.getContent=function(){var b=a(this.element).find(".foggy-pass-relative")[0];if(b){return a(b).html()}else{return a(this.element).html()}};h.prototype.render=function(){var b=this.getContent();a(this.element).empty();var c=a("<div/>").css({position:"relative"});var d=this.calculateOffsets(this.settings.blurRadius*2,this.settings.quality);var e=this.settings.opacity*1.2/(d.length+1);(new f(b,"relative",[0,0],e)).render(c);a(d).each(function(a,d){(new f(b,"absolute",d,e)).render(c)});c.appendTo(this.element)};var i=function(a,b){this.element=a;this.settings=b};i.prototype.render=function(){var b=(""+e.opacity).slice(2,4);var c=this.settings.blurRadius;a(this.element).css({"-webkit-filter":"blur("+c+"px)",opacity:e.opacity})};return this.each(function(a,b){if(e.cssFilterSupport&&"-webkit-filter"in document.body.style){(new i(b,e)).render()}else{(new h(b,e)).render()}})}})(jQuery);

(function($){$.fn.tipr=function(options){var set=$.extend({"speed":200,"mode":"bottom"},options);return this.each(function(){var tipr_cont=".tipr_container_"+set.mode;$(this).hover(function(){var out='<div class="tipr_container_'+set.mode+'"><div class="tipr_point_'+set.mode+'"><div class="tipr_content">'+$(this).attr("data-tip")+"</div></div></div>";$(this).append(out);var w_t=$(tipr_cont).outerWidth();var w_e=$(this).width();var m_l=w_e/2-w_t/2 - 5;$(tipr_cont).css("margin-left",m_l+"px");$(this).removeAttr("title");
$(tipr_cont).fadeIn(set.speed)},function(){$(tipr_cont).remove()})})}})(jQuery);

(function($){$.fn.clearFields=function(m){var y="oldValue";var z="changed";var t="true";var i="input[type=";var j="text]";var c="textarea";var v="password]";var a={'selector':'*','textFields':true,'textAreas':true,'passwordFields':true};var b={c:function(e){if(e.val().trim()==""){e.val(e.attr(y)).removeAttr(y).removeAttr(z);}else{e.attr(z,t);}},d:function(e){if(e.attr(z)!=t){e.attr(y,e.val()).val("");}},k:function(e){if(g!="*"){e=e.filter(g);}e.focus(function(){b.d($(this));}).blur(function(){b.c($(this));});}};var g;return this.each(function(){if(c){a=$.extend(a,m);}var d=a.textFields;var e=a.textAreas;var f=a.passwordFields;if(!(d||e||f)){return;}g=a.selector;if(d){b.k($(this).find(i+j));}if(f){b.k($(this).find(i+v));}if(e){b.k($(this).find(c));}});};})(jQuery);
