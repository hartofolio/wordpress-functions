/*-------------------------------------------------------------------
-- Limit max menu depth in admin panel to x . x=2 in this example
--------------------------------------------------------------------*/
function hafo_limit_menu_depth( $hook ) {
  if ( $hook != 'nav-menus.php' ) return;
  wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 2;', 'after' );
}
add_action( 'admin_enqueue_scripts', 'hafo_limit_menu_depth' );

/*-------------------------------------------------------------------
-- Replace menu item with Label "Home" with Logo image
--------------------------------------------------------------------*/
$themeurl 	= get_stylesheet_directory_uri();
$imgdir 	  = $themeurl.'/images';

function home_logo_menu($item_output, $item, $depth, $args) {
	global $imgdir; 
    if ('Home' == $item->title) {
  		if(has_custom_logo()){
  			$custom_logo_id = get_theme_mod( 'custom_logo' );
  			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  			$logo = '<img src="'.$image[0].'">';
  		} else {
  			$logo = '<img src="'.$imgdir.'/logo.png">';
  		}
      $item_output = str_replace('Home</a>', ''. $logo .'</a>', $item_output);
		  $item_output = str_replace('class="', 'class="logo-menu-item d-none d-xl-block ', $item_output);
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'home_logo_menu', 10, 4);
