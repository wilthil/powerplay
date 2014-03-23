<h1>Shortcodes</h1>

<div class="about-text">The theme itself has very few shortcodes. Most are located in the plugins that come bundled with the theme, especially in the Veuse Uikit plugin.</div>

<h3>Shortcode reference:</h3>

<h3>
<a name="alerts" class="anchor" href="#alerts"><span class="octicon octicon-link"></span></a>Alerts</h3>

<pre><code>[veuse_alert icon="" color=""] The text you want to display [/veuse_alert]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>Color: white, red, yellow, green, grey or blue ( Optional. Default is blue )</li>
<li>Icon: Select any Fontawesome icon from <a href="http://fontawesome.io">http://fontawesome.io</a>. Leave out fa- in the icon name. Write only icon name like '<em>star-o</em>' ( Optional. Default is NULL )</li>
</ul><hr><h3>
<a name="buttons" class="anchor" href="#buttons"><span class="octicon octicon-link"></span></a>Buttons</h3>

<pre><code>[veuse_button href="" size="" color="" style="" align="" target="" width="" icon="" bevel="" ]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>href: the url you want the button to link to ( Required ).</li>
<li>size: tiny, small, medium, large ( Optional. Default is small ) </li>
<li>align: left, right, none, justif ( Optional. Default is none )</li>
<li>target: none or blank to open link in new tab/window.</li>
<li>icon: Select any Fontawesome icon from <a href="http://fontawesome.io/icons">http://fontawesome.io/icons</a>. Leave out fa- in the icon name. Write only icon name like '<em>star-o</em>'</li>
</ul><hr><h3>
<a name="attachment-download" class="anchor" href="#attachment-download"><span class="octicon octicon-link"></span></a>Attachment Download</h3>

<p>The download-shortcode inserts a section with title, description and a button linking to your attachment file. Great for inserting call-to-actions for i.e. downloading pdf's. </p>

<pre><code>[veuse_download id="" title="" button_text=""] Some descriptive text here, like an excerpt [/veuse_download]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: A title text to go with the download-box ( Required )</li>
<li>id: the id of the file you want to be downloaded ( Required )</li>
<li>button_text: The text for the link ( Default is <em>Download</em> )</li>
</ul><hr><h3>
<a name="callout" class="anchor" href="#callout"><span class="octicon octicon-link"></span></a>Callout</h3>

<p>The callout-shortcode inserts a call-to-action section on your page. Great for conversions.</p>

<pre><code>[veuse_callout caption="" link="" buttontext="" color="" icon="" ]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>caption: The text to go in the callout section. ( Required. Default: None )</li>
<li>link: The url you want the button to point to ( Required. Default: None )</li>
<li>buttontext: The text for the link/button ( Required. Default: None )</li>
<li>color: The color of the callout-section ( Optional. Default: None )</li>
<li>icon: The name of the fontawesome-icon you want to use ( Optional. Default None )</li>
</ul><hr><h3>
<a name="dividers" class="anchor" href="#dividers"><span class="octicon octicon-link"></span></a>Dividers</h3>

<pre><code>[veuse_divider title="" icon="" textstyle="" alignment=""]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: Text to go in the dividerline</li>
<li>icon: Enter name of fontawesome icon to go in the dividerline. See <a href="http://fontawesome.io">http://fontawesome.io</a>
</li>
<li>textstyle: Text size ( h3, h4, h5, h6 or paragraph. Optional. Default: h4 )</li>
<li>alignment: Position of text and icon in dividerline ( left, center or right. Optional. Default: center )</li>
</ul><hr><h3>
<a name="featured-page" class="anchor" href="#featured-page"><span class="octicon octicon-link"></span></a>Featured page</h3>

<pre><code>[veuse_page id="" imagesize="" custom_imagesize="" link="" button_text="" image=""]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>id: The id of the page you want to pull content from</li>
<li>imagesize: Enter name of imagesize ( Thumbnail, Medium, Large, or any other registered imagesize. Optional. Default: medium)</li>
<li>custom_imagesize: Manually define an exact image size ( Example: If you enter 300*200, it will output an image of 300px * 200px )</li>
<li>link: Selec if you want to add a link to the full version of the page. Enter <em>true</em> or <em>false</em>. ( Optional. Default: true )</li>
<li>button_text: The text you want in the link/button. (Optional. Default: Read more )</li>
<li>image: Select if you want to display the pages featured image. ( true or false. Default: true )</li>
</ul><hr><h3>
<a name="posts-slider" class="anchor" href="#posts-slider"><span class="octicon octicon-link"></span></a>Posts slider</h3>

<pre><code>[veuse_postslider categories="" perpage="" order="" orderby="" width="" height=""]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>categories: The id's of the categories you want to pull posts from</li>
<li>perpage: How many posts to show ( -1 == all posts )</li>
<li>order: The order for the posts. Ascending (ASC) or descending (DESC). Optional. Default is DESC</li>
<li>orderby: Order post by title or date ( Optional. Default id date )</li>
<li>width: Value for slider width, calculated in pixels ( Optional. Default is 600 ).</li>
<li>height: Value for slider height, calculated in pixels ( Optional. Default is 300 ). </li>
</ul><hr><h3>
<a name="progress-bars" class="anchor" href="#progress-bars"><span class="octicon octicon-link"></span></a>Progress bars</h3>

<pre><code>[veuse_progressbar width="" color="" title=""]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: A caption text for the progress bar</li>
<li>color: Set color for the bar ( red, green, yellow, blue, orange, black, lightblue, silver, red, pink, purple, magenta, lightgreen, forrestgreen, darkblue, darkbrown, brown, grey )</li>
<li>width: A percentage value (A value of 90 == 90%. Do not enter % letter ) </li>
</ul><hr><h3>
<a name="tab" class="anchor" href="#tab"><span class="octicon octicon-link"></span></a>Tab</h3>

<pre><code>[veuse_tab title="" icon=""] Tab content goes here [/veuse_tab]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: The tab button text</li>
<li>icon: Add name of fontawesome icon you want to use. ( Optional. Default is NULL. View fonts at <a href="http://fontawesome.io">http://fontawesome.io</a>
</li>
</ul><hr><h3>
<a name="testimonial" class="anchor" href="#testimonial"><span class="octicon octicon-link"></span></a>Testimonial</h3>

<pre><code>[veuse_testimonial name="" designation=""] Testimonial text goes here [/veuse_testimonial]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>name: The name of the testimonial writer</li>
<li>designation: The testimonial writers job title</li>
</ul><hr><h3>
<a name="toggle" class="anchor" href="#toggle"><span class="octicon octicon-link"></span></a>Toggle</h3>

<pre><code>[veuse_toggle title="" icon=""] Toggle content goes here [/veuse_toggle]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: The toggle button text</li>
<li>icon: Add name of fontawesome icon you want to use. ( Optional. Default is NULL. View fonts at <a href="http://fontawesome.io">http://fontawesome.io</a>
</li>
</ul><hr><h3>
<a name="vertical-tab" class="anchor" href="#vertical-tab"><span class="octicon octicon-link"></span></a>Vertical tab</h3>

<pre><code>[veuse_verticaltab title="" icon=""] Toggle content goes here [/veuse_verticaltab]
</code></pre>

<p><strong>Attributes</strong></p>

<ul>
<li>title: The tab button text</li>
<li>icon: Add name of fontawesome icon you want to use. ( Optional. Default is NULL. View fonts at <a href="http://fontawesome.io">http://fontawesome.io</a>
</li>
</ul>