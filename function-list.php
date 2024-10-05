/*-------------------------------------------------------------------
-- Limit max menu depth in admin panel to x . x=2 in this example
--------------------------------------------------------------------*/
function hafo_limit_menu_depth( $hook ) {
  if ( $hook != 'nav-menus.php' ) return;
  wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 2;', 'after' );
}
add_action( 'admin_enqueue_scripts', 'hafo_limit_menu_depth' );
