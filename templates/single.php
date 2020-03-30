<?php 
/**
 * Add single page 
 * @package Easy_Documentation
 */

 get_header(); ?>

 	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-lg-4">
				<div class="docs-sidebar">
					<ul>
					<?php 
					wp_list_pages( array(
						'post_type' => 'easy_documentation',
						'title_li'  => '',
		        		'order'     => 'menu_order',
				    ) ) ?>
				    </ul>
			    </div>
			</div>
			<div class="col-lg-8">
				<div class="docs-wrapper">
				<?php while ( have_posts() ) { the_post(); ?>
					<?php the_title( '<h1 class="docs-title">','</h1>' ) ?>
					<?php the_content() ?>
					<?php if ( comments_open() || get_comments_number() ) { ?>					
					<hr>
					<?php
						comments_template(); 
					} ?>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer();