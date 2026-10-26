<?php
/**
 * Title: Cooking & Recipes
 * Slug: pergamon/cooking
 * Categories: featured, posts
 * Description: A delicious layout for food blogs and recipes with a large hero image and a clean grid.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
			<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large","lineHeight":"1.2"}}} -->
			<h1 class="wp-block-heading">Delicious Recipes for Every Day</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
			<p class="has-medium-font-size">Simple, healthy, and tasty meals you can cook at home.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-large has-custom-border">
				<img src="https://images.unsplash.com/photo-1495521821757-a1efb6729352?auto=format&fit=crop&w=800&q=80" alt="Cooking" style="border-radius:8px"/>
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}}} -->
	<hr class="wp-block-separator is-style-wide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"/>
	<!-- /wp:separator -->

	<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|x-large"},"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
	<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--30)">Latest Recipes</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":60,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1/1","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
