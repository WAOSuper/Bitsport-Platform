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
class Pricing extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_pricing';
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
		return esc_html__( 'Pricing', 'appway' );
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
			'pricing',
			[
				'label' => esc_html__( 'Pricing', 'appway' ),
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
			'text',
			[
				'label'       => __( 'Description Text', 'rashid' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'rashid' ),
			]
		);	
		$this->add_control(
			'bttn',
			[
				'label'       => __( 'Button', 'rashid' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'rashid' ),
			]
		);
		$this->add_control(
			'bttn1',
			[
				'label'       => __( 'Button', 'rashid' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title', 'rashid' ),
			]
		);
		
		$this->end_controls_section();
		
		// New Tab#1

	$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Tab 1', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Column', 'fixkar' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'12'   => esc_html__( 'One Column', 'fixkar' ),
					'6'   => esc_html__( 'Two Column', 'fixkar' ),
					'4'   => esc_html__( 'Three Column', 'fixkar' ),
					'3'   => esc_html__( 'Four Column', 'fixkar' ),
					'2'   => esc_html__( 'Six Column', 'fixkar' ),
				),
			]
		);
		$this->add_control(
              'repeat', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'seperator' => 'before',
            		'default' => 
						[
                			['block_title' => esc_html__('Projects Completed', 'rashid')],
            			],
            		'fields' => 
						[
							[
							  'name' => 'block_image',
							  'label' => __( 'Image', 'rashid' ),
							  'type' => Controls_Manager::MEDIA,
							  'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
								'name' => 'block_imgtitle',
								'label' => esc_html__('Image Text', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_title',
								'label' => esc_html__('Title', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_amount',
								'label' => esc_html__('Amount', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('99', 'rashid')
							],
							[
								'name' => 'block_currency',
								'label' => esc_html__('Currency', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('$', 'rashid')
							],
							[
								'name' => 'block_feature_str',
								'label'       => __( 'Features List', 'rashid' ),
								'type'        => Controls_Manager::TEXTAREA,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enter your Features List', 'rashid' ),
								'default'     => __( '', 'rashid' ),
							],
							[
								'name' => 'block_button',
								'label'       => __( 'Button', 'rashid' ),
								'type'        => Controls_Manager::TEXT,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enter your Button Title', 'rashid' ),
							],
							[
							  'name' => 'block_btnlink',
							  'label' => __( 'Button Url', 'rashid' ),
							  'type' => Controls_Manager::URL,
							  'placeholder' => __( 'https://your-link.com', 'rashid' ),
							  'show_external' => true,
							  'default' => [
								'url' => '',
								'is_external' => true,
								'nofollow' => true,
							  ],
						   ],
            			],
            	    'title_field' => '{{block_title}}',
                 ]
        );
		
		
		$this->end_controls_section();
		
	// New Tab#2

	$this->start_controls_section(
				'content_section1',
				[
					'label' => __( 'Tab 2', 'rashid' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
			'column1',
			[
				'label'   => esc_html__( 'Column', 'fixkar' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'12'   => esc_html__( 'One Column', 'fixkar' ),
					'6'   => esc_html__( 'Two Column', 'fixkar' ),
					'4'   => esc_html__( 'Three Column', 'fixkar' ),
					'3'   => esc_html__( 'Four Column', 'fixkar' ),
					'2'   => esc_html__( 'Six Column', 'fixkar' ),
				),
			]
		);
		$this->add_control(
              'repeat1', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'seperator' => 'before',
            		'default' => 
						[
                			['block_title' => esc_html__('Projects Completed', 'rashid')],
            			],
            		'fields' => 
						[
							[
							  'name' => 'block_image1',
							  'label' => __( 'Image', 'rashid' ),
							  'type' => Controls_Manager::MEDIA,
							  'default' => ['url' => Utils::get_placeholder_image_src(),],
							],
							[
								'name' => 'block_imgtitle1',
								'label' => esc_html__('Image Text', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_title1',
								'label' => esc_html__('Title', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('', 'rashid')
							],
							[
								'name' => 'block_amount1',
								'label' => esc_html__('Amount', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('99', 'rashid')
							],
							[
								'name' => 'block_currency1',
								'label' => esc_html__('Currency', 'rashid'),
								'type' => Controls_Manager::TEXTAREA,
								'default' => esc_html__('$', 'rashid')
							],
							[
								'name' => 'block_feature_str1',
								'label'       => __( 'Features List', 'rashid' ),
								'type'        => Controls_Manager::TEXTAREA,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enter your Features List', 'rashid' ),
								'default'     => __( '', 'rashid' ),
							],
							[
								'name' => 'block_button1',
								'label'       => __( 'Button', 'rashid' ),
								'type'        => Controls_Manager::TEXT,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enter your Button Title', 'rashid' ),
							],
							[
							  'name' => 'block_btnlink',
							  'label' => __( 'Button Url', 'rashid' ),
							  'type' => Controls_Manager::URL,
							  'placeholder' => __( 'https://your-link.com', 'rashid' ),
							  'show_external' => true,
							  'default' => [
								'url' => '',
								'is_external' => true,
								'nofollow' => true,
							  ],
						   ],
            			],
            	    'title_field' => '{{block_title}}',
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

          
           
<!-- pricing-section -->
    <section class="pricing-section centred <?php echo $settings['sec_class'];?>">
        <div class="container">
            <div class="sec-title center">
                <h2><?php echo $settings['title'];?></h2>
                <p><?php echo $settings['text'];?></p>
            </div>
            <div class="tabs-box">
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="row">
						
							<?php foreach($settings['repeat'] as $item):?>
						
                            <div class="col-lg-<?php echo esc_attr($settings['column'], true );?> col-md-6 col-sm-12 pricing-column">
                                <div class="pricing-block-one">
                                    <div class="pricing-table">
                                        
										<?php if(wp_get_attachment_url($item['block_image']['id'])): ?>
										<figure class="image"><img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle'], $allowed_tags);?>"></figure>
										<?php endif; ?>
										
										
                                        <div class="table-header">
                                            <h3 class="title"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h3>
                                            <h2 class="price"><?php echo wp_kses($item['block_amount'], $allowed_tags);?><span><?php echo wp_kses($item['block_currency'], $allowed_tags);?></span></h2>
                                        </div>
                                        <div class="table-content">
                                            <ul> 
                                                <?php $fearures = explode("\n", ($item['block_feature_str']));?>
												<?php foreach($fearures as $feature):?>
												<?php echo wp_kses($feature, true); ?>
												<?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="<?php echo esc_url($item['block_btnlink']['url']);?>" class="theme-btn-two"><?php echo wp_kses($item['block_button'], $allowed_tags);?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>
                    <div class="tab" id="tab-2">
                        <div class="row">
						
							<?php foreach($settings['repeat1'] as $item):?>
						
                            <div class="col-lg-<?php echo esc_attr($settings['column1'], true );?> col-md-6 col-sm-12 pricing-column">
                                <div class="pricing-block-one">
                                    <div class="pricing-table">
                                        
										<?php if(wp_get_attachment_url($item['block_image1']['id'])): ?>
										<figure class="image"><img src="<?php echo wp_get_attachment_url($item['block_image1']['id']);?>" alt="<?php echo wp_kses($item['block_imgtitle1'], $allowed_tags);?>"></figure>
										<?php endif; ?>
										
                                        <div class="table-header">
                                            <h3 class="title"><?php echo wp_kses($item['block_title1'], $allowed_tags);?></h3>
                                            <h2 class="price"><?php echo wp_kses($item['block_amount1'], $allowed_tags);?><span><?php echo wp_kses($item['block_currency1'], $allowed_tags);?></span></h2>
                                        </div>
                                        <div class="table-content">
                                            <ul> 
                                                <?php $fearures = explode("\n", ($item['block_feature_str1']));?>
												<?php foreach($fearures as $feature):?>
												<?php echo wp_kses($feature, true); ?>
												<?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="table-footer">
                                            <a href="<?php echo esc_url($item['block_btnlink']['url']);?>" class="theme-btn-two"><?php echo wp_kses($item['block_button1'], $allowed_tags);?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<?php endforeach; ?>
							
                        </div>
                    </div>           
                </div>
                <div class="tab-btn-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><?php echo $settings['bttn'];?></li>
                        <li class="tab-btn" data-tab="#tab-2"><?php echo $settings['bttn1'];?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-section end -->
            
		<?php 
	}

}