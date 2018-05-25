<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_TT_Circle_Progress_Bar extends Widget_Base {

	public function get_name() {
		return 'tt-circle-bar';
	}

	public function get_title() {
		return __( 'Circle Progress Bar', 'elementor-custom-element' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
	}

	public function get_script_depends() {
		return array( 'jquery-numerator' );
	}

	protected function _register_controls() {

		/**
		 * Tab Content
		 *
		 * Section Circle Progress Bar
		 */
		$this->start_controls_section(
			'circle_bar_section_content',
			[
				'label'      => __( 'Circle Progress Bar', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_CONTENT,
				'show_label' => false,
			]
		);
		$this->add_control(
			'values_type',
			array(
				'label'   => esc_html__( 'Progress Bar Type', 'elementor-custom-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'percent',
				'options' => array(
					'percent'  => esc_html__( 'Percent', 'elementor-custom-element' ),
					'custom'   => esc_html__( 'Custom Value', 'elementor-custom-element' ),
				),
			)
		);
		$this->add_control(
			'percent_value',
			array(
				'label'      => esc_html__( 'Current Percent', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 75,
				),
				'range'      => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition' => array(
					'values_type' => 'percent',
				),
			)
		);
		$this->add_control(
			'custom_value_curr',
			array(
				'label'     => esc_html__( 'Current Value', 'elementor-custom-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 75,
				'condition' => array(
					'values_type' => 'custom',
				),
			)
		);
		$this->add_control(
			'custom_value_max',
			array(
				'label'     => esc_html__( 'Max Value', 'elementor-custom-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 150,
				'condition' => array(
					'values_type' => 'custom',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Settings
		 */
		$this->start_controls_section(
			'circle_bar_section_settings',
			[
				'label'      => __( 'Settings', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_CONTENT,
				'show_label' => false,
			]
		);
		$this->add_control(
			'circle_size',
			array(
				'label'      => esc_html__( 'Size', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 150,
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 600,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tt-circle-progress-bar' => 'max-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tt-position-in-circle'  => 'height: {{SIZE}}{{UNIT}}',

				),
				'render_type' => 'template',
			)
		);
		$this->add_control(
			'value_thickness', //'value_stroke',
			array(
				'label'      => esc_html__( 'Thickness Value', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 7,
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 300,
					),
				),
			)
		);
		$this->add_control(
			'bg_thickness',
			array(
				'label'      => esc_html__( 'Thickness Background Value', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 7,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
			)
		);
		$this->add_control(
			'animation_time',
			array(
				'label'   => esc_html__( 'Animation Time', 'elementor-custom-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
				'min'     => 100,
				'step'    => 100,
			)
		);
		$this->add_control(
			'before_value',
			array(
				'label'       => esc_html__( 'Value Prefix Before', 'elementor-custom-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+',
				'placeholder' => '',
			)
		);
		$this->add_control(
			'after_value',
			array(
				'label'       => esc_html__( 'Value Prefix After', 'elementor-custom-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '%',
				'placeholder' => '',
			)
		);
		$this->add_control(
			'circle_title',
			array(
				'label'       => esc_html__( 'Circle Title', 'elementor-custom-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Circle Title',
				'placeholder' => 'Title',
			)
		);
		$this->add_control(
			'circle_subtitle',
			array(
				'label'       => esc_html__( 'Circle Subtitle', 'elementor-custom-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Circle Subtitle',
				'placeholder' => 'Subtitle',
			)
		);
		$this->add_control(
			'percent_position',
			array(
				'label'   => esc_html__( 'Percent Position', 'elementor-custom-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'in-circle',
				'options' => array(
					'in-circle'  => esc_html__( 'Inside', 'elementor-custom-element' ),
					'out-circle' => esc_html__( 'Outside', 'elementor-custom-element' ),
				),
			)
		);
		$this->add_control(
			'labels_position',
			array(
				'label'   => esc_html__( 'Label Position', 'elementor-custom-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'in-circle',
				'options' => array(
					'in-circle'  => esc_html__( 'Inside', 'elementor-custom-element' ),
					'out-circle' => esc_html__( 'Outside', 'elementor-custom-element' ),
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Tab Style
		 * 
		 * Section Circle Bar Style
		 */
		$this->start_controls_section(
			'circle_bar_section_style',
			array(
				'label'      => esc_html__( 'Circle Bar Style', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'circle_type',
			array(
				'label'       => esc_html__( 'Circle Type', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color' => array(
						'title' => esc_html__( 'Classic', 'elementor-custom-element' ),
						'icon'  => 'fa fa-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'elementor-custom-element' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'color',
				'label_block' => false,
				'render_type' => 'ui',
			)
		);
		$this->add_control(
			'circle_color',
			array(
				'label'     => esc_html__( 'Circle Color', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#009ee2',
				'condition' => array(
					'circle_type' => array( 'color' ),
				),
			)
		);
		$this->add_control(
			'circle_gradient_a',
			array(
				'label'     => esc_html__( 'Gradient Color A', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#009ee2',
				'condition' => array(
					'circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'circle_gradient_b',
			array(
				'label'     => esc_html__( 'Gradient Color B', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => array(
					'circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'circle_gradient_angle',
			array(
				'label'     => esc_html__( 'Gradient Angle', 'elementor-custom-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'min'       => 0,
				'max'       => 360,
				'step'      => 1,
				'condition' => array(
					'circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'bg_circle_type',
			array(
				'label'       => esc_html__( 'Background Circle Type', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color' => array(
						'title' => esc_html__( 'Color', 'elementor-custom-element' ),
						'icon'  => 'fa fa-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'elementor-custom-element' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'color',
				'label_block' => false,
				'render_type' => 'ui',
			)
		);
		$this->add_control(
			'bg_circle_color',
			array(
				'label'     => esc_html__( 'Background Circle Color', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e0e0e0',
				'condition' => array(
					'bg_circle_type' => array( 'color' ),
				),
			)
		);
		$this->add_control(
			'bg_circle_gradient_a',
			array(
				'label'     => esc_html__( 'Background Circle Color A', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e0e0e0',
				'condition' => array(
					'bg_circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'bg_circle_gradient_b',
			array(
				'label'     => esc_html__( 'Background Circle Color B', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => array(
					'bg_circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'bg_circle_gradient_angle',
			array(
				'label'     => esc_html__( 'Gradient Angle', 'elementor-custom-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'min'       => 0,
				'max'       => 360,
				'step'      => 1,
				'condition' => array(
					'bg_circle_type' => array( 'gradient' ),
				),
			)
		);
		$this->add_control(
			'bg_circle_fill_color',
			array(
				'label'     => esc_html__( 'Circle Fill Color', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .circle-progress-bg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'stroke_linecap',
			array(
				'label'   => esc_html__( 'Circle Line Endings', 'elementor-custom-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'butt',
				'options' => array(
					'butt'  => esc_html__( 'Flat', 'elementor-custom-element' ),
					'round' => esc_html__( 'Rounded', 'elementor-custom-element' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .circle-progress-value' => 'stroke-linecap: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Number
		 */
		$this->start_controls_section(
			'circle_bar_section_number',
			array(
				'label'      => esc_html__( 'Number', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'number_color',
			array(
				'label' => esc_html__( 'Color', 'jet-elements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tt-circle-counter .tt-circle-val',
			)
		);
		$this->add_responsive_control(
			'number_prefix_font_size',
			array(
				'label'      => esc_html__( 'Prefix Font Size', 'jet-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val .circle-before-value' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'number_prefix_alignment',
			array(
				'label'       => esc_html__( 'Prefix Alignment', 'jet-elements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'jet-elements' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-elements' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'jet-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val .circle-before-value' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'number_suffix_font_size',
			array(
				'label'      => esc_html__( 'Suffix Font Size', 'jet-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val .circle-after-value' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'number_suffix_alignment',
			array(
				'label'       => esc_html__( 'Suffix Alignment', 'jet-elements' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'jet-elements' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-elements' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'jet-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val .circle-after-value' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'number_padding',
			array(
				'label'      => esc_html__( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .tt-circle-val' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Title
		 */
		$this->start_controls_section(
			'circle_bar_section_title',
			array(
				'label'      => esc_html__( 'Title', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label' => esc_html__( 'Color', 'jet-elements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tt-circle-counter .circle-content-title',
			)
		);
		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Subtitle
		 */
		$this->start_controls_section(
			'circle_bar_section_subtitle',
			array(
				'label'      => esc_html__( 'Subtitle', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'subtitle_color',
			array(
				'label'  => esc_html__( 'Color', 'jet-elements' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-subtitle' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .tt-circle-counter .circle-content-subtitle',
			)
		);
		$this->add_responsive_control(
			'subtitle_padding',
			array(
				'label'      => esc_html__( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'subtitle_margin',
			array(
				'label'      => esc_html__( 'Margin', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tt-circle-counter .circle-content-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'circle-bar-wrap', array(
			'class'         => sprintf( 'tt-circle-progress-bar-wrap' ),
			'data-duration' => $this->get_settings( 'animation_time' ),
		) );
		$this->add_render_attribute( 'circle-bar', array(
			'class'         => sprintf( 'tt-circle-progress-bar' ),
		) );

		?>
		<div <?php echo $this->get_render_attribute_string( 'circle-bar-wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'circle-bar' ); ?>>
			<?php
				echo $this->get_circle_template();
				if ( 'in-circle' === $settings['percent_position'] || 'in-circle' === $settings['labels_position'] ) {
					echo '<div class="tt-position-in-circle">';
					echo $this->get_content_template('in-circle');
					echo '</div>';
				}
			?>
			</div>
			<?php
				if ( 'out-circle' === $settings['percent_position'] || 'out-circle' === $settings['labels_position'] ) {
					echo '<div class="tt-position-out-circle">';
					echo $this->get_content_template('out-circle');
					echo '</div>';
				}
			?>
		</div>	
		<?php
	}

	public function get_content_template( $val = null ) {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-circle-counter">
			<?php if ( $settings['percent_position'] === $val ) { ?>
			<div class="tt-circle-val">
				<?php
					echo sprintf( '<span class="circle-before-value">%s</span>', $settings['before_value'] );
					echo $this->get_counter_number();
					echo sprintf( '<span class="circle-after-value">%s</span>', $settings['after_value'] );
				?>
			</div>
			<?php } ?>
			<?php if ( $settings['labels_position'] === $val ) { ?>
			<div class="tt-circle-content">
				<?php
					echo sprintf( '<div class="circle-content-title">%s</div>', $settings['circle_title'] );
					echo sprintf( '<div class="circle-content-subtitle">%s</div>', $settings['circle_subtitle'] );
				?>
			</div>
			<?php } ?>
		</div>
	<?php
		return ob_get_clean();
	}

	public function get_counter_number() {
		$settings = $this->get_settings();
		$value = 0;
		if ( 'percent' === $settings['values_type'] ) {
			$value = $settings['percent_value']['size'];
		} else {
			$value  = $settings['custom_value_curr'];
		}
		$this->add_render_attribute( 'circle-counter', array(
			'class'         => 'circle-counter-number',
			'data-to-value' => $value,
		) );
		ob_start();
	?>
		<span <?php echo $this->get_render_attribute_string( 'circle-counter' ); ?>>0</span>
	<?php
		return ob_get_clean();
	}

	public function get_circle_template() {
		$settings   = $this->get_settings();
		if( is_array( $settings['circle_size'] ) ) { $circle_size = $settings['circle_size']['size']; } else { $circle_size = $settings['circle_size']; }
		if( is_array( $settings['circle_size'] ) ) { $value_thickness = $settings['value_thickness']['size']; } else { $value_thickness = $settings['value_thickness']; }
		if( is_array( $settings['circle_size'] ) ) { $bg_thickness = $settings['bg_thickness']['size']; } else { $bg_thickness = $settings['bg_thickness']; }
		$radius     = $circle_size / 2;
		$center     = $radius;
		$viewBox    = sprintf( '0 0 %1$s %1$s', $circle_size );
		if( $value_thickness >= $bg_thickness ) { $max = $value_thickness; } else { $max = $bg_thickness; }
		$radius     = $radius - ( $max / 2 );
		$value      = 0;
		if ( 'percent' === $settings['values_type'] ) {
			$value    = $settings['percent_value']['size'];
		} elseif ( 0 !== absint( $settings['custom_value_max'] ) ) {
			$curr     = $settings['custom_value_curr'];
			$max      = $settings['custom_value_max'];
			$value    = round( ( ( absint( $curr ) * 100 ) / absint( $max ) ), 0 );
		}
		$circumference = 2 * M_PI * $radius;
		$bg_circle_color = ( 'color' === $settings['bg_circle_type'] ) ? $settings['bg_circle_color'] : 'url(#circle-progress-meter-gradient-' . $this->get_id() . ')';
		$circle_color = ( 'color' === $settings['circle_type'] ) ? $settings['circle_color'] : 'url(#circle-progress-value-gradient-' . $this->get_id() . ')';
		ob_start();
	?>
		<svg class="svg-circle-progress" width="<?php echo $circle_size; ?>" height="<?php echo $circle_size; ?>" viewBox="<?php echo $viewBox; ?>" data-radius="<?php echo $radius; ?>" data-circumference="<?php echo $circumference; ?>">
			<linearGradient id="circle-progress-meter-gradient-<?php echo $this->get_id(); ?>" gradientUnits="objectBoundingBox" gradientTransform="rotate(<?php echo $settings['bg_circle_gradient_angle']; ?> 0.5 0.5)" x1="-0.25" y1="0.5" x2="1.25" y2="0.5">
				<stop offset="0%" stop-color="<?php echo $settings['bg_circle_gradient_a']; ?>"/>
				<stop offset="100%" stop-color="<?php echo $settings['bg_circle_gradient_b']; ?>"/>
			</linearGradient>
			<linearGradient id="circle-progress-value-gradient-<?php echo $this->get_id(); ?>" gradientUnits="objectBoundingBox" gradientTransform="rotate(<?php echo $settings['circle_gradient_angle']; ?> 0.5 0.5)" x1="-0.25" y1="0.5" x2="1.25" y2="0.5">
				<stop offset="0%" stop-color="<?php echo $settings['circle_gradient_a']; ?>"/>
				<stop offset="100%" stop-color="<?php echo $settings['circle_gradient_b']; ?>"/>
			</linearGradient>
			<circle
				class="circle-progress-bg"
				cx="<?php echo $center; ?>"
				cy="<?php echo $center; ?>"
				r="<?php echo $radius; ?>"
				fill="none"
				stroke="<?php echo $bg_circle_color; ?>"
				stroke-width="<?php echo $bg_thickness; ?>"
			></circle>
			<circle
				class="circle-progress-value"
				cx="<?php echo $center; ?>"
				cy="<?php echo $center; ?>"
				r="<?php echo $radius; ?>"
				fill="none"
				stroke="<?php echo $circle_color; ?>"
				stroke-width="<?php echo $value_thickness; ?>"
				data-value="<?php echo $value; ?>"
				stroke-dasharray="<?php echo $circumference; ?>"
				stroke-dashoffset="<?php echo $circumference; ?>"
			></circle>
		</svg>
	<?php
		return ob_get_clean();
	}

	protected function content_template() {}
	public function render_plain_content($instance = []) {}
}
	Plugin::instance()->widgets_manager->register_widget_type(new Widget_TT_Circle_Progress_Bar);
?>