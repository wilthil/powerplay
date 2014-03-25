<h1><?php _e('Pages','veuse');?></h1>

<div class="about-text">In your page edit screen you will se a meta-panel called Page Elements. This panel enables you to select which elements you want to display on your page. As default, Page title and content are checked, but you can also set the page to display featured image, gallery, video, an excerpt and a submenu with the pages child-pages.</div> 

<h4>To display featured image</h4>
<p>Add a featured image to the page, and check the checkbox for "Featured image" in the "Page Elements" meta-panel.</p>

<h4>To display gallery</h4>
<p>Add images to the "Image gallery"" meta-panel, and check the checkbox for "Featured image"</p>

<h4>To display excerpt</h4>
<p>Enter an excerpt in the Excerpt panel, and check the checkbox for "Excerpt"</p>

<h4>To display video</h4>
<p>Add a video to the "Video" meta-panel, and check the checkbox for "Video"</p>

<h4>To display submenu</h4>
<p>Check the checkbox for "submenu". Any child pages will be displayed in a menu in a sidebar. (This only works on pages with sidebars)</p>

<hr>

<h2>Page templates</h2>
<p>Several page templates come with the theme: 
	<ul>
		<li>Full width (No sidebar)</li>
		<li>Sidebar on left</li>
		<li>Sidebar on right</li>
	</ul>	
	<p>You also have a template for Portfolio, which requires you have the veuse-portfolio plugin installed and activated.</p>
	<p><b>PS!</b> You can choose default page template in the theme options page.</p>
	
<hr>

<h2>Page sections</h2>
<?php if(class_exists('VeuseSections')):?>

	<div id="message" class="error below-h2">

	<p><b>Important!</b></p>
	<p>The veuse-sections plugin is not installed and/or activated.</p>

	<p> Before you can create page sections, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page an reactivate it.</p>
	<p>
	The veuse-sections plugin is licenced as GPL, and can be found at github: <a href="https://github.com/veuse/veuse-sections">https://github.com/veuse/veuse-sections</a>
	</p>
</div>

<?php else:?>

<?php endif;?>