<?php
/**
 * Title: MIRA Luxury Journal
 * Slug: pergamon/home-mira
 * Categories: featured
 */
?>

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)">
	
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns">
		
		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%">
			<!-- wp:query {"queryId":1,"query":{"perPage":1,"offset":0,"postType":"post","order":"desc","orderBy":"date"},"layout":{"type":"default"}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","color":"#E6DECA"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"layout":{"type":"default"}} -->
					<div class="wp-block-group has-border-color has-background" style="border-color:#E6DECA;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
						
						<!-- wp:columns {"verticalAlignment":"center"} -->
						<div class="wp-block-columns are-vertically-aligned-center">
							<!-- wp:column {"width":"50%"} -->
							<div class="wp-block-column" style="flex-basis:50%">
								<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"12px"}}} /-->
							</div>
							<!-- /wp:column -->
							
							<!-- wp:column {"width":"50%"} -->
							<div class="wp-block-column" style="flex-basis:50%">
								<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase","letterSpacing":"1px","fontWeight":"600"},"color":{"text":"var:preset|color|muted"}}} /-->
								<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"var:preset|font-size|x-large","lineHeight":"1.2","fontFamily":"var:preset|font-family|serif"},"spacing":{"margin":{"top":"0.5rem","bottom":"1rem"}}}} /-->
								<!-- wp:post-excerpt {"style":{"typography":{"fontSize":"var:preset|font-size|normal"},"color":{"text":"var:preset|color|muted"}}} /-->
								
								<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
								<div class="wp-block-buttons">
									<!-- wp:button {"backgroundColor":"primary","textColor":"base","style":{"border":{"radius":"8px"},"typography":{"fontSize":"0.85rem","textTransform":"uppercase","letterSpacing":"1px"}}} -->
									<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background" style="border-radius:8px;text-transform:uppercase;letter-spacing:1px;font-size:0.85rem">Read Article</a></div>
									<!-- /wp:button -->
								</div>
								<!-- /wp:buttons -->
							</div>
							<!-- /wp:column -->
						</div>
						<!-- /wp:columns -->
						
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:query {"queryId":2,"query":{"perPage":2,"offset":1,"postType":"post","order":"desc","orderBy":"date"},"layout":{"type":"default"}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","color":"#E6DECA"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"margin":{"bottom":"var:preset|spacing|30"}}},"layout":{"type":"default"}} -->
					<div class="wp-block-group has-border-color has-background" style="border-color:#E6DECA;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">
						
						<!-- wp:columns {"verticalAlignment":"center"} -->
						<div class="wp-block-columns are-vertically-aligned-center">
							<!-- wp:column {"width":"40%"} -->
							<div class="wp-block-column" style="flex-basis:40%">
								<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1/1","style":{"border":{"radius":"12px"}}} /-->
							</div>
							<!-- /wp:column -->
							
							<!-- wp:column {"width":"60%"} -->
							<div class="wp-block-column" style="flex-basis:60%">
								<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"var:preset|font-size|medium","lineHeight":"1.3","fontFamily":"var:preset|font-family|serif"},"spacing":{"margin":{"top":"0","bottom":"0.5rem"}}}} /-->
								<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem"},"color":{"text":"var:preset|color|muted"}}} -->
								<p class="has-text-color" style="color:var(--wp--preset--color--muted);font-size:0.75rem">Read More →</p>
								<!-- /wp:paragraph -->
							</div>
							<!-- /wp:column -->
						</div>
						<!-- /wp:columns -->
						
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->
		
	</div>
	<!-- /wp:columns -->

	<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"border"} -->
	<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity is-style-wide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--50)"/>
	<!-- /wp:separator -->

	<!-- wp:query {"queryId":3,"query":{"perPage":4,"offset":3,"postType":"post","order":"desc","orderBy":"date"},"layout":{"type":"default"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":4}} -->
			<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","color":"#E6DECA"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group has-border-color has-background" style="border-color:#E6DECA;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
				
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"12px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.7rem","textTransform":"uppercase","fontWeight":"600"},"color":{"text":"var:preset|color|muted"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} /-->
				<!-- wp:post-title {"isLink":true,"level":4,"style":{"typography":{"fontSize":"var:preset|font-size|medium","lineHeight":"1.3","fontFamily":"var:preset|font-family|serif"},"spacing":{"margin":{"top":"0.5rem"}}}} /-->
				
				<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"},"padding":{"top":"var:preset|spacing|20"}},"border":{"top":{"color":"#E6DECA","width":"1px"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
				<div class="wp-block-group" style="border-top-color:#E6DECA;border-top-width:1px;margin-top:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--20)">
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.7rem"},"color":{"text":"var:preset|color|muted"}}} -->
					<p class="has-text-color" style="color:var(--wp--preset--color--muted);font-size:0.7rem">Read More</p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.7rem","fontWeight":"bold"},"color":{"text":"var:preset|color|primary"}}} -->
					<p class="has-text-color" style="color:var(--wp--preset--color--primary);font-size:0.7rem;font-weight:bold">→</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				
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
