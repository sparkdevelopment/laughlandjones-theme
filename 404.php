<?php
/**
 * Template that handle 404 requests on server
 *
 * @link https://developer.wordpress.org/themes/functionality/404-pages/
 */
?>

<?php get_header(); ?>

<main>
	<section>
		<article style="text-align: center;">
			<h1 style="color: #66686a; padding: 10vh 0;">
				<?php echo esc_html( 'Page not found', 'tonik' ); ?>
			</h1>

			<h2>
				<a href="<?php echo esc_attr( home_url() ); ?>" style="color: #66686a; font-size: 1rem;">
					<?php echo esc_html( 'Return to homepage', 'tonik' ); ?>
				</a>
			</h2>
		</article>
	</section>
</main>

<?php get_footer(); ?>
