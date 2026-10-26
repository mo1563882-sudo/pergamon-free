<?php
/**
 * Title: MIRA Homepage
 * Slug: pergamon/home-mira
 * Categories: featured, posts
 * Description: Asymmetric homepage grid (60/40) for the MIRA design.
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide">
		
		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%">
			<!-- wp:query {"queryId":10,"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"8px"}}} /-->
					<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
					<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|x-large","lineHeight":"1.2"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->
					<!-- wp:post-excerpt /-->
				<!-- /wp:post-template -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|large"}}} -->
			<h3 class="wp-block-heading">أحدث المقالات</h3>
			<!-- /wp:heading -->

			<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":1,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"bottom":"var:preset|spacing|20"}},"border":{"bottom":{"color":"var:preset|color|muted","width":"1px"}}},"layout":{"type":"default"}} -->
					<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--muted);border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--20)">
						<!-- wp:post-title {"isLink":true,"level":4,"style":{"typography":{"fontSize":"var:preset|font-size|medium"}}} /-->
						<!-- wp:post-date {"style":{"typography":{"fontSize":"var:preset|font-size|small"}}} /-->
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->
		
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
