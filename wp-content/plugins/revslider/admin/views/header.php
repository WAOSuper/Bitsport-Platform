<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2019 ThemePunch
 */

if(!defined('ABSPATH')) exit();

$rsaf	= new RevSliderFunctionsAdmin();
$rsa	= $rsaf->get_short_library();
$rsupd	= new RevSliderPluginUpdate();
$rsaddon= new RevSliderAddons();

$rs_addon_update		 = $rsaddon->check_addon_version();
$rs_addons				 = $rsaddon->get_addon_list();
$rs_wp_date_format		 = get_option('date_format');
$rs_wp_time_format		 = get_option('time_format');
$rs_added_image_sizes	 = $rsaf->get_all_image_sizes();
$rs_image_meta_todo		 = get_option('rs_image_meta_todo', array());
$rs_slider_update_needed = $rsupd->slider_need_update_checks();
$rs_global_settings		 = $rsaf->get_global_settings();
$rs_notices				 = $rsaf->add_notices();
$rs_color_picker_presets = RSColorpicker::get_color_presets();
$rs_compression			 = $rsaf->compression_settings();
$rs_backend_fonts		 = $rsaf->get_font_familys();
$rs_new_addon_counter	 = get_option('rs-addons-counter', false);
$rs_new_addon_counter	 = ($rs_new_addon_counter === false) ? count($rs_addons) : $rs_new_addon_counter;
$rs_new_temp_counter	 = get_option('rs-templates-counter', false);
if($rs_new_temp_counter === false){
	$_rs_tmplts			 = get_option('rs-templates', array());
	$rs_new_temp_counter = (isset($_rs_tmplts['slider'])) ? count($_rs_tmplts['slider']) : $rs_new_temp_counter;
}
$rs_global_sizes		 = array(
	'd' => $rsaf->get_val($rs_global_settings, array('size', 'desktop'), '1240'),
	'n' => $rsaf->get_val($rs_global_settings, array('size', 'notebook'), '1024'),
	't' => $rsaf->get_val($rs_global_settings, array('size', 'tablet'), '778'),
	'm' => $rsaf->get_val($rs_global_settings, array('size', 'mobile'), '480')
);
$rs_show_updated = get_option('rs_cache_overlay', RS_REVISION);
if(version_compare(RS_REVISION, $rs_show_updated, '>')){
    update_option('rs_cache_overlay', RS_REVISION);
}

?>
<!-- GLOBAL VARIABLES -->
<script type="text/javascript">
	window.RVS = window.RVS === undefined ? {F:{}, C:{}, ENV:{}, LIB:{}, V:{}, S:{}, DOC:jQuery(document), WIN:jQuery(window)} : window.RVS;
	
	RVS.LIB.ADDONS			= RVS.LIB.ADDONS === undefined ? {} : RVS.LIB.ADDONS;	
	RVS.LIB.ADDONS			= jQuery.extend(true,RVS.LIB.ADDONS,<?php echo (!empty($rs_addons)) ? 'jQuery.parseJSON('.$rsaf->json_encode_client_side($rs_addons).')' : '{}'; ?>);	
	RVS.LIB.OBJ 			= {types: jQuery.parseJSON(<?php echo $rsaf->json_encode_client_side($rsa); ?>)};
	RVS.LIB.SLIDERS			= <?php echo json_encode(RevSliderSlider::get_sliders_short_list()); ?>;
	RVS.LIB.COLOR_PRESETS	= <?php echo (!empty($rs_color_picker_presets)) ? 'jQuery.parseJSON('. $rsaf->json_encode_client_side($rs_color_picker_presets) .')' : '{}'; ?>;

	RVS.ENV.addOns_to_update = <?php echo (!empty($rs_addon_update)) ? 'jQuery.parseJSON('.$rsaf->json_encode_client_side($rs_addon_update).')' : '{}'; ?>;
	RVS.ENV.activated		= '<?php echo (get_option('revslider-valid', 'false')) == 'true' ? 'true' : 'false'; ?>';
	RVS.ENV.activated		= RVS.ENV.activated == 'true' || RVS.ENV.activated == true ? true : false;
	RVS.ENV.nonce			= '<?php echo wp_create_nonce('revslider_actions'); ?>';
	RVS.ENV.plugin_dir		= 'revslider';
	RVS.ENV.slug_path		= '<?php echo RS_PLUGIN_SLUG_PATH; ?>';
	RVS.ENV.slug			= '<?php echo RS_PLUGIN_SLUG; ?>';
	RVS.ENV.plugin_url		= '<?php echo RS_PLUGIN_URL; ?>';
	RVS.ENV.wp_plugin_url 	= '<?php echo WP_PLUGIN_URL . "/"; ?>';
	RVS.ENV.admin_url		= '<?php echo admin_url('admin.php?page=revslider'); ?>';
	RVS.ENV.revision		= '<?php echo RS_REVISION; ?>';
	RVS.ENV.updated			= <?php echo (version_compare(RS_REVISION, $rs_show_updated, '>')) ? 'true' : 'false'; ?>;
	RVS.ENV.latest_version	= '<?php echo get_option('revslider-latest-version', RS_REVISION); ?>';	
	RVS.ENV.php_version		= '<?php echo phpversion(); ?>';
	RVS.ENV.output_compress	= <?php echo (!empty($rs_compression)) ? 'jQuery.parseJSON('. $rsaf->json_encode_client_side($rs_compression) .')' : '[]'; ?>;
	RVS.ENV.placeholder		= {
		date_format:		'<?php echo $rs_wp_date_format; ?>',
		time_format:		'<?php echo $rs_wp_time_format; ?>',
		date_today:			'<?php echo date($rs_wp_date_format); ?>',
		time:				'<?php echo date($rs_wp_time_format); ?>',
		tomorrow:			'<?php echo date($rs_wp_date_format, strtotime(date($rs_wp_date_format) . ' +1 day')); ?>',
		last_week:			'<?php echo date($rs_wp_date_format, strtotime(date($rs_wp_date_format) . ' -7 day')); ?>',
		<?php
		if(RevSliderWooCommerce::woo_exists()){
			$wc = new WC_Product(0);
		?>wc_full_price:		'<?php echo wc_price('99') . $wc->get_price_suffix(); ?>',
		wc_price:			'<?php echo strip_tags(wc_price('99') . $wc->get_price_suffix()); ?>',
		wc_price_no_cur:	'<?php echo strip_tags(wc_price('99')); ?>',
		wc_categories:		'shoes, socks',
		wc_tags:			'comfort, health',
		<?php
		}
		if(RevSliderEventsManager::isEventsExists()){
		?>event_start_date:	'<?php echo date($rs_wp_date_format); ?>',
		event_end_date:		'<?php echo date($rs_wp_date_format); ?>',
		event_start_time:	'<?php echo date($rs_wp_time_format); ?>',
		event_end_time:		'<?php echo date($rs_wp_time_format); ?>',
		<?php
		}
		?>date:				'<?php echo date($rs_wp_date_format); ?>',
		date_modified:		'<?php echo date($rs_wp_date_format); ?>'
	};
	RVS.ENV.glb_slizes		= jQuery.parseJSON(<?php echo $rsaf->json_encode_client_side($rs_global_sizes); ?>);
	RVS.ENV.img_sizes		= jQuery.parseJSON(<?php echo $rsaf->json_encode_client_side($rs_added_image_sizes); ?>);
	RVS.ENV.create_img_meta	= <?php echo (!empty($rs_image_meta_todo)) ? 'true' : 'false'; ?>;
	RVS.ENV.notices			= <?php echo (!empty($rs_notices)) ? 'jQuery.parseJSON('. $rsaf->json_encode_client_side($rs_notices) .')' : '[]'; ?>;
	RVS.ENV.selling			= <?php echo ($rsaf->get_addition('selling') === true) ? 'true' : 'false'; ?>;
	RVS.ENV.newAddonsAmount = '<?php echo $rs_new_addon_counter; ?>';
	RVS.ENV.newTemplatesAmount = '<?php echo $rs_new_temp_counter; ?>';
	
	<?php
	if($rs_slider_update_needed == true){
	?>
	var RS_DO_SILENT_SLIDER_UPDATE = <?php echo ($rs_slider_update_needed == true) ? 'true' : 'false'; ?>;
	
	if(RS_DO_SILENT_SLIDER_UPDATE === true){
		//push request to update slider for slider until finished
		jQuery(document).ready(function(){
			rs_do_silent_update();
		});
	}
	
	function rs_do_silent_update(){
		RVS.F.ajaxRequest('silent_slider_update', {}, function(response){
			if(response.status !== 'finished'){
				rs_do_silent_update();
			}else{
				RS_DO_SILENT_SLIDER_UPDATE = false;
			}
		}, true);
	}
	<?php
	}
	?>
</script>
<?php
do_action('revslider_header_content', $rsaf);
?>

<?php
//add custom fonts that have backend set to true
if(!empty($rs_backend_fonts)){
	foreach($rs_backend_fonts as $rs_bf){
		if($rs_bf['type'] === 'custom' && isset($rs_bf['url']) && isset($rs_bf['backend']) && $rs_bf['backend'] === true){
			echo '<link href="'.esc_html($rs_bf['url']).'" rel="stylesheet" property="stylesheet" media="all" type="text/css" >'."\n";
		}
	}
}
?>

<?php
//added for builder
?>
<script src="https://player.vimeo.com/api/player.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<!-- COLLECTOR FOR ADDONS -->


<!-- WAIT A MINUTE OVERLAY CONTAINER -->
<div id="waitaminute" class="_TPRB_">
	<div class="waitaminute-message"><i class="eg-icon-emo-coffee"></i><br><?php _e('Please Wait...', 'revslider'); ?></div>
</div>

<!-- TOP RIGHT CORNER INFORMATION CONTAINER -->
<div id="rb_maininfo_wrap" class="_TPRB_"></div>