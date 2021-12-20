<?php $style = $options->get('theme_preloader_style') ?>
<?php if($style == 1) : ?>
	 <div class="preloader"></div>
<?php elseif($style == 2): ?>
	<div class="loader-inner ball-grid-pulse">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 3): ?>
	<div class="loader-inner ball-clip-rotate">
		<div></div>
	</div>
<?php elseif($style == 4): ?>
	<div class="loader-inner ball-clip-rotate-pulse">
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 5): ?>
	<div class="loader-inner square-spin">
		<div></div>
	</div>
<?php elseif($style == 6): ?>
	<div class="loader-inner ball-clip-rotate-multiple">
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 7): ?>
	<div class="loader-inner ball-pulse-rise">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 8): ?>
	<div class="loader-inner ball-rotate">
		<div></div>
	</div>
<?php elseif($style == 9): ?>
	<div class="loader-inner cube-transition">
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 10): ?>
	<div class="loader-inner ball-zig-zag">
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 11): ?>
	<div class="loader-inner ball-zig-zag-deflect">
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 12): ?>
	<div class="loader-inner ball-triangle-path">
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 13): ?>
	<div class="loader-inner ball-scale">
		<div></div>
	</div>
<?php elseif($style == 14): ?>
	<div class="loader-inner line-scale">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 15): ?>
	<div class="loader-inner line-scale-party">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 16): ?>
	<div class="loader-inner ball-scale-multiple">
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 17): ?>
	<div class="loader-inner ball-pulse-sync">
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 18): ?>
	<div class="loader-inner ball-beat">
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 19): ?>
	<div class="loader-inner line-scale-pulse-out">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 20): ?>
	<div class="loader-inner line-scale-pulse-out-rapid">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 21): ?>
	<div class="loader-inner ball-scale-ripple">
		<div></div>
	</div>
<?php elseif($style == 22): ?>
	<div class="loader-inner ball-scale-ripple-multiple">
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 23): ?>
	<div class="loader-inner ball-spin-fade-loader">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 24): ?>
	<div class="loader-inner line-spin-fade-loader">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 25): ?>
	<div class="loader-inner triangle-skew-spin">
		<div></div>
	</div>
<?php elseif($style == 26): ?>
	<div class="loader-inner pacman">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 27): ?>
	<div class="loader-inner ball-grid-beat">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
<?php elseif($style == 28): ?>
	<div class="loader-inner semi-circle-spin">
		<div></div>
	</div>

<?php else: ?>
	<div class="loader-inner semi-circle-spin">
		<div></div>
	</div>
<?php endif; ?>