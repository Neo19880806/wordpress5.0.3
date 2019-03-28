<!--Default banner-->
<?php

$banner_title         = null;
$banner_description   = get_post_meta( get_the_ID(), 'pearl_banner_description', true );
$banner_title_display = get_option( 'pearl_banner_page_title', 'show' );

if ( is_home() ) {

	$banner_title       = pearl_blog_title();
	$banner_description = pearl_blog_description();

} elseif ( is_404() ) {

	$banner_title = esc_html__( 'No Page Found', 'pearl-antarctica' );

} else if ( is_singular( 'post' ) ) {

	$banner_title = get_option( 'pearl_blog_banner_title', esc_html__( 'Our Blog', 'pearl-antarctica' ) );
//	$banner_description   = get_option( 'pearl_blog_banner_description', esc_html__( 'We are quite bloggers', 'pearl-antarctica' ) );

} else if ( is_singular( 'portfolio' ) ) {

	$banner_title = get_option( 'pearl_portfolio_banner_title', esc_html__( 'Our Portfolio', 'pearl-antarctica' ) );
	$banner_description   = get_option( 'pearl_portfolio_banner_description', '' );

} else if ( is_singular( 'product' ) ) {

	$banner_title = apply_filters( 'pearl_single_shop_title', esc_html__( 'Product Detail', 'pearl-antarctica' ) );

} elseif ( is_page() || is_front_page() || is_single() ) {

	$banner_title = get_the_title();

} elseif ( is_search() ) {

	$banner_title = sprintf( esc_html__( 'Search Results for: %s', 'pearl-antarctica' ), get_search_query() );

} elseif ( is_author() ) {

	global $wp_query;
	$current_author = $wp_query->get_queried_object();
	if ( ! empty( $current_author->display_name ) ) {
		$banner_title = $current_author->display_name;
	}

} elseif ( is_archive() && ( is_woocommerce_activated() && ! is_shop() ) ) {

	$banner_title = get_the_archive_title();

} elseif ( is_woocommerce_activated() && is_shop() ) {

	$banner_title = apply_filters( 'pearl_shop_title', esc_html__( 'Shop', 'pearl-antarctica' ) );

}

$banner_title = apply_filters( 'pearl_page_banner_tile', $banner_title );

?>
<div class="sub-header" style="<?php pearl_header_banner_image(); ?>">
<div class="bg-overlay"></div>
<div class="container">
	<?php
		if ( ! empty ( $banner_title ) && $banner_title_display == 'show' ) {
			echo '<h1 class="title">' . $banner_title . '</h1>';
		}

		if ( ! empty( $banner_description ) ) {
			echo '<p class="description">' . esc_html( $banner_description ) . '</p>';
		}
	?>
</div>
</div>