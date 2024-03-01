<?php
/**
 * Headerblock Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$title			= get_sub_field( 'title' ) ?? false;
$text			= get_sub_field('text') ?? '';
$projects		= get_field( 'projects' )?? get_sub_field( 'projects' );
$text_snippet	= get_field( 'show_text_snippet' )?? get_sub_field( 'show_text_snippet' );

// If no posts have been selected, load all the posts from this project's post-type.
if(!$projects || empty($projects)){
	global $post;

	$projects = get_posts([
		'post_type' => 'project',
		'meta_query' => [
			[
				'key' => 'product_project_relation', // name of custom field
				'value' => '"' . $post->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			],
		]
	]);
}

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'projects-block norhage-block slider';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

if ( empty( $block['align'] ) ) {
	$class_name .= ' alignfull';
}else{
    $class_name .= ' align' . $block['align'];
}
if($text_snippet){
	$class_name .= ' with-text-snippets';
}

$innerBlocksTemplate = [
	[
		'core/heading',
		[
			'level'	=> 2,
			'content' => 'Our quality? Have a look for yourself!'
		]
	],
	[
		'core/paragraph',
		[
			'content' => 'We take pride in the quality and durabillity of our products.' 
		]
	],
	[
		'core/button',
		[ 
			'text' => 'All showcases',
			'url' => '/projects'
		]
	]
];
$allowedBlocks = ['core/heading', 'core/paragraph', 'core/list', 'core/list-item', 'core/button'];
?>


<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" >
	<div class="title-col">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowedBlocks ) ); ?>" 
			template="<?php echo esc_attr( wp_json_encode( $innerBlocksTemplate ) ); ?>" />
		<?php if($title): ?>
			<h2><?php echo esc_html( $title ); ?></h2>
			<?php echo $text; ?>
		<?php endif; ?>

		<ul class="slider-nav">
			<li><button class="left"><?php _e('Left', 'norhageindustri'); ?></button></li>
			<li><button class="right"><?php _e('Right', 'norhageindustri'); ?></button></li>
		</ul>

	</div>
	<div class="projects-col">
		<?php if($projects): ?>
			<ul>

			<?php foreach($projects as $project):
				$permalink = get_permalink( $project->ID );
        		$title = get_the_title( $project->ID );
        		$thumb = get_the_post_thumbnail($project->ID);
        	?>
				<li class="image-button">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo $thumb; ?></a>
					<h3 class="title"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
					<?php if($text_snippet): ?>
						<p class="excerpt"><?php echo wp_strip_all_tags(get_the_excerpt()); ?></p>
						<p><a href="<?php echo esc_url( $permalink ); ?>"><?php echo __( 'Read more ->' ); ?></a></p>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
			</ul>
			<?php 
		    // Reset the global post object so that the rest of the page works correctly.
		    wp_reset_postdata(); ?>
		<?php else: ?>
			<ul>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
				<li class="image-button"></li>
			</ul>
		<?php endif; ?>
	</div>
</div>