<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'veuse' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback'	  => 'veuse_comments'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'veuse' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'veuse' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'veuse' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'veuse' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$args = array(
	  'id_form'           => 'commentform',
	  'id_submit'         => 'submit',
	  'title_reply'       => __( 'Leave a Reply','veuse' ),
	  'title_reply_to'    => __( 'Leave a Reply to %s','veuse' ),
	  'cancel_reply_link' => __( 'Cancel Reply','veuse' ),
	  'label_submit'      => __( 'Post Comment','veuse' ),
	
	  'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . __( 'Enter comment...', 'veuse' ) .
	    '</textarea></p>',
	
	  'must_log_in' => '<p class="must-log-in">' .
	    sprintf(
	      __( 'You must be <a href="%s">logged in</a> to post a comment.','veuse' ),
	      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
	    ) . '</p>',
	
	  'logged_in_as' => '<p class="logged-in-as">' .
	    sprintf(
	    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
	      admin_url( 'profile.php' ),
	      $user_identity,
	      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
	    ) . '</p>',
	
		/*	
	  'comment_notes_before' => '<p class="comment-notes">' .
	    __( 'Your email address will not be published.' ) .
	    '</p>',
	    
	   */
	   
	    'comment_notes_before' => '',
	/*
	  'comment_notes_after' => '<p class="form-allowed-tags">' .
	    sprintf(
	      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
	      ' <code>' . allowed_tags() . '</code>'
	    ) . '</p>',
	*/
		
		'comment_notes_after' => '',
		
		
	  'fields' => apply_filters( 'comment_form_default_fields', array(
	
	    'author' =>
	      '<div class="row "><p class="comment-form-author small-12 large-4 columns">' .
	      '<input id="author" name="author" type="text" value="' . __( 'Name', 'domainreference' ) .
	      '" size="30"' . $aria_req . ' /></p>',
	
	    'email' =>
	      '<p class="comment-form-email small-12 large-4 columns">' .
	      '<input id="email" name="email" type="text" value="' . __( 'Email', 'domainreference' ) .
	      '" size="30"' . $aria_req . ' /></p>',
	
	    'url' =>
	      '<p class="comment-form-url small-12 large-4 columns">' .
	      '<input id="url" name="url" type="text" value="' . __( 'Website', 'domainreference' ) .
	      '" size="30" /></p></div>'
	    )
	  ),
	);

	
	
	comment_form($args); ?>

</div><!-- #comments -->