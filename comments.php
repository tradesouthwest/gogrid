<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
    return;
        ?><ol id="gogridComm" class="commentlist" itemscope="commentText" 
                                  itemtype="https://schema.org/UserComments">
        <?php
            wp_list_comments( array(
                'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
        ?></ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<ul id="comment-nav-below" class="navigation comment-navigation">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link(
                    esc_attr__("&laquo; Older Comments", "gogrid") ); ?></li>
			<li class="next"><?php next_comments_link(
                    esc_attr__("Newer Comments &raquo;", "gogrid") ); ?></li>
		</ul>
	</ul>
	<?php endif; ?>

<?php 
    $wurl = wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) );
    $comment_args = array(
    // Change the title of send button
    'label_submit' => esc_attr__( 'Send', 'gogrid' ),

    // Change the title of the reply section
    'title_reply' => esc_attr__( 'Write a Reply or Comment', 'gogrid' ),

    // Remove "Text or HTML to be displayed after the set of comment fields".
    'comment_notes_after' => '<p class="form-allowed-tags">'
         . esc_html__( 'You may use these ', 'gogrid' ) . '<abbr title="' 
         . esc_attr__( 'HyperText Markup Language', 'gogrid') .'">'
         . esc_html__( 'HTML', 'gogrid' ) . '</abbr>'
         . esc_html__( 'tags and attributes: ', 'gogrid' ) . ' <code>'
         . allowed_tags() . '</code></p>',

    // Redefine default textarea (the comment body).
    'comment_field' => '<p class="comment-form-comment"><label for="comment">'
        . esc_attr__( 'Respond', 'gogrid' )
        . '<span class="screen-reader-text">'
        . esc_html__( 'Comment textarea box', 'gogrid' ) . '</label>
        <br /><textarea id="comment" name="comment" aria-required="true">
        </textarea></p>',

    //logged in check
    'must_log_in' => '<p class="must-log-in">'
        . esc_html__( 'You must be ', 'gogrid' ) . '<a href="'. esc_url($wurl) 
        .'">'. esc_html__( 'logged in ', 'gogrid' ) .'</a>'
        . esc_html__( 'to post a comment.', 'gogrid' ) .'</p>',


    'comment_notes_before' => '<p class="comment-notes">' .
        esc_html__( 'Your email address will not be published.', 'gogrid' ) 
        . '</p>',

);
                comment_form( $comment_args ); ?>
