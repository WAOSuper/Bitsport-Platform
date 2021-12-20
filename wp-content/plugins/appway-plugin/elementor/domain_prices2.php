<?php

namespace APPWAYPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Domain_Prices2 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_domain_prices2';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Domain Prices 2', 'appway' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-briefcase';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'appway' ];
	}
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'domain_prices2',
			[
				'label' => esc_html__( 'Domain Prices 2', 'appway' ),
			]
		);
		$this->add_control(
			'sec_class',
			[
				'label'       => __( 'Section Class', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Section Class', 'rashid' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'title1',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'title2',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'feature_str',
			[
				'label'       => __( 'Features List', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Features List', 'rashid' ),
				'default'     => __( '', 'rashid' ),
			]
		);

	$this->end_controls_section();
		
	// New Tab#1

	$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Pricing Inner', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		$this->add_control(
						'bgimg',
						[
							'label' => esc_html__('Background image', 'rashid'),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						]
					);
		$this->add_control(
			'title3',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'feature_str1',
			[
				'label'       => __( 'Features List', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Features List', 'rashid' ),
				'default'     => __( '', 'rashid' ),
			]
		);
	$this->end_controls_section();
		
	// New Tab#1

	$this->start_controls_section(
				'content_section1',
				[
					'label' => __( 'Pricing Inner', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		$this->add_control(
			'title4',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'feature_str2',
			[
				'label'       => __( 'Features List', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Features List', 'rashid' ),
				'default'     => __( '', 'rashid' ),
			]
		);
	$this->end_controls_section();
		
	// New Tab#1
	$this->start_controls_section(
				'content_section2',
				[
					'label' => __( 'Pricing Inner', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		$this->add_control(
			'title5',
			[
				'label'       => __( 'Title', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'rashid' ),
			]
		);
		$this->add_control(
			'feature_str3',
			[
				'label'       => __( 'Features List', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Features List', 'rashid' ),
				'default'     => __( '', 'rashid' ),
			]
		);
	$this->end_controls_section();

	
	
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	 
	 
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		?>
<section class="domain-prices <?php echo esc_attr($settings['sec_class']);?>">
        <div class="container">
            <div class="sec-title center">
                <h3><?php echo $settings['title'];?></h3>
                <h2><?php echo $settings['title1'];?></h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 small-column">
                    <div class="domain-name">
                        <ul class="name-list">
                            <li class="heading"><?php echo $settings['title2'];?></li>
                            
							<?php $fearures = explode("\n", ($settings['feature_str']));?>
							<?php foreach($fearures as $feature):?>
							
							<li><?php echo wp_kses($feature, true); ?></li>
                            
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 big-column">
                    <div class="pricing-inner clearfix">
                        <div class="pattern-layer" style="background-image: url(<?php echo wp_get_attachment_url($settings['bgimg']['id']);?>);"></div>
                        <ul class="pricing-table">
                            <li class="heading"><?php echo $settings['title3'];?></li>
                            
							<?php $fearures = explode("\n", ($settings['feature_str1']));?>
							<?php foreach($fearures as $feature):?>
							
							<li><?php echo wp_kses($feature, true); ?></li>
                            
							<?php endforeach; ?>
                        </ul>
                        <ul class="pricing-table">
                            <li class="heading"><?php echo $settings['title4'];?></li>
                            
							<?php $fearures = explode("\n", ($settings['feature_str2']));?>
							<?php foreach($fearures as $feature):?>
							
							<li><?php echo wp_kses($feature, true); ?></li>
                            
							<?php endforeach; ?>
                        </ul>
                        <ul class="pricing-table">
                            <li class="heading"><?php echo $settings['title5'];?></li>
                            
							<?php $fearures = explode("\n", ($settings['feature_str3']));?>
							<?php foreach($fearures as $feature):?>
							
							<li><?php echo wp_kses($feature, true); ?></li>
                            
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
		<?php 
	}

}