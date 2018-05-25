<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_TT_Progress_Bar extends Widget_Base {

	public function get_name() {
		return 'tt-progress-bar';
	}

	public function get_title() {
		return __( 'Progress Bar', 'elementor-custom-element' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	protected function _register_controls() {

		/**
		 * Tab Content
		 */
		$this->start_controls_section(
			'progress_bar_section_content',
			[
				'label'      => __( 'Progress Bar', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_CONTENT,
				'show_label' => false,
			]
		);
		$this->add_control(
			'bar_title',
			array(
				'label'       => esc_html__( 'Title', 'elementor-custom-element' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'elementor-custom-element' ),
				'default'     => esc_html__( 'Title', 'elementor-custom-element' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'bar_icon_show',
			array(
				'label'        => __( 'Show Icon', 'elementor-custom-element' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementor-custom-element' ),
				'label_off'    => __( 'No', 'elementor-custom-element' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'bar_icon',
			array(
				'label'       => esc_html__( 'Icon', 'elementor-custom-element' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'file'        => '',
				'default'     => 'fa fa-thumbs-up',
				'condition'   => array(
					'bar_icon_show' => 'yes',
				),
			)
		);
		$this->add_control(
			'bar_percent',
			array(
				'label'       => esc_html__( 'Percentage', 'elementor-custom-element' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 45,
				'min'         => 0,
				'max'         => 100,
				'label_block' => false,
			)
		);
		$this->add_control(
			'bar_type',
			array(
				'label' => esc_html__( 'Type', 'elementor-custom-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'template_type_1',
				'options' => array(
					'template_type_1' => esc_html__( 'On the right', 'elementor-custom-element' ),
					'template_type_2' => esc_html__( 'Placed above ', 'elementor-custom-element' ),
					'template_type_3' => esc_html__( 'Shown as tip', 'elementor-custom-element' ),
					'template_type_4' => esc_html__( 'Inside the bar', 'elementor-custom-element' ),
					'template_type_5' => esc_html__( 'Inside the empty bar', 'elementor-custom-element' ),
					'template_type_6' => esc_html__( 'Inside the bar with title', 'elementor-custom-element' ),
					'template_type_7' => esc_html__( 'Inside the vertical bar', 'elementor-custom-element' ),
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Tab Style
		 * 
		 * Section Progress Bar
		 */
		$this->start_controls_section(
			'progress_bar_section_progress',
			array(
				'label'      => esc_html__( 'Progress Bar', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_responsive_control(
			'progress_wrapper_height',
			array(
				'label'      => esc_html__( 'Progress Height', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-wrapper' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'progress_wrapper_width',
			array(
				'label'      => esc_html__( 'Progress Width', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 300,
					),
				),
				'condition' => array(
					'bar_type' => array( 'template_type_7' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-wrapper' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'progress_wrapper_background',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'progress_wrapper_border',
				'label'       => esc_html__( 'Border', 'elementor-custom-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['progress_wrapper'],
			)
		);
		$this->add_responsive_control(
			'progress_wrapper_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['progress_wrapper'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name' => 'progress_wrapper_box_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['progress_wrapper'],
			)
		);
		$this->add_responsive_control(
			'progress_wrapper_margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Status Bar
		 */
		$this->start_controls_section(
			'progress_bar_section_status',
			array(
				'label'      => esc_html__( 'Status Bar', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'status_bar_background',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-status-bar',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'status_bar_border',
				'label'       => esc_html__( 'Border', 'elementor-custom-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . '.tt-progress-bar-status-bar',
			)
		);
		$this->add_responsive_control(
			'status_bar_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-status-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Title
		 */
		$this->start_controls_section(
			'progress_bar_section_title',
			array(
				'label'      => esc_html__( 'Title', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'text_color',
			array(
				'label'  => esc_html__( 'Text Color', 'elementor-custom-element' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-text',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'title_background',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'title_border',
				'label'       => esc_html__( 'Border', 'elementor-custom-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . '.tt-progress-bar-title',
			)
		);
		$this->add_responsive_control(
			'title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_box_shadow',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-title',
			)
		);
		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_alignment',
			array(
				'label'       => esc_html__( 'Title Alignment', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => '',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'condition' => array(
					'bar_type' => array( 'template_type_2', 'template_type_3', 'template_type_4', 'template_type_5' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-title' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'text_alignment',
			array(
				'label'       => esc_html__( 'Text Alignment', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => '',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-text' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Icon
		 */
		$this->start_controls_section(
			'progress_bar_section_icon',
			array(
				'label'      => esc_html__( 'Icon', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'elementor-custom-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-icon' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em',
				),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		/**
		 * Section Percent
		 */
		$this->start_controls_section(
			'progress_bar_section_percent',
			array(
				'label'      => esc_html__( 'Percent', 'elementor-custom-element' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'percent_color',
			array(
				'label'  => esc_html__( 'Text Color', 'elementor-custom-element' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-percent' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'percent_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-percent',
			)
		);
		$this->add_responsive_control(
			'number_suffix_font_size',
			array(
				'label'      => esc_html__( 'Suffix Font Size', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-percent' . ' .tt-progress-bar-percent-suffix' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'percent_background',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-percent',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'percent_border',
				'label'       => esc_html__( 'Border', 'elementor-custom-element' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . '.tt-progress-bar-percent',
			)
		);
		$this->add_responsive_control(
			'percent_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-percent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'percent_box_shadow',
				'selector' => '{{WRAPPER}} ' . '.tt-progress-bar-percent',
			)
		);
		$this->add_responsive_control(
			'percent_margin',
			array(
				'label'      => esc_html__( 'Margin', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-percent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'percent_padding',
			array(
				'label'      => esc_html__( 'Padding', 'elementor-custom-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . '.tt-progress-bar-percent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'percent_width',
			array(
				'label'      => esc_html__( 'Percent Width', 'elementor-custom-element' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min' => 20,
						'max' => 200,
					),
				),
				'condition' => array(
					'bar_type' => array( 'template_type_3' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-percent' => 'width: {{SIZE}}{{UNIT}}; margin-right: calc( {{SIZE}}{{UNIT}}/-2 );',
				),
			)
		);
		$this->add_responsive_control(
			'percent_alignment',
			array(
				'label'       => esc_html__( 'Percent Alignment', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => '',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'elementor-custom-element' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'condition' => array(
					'bar_type' => array( 'template_type_2' ,'template_type_4' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-percent' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'percent_suffix_alignment',
			array(
				'label'       => esc_html__( 'Percent Suffix Alignment', 'elementor-custom-element' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Top', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'elementor-custom-element' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. '.tt-progress-bar-percent' . ' .tt-progress-bar-percent-suffix' => 'align-self: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'container', 'class', array(
			'tt-progress-bar',
			'tt-progress-bar-' . $settings['bar_type'],
		) );

		$this->add_render_attribute( 'container', 'data-percent', $settings['bar_percent'] );
		$this->add_render_attribute( 'container', 'data-type', $settings['bar_type'] );

		?>
			<div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
				<?php echo $this->get_template_type( $settings['bar_type'] ); ?>
			</div>
		<?php
	}

	public function get_template_type( $type ) {
		switch ($type) {
			case 'template_type_1':
				return $this->template_type_1();
				break;
			case 'template_type_2':
				return $this->template_type_2();
				break;
			case 'template_type_3':
				return $this->template_type_3();
				break;
			case 'template_type_4':
				return $this->template_type_4();
				break;
			case 'template_type_5':
				return $this->template_type_5();
				break;
			case 'template_type_6':
				return $this->template_type_6();
				break;
			case 'template_type_7':
				return $this->template_type_7();
				break;
			default:
				return $this->template_type_1();
				break;
		}
	}

	public function get_icon_title_bar() {
		$settings   = $this->get_settings();
		$icon       = filter_var( $settings['bar_icon_show'], FILTER_VALIDATE_BOOLEAN );
		$renderHtml = '';
		if($icon) {
			$renderHtml .= sprintf( '<i class="tt-progress-bar-icon %s"></i>', $settings['bar_icon'] );
			$renderHtml .= sprintf( '<span class="tt-progress-bar-text">%s</span>', $settings['bar_title'] );
		} else {
			$renderHtml .= sprintf( '<span class="tt-progress-bar-text">%s</span>', $settings['bar_title'] );
		}
		return $renderHtml;
	}

	public function template_type_1() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar"></div>
			</div>
			<div class="tt-progress-bar-percent">
				<span class="tt-progress-bar-percent-value">0</span>
				<span class="tt-progress-bar-percent-suffix">&#37;</span>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}

	public function template_type_2() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-percent">
				<span class="tt-progress-bar-percent-value">0</span>
				<span class="tt-progress-bar-percent-suffix">&#37;</span>
			</div>
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar"></div>
			</div>
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}
	public function template_type_3() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar">
					<div class="tt-progress-bar-percent">
						<span class="tt-progress-bar-percent-value">0</span>
						<span class="tt-progress-bar-percent-suffix">&#37;</span>
					</div>
				</div>
			</div>
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}
	public function template_type_4() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar">
					<div class="tt-progress-bar-percent">
						<span class="tt-progress-bar-percent-value">0</span>
						<span class="tt-progress-bar-percent-suffix">&#37;</span>
					</div>
				</div>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}
	public function template_type_5() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar"></div>
				<div class="tt-progress-bar-percent">
					<span class="tt-progress-bar-percent-value">0</span>
					<span class="tt-progress-bar-percent-suffix">&#37;</span>
				</div>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}
	public function template_type_6() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-status-bar"></div>
				<div class="tt-progress-bar-status">
					<div class="tt-progress-bar-percent">
						<span class="tt-progress-bar-percent-value">0</span>
						<span class="tt-progress-bar-percent-suffix">&#37;</span>
					</div>
					<div class="tt-progress-bar-title">
						<?php
							echo $this->get_icon_title_bar();
						?>	
					</div>
				</div>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}
	public function template_type_7() {
		$settings = $this->get_settings();
		ob_start();
	?>
		<div class="tt-progress-bar-inner">
			<div class="tt-progress-bar-wrapper">
				<div class="tt-progress-bar-percent">
					<span class="tt-progress-bar-percent-value">0</span>
					<span class="tt-progress-bar-percent-suffix">&#37;</span>
				</div>
				<div class="tt-progress-bar-status-bar"></div>
			</div>
			<div class="tt-progress-bar-title">
				<?php
					echo $this->get_icon_title_bar();
				?>
			</div>
		</div>
	<?php
		return ob_get_clean();
	}

	protected function content_template() {}
	public function render_plain_content($instance = []) {}
}
	Plugin::instance()->widgets_manager->register_widget_type(new Widget_TT_Progress_Bar);
?>