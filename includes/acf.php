<?php

use Kntnt\Schedule_Sociala_Media_Zapier\Plugin;

acf_add_local_field_group( [
    'key' => 'group_5de3d371c0c5d',
    'title' => 'Scheduled Social Media Posts',
    'fields' => [
        [
            'key' => 'field_5de3d3c09e8a6',
            'label' => 'Missing webhooks',
            'name' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'message' => 'Add the catch webhooks for your LinkedIn-, Facebook-, and/or Twitter-zaps in the <a href="/wp-admin/options-general.php?page=kntnt-schedule-sociala-media-zapier">settings page</a>.',
            'new_lines' => '',
            'esc_html' => 0,
            'wpml_cf_preferences' => 0,
        ],
        [
            'key' => 'field_5de3d40b9e8a7',
            'label' => 'LinkedIn',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'placement' => 'top',
            'endpoint' => 0,
            'wpml_cf_preferences' => 0,
        ],
        [
            'key' => 'field_5de3d44b9e8aa',
            'label' => 'Scheduled LinkedIn posts',
            'name' => 'linkedin_posts',
            'type' => 'repeater',
            'instructions' => 'Add as many LinkedIn posts you need. Leave the content empty to post the excerpt of the article. Non-scheduled posts are published at the same time as the article or an update is published.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'wpml_cf_preferences' => 0,
            'collapsed' => 'field_5de3d4e89e8ab',
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Add post',
            'sub_fields' => [
                [
                    'key' => 'field_5de3d65a9e8ac',
                    'label' => 'Post',
                    'name' => 'content',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => Plugin::option( 'linkedin_length', 700 ),
                    'rows' => 3,
                    'new_lines' => '',
                ],
                [
                    'key' => 'field_5de3d4e89e8ab',
                    'label' => 'Schedule',
                    'name' => 'date_and_time',
                    'type' => 'date_time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 0,
                    'display_format' => 'Y-m-d H:i',
                    'return_format' => 'Y-m-d H:i',
                    'first_day' => 1,
                ],
            ],
        ],
        [
            'key' => 'field_5de3d4269e8a8',
            'label' => 'Facebook',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'placement' => 'top',
            'endpoint' => 0,
            'wpml_cf_preferences' => 0,
        ],
        [
            'key' => 'field_5de3e11763ca8',
            'label' => 'Scheduled Facebook posts',
            'name' => 'facebook_posts',
            'type' => 'repeater',
            'instructions' => 'Add as many Facebook posts you need. Leave the content empty to post the excerpt of the article. Non-scheduled posts are published at the same time as the article or an update is published.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'wpml_cf_preferences' => 0,
            'collapsed' => 'field_5de3d4e89e8ab',
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Add post',
            'sub_fields' => [
                [
                    'key' => 'field_5de3e11763ca9',
                    'label' => 'Post',
                    'name' => 'content',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => Plugin::option( 'facebook_length', 63206 ),
                    'rows' => 3,
                    'new_lines' => '',
                ],
                [
                    'key' => 'field_5de3e11763caa',
                    'label' => 'Schedule',
                    'name' => 'date_and_time',
                    'type' => 'date_time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 0,
                    'display_format' => 'Y-m-d H:i',
                    'return_format' => 'Y-m-d H:i',
                    'first_day' => 1,
                ],
            ],
        ],
        [
            'key' => 'field_5de3d42f9e8a9',
            'label' => 'Twitter',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'wpml_cf_preferences' => 0,
            'placement' => 'top',
            'endpoint' => 0,
        ],
        [
            'key' => 'field_5de3e1f4f470e',
            'label' => 'Scheduled tweets',
            'name' => 'twitter_posts',
            'type' => 'repeater',
            'instructions' => 'Add as many tweets you need. Leave the content empty to post the excerpt of the article. Non-scheduled posts are published at the same time as the article or an update is published.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'wpml_cf_preferences' => 0,
            'collapsed' => 'field_5de3d4e89e8ab',
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Add tweet',
            'sub_fields' => [
                [
                    'key' => 'field_5de3e1f4f470f',
                    'label' => 'Post',
                    'name' => 'content',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => Plugin::option( 'twitter_length', 256 ),
                    'rows' => 3,
                    'new_lines' => '',
                ],
                [
                    'key' => 'field_5de3e1f4f4710',
                    'label' => 'Schedule',
                    'name' => 'date_and_time',
                    'type' => 'date_time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 0,
                    'display_format' => 'Y-m-d H:i',
                    'return_format' => 'Y-m-d H:i',
                    'first_day' => 1,
                ],
            ],
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
] );