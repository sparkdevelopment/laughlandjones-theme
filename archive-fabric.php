<?php

get_header();

$fabric_options = get_option( 'lj_fabric_options' );

$template_data = [
	'intro' => $fabric_options['lj_fabrics_intro'],
	'featured' => [
		1 => get_fabric_data( $fabric_options['lj_fabrics_featured1'] ),
		2 => get_fabric_data( $fabric_options['lj_fabrics_featured2'] ),
		3 => get_fabric_data( $fabric_options['lj_fabrics_featured3'] ),
	],
];

?>

<div class="fabrics-header">
	<?php get_template_part( 'resources/templates/nav/nav', 'fabrics' ); ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 breadcrumbs">
				<ul>
					<li>Fabrics</li>
				</ul>
			</div>

			<div class="col-sm-12 col-md-6 basket"></div>
		</div>
	</div>
</div>

<div class="fabrics fabrics-archive page">

	<div class="highlights-section">
		<div class="container">
			<h1 class="page-header">Newest Collections</h1>
			<?php echo wpautop( esc_html( $template_data['intro'] ) ); ?>

			<div class="highlights-container">
				<?php for ($i=1; $i <= 3 ; $i++) { ?>
				<div class="highlight">
					<a href="<?php echo esc_url( $template_data['featured'][ $i ]['url'] ); ?>">
						<div class="label"><?php echo esc_html( $template_data['featured'][ $i ]['name'] ); ?></div>
						<i style="background-image:url(<?php echo esc_url( $template_data['featured'][ $i ]['image'] ); ?>)"></i>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="all-section">
		<div class="container">
			<h1>All of Our Collections</h1>
			<div class="collections-container">
				<?php
					$all_collections = new WP_Term_Query([
						'taxonomy'   => 'fabric_collection',
						'orderby'    => 'name',
						'order'      => 'ASC',
						'hide_empty' => true,
					]);
					foreach( $all_collections->get_terms() as $collection ) {
						$collection_data = get_fabric_data( $collection->term_id );
						?>
						<div class="collection">
							<a href="<?php echo esc_url( $collection_data['url'] ); ?>">
								<div class="label"><?php echo esc_html( $collection_data['name'] ); ?></div>
								<i style="background-image:url(<?php echo esc_url( $collection_data['image'] ); ?>)"></i>
							</a>
						</div>
					<?php } ?>
			</div>
		</div>
	</div>

</div>

<?php get_footer();
