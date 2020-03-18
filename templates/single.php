<?php 
/**
 * Add single page 
 * @package Easy_Documentation
 */

 get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-4">
			
		</div>
		<div class="col-8">
			
			<?php while ( have_posts() ) { the_post(); ?>
				<?php the_title( '<h1>','</h1>' ) ?>
				<?php the_content() ?>
			<?php } ?>
			
		</div>
	</div>
</div>

<?php get_footer();