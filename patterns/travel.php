<?php
/**
 * Title: Travel & Adventure
 * Slug: pergamon/travel
 * Categories: featured, posts
 * Description: A stunning travel layout with a full-width hero and a grid of destinations.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:cover {"url":"https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&q=80","dimRatio":40,"overlayColor":"contrast","minHeight":400,"align":"wide","style":{"border":{"radius":"8px"}}} -->
	<div class="wp-block-cover alignwide" style="border-radius:8px;min-height:400px">
		<span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim"></span>
		<img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1200&q=80" data-object-fit="cover"/>
		<div class="wp-block-cover__inner-container">
			<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large"},"color":{"text":"var:preset|color|base"}}} -->
			<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color">Explore the World</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var:preset|color|base"}}} -->
			<p class="has-text-align-center has-base-color has-text-color">Discover new places, cultures, and adventures.</p>
			<!-- /wp:paragraph -->
		</div>
	</div>
	<!-- /wp:cover -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)">
		<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"var:preset|font-size|x-large"}}} -->
		<h2 class="wp-block-heading has-text-align-center">Latest Destinations</h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":50,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/5","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|large"}}} /-->
				<!-- wp:post-excerpt {"moreText":"Read More"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
