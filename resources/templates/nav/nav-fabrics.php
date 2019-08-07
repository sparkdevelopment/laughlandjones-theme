<?php

$nav_data = [
	'colours' => [],
];

$colours_query = new WP_Term_Query([
	'taxonomy'   => 'fabric_colour',
	'hide_empty' => false,
	'orderby' => 'name',
]);

foreach( $colours_query->get_terms() as $colour ) {
	$nav_data['colours'][ $colour->slug ] = $colour->name;
}

?>

<nav class="fabrics-filters">
	<div class="container">
		<ul class="filters">
			<li>
				<label for="filter-select-colour">
					<input type="radio" name="filter-select" id="filter-select-colour" checked>
					Search by colour
				</label>
				<select name="colour-filter" id="colour-filter"  multiple="multiple">
					<?php foreach( $nav_data['colours'] as $slug => $name ) { ?>
					<option value="<?php esc_attr_e( $slug ); ?>"><?php echo esc_html( $name ); ?></option>
					<?php } ?>
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

<script type="text/javascript">
	jQuery(document).ready( function() {
		jQuery('#colour-filter').multiselect();
		jQuery('#sort-order').multiselect();
	});
</script>
