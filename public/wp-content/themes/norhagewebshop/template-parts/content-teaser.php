<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package norhagewebshop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(['teaser', 'alignwide']); ?>>
	
		<?php
			$title = get_the_title( );
		    $thumb = get_the_post_thumbnail($post, 'post-thumbnail', ['loading' => 'lazy', 'fetchpriority' => 'auto']);
		    $categories = get_the_category();
	    ?>
	    
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-thumbnail" ><?php echo $thumb; ?></a>

		<div class="column-wrap" >
			<h2 class="title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $title ); ?></a></h2>
			
			<div class="entry-meta">
				<?php norhagewebshop_posted_on();  ?>
				<?php if(!empty($categories)){ ?>
					<ul class="categories">
					<?php foreach($categories as $cat){
						printf('<li><a href="%s">%s</a></li>', esc_url( get_category_link( $cat->term_id ) ), $cat->name);
					} ?>
					</ul> 
				<?php } ?>
			</div>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div>
</article><!-- #post-<?php the_ID(); ?> -->
