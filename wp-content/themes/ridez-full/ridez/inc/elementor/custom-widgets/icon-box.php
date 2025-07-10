
<?php

use Elementor\Controls_Manager;

add_action('elementor/element/icon-box/section_style_content/before_section_end', function ($element, $args) {
	$element->add_control(
		'icon_box_title_hover',
		[
			'label'     => esc_html__('Color Title Hover', 'ridez'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
			],
		]
	);
}, 10, 2);

add_action('elementor/element/icon-box/section_style_content/before_section_end', function ($element, $args) {
    $element->update_control(
        'hover_primary_color',
        [
            'selectors' => [
                '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
            ],
        ]
    );

    $element->update_control(
        'hover_secondary_color',
        [
            'selectors' => [
                '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],
        ]
    );


}, 10, 2);

add_action('elementor/element/icon-box/section_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'enable_effects',
        [
            'label'     => esc_html__('Effects', 'ridez'),
            'type'      => Controls_Manager::SWITCHER,
            'prefix_class' => 'enable-effects-',
        ]
    );

}, 10, 2);
