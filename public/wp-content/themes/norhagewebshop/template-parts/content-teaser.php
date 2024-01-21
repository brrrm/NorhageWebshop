<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package norhagewebshop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(['teaser']); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php
			$title = get_the_title( );
		    $thumb = get_the_post_thumbnail();
	    ?>
	    <h2 class="title"><?php echo esc_html( $title ); ?></h2>
		<?php echo $thumb; ?>
    </a>
</article><!-- #post-<?php the_ID(); ?> -->
