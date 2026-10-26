<?php
/**
 * Title: Personal Blog
 * Slug: pergamon/personal-blog
 * Categories: featured, posts
 * Description: A clean, personal blog layout with a large intro and a grid of recent posts.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large","lineHeight":"1.2"}}} -->
		<h1 class="wp-block-heading">Welcome to My Blog</h1>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} -->
		<p class="has-medium-font-size">Thoughts, stories, and ideas. Sharing what I learn along the way.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":20,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|large"},"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} /-->
				<!-- wp:post-excerpt {"moreText":"Read more"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
		
		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:query -->
	
</div>
<!-- /wp:group -->
