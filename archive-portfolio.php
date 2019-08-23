<?php
/**
 * This is a custom post type archive for Portfolio items
 */

// Mobile Detect init
require_once get_template_directory() . '/mobile_detect.php';
$detect = new Mobile_Detect;

$projects = [
	[
		'feature_image' => [
			'orientation' => 'landscape',
			'image' => [
				'url' => [
					'normal' => 'http://laughland-jones.s3.amazonaws.com/production/33/699/normal/barbaredited4.jpg?1485517449'
				]
			]
		],
		'slug' => 'chalet-babar',
		'title' => 'Chalet Babar',
		'location' => 'Verbier, Switzerland',
		'client' => 'Private Client',
		'description' => "Appointed for architectural and interior design. 400 square metres, 5 bedrooms. Winner of the global 'Best Ski Chalet' award at the International Hotel and Property awards in 2016."
	]
];

$projects_query = new WP_Query( array(
	'post_type'   => 'portfolio',
	'nopaging'    => true,
	'post_status' => 'publish',
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
));
$projects = array();

foreach ( $projects_query->posts as $project ) {
	$project_meta = get_post_meta($project->ID);

	if ( isset( $project_meta['photo_id'] ) ) {
		$imgmeta = wp_get_attachment_metadata( $project_meta['photo_id'][0] );
		$is_landscape = $imgmeta['width'] > $imgmeta['height'];

		$projects[] = array(
			'slug'          => $project->post_name,
			'title'         => $project->post_title,
			'location'      => $project_meta['location'][0],
			'client'        => $project_meta['client'][0],
			'description'   => $project_meta['description'][0],
			'feature_image' => array(
				'orientation' => $is_landscape ? 'landscape' : 'portrait',
				'image' => array(
					'url' => array(
						'normal' => wp_get_attachment_image_src( $project_meta['photo_id'][0], $is_landscape ? 'lj-portfolio-l' : 'lj-portfolio-p' )[0]
					)
				)
			),
		);
	}
}

?>

<?php get_header(); ?>

<div id="portfolio" class="page">

	<div id="left" class="scroll-buttons"></div>

	<div id="right" class="scroll-buttons"></div>

	<div class="projects-list-wrap">

    	<ul id="projects">

			<?php if ( count($projects) ) { ?>

				<?php foreach ($projects as $project) { ?>

					<li class="project <?php esc_attr_e( $project['feature_image']['orientation']) ?>" data-project="<?php esc_attr_e( $project['slug']) ?>">
						<div class="image-window lazyload" data-bg="<?php echo esc_url($project['feature_image']['image']['url']['normal']) ?>">
							<div class="image lazyload" data-bg="<?php echo esc_url( $project['feature_image']['image']['url']['normal']) ?>" data-image="<?php echo esc_url( $project['feature_image']['image']['url']['normal']) ?>"></div>
						</div>
						<div class="copy <?php echo ( $detect->isTablet() || $detect->isMobile() ) ? '' : 'hover-reveal'; ?>">
							<h2><?php esc_html_e( $project['title']) ?></h2>
							<p class="cli-location">
								<?php esc_html_e( $project['location']) ?>
								<br>
								<?php esc_html_e( $project['client']) ?>
							</p>
							<p class="project-blurb">
								<?php esc_html_e( $project['description']) ?>
							</p>
							<img src="<?php esc_attr_e( get_template_directory_uri() ) ?>/resources/assets/images/arrow.png">
						</div>
					</li>
				<?php } ?>
			<?php } else { ?>
				<h1 class="page-header show">
					Unfortunately, there don't seem to be any projects.
				</h1>
			<?php } ?>
		</ul>
	</div>

<?php // = render partial: 'home/elements/loading' ?>
</div>

<?php get_footer(); ?>
