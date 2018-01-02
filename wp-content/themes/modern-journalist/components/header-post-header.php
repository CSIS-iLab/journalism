<?php
/**
 * Post Header Component
 *
 * @package Aerospace
 */

?> 
<div class="header-bottom  post-header">
	<div class="header-post-header">
		<div class="header-post-header-title">
			<?php
			
			the_title();
			?>
		</div>
		<div class="header-post-header-right">

		<div class="header-post-header-chapters">
			<span class="meta-label"><i class="icon-bookmark"></i>Sections</span>
			
			
		</div>
		<div class="header-post-header-share">
			<span class="meta-label">Share</span>
			<div class="post-share-social inline-social-list">
				<?php
		if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
					ADDTOANY_SHARE_SAVE_KIT();
				}
		?>
		</div>
		</div>
	</div>
	</div>
	<div class="post-nav-container">
	<div class="post-nav">
	<div class="post-links">
		<span class="post-nav-toTop"><a href="#page">TOP<i class="icon icon-arrow-long-up"></i></a></span>
		<ul class="post-nav-toc"></ul>
	</div>
	<div class="post-share">
		<div class="post-share-social">
				<?php
		if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
					ADDTOANY_SHARE_SAVE_KIT();
				}
		?>
		</div>
			<div class="post-share-other">
			
			
			</div>
	</div>
</div><!-- post-nav -->
</div> <!-- header-bottom -->


