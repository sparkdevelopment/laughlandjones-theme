<?php
/**
* Template Name: Basket
*
* @package WordPress
* @subpackage Laughland Jones
* @since Laughland Jones 1.0
*/
?>

<?php

// Get template data
$basket_contents = json_decode( wp_unslash( $_COOKIE['lj-basket'] ?? null ) ) ?? [];

$requested = [];
foreach ($basket_contents as $basket_item ) {
	$requested[] = [
		'id'           => $basket_item->fabric,
		'url'          => get_the_permalink( $basket_item->fabric ),
		'name'         => get_the_title( $basket_item->fabric ),
		'ref'          => get_post_meta( $basket_item->fabric, 'lj_pattern' )[0],
		'collection'   => wp_get_post_terms( $basket_item->fabric, 'fabric_collection' )[0],
		'variation_id' => $basket_item->variation,
		'variation'    => get_variations( $basket_item->fabric, $basket_item->variation ),
	];
}
// var_dump($requested);die;
get_header();

?>

<div id="basket" class="page">

	<div class="fabrics-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 breadcrumbs">
					<div class="container">
						<ul>
							<li><a href="<?php echo esc_url( get_site_url() . '/fabrics/' ); ?>">Fabrics</a></li>
							<li><?php the_title(); ?></li>
						</ul>
					</div>
				</div>

				<div class="col-sm-12 col-md-6 basket"></div>
			</div>
		</div>
	</div>

	<div class="fabrics fabric-page">
		<header class="entry-header design-header">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="entry-title">Your Basket</h1>
					</div><!-- .entry-header .container .row .col -->
				</div><!-- .entry-header .container .row -->
			</div><!-- .entry-header .container -->
		</header><!-- .entry-header -->

		<div class="basket-contents">
			<div class="container">
				<div class="row">
					<?php if( count( $requested ) ) { ?>
						<ul id="basket-list" class="basket-list col-md-12">
						<?php foreach( $requested as $item ) { ?>
							<li id="item-<?php echo esc_attr( $item['id'] ); ?>">
								<a href="<?php echo esc_url( $item['url'] . '/?variaton=' . $item['variation_id'] ); ?>" class="image" style="background-image:url(<?php echo esc_url( $item['variation']['image_url'] ); ?>);"></a>
								<h3>
									<a href="<?php echo esc_url( get_term_link( $item['collection']->term_id, 'fabric_collection' ) ); ?>">Collection: <?php echo esc_html( $item['collection']->name ); ?></a>
								</h3>
								<div>
									<a href="<?php echo esc_url( $item['url'] . '/?variaton=' . $item['variation_id'] ); ?>">Design: <?php echo esc_html( $item['name'] ); ?></a>
								</div>
								<div>Code Ref: <span class="fabric-pattern-number"><?php echo esc_html( $item['variation']['no'] ); ?></span></div>
								<a id="remove-from-cart" class="remove-from-cart" data-id="<?php echo esc_attr( $item['id'] ); ?>" data-variation="<?php echo esc_attr( $item['variation_id'] ); ?>" href="javascript:;">Remove from basket</a>
							</li>
						<?php } ?>
						</ul>
						<div class="form">
							<?php
							wp_reset_postdata();
							the_content();
							?>
						</div>
					<?php } else { ?>
						<div class="empty-basket">Basket is empty. Please visit our <a href="<?php echo esc_url( get_site_url() . '/fabrics' ); ?>">Fabrics</a> page.</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>
