<?php // Google Analytics - Core Functions

if (!function_exists('add_action')) die();

function ga_google_analytics_init($GA_Google_Analytics) {
	
	$options = get_option('gap_options', $GA_Google_Analytics->default_options());
	
	$location = isset($options['gap_location']) ? $options['gap_location'] : 'header';
	
	$admin = isset($options['admin_area']) ? $options['admin_area'] : 0;
	
	$function = 'ga_google_analytics_tracking_code';
	
	if ($location === 'header') {
		
		if ($admin) add_action('admin_head', $function);
		
		add_action('wp_head', $function);
		
	} else {
		
		if ($admin) add_action('admin_footer', $function);
		
		add_action('wp_footer', $function);
		
	}
	
}

function ga_google_analytics_tracking_code() {
	
	extract(ga_google_analytics_options());
	
	if (empty($tracking_id)) {
		
		echo $custom;
		
		return;
		
	}
	
	if (empty($tracking_method)) return;
	
	if (current_user_can('administrator') && $disable_admin) return;
	
	if ($custom && $custom_location) echo $custom . "\n";
	
	if ($tracking_method == 3) {
		
		ga_google_analytics_legacy($options);
		
	} elseif ($tracking_method == 2) {
		
		ga_google_analytics_global($options);
		
	} else {
		
		if ($universal) {
			
			ga_google_analytics_universal($options);
			
		} else {
			
			ga_google_analytics_legacy($options);
			
		}
		
	}
	
	if ($custom && !$custom_location) echo $custom . "\n";
	
}

function ga_google_analytics_credit() {
	
	return '<!-- GA Google Analytics @ https://m0n.co/ga -->' ."\n";
	
}

function ga_google_analytics_universal() {
	
	extract(ga_google_analytics_options());
	
	$custom_code = ga_google_analytics_custom_code($custom_code);
	
	$auto = apply_filters('ga_google_analytics_enable_auto', true) ? ", 'auto'" : "";
	
	$ga_display = "ga('require', 'displayfeatures');";
	$ga_link    = "ga('require', 'linkid');";
	$ga_anon    = "ga('set', 'anonymizeIp', true);";
	$ga_ssl     = "ga('set', 'forceSSL', true);";
	
	$script_atts = apply_filters('ga_google_analytics_script_atts', '');
	
	?>

		<?php echo ga_google_analytics_credit(); ?>
		<script<?php echo esc_attr($script_atts); ?>>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php echo $tracking_id; ?>'<?php echo $auto; if ($tracker_object) echo ', '. stripslashes(rtrim($tracker_object)); ?>);
			<?php 
				if ($custom_code) echo $custom_code . "\n\t\t\t";
				if ($display_ads) echo $ga_display  . "\n\t\t\t";
				if ($link_attr)   echo $ga_link     . "\n\t\t\t";
				if ($anonymize)   echo $ga_anon     . "\n\t\t\t";
				if ($force_ssl)   echo $ga_ssl      . "\n\t\t\t";
			?>ga('send', 'pageview');
		</script>

	<?php
	
}

function ga_google_analytics_global() {
	
	extract(ga_google_analytics_options());
	
	$custom_code = ga_google_analytics_custom_code($custom_code);
	
	$script_atts_ext = apply_filters('ga_google_analytics_script_atts_ext', ' async');
	
	$script_atts = apply_filters('ga_google_analytics_script_atts', '');
	
	?>

		<?php echo ga_google_analytics_credit(); ?>
		<script<?php echo esc_attr($script_atts_ext); ?> src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_id; ?>"></script>
		<script<?php echo esc_attr($script_atts); ?>>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			<?php if ($custom_code) echo $custom_code . "\n\t\t\t";
			?>gtag('config', '<?php echo $tracking_id; ?>'<?php if ($tracker_object) echo ', '. stripslashes(rtrim($tracker_object)); ?>);
		</script>

	<?php
	
}

function ga_google_analytics_legacy() {
	
	extract(ga_google_analytics_options());
	
	$custom_code = ga_google_analytics_custom_code($custom_code);
	
	$ga_alt  = "('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';";
	$ga_src  = "('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';";
	$ga_link = "var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';\n\t\t\t_gaq.push(['_require', 'inpage_linkid', pluginUrl]);";
	$ga_anon = "_gaq.push(['_gat._anonymizeIp']);";
	$ga_ssl  = "_gaq.push(['_gat._forceSSL']);";
	
	if ($display_ads) $ga_src = $ga_alt;
	
	$script_atts = apply_filters('ga_google_analytics_script_atts', '');
	
	?>

		<?php echo ga_google_analytics_credit(); ?>
		<script<?php echo esc_attr($script_atts); ?> type="text/javascript">
			var _gaq = _gaq || [];
			<?php 
				if ($link_attr)   echo $ga_link     . "\n\t\t\t";
				if ($anonymize)   echo $ga_anon     . "\n\t\t\t"; 
				if ($force_ssl)   echo $ga_ssl      . "\n\t\t\t"; 
				if ($custom_code) echo $custom_code . "\n\t\t\t"; 
			?>_gaq.push(['_setAccount', '<?php echo $tracking_id; ?>']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = <?php echo $ga_src . "\n"; ?>
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>

	<?php
	
}

function ga_google_analytics_custom_code($custom_code) {
	
	$custom_code_array = explode(PHP_EOL, $custom_code);
	
	$custom_code = '';
	
	foreach ($custom_code_array as $code) {
		
		$code = preg_replace("/%%userid%%/i", get_current_user_id(), $code);
		
		$custom_code .= "\t\t\t" . rtrim($code) . "\n";
		
	}
	
	$custom_code = stripslashes(trim($custom_code));
	
	return apply_filters('gap_custom_code', $custom_code);
	
}

function ga_google_analytics_options() {
	
	global $GA_Google_Analytics;
	
	$options = get_option('gap_options', $GA_Google_Analytics->default_options());
	
	$tracking_id = (isset($options['gap_id']) && !empty($options['gap_id'])) ? $options['gap_id'] : '';
	
	$location        = isset($options['gap_location'])    ? $options['gap_location']    : 'header';
	
	$tracking_method = isset($options['gap_enable'])      ? $options['gap_enable']      : 1;
	
	$universal       = isset($options['gap_universal'])   ? $options['gap_universal']   : 1;
	
	$display_ads     = isset($options['gap_display_ads']) ? $options['gap_display_ads'] : 0;
	
	$link_attr       = isset($options['link_attr'])       ? $options['link_attr']       : 0;
	
	$anonymize       = isset($options['gap_anonymize'])   ? $options['gap_anonymize']   : 0;
	
	$force_ssl       = isset($options['gap_force_ssl'])   ? $options['gap_force_ssl']   : 0;
	
	$admin_area      = isset($options['admin_area'])      ? $options['admin_area']      : 0;
	
	$disable_admin   = isset($options['disable_admin'])   ? $options['disable_admin']   : 0;
	
	$custom_location = isset($options['gap_custom_loc'])  ? $options['gap_custom_loc']  : 0;
	
	$tracker_object  = isset($options['tracker_object'])  ? $options['tracker_object']  : '';
	
	$custom_code     = isset($options['gap_custom_code']) ? $options['gap_custom_code'] : '';
	
	$custom          = isset($options['gap_custom'])      ? $options['gap_custom']      : '';
	
	// $options, $tracking_id, $location, $tracking_method, $universal, $display_ads, $link_attr, $anonymize, 
	// $force_ssl, $admin_area, $disable_admin, $custom_location, $tracker_object, $custom_code, $custom
	
	$options_array = array(
		
		'options'         => $options,
		'tracking_id'     => $tracking_id,
		'location'        => $location,
		'tracking_method' => $tracking_method,
		'universal'       => $universal,
		'display_ads'     => $display_ads,
		'link_attr'       => $link_attr,
		'anonymize'       => $anonymize,
		'force_ssl'       => $force_ssl,
		'admin_area'      => $admin_area,
		'disable_admin'   => $disable_admin,
		'custom_location' => $custom_location,
		'tracker_object'  => $tracker_object,
		'custom_code'     => $custom_code,
		'custom'          => $custom
	);
	
	return apply_filters('ga_google_analytics_options_array', $options_array);
	
}
