<?php
/**
 * Title: Fashion & Beauty
 * Slug: pergamon/fashion-beauty
 * Categories: featured, posts
 * Description: An elegant, image-focused layout for fashion, beauty, and lifestyle blogs.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large","letterSpacing":"2px","textTransform":"uppercase"}}} -->
		<h1 class="wp-block-heading has-text-align-center" style="letter-spacing:2px;text-transform:uppercase">The Style Edit</h1>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
		<p class="has-text-align-center has-medium-font-size">Curated trends, beauty secrets, and fashion inspiration.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":100,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/4","style":{"border":{"radius":"0px"}}} /-->
				
				<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"layout":{"type":"default"}} -->
				<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--10)">
					<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small","textTransform":"uppercase","letterSpacing":"1px"},"color":{"text":"var:preset|color|accent"}}} /-->
					<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|large"}}} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
