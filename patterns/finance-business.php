<?php
/**
 * Title: Finance & Business
 * Slug: pergamon/finance-business
 * Categories: featured, posts
 * Description: A professional layout for finance, business, and corporate blogs.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"border":{"radius":"8px"}},"color":{"background":"var:preset|color|muted"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group has-muted-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)">
		
		<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large"}}} -->
		<h1 class="wp-block-heading has-text-align-center">Insights for Business Leaders</h1>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
		<p class="has-text-align-center has-medium-font-size">Strategies, market analysis, and financial advice to grow your business.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"primary","textColor":"base","style":{"border":{"radius":"4px"}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background wp-element-button" style="border-radius:4px">Explore Articles</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

	<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|x-large"},"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}}} -->
	<h2 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)">Latest Analysis</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":70,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"var:preset|color|muted","width":"1px"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--muted);border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--20)">
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|large"},"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} /-->
				<!-- wp:post-excerpt {"moreText":"Read Analysis"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
