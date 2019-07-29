<?php

get_header();

$fabric_options = get_option( 'lj_fabric_options' );

$template_data = [
	'intro' => $fabric_options['lj_fabrics_intro'],
	'featured' => [
		1 => get_featured_data( $fabric_options['lj_fabrics_featured1'] ),
		2 => get_featured_data( $fabric_options['lj_fabrics_featured2'] ),
		3 => get_featured_data( $fabric_options['lj_fabrics_featured3'] ),
	],
];

function get_featured_data( $term_id ) {
	if ( '' === $term_id ) {
		return;
	}

	$collection = get_term( $term_id, 'fabric_collection' );

	return [
		'name'  => $collection->name,
		'image' => get_term_meta( $term_id, 'lj_collection_cover', true ),
		'url'   => get_term_link( (int) $term_id, 'fabric_collection' ),
	];
}

?>

<div class="fabrics-header">
	<nav class="fabrics-filters">
		<div class="container">
			<ul class="filters">
				<li>
					<label for="filter-select-colour">
						<input type="radio" name="filter-select" id="filter-select-colour" checked>
						Search by colour
					</label>
					<select name="colour-filter" id="colour-filter"  multiple="multiple">
						<option value="red">Red</option>
						<option value="green">Green</option>
						<option value="blue">Blue</option>
					</select>
				</li>
				<li>
					<label for="filter-select-keyword">
						<input type="radio" name="filter-select" id="filter-select-keyword">
						Search by keyword
					</label>
					<input type="text" name="keyword-filter" id="keyword-filter">
				</li>
				<li>
					<label for="filter-select-all">
						<input type="radio" name="filter-select" id="filter-select-all">
						Show all
					</label>
					<select name="sort-order" id="sort-order">
						<option value="new">Newest first</option>
						<option value="alpha">Alphabetical</option>
					</select>
				</li>
				<li>
					<button type="submit">Go</button>
				</li>
			</ul>
		</div>
	</nav>

	<div class="breadcrumbs">
		<div class="container">
			Fabrics
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
						$collection_data = get_featured_data( $collection->term_id );
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

<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('#colour-filter').multiselect();
		jQuery('#sort-order').multiselect();
	});
</script>

<?php get_footer();
