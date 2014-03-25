<h1><?php _e('Portfolio','veuse');?></h1>


<?php if(!is_plugin_active('veuse-portfolio/veuse-portfolio.php')):?>

<div id="message" class="error below-h2">

	<p><b>Important!</b></p>
	<p>The veuse-portfolio plugin is not installed and/or activated.</p>

	<p> Before you can create a portfolio, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page an reactivate it.</p>
	<p>
	The veuse-portfolio plugin is licenced as GPL, and can be found at github: <a href="https://github.com/veuse/veuse-portfolio">https://github.com/veuse/veuse-portfolio</a>
	</p>
</div>

<?php endif;?>

<h4>Documentation for portfolio is located under the portfolio menu.</h4>
<p>The reason for this is that the portfolio is installed as a plugin, and is not directly related to the theme</p>
<a href="edit.php?post_type=portfolio&page=portfolio_documentation" class="button button-primary">Click here to open portfolio documentation</a>
	




