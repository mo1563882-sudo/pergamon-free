<?php
/**
 * Title: Education & Courses
 * Slug: pergamon/education
 * Categories: featured, posts
 * Description: A structured layout for online courses, tutorials, and educational content.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"60%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
			<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large","lineHeight":"1.2"}}} -->
			<h1 class="wp-block-heading">Learn New Skills, Anytime.</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
			<p class="has-medium-font-size">Explore tutorials, guides, and courses to advance your knowledge and career.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-large has-custom-border">
				<img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" alt="Students learning" style="border-radius:8px"/>
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
	<h2 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--30)">Latest Lessons</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":90,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
