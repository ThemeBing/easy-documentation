<?php 
/**
 * Add archive page 
 * @package Easy_Documentation
 */

get_header();

$products = new \WP_Query( array( 
  'post_type' => 'easy_documentation',
  'posts_per_page' => -1,
  'order' => 'DESC',
  'post_parent' => 0
));
?>
<div class="mt-5"></div>
<div class="container">
	<div class="row">
	<?php
	/* Start the Loop */
	while ( $products->have_posts() ) : $products->the_post(); ?>

		<div class="col-lg-4">
			<div class="easy-documentation">
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail() ?>
					<?php the_title( '<h4>', '</h4>' ) ?>	
				</a>
			</div>
		</div>


	<?php endwhile; wp_reset_postdata(); ?>

	</div>
</div>
<div class="mb-5"></div>
<?php get_footer();