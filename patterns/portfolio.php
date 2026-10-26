<?php
/**
 * Title: Portfolio
 * Slug: pergamon/portfolio
 * Categories: featured, posts
 * Description: A clean, visual layout for showcasing creative work and projects.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large"}}} -->
		<h1 class="wp-block-heading">Selected Works</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
		<p class="has-medium-font-size">A showcase of recent projects, designs, and creative explorations.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":80,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|large"}}} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
