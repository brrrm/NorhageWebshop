<?php
/**
 * norhagewebshop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package norhagewebshop
 */

if ( ! defined( '_G_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_G_VERSION', '0.0.7' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function norhagewebshop_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on norhagewebshop, use a find and replace
		* to change 'norhagewebshop' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'norhagewebshop', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'norhagewebshop' ),
			'menu-2' => esc_html__( 'Secondary navigation', 'norhagewebshop' ),
			'menu-3' => esc_html__( 'Footer navigation', 'norhagewebshop' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'align-wide' );

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'norhagewebshop_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'norhagewebshop_setup' );

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function norhagewebshop_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type( __DIR__ . '/blocks/headerblock' );
    register_block_type( __DIR__ . '/blocks/product-header-block' );
    register_block_type( __DIR__ . '/blocks/text-image-block' );
    register_block_type( __DIR__ . '/blocks/projects-block' );
    register_block_type( __DIR__ . '/blocks/products-slider-block' );
    register_block_type( __DIR__ . '/blocks/cta-block' );
    register_block_type( __DIR__ . '/blocks/cta-within-text-block' );
    register_block_type( __DIR__ . '/blocks/reviews-block' );
    register_block_type( __DIR__ . '/blocks/categories-block' );
    register_block_type( __DIR__ . '/blocks/products-block' );
}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'norhagewebshop_register_acf_blocks' );

// Our custom post type function
function norhagewebshop_create_posttypes() {
	$projects = [
		'labels'	=> [
			'name' 						=> __( 'Projects', 'norhagewebshop' ),
			'singular_name' 			=> __( 'Project', 'norhagewebshop' ),
			'add_new' 					=> __( 'New project', 'norhagewebshop' ),
			'add_new_item' 				=> __( 'Add new project', 'norhagewebshop' ),
			'edit_item' 				=> __( 'Edit project', 'norhagewebshop' ),
			'new_item'					=> __( 'New project', 'norhagewebshop' ),
			'view_item' 				=> __( 'View project', 'norhagewebshop' ),
			'search_items'				=> __( 'Search project', 'norhagewebshop' ),
			'not_found' 				=>  __( 'No projects found', 'norhagewebshop' ),
			'not_found_in_trash' 		=> __( 'No projects found in trash', 'norhagewebshop'),
		],
		'public' 				=> true,
		'exclude_from_search'	=> false,
		'has_archive' 			=> false,
		'rewrite' 				=> array('slug' => 'project'),
		'show_in_rest' 			=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> true,
		'menu_position'			=> 4,
		'menu_icon'				=> 'dashicons-images-alt2',
		'supports'				=> [
			'title',
			'editor',
			'revisions',
			'thumbnail',
		],
		'template'				=> [
			[
				'core/paragraph',
				[
					'placeholder'	=> 'Aenean ac nisi nisi. Praesent eget bibendum orci. Vivamus ac nisl aliquam, varius leo eu, dictum risus. Cras malesuada posuere enim, sit amet tincidunt dolor lobortis sit amet. Sed et urna consequat, tincidunt nibh nec, aliquet neque. Fusce imperdiet dictum odio sit amet iaculis. Curabitur tempus vestibulum urna, et varius nunc maximus at. Ut vulputate nulla erat, gravida consectetur sem dignissim et.',
					'lock'		=> [
						'move'		=> false,
						'remove'	=> false
					]
				]
			],
			[
				'core/gallery',
				[
					'align'		=> 'wide',

				]
			]
		]
	];
	register_post_type('project', $projects);
}
add_action( 'init', 'norhagewebshop_create_posttypes' );


/**
 * ADD THE PRODUCTS TO THE CATEGORY MENU ITEMS
 * */
function norhage_menu_add_category_posts( $output, $item, $depth, $args ) {
    // Check if the item is a Category or Custom Taxonomy
    if( $args->menu_id == 'primary-menu' && $item->type == 'taxonomy' && $depth == 1 ) {
        switch($item->object){
        	case 'greenhouse-type':
        		$post_type = 'greenhouse';
        		break;
        	case 'plastic-type':
        		$post_type = 'plastic';
        		break;
        	case 'constr-mat-type':
        		$post_type = 'construction';
        		break;
        	case 'service-type':
        		$post_type = 'service';
        		break;
        }
        $posts = get_posts([
        	'post_type'		=> 'product',
        	'numberposts'	=> -1,
        	'tax_query'		=> [
        		[
	        		'taxonomy'		=> $item->object,
	        		'field'			=> 'term_id',
	        		'terms'			=> $item->object_id
	        	]
        	]
        ]);

        // Check count, if more than 0 display count
        if(count($posts) > 0){
        	$output .= '<ul class="products-sub-menu">';
        	foreach($posts as $post){
        		$thumb = get_the_post_thumbnail($post->ID, [420, 420]);
        		$output .= '<li class="image-button"><a href="' . esc_url( get_permalink($post) ) . '">' . $thumb . '</a><span class="title"><a href="' . esc_url( get_permalink($post) ) . '">' . get_the_title($post) . '</span></a></li>' ;
        	}
        	$output .= '</ul>';
        }
    }

    if( $args->menu_id == 'primary-menu' && $item->type == 'post_type' && $item->object == 'service') {
    	$thumb = get_the_post_thumbnail($item->object_id, [420,420]);
        $output = '<div class="image-button"><a href="' . esc_url( $item->url ) . '">' . $thumb . '</a><span class="title"><a href="' . esc_url( $item->url ) . '">' . $item->title . '</span></a></div>' ;
    }
    if( $args->menu_id == 'primary-menu' && in_array('menu-item-has-children', $item->classes) ){
	    $output .= '<button class="expander">' . __('expand', 'norhagewebshop') . '</button>';
	}

    return $output;
}
add_action( 'walker_nav_menu_start_el', 'norhage_menu_add_category_posts', 10, 4 );

# filter_hook function to react on start_in argument
function norhage_wp_nav_menu_objects_start_in( $sorted_menu_items, $args ) {
    if(isset($args->show_submenu) && $args->show_submenu) {
        $root_id = 0;
        foreach( $sorted_menu_items as $key => $item ) {
        	if($item->current){
        		$root_id = $item->menu_item_parent?? $item->ID;
        		break;
        	}
        }

        $menu_item_parents = array();
        foreach( $sorted_menu_items as $key => $item ) {
            // init menu_item_parents
            if( $item->ID == (int)$root_id ) $menu_item_parents[] = $item->ID;

            if( in_array($item->menu_item_parent, $menu_item_parents) || in_array($item->ID, $menu_item_parents) ) {
                // part of sub-tree: keep!
                $menu_item_parents[] = $item->ID;
            } else {
                // not part of sub-tree: away with it!
                unset($sorted_menu_items[$key]);
            }
        }
        return $sorted_menu_items;
    } else {
        return $sorted_menu_items;
    }
}
add_filter("wp_nav_menu_objects",'norhage_wp_nav_menu_objects_start_in',10,2);


/**
 * Enqueue scripts and styles.
 */
function norhagewebshop_scripts() {
	wp_enqueue_style( 'norhagewebshop-style', get_stylesheet_uri(), array(), _G_VERSION );
	wp_enqueue_script('reeleaf-misc', get_stylesheet_directory_uri() . '/js/frontend.js', ['jquery'], _G_VERSION);
}
add_action( 'wp_enqueue_scripts', 'norhagewebshop_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});


/**
 * CREATE NORHAGE BLOCKS CATEGORY
 */
add_filter( 'block_categories_all' , function( $categories ) {

    // Adding a new category.
	array_unshift( $categories, array(
		'slug'  => 'norhage',
		'title' => 'Norhage'
	));

	return $categories;
} );




/**
 * REMOVE POSTS
 */
function remove_default_post_type() {
    remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_default_post_type' );

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_add_new_post_href_in_admin_bar() {
    ?>
    <script type="text/javascript">
        function remove_add_new_post_href_in_admin_bar() {
            var add_new = document.getElementById('wp-admin-bar-new-content');
            if(!add_new) return;
            var add_new_a = add_new.getElementsByTagName('a')[0];
            if(add_new_a) add_new_a.setAttribute('href','#!');
        }
        remove_add_new_post_href_in_admin_bar();
    </script>
    <?php
}
add_action( 'admin_footer', 'remove_add_new_post_href_in_admin_bar' );

function remove_frontend_post_href(){
    if( is_user_logged_in() ) {
        add_action( 'wp_footer', 'remove_add_new_post_href_in_admin_bar' );
    }
}
add_action( 'init', 'remove_frontend_post_href' );










/**
 * REMOVE COMMENTS
 */ 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});



/**
 * if there's no post-thumbnail, get the first image from the content.
 * better then nothing
 */
add_filter( 'post_thumbnail_id', function($thumbnail_id, $post ){
	if(!$thumbnail_id){
		$content = get_post_field('post_content', $post->ID);
		preg_match('/(wp:image {"id":|"images":\[")(\d+)/', $content, $matches);
		if(isset($matches[2]) && is_numeric($matches[2]) ){
			return $matches[2];
		}
	}else{
		return $thumbnail_id;
	}
}, 10, 2);



/**
 * Function for `woocommerce_add_cart_item_data` filter-hook.
 * add the addons for variable products to the cart_item_data.
 * 
 * @param array   $cart_item_data Array of other cart item data.
 * @param integer $product_id     ID of the product added to the cart.
 * @param integer $variation_id   Variation ID of the product added to the cart.
 * @param integer $quantity       Quantity of the item added to the cart.
 *
 * @return array
 */
function norhage_add_cart_item_data( $cart_item_data, $product_id, $variation_id, $quantity ){
	if(isset($_POST['addons']) && !empty($_POST['addons'])){
		$cart_item_data['addons'] = $_POST['addons'];
	}
	if(isset($_POST['cutting_variables'])){
		$cart_item_data['cutting_variables'] = $_POST['cutting_variables'];
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'norhage_add_cart_item_data', 10, 4 );

/**
 * Display custom cart_item_data in the cart
 */
function norhage_get_item_data( $item_data, $cart_item_data ) {
	if(isset($cart_item_data['cutting_variables'])){
		$item_data[] = [
			'key'	=> __('Cutting fee', 'norhage'),
			'value'	=> wc_price($cart_item_data['cutting_variables']['cutting_fee'])
		];
		$item_data[] = [
			'key'	=> __('Size', 'norhage'),
			'value'	=> $cart_item_data['cutting_variables']['width'] . 'm x ' . $cart_item_data['cutting_variables']['height'] . 'm'
		];
	}

	if(isset($cart_item_data['addons']) && !empty($cart_item_data['addons'])) {
		foreach($cart_item_data['addons'] as $product_id => $quantity){
			if($quantity <= 0){
				// don't show unselected extra's
				continue;
			}
			$product = wc_get_product($product_id);
			$item_data[] = [
				'key' => $quantity . ' x ',
				'value' => $product->get_name() . ' (' . wc_price($product->get_price()) . ')'
			];
		}
	}
	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'norhage_get_item_data', 10, 2 );

/**
 *  calculate the price of the items in the cart
 */
function norhage_before_calculate_totals($cart_object){
	
	foreach ( $cart_object->get_cart() as $hash => $value ) {
		$product = wc_get_product( $value['data']->get_id() );
		$product_price = $product->get_price();
		
		if(isset($value['cutting_variables'])){
			$cutting_fee = floatval($value['cutting_variables']['cutting_fee']);
			$width = floatval($value['cutting_variables']['width']);
			$height = floatval($value['cutting_variables']['height']);
			$product_price = $cutting_fee + ($width * $height * $product_price);
		}

		if(isset($value['addons']) && !empty($value['addons'])){
			
			$extra_costs = 0;
			foreach($value['addons'] as $product_id => $quantity){
				if($quantity < 1){
					continue;
				}
				$addon_product = wc_get_product($product_id);
				$addon_price = $addon_product->get_price();
				$extra_costs += $addon_price * $quantity;
			}
			$product_price += $extra_costs;
		}

		$value[ 'data' ]->set_price( $product_price );
	}
}
add_action( 'woocommerce_before_calculate_totals', 'norhage_before_calculate_totals', 99 );

/**
 * Add custom meta to order
 */
function norhage_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {

	if(isset($values['cutting_variables'])){
		$item->add_meta_data(
			__('Cutting fee', 'norhagewebshop'),
			wc_price($values['cutting_variables']['cutting_fee'])
		);
		$item->add_meta_data(
			__('Size', 'norhagewebshop'),
			$values['cutting_variables']['width'] . 'm x ' . $values['cutting_variables']['height'] . 'm'
		);
	}

	if( isset( $values['addons'] ) ) {
		foreach($values['addons'] as $product_id => $quantity){
			if($quantity < 1){
				continue;
			}
			$product = wc_get_product( $product_id );
			$item->add_meta_data(
				$quantity . ' x ',
				$product->get_name() . ' (' . wc_price($product->get_price()) . ')',
				true
			);
		}
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'norhage_checkout_create_order_line_item', 10, 4 );


/**
 * Add custom cart item data to emails
 */
function norhage_order_item_name( $product_name, $item ) {

	if(isset($item['cutting_variables'])){
		$product_name .= sprintf('<br /> %s: %s', __('Cutting fee', 'norhage'), wc_price($cart_item_data['cutting_variables']['cutting_fee']));
		$product_name .= sprintf(
			'<br /> %s: %sm x %sm', 
			__('Sizes', 'norhage'), 
			$cart_item_data['cutting_variables']['width'],
			$cart_item_data['cutting_variables']['height']
		);
	}

	if(isset($item['addons']) && !empty($item['addons'])){
		foreach($values['addons'] as $product_id => $quantity){
			if($quantity < 1){
				continue;
			}
			$product = wc_get_product( $product_id );
			$addon_text = sprintf('<br /> %s x %s', $quantity, $product->get_name());
			$product_name .= $addon_text;
		}
	}
	return $product_name;
}

add_filter( 'woocommerce_order_item_name', 'norhage_order_item_name', 10, 2 );

/**
 * Remove the woocommerce template parts
 */
add_action( 'init', 'norhage_remove_wc_template_stuff' );
function norhage_remove_wc_template_stuff() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

/**
 * Allow HTML in term (category, tag) descriptions
 * FIRST remove html filters from output
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
if ( ! current_user_can( 'unfiltered_html' ) ) {
	add_filter( 'pre_term_description', 'wp_filter_post_kses' );
}
remove_filter( 'term_description', 'wp_kses_data' );

// add extra css to display quicktags correctly
add_action( 'admin_print_styles', 'categorytinymce_admin_head' );
function categorytinymce_admin_head() { 
	global $current_screen;
	if ( $current_screen->id == 'edit-category' OR 'edit-tag' ):
		echo '<style type="text/css">.quicktags-toolbar input{float:left !important; width:auto !important;}.term-description-wrap{display:none;}</style>';
	endif;
}

// load tinymce
add_filter('product_cat_edit_form_fields', 'add_rich_category_description');
function add_rich_category_description($tag) {
	//$tag_extra_fields = get_option('Category_Description_option');
	?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php _e('Description', 'categorytinymce'); ?></label></th>
			<td>
			<?php  
				$settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );	
				wp_editor(html_entity_decode($tag->description , ENT_QUOTES, 'UTF-8'), 'Category_Description_option', $settings); 
			?>
				<br />
				<span class="description"><?php _e('The description is shown on the category overview page.', 'norhagewebshop'); ?></span>
			</td>	
		</tr>
	<?php

}
/*
// CORS HOT FIX BY NB:
add_filter( 'script_loader_src', 'wpse47206_src' );
add_filter( 'style_loader_src', 'wpse47206_src' );
function wpse47206_src( $url )
{
    if(!isset($_SERVER['SERVER_NAME'])) return $url;
    if (strpos($_SERVER['SERVER_NAME'],'norhagewebshop.no') !== false) {
        return str_replace('norhagewebshop.com', 'norhagewebshop.no', $url);
    }
    return $url;
}

function check_for_src($attr, $attachment){
    if(!isset($_SERVER['SERVER_NAME'])) return $attr;
    if (strpos($_SERVER['SERVER_NAME'],'norhagewebshop.no') !== false) {
        $find_and_replace = str_replace("norhagewebshop.com","norhagewebshop.no", $attr["src"]);
        $attr["src"] = $find_and_replace;
        $attr["srcset"] = $find_and_replace;
        return $attr;
    }
    return $attr;
}
add_filter("wp_get_attachment_image_attributes","check_for_src",10,2);


function modify_adminy_url_for_ajax( $url, $path, $blog_id ) {
    if(!isset($_SERVER['SERVER_NAME'])) return $url;
    if ( "admin-ajax.php" == $path ) {
        if (strpos($_SERVER['SERVER_NAME'],'norhagewebshop.no') !== false) {
            return "https://norhagewebshop.no/wp-admin/admin-ajax.php";
        }
        return $url;
    }
    return $url;
}
add_filter("admin_url", "modify_adminy_url_for_ajax", 10, 3 );

add_filter('allowed_http_origins', 'add_allowed_origins');
function add_allowed_origins($origins) {
    $origins[] = 'https://norhagewebshop.no';
    $origins[] = 'https://norhagewebshop.com';
    return $origins;
}

// change the edit and elementor-edit links in post table
function ElementorLinksFix($actions, $post)
{
    if(empty($actions['edit_with_elementor'])) return $actions;
    if(!function_exists("pll_get_post_language")) return $actions;

    if ( pll_get_post_language($post->ID) === 'de'){
        $actions['edit'] = str_replace(array('norhagewebshop.com'), array('norhagewebshop.no'), $actions['edit']);
        $actions['edit_with_elementor'] = str_replace('norhagewebshop.com/', 'norhagewebshop.no/', $actions['edit_with_elementor']);
    }


    return $actions;
}

add_filter('post_row_actions', 'ElementorLinksFix', 12, 2);
add_filter('page_row_actions', 'ElementorLinksFix', 12, 2);
*/
