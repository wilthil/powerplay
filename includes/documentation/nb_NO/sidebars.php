<h1><?php _e('Sidebars','veuse');?></h1>



<?php if(!is_plugin_active('veuse-portfolio/veuse-portfolio.php')):?>
<div id="message" class="alert below-h2"><p><b>Important!</b> To create sidebars, you need to have the veuse-sidebars plugin installed and activated. This plugin is automatically installed and activated on theme activation.</p></div>

<?php else:?>
<h4>A sidebar-generator is included in this theme. This lets you create as many sidebars/widget areas as you like.</h4>
<p>To create a sidebar, go to <a href="edit.php?post_type=sidebar" target="blank">Appearance -> Sidebar generator</a> and click <a href="post-new.php?post_type=sidebar" target="blank"><b>Add New Sidebar</b></a>.</p>

<p>After you have created your sidebars, you can select them in a dropdown in your edit-post page.



<?php endif;?>