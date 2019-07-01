<?php
/**
* Template Name: Our Approach
*
* @package WordPress
* @subpackage Laughland Jones
* @since Laughland Jones 1.0
*/

$metadata = get_post_meta(get_the_ID());

$sectors = [
	[
		"title" => "Interior<br/>Architecture",
		"class" => "interior-architecture",
		"subsections" => explode(PHP_EOL,$metadata['interior_architecture'][0]),
		"image" => "https://s3-eu-west-1.amazonaws.com/laughland-jones/what-we-do/architecture.jpg",
		"hasSlideshow" => true
	],
	[
		"title" => "Interior<br/>Design",
		"class" => "interior-design",
		"subsections" => explode(PHP_EOL,$metadata['interior_design'][0]),
		"image" => "https://s3-eu-west-1.amazonaws.com/laughland-jones/what-we-do/artisan.jpg",
		"hasSlideshow" => true
	],
	[
		"title" => "Purchasing<br/>& Logistics",
		"class" => "purchasing-and-logistics",
		"subsections" => explode(PHP_EOL,$metadata['purchasing_logistics'][0]),
		"image" => "https://s3-eu-west-1.amazonaws.com/laughland-jones/what-we-do/purchasing.jpg",
		"hasSlideshow" => true
	],
	[
		"title" => "Workflow",
		"class" => "workflow",
		"subsections" => explode(PHP_EOL,$metadata['workflow'][0]),
		"image" => "https://s3-eu-west-1.amazonaws.com/laughland-jones/what-we-do/workflow.jpg",
		"hasSlideshow" => true
	],
	[
		"title" => "Artisans",
		"class" => "artisans",
		"copy" => [$metadata['artisans'][0]],
		"image" => "https://s3-eu-west-1.amazonaws.com/laughland-jones/what-we-do/artisans2.jpg",
		"hasSlideshow" => false
	]
];
?>

<?php get_header(); ?>

<script>
	window._Sectors = <?php echo json_encode($sectors) ?>;
</script>

<div id="approach" class="page">
  <h1 class="page-header">Our Approach</h1>
  <ul id="sectors">
	<?php foreach ($sectors as $i => $sector) {
		?><li class="sector <?php esc_attr_e($sector['class'] . ( $i === 0 ? ' active' : '' )) ?>" data-sector="<?php esc_attr_e($i) ?>" data-icon="<?php esc_attr_e(get_template_directory_uri() . '/resources/assets/images/' . $sector['class'] . '-icon.jpg') ?>">
			<div class="icon-wrap">
				<img src="<?php esc_attr_e(get_template_directory_uri() . '/resources/assets/images/' . $sector['class'] . '-icon.png') ?>" class="oa-icons white-icon">
				<img src="<?php esc_attr_e(get_template_directory_uri() . '/resources/assets/images/' . $sector['class'] . '-icon-orange.png') ?>" class="oa-icons orange-icon">
			</div>
			<img src="<?php esc_attr_e(get_template_directory_uri() . '/resources/assets/images/' . $sector['class'] . '-icon.jpg') ?>" class="sector-icon">
			<h2 class="sector-title"><?php echo wp_kses_post( $sector['title'] ) ?></h2>
		</li><?php
	} ?><li class="sector ghost-sector"></li>
</ul>

	<!-- The subsectors -->
	<div id="subsectors-list">

		<div id="slideshow" class="swiper-container">

			<div class="swiper-wrapper">
				<?php foreach ($sectors as $i => $sector) { ?>
					<div class="swiper-slide" style="background-image: url(<?php esc_attr_e( $sector['image']) ?>)">
						<div class="blackoutz"></div>
						<div class="slide-copy">
							<?php if(isset($sector['subsections'])) { ?>
								<?php foreach ($sector['subsections'] as $subsection) { ?>
									<p><?php echo wp_kses_post($subsection) ?></p>
								<?php } ?>
							<?php } ?>

							<?php if(isset($sector['copy'])) { ?>
								<?php foreach ($sector['copy'] as $copy) { ?>
									<p class="paragraphs"><?php echo wp_kses_post($copy) ?></p>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div id="sector-copy">

			<h2 id="sector-heading"></h2>

			<div id="section-img"></div>

			<img src="<?php esc_attr_e(get_template_directory_uri()) ?>/resources/assets/images/close.png" id="sector-close-button">

			<ul id="subsections" class="pagination"></ul>

			<div id="subsection-copy"></div>

			<div id="back-link">
				<img src="<?php esc_attr_e(get_template_directory_uri()) ?>/resources/assets/images/arrow-back.png" alt="">
				<p>Back</p>
			</div>

		</div>

	</div>

</div>

<?php get_footer(); ?>
