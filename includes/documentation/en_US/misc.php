<h1>Miscellannous</h1>
<div class="about-text">Here you will find documentation for other post-types and functions</div>

<h3>FAQ posts</h3>


<?php if(!is_plugin_active('veuse-faq/veuse-faq.php')):?>
<div id="message" class="error below-h2">
	

	<h4>The Veuse FAQ plugin is not installed or activated!</h4>
	

	<p> Before you can create FAQ, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page and reactivate it.</p>
	<p>
	The Veuse FAQ plugin is licenced as GPL, and can also be found on github: <a href="https://github.com/veuse/veuse-faq">https://github.com/veuse/veuse-faq</a>
	</p>
</div>

<?php else:?>

	<h4>Documentation for FAQ is located under the FAQ menu.</h4>
	<p>The reason is that the FAQ is installed as a plugin, and is not directly related to the theme</p>
	<p><a href="edit.php?post_type=faq&page=faq_documentation" class="button button-primary">Click here to open faq documentation</a></p>

<?php endif;?>

<br>
<hr>

<h3>Pricetables</h3>

<?php if(is_plugin_active('veuse-pricetable/veuse-pricetable.php')):?>
	
	<h4>Documentation for Pricetable is located under the Pricetable menu.</h4>
	<p>The reason is that the Pricetable is installed as a plugin, and is not directly related to the theme</p>
	<p><a href="edit.php?post_type=priceitem&page=pricetable_documentation" class="button button-primary">Click here to open pricetable documentation</a></p>
	
<?php else:?>

	<div id="message" class="error below-h2">
	
	<h4>The Veuse Pricetable plugin is not installed or activated!</h4>

	<p> Before you can create pricetables, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page and reactivate it.</p>
	<p>
	The Veuse Pricetable plugin is licenced as GPL, and can also be found on github: <a href="https://github.com/veuse/veuse-pricetable">https://github.com/veuse/veuse-faq</a>
	</p>
</div>

	
<?php endif;?>

<br>
<hr>

<h3>Sliders</h3>

<?php if(is_plugin_active('veuse-slider/veuse-slider.php')):?>
	
	<h4>Documentation for Slider is located under the Slideshow menu.</h4>
	<p>The reason is that the slideshow is installed as a plugin, and is not directly related to the theme</p>
	<p><a href="edit.php?post_type=slideshow&page=slider_documentation" class="button button-primary">Click here to open slider documentation</a></p>
	
<?php else:?>

	<div id="message" class="error below-h2">
	
	<h4>The Veuse Slider plugin is not installed or activated!</h4>

	<p> Before you can create slideshows, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page and reactivate it.</p>
	<p>
	The Veuse Slider plugin is licenced as GPL, and can also be found on github: <a href="https://github.com/veuse/veuse-slider">https://github.com/veuse/veuse-faq</a>
	</p>
</div>

	
<?php endif;?>

<br>

<hr>

<h3>Staff/employees</h3>

<p>Info here</p>


