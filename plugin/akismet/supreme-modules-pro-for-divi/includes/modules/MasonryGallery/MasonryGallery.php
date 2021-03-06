<?php

class DSM_MasonryGallery extends ET_Builder_Module {

	public $slug       = 'dsm_masonry_gallery';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divisupreme.com/',
		'author'     => 'Divi Supreme',
		'author_uri' => 'https://divisupreme.com/',
	);

	public function init() {
		$this->icon_path              = plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->name                   = esc_html__( 'Supreme Masonry Gallery', 'dsm-supreme-modules-pro-for-divi' );
		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'gallery'  => esc_html__( 'Gallery', 'dsm-supreme-modules-pro-for-divi' ),
					'settings' => esc_html__( 'Settings', 'dsm-supreme-modules-pro-for-divi' ),
					'overlay'  => esc_html__( 'Overlay', 'dsm-supreme-modules-pro-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout'       => esc_html__( 'Grid Layout', 'dsm-supreme-modules-pro-for-divi' ),
					'overlay_text' => array(
						'sub_toggles'       => array(
							'title'       => array(
								'name' => 'Title',
							),
							'caption'     => array(
								'name' => 'Caption',
							),
							'description' => array(
								'name' => 'Description',
							),
						),
						'tabbed_subtoggles' => true,
						'title'             => 'Overlay Text',
					),
					'grid'         => esc_html__( 'Grid Items', 'dsm-supreme-modules-pro-for-divi' ),
					'overlay'      => esc_html__( 'Overlay', 'dsm-supreme-modules-pro-for-divi' ),
				),
			),
		);
	}

	public function get_advanced_fields_config() {

		$advanced_fields                = array();
		$advanced_fields['text']        = false;
		$advanced_fields['text_shadow'] = false;
		$advanced_fields['fonts']       = false;

		$advanced_fields['borders']['default'] = array(
			'css' => array(
				'main' => array(
					'border_radii'  => '%%order_class%%',
					'border_styles' => '%%order_class%%',
				),
			),
		);

		$advanced_fields['borders']['grid'] = array(
			'label_prefix' => esc_html__( 'Grid Items', 'dsm-supreme-modules-pro-for-divi' ),
			'toggle_slug'  => 'grid',
			'tab_slug'     => 'advanced',
			'css'          => array(
				'main' => array(
					'border_radii'  => '%%order_class%% .grid .et_pb_image_wrap',
					'border_styles' => '%%order_class%% .grid .et_pb_image_wrap',
				),
			),
		);

		$advanced_fields['box_shadow']['grid'] = array(
			'label'       => esc_html__( 'Grid Items Box Shadow', 'dsm-supreme-modules-pro-for-divi' ),
			'toggle_slug' => 'grid',
			'tab_slug'    => 'advanced',
			'css'         => array(
				'main' => '%%order_class%% .grid .et_pb_image_wrap',
			),
		);

		$advanced_fields['fonts']['image_title'] = array(
			'label'           => esc_html__( 'Title', 'dsm-supreme-modules-pro-for-divi' ),
			'css'             => array(
				'main' => '%%order_class%% .dsm-overlay-title',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'header_level'    => array(
				'default' => 'h4',
			),
			'font_size'       => array(
				'default' => '18px',
			),
			'line_height'     => array(
				'default'        => '1em',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '0.1',
				),
			),
			'header_level'    => array(
				'default'          => 'h4',
				'computed_affects' => array(
					'__gallery',
				),
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'overlay_text',
			'sub_toggle'      => 'title',
		);

		$advanced_fields['fonts']['image_caption'] = array(
			'label'           => esc_html__( 'Caption', 'dsm-supreme-modules-pro-for-divi' ),
			'css'             => array(
				'main' => '%%order_class%% .dsm-overlay-caption',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default'        => '1.7em',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '0.1',
				),
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'overlay_text',
			'sub_toggle'      => 'caption',
		);

		$advanced_fields['fonts']['image_desc'] = array(
			'label'           => esc_html__( 'Description', 'dsm-supreme-modules-pro-for-divi' ),
			'css'             => array(
				'main' => '%%order_class%% .dsm-overlay-desc',
			),
			'important'       => 'all',
			'hide_text_align' => true,
			'font_size'       => array(
				'default' => '14px',
			),
			'line_height'     => array(
				'default'        => '1.7em',
				'range_settings' => array(
					'min'  => '1',
					'max'  => '3',
					'step' => '0.1',
				),
			),
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'overlay_text',
			'sub_toggle'      => 'description',
		);

		return $advanced_fields;
	}

	public function get_fields() {

		$fields = array();

		$fields['gallery_ids'] = array(
			'label'            => esc_html__( 'Add Images', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'upload-gallery',
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'gallery',
		);

		$fields['columns'] = array(
			'label'            => esc_html__( 'Columns', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'range',
			'default'          => '3',
			'range_settings'   => array(
				'min'  => '1',
				'max'  => '12',
				'step' => '1',
			),
			'computed_affects' => array(
				'__gallery',
			),
			'mobile_options'   => true,
			'responsive'       => true,
			'unitless'         => true,
			'toggle_slug'      => 'layout',
			'tab_slug'         => 'advanced',
		);

		$fields['gutter'] = array(
			'label'            => esc_html__( 'Columns Gap', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'range',
			'default'          => '12',
			'mobile_options'   => true,
			'responsive'       => true,
			'computed_affects' => array(
				'__gallery',
			),
			'range_settings'   => array(
				'min'  => '0',
				'max'  => '200',
				'step' => '1',
			),
			'toggle_slug'      => 'layout',
			'tab_slug'         => 'advanced',
			'unitless'         => true,
		);

		$fields['use_overlay'] = array(
			'label'            => esc_html__( 'Use Overlay', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'off',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
		);

		$fields['overlay_title'] = array(
			'label'            => esc_html__( 'Show Image Overlay Title', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
			'show_if'          => array(
				'use_overlay' => 'on',
			),
		);

		$fields['overlay_caption'] = array(
			'label'            => esc_html__( 'Show Image Overlay Caption', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
			'show_if'          => array(
				'use_overlay' => 'on',
			),
		);

		$fields['overlay_description'] = array(
			'label'            => esc_html__( 'Show Image Overlay Description', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
			'show_if'          => array(
				'use_overlay' => 'on',
			),
		);

		$fields['use_lightbox'] = array(
			'label'            => esc_html__( 'Use Lightbox', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'off',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
		);

		$fields['lightbox_img_sizes'] = array(
			'label'            => esc_html__( 'Image Size', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'select',
			'option_category'  => 'layout',
			'toggle_slug'      => 'settings',
			'default'          => 'full',
			'default_on_front' => 'full',
			'computed_affects' => array(
				'__gallery',
			),
			'options'          => self::dsm_get_all_image_sizes(),
			'show_if'          => array(
				'use_lightbox' => 'on',
			),
		);

		$fields['lightbox_title'] = array(
			'label'            => esc_html__( 'Show Image Lightbox Title', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'lightbox',
			'show_if'          => array(
				'use_lightbox' => 'on',
			),
		);

		$fields['lightbox_caption'] = array(
			'label'            => esc_html__( 'Show Image Lightbox Caption', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'tab_slug'         => 'advanced',
			'toggle_slug'      => 'lightbox',
			'show_if'          => array(
				'use_lightbox' => 'on',
			),
		);

		$fields['overlay_color'] = array(
			'label'       => esc_html__( 'Overlay Color', 'dsm-supreme-modules-pro-for-divi' ),
			'type'        => 'color-alpha',
			'default'     => et_builder_accent_color(),
			'show_if'     => array(
				'use_overlay' => 'on',
			),
			'tab_slug'    => 'advanced',
			'toggle_slug' => 'overlay',
			'show_if'     => array(
				'use_overlay' => 'on',
			),
		);

		$fields['use_horizontal_order'] = array(
			'label'            => esc_html__( 'Use Horizontal Order', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'on',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
		);

		$fields['use_zoom_on_hover'] = array(
			'label'            => esc_html__( 'Use Zoom On Hover', 'dsm-supreme-modules-pro-for-divi' ),
			'type'             => 'yes_no_button',
			'default'          => 'off',
			'options'          => array(
				'off' => esc_html__( 'Off', 'dsm-supreme-modules-pro-for-divi' ),
				'on'  => esc_html__( 'On', 'dsm-supreme-modules-pro-for-divi' ),
			),
			'computed_affects' => array(
				'__gallery',
			),
			'toggle_slug'      => 'settings',
		);

		$fields['__gallery'] = array(
			'type'                => 'computed',
			'computed_callback'   => array( 'DSM_MasonryGallery', 'get_galleries' ),
			'computed_depends_on' => array(
				'gallery_ids',
				'columns',
				'gutter',
				'use_lightbox',
				'lightbox_img_sizes',
				'use_overlay',
				'overlay_caption',
				'overlay_description',
				'overlay_title',
				'image_title_level',
				'use_horizontal_order',
				'use_zoon_on_hover',
			),
			'computed_minimum'    => array(
				'gallery_ids',
			),
		);

		return $fields;
	}

	static function get_galleries( $args = array(), $conditional_tags = array(), $current_page = array() ) {

		$defaults = array(
			'gallery_ids'         => array(),
			'use_overlay'         => 'off',
			'use_zoom_on_hover'   => 'off',
			'overlay_title'       => 'on',
			'overlay_caption'     => 'on',
			'overlay_description' => 'on',
			'lightbox_title'      => 'on',
			'lightbox_caption'    => 'on',
			'image_title_level'   => 'h4',
			'lightbox_img_sizes'  => 'full',
		);

		$args = wp_parse_args( $args, $defaults );

		$attachments_args = array(
			'include'        => $args['gallery_ids'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'post__in',
		);

		$_attachments = get_posts( $attachments_args );

		foreach ( $_attachments as $key => $val ) {
			$attachments[ $key ]                          = $_attachments[ $key ];
			$attachments[ $key ]->lightbox_image_src_full = wp_get_attachment_image_src( $val->ID, $args['lightbox_img_sizes'] );
		}

		$output = array(
			'<div class="grid-sizer"></div>',
			'<div class="gutter-sizer"></div>',
		);

		foreach ( $attachments as $id => $attachment ) {
			$dsm_upload_gallery_custom_link_url       = get_post_meta( $attachment->ID, 'dsm_upload_gallery_custom_link_url', true );
			$dsm_upload_gallery_link_url_target       = get_post_meta( $attachment->ID, 'dsm_upload_gallery_link_url_target', true );
			$dsm_upload_gallery_link_as_download_file = get_post_meta( $attachment->ID, 'dsm_upload_gallery_link_as_download_file', true );

			$image             = wp_get_attachment_image_src( $attachment->ID, 'full' );
			$image_title       = get_the_title( $attachment->ID );
			$image_alt         = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
			$image_caption     = wp_get_attachment_caption( $attachment->ID );
			$gallery           = get_post( $attachment->ID );
			$image_description = isset( $attachment->post_content ) ? $attachment->post_content : '';

			$image_html = sprintf(
				'<img src="%1$s" class="skip-lazy" title="%2$s" alt="%3$s" />',
				esc_url( $image[0] ),
				esc_attr( $image_title ),
				esc_attr( $image_alt )
			);

			$image_title_render = sprintf(
				'<%2$s class="dsm-overlay-title">
                    %1$s
                </%2$s>',
				esc_attr( $image_title ),
				esc_attr( $args['image_title_level'] )
			);

			$image_caption_render = sprintf(
				'<p class="dsm-overlay-caption">
                    %1$s
                </p>',
				esc_attr( $image_caption )
			);

			$image_description_render = sprintf(
				'<p class="dsm-overlay-desc">
                    %1$s
                </p>',
				esc_attr( $image_description )
			);

			$overlay = '';
			if ( 'on' === $args['use_overlay'] ) {
				$overlay = sprintf(
					'<span class="et_overlay dsm-overlay">
                        <div class="dsm-overlay-inner">
                            %1$s
                            %2$s
							%3$s
                        </div>
                    </span>',
					'on' === $args['overlay_title'] ? $image_title_render : '',
					'on' === $args['overlay_caption'] ? $image_caption_render : '',
					'on' === $args['overlay_description'] ? $image_description_render : ''
				);
			}

			$lightbox = '';
			if ( 'on' === $args['use_lightbox'] ) {
				$lightbox = sprintf(
					'<a href="%5$s" %3$s %4$s data-mfp-src="%6$s">
                        <div class="et_pb_image_wrap">
                            %1$s
                            %2$s
                        </div>
                    </a>',
					$image_html,
					$overlay,
					'on' === $args['lightbox_title'] ? " data-title='$image_title'" : '',
					'on' === $args['lightbox_caption'] ? " data-caption='" . $image_caption . "'" : '',
					$image[0],
					esc_url( $attachment->lightbox_image_src_full[0] )
				);
			} elseif ( '' !== $dsm_upload_gallery_custom_link_url ) {
				$lightbox = sprintf(
					'<a href="%3$s" target="%4$s" %5$s>
						<div class="et_pb_image_wrap">
                        	%1$s
							%2$s
						</div>
					</a>
					',
					$image_html,
					$overlay,
					esc_url( $dsm_upload_gallery_custom_link_url ),
					esc_attr( $dsm_upload_gallery_link_url_target ),
					( '1' === $dsm_upload_gallery_link_as_download_file ? ' download' : '' )
				);
			} else {
				$lightbox = sprintf(
					'<div class="et_pb_image_wrap">
                        %1$s
                        %2$s
                    </div>',
					$image_html,
					$overlay
				);
			}

			$output[] = sprintf(
				'<div class="grid-item">
                    %1$s
                </div>',
				$lightbox
			);
		}

		return implode( '', $output );
	}

	public function render( $attrs, $content, $render_slug ) {

		$gutter                   = $this->props['gutter'];
		$gutter_last_edited       = $this->props['gutter_last_edited'];
		$gutter_responsive_status = isset( $gutter_last_edited ) && et_pb_get_responsive_status( $gutter_last_edited );
		$gutter_tablet            = $gutter_responsive_status && $this->props['gutter_tablet'] ? $this->props['gutter_tablet'] : $gutter;
		$gutter_phone             = $gutter_responsive_status && $this->props['gutter_phone'] ? $this->props['gutter_phone'] : $gutter_tablet;

		$columns                   = $this->props['columns'];
		$columns_last_edited       = $this->props['columns_last_edited'];
		$columns_responsive_status = isset( $columns_last_edited ) && et_pb_get_responsive_status( $columns_last_edited );
		$columns_tablet            = $columns_responsive_status && $this->props['columns_tablet'] ? $this->props['columns_tablet'] : $columns;
		$columns_phone             = $columns_responsive_status && $this->props['columns_phone'] ? $this->props['columns_phone'] : $columns_tablet;

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .gutter-sizer',
				'declaration' => "width: {$gutter}px;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .gutter-sizer',
				'declaration' => "width: {$gutter_tablet}px;",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .gutter-sizer',
				'declaration' => "width: {$gutter_phone}px;",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item, %%order_class%% .grid-sizer',
				'declaration' => "width: calc((100% - ({$columns} - 1) * {$gutter}px) / {$columns});",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item, %%order_class%% .grid-sizer',
				'declaration' => "width: calc((100% - ({$columns_tablet} - 1) * {$gutter_tablet}px) / {$columns_tablet});",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item, %%order_class%% .grid-sizer',
				'declaration' => "width: calc((100% - ({$columns_phone} - 1) * {$gutter_phone}px) / {$columns_phone});",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item',
				'declaration' => "margin-bottom: {$gutter}px;",
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item',
				'declaration' => "margin-bottom: {$gutter_tablet}px;",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item',
				'declaration' => "margin-bottom: {$gutter_phone}px;",
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
			)
		);

		ET_Builder_Element::set_style(
			$render_slug,
			array(
				'selector'    => '%%order_class%% .grid-item .dsm-overlay',
				'declaration' => "background: {$this->props['overlay_color']} !important;",
			)
		);

		$galleries = self::get_galleries( $this->props );

		if ( 'on' === $this->props['use_lightbox'] ) {
			wp_enqueue_script( 'magnific-popup' );
		}
		wp_enqueue_script( 'dsm-masonry-gallery' );

		return sprintf(
			'<div class="dsm-gallery grid%4$s" data-lightbox="%2$s" data-horizontalorder="%3$s">
                %1$s
             </div>',
			$galleries,
			'on' === $this->props['use_lightbox'] ? esc_attr( 'true' ) : esc_attr( 'false' ),
			'on' === $this->props['use_horizontal_order'] ? esc_attr( 'true' ) : esc_attr( 'false' ),
			'on' === $this->props['use_zoom_on_hover'] ? esc_attr( ' dsm_masonry_zoom_hover' ) : ''
		);

	}

	static function dsm_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		$image_sizes = array(
			'full' => esc_html__( 'Full Size', 'dsm-supreme-modules-pro-for-divi' ),
		);

		foreach ( $sizes as $size_key => $size_value ) {
			$size_key_title           = str_replace( '_', ' ', $size_key );
			$size_key_title           = str_replace( '-', ' ', $size_key_title );
			$image_sizes[ $size_key ] = sprintf(
				'%1$s (W: %2$s x H: %3$s,%4$s Cropped)',
				ucfirst( $size_key_title ),
				$size_value['width'],
				$size_value['height'],
				( false === $size_value['crop'] ? ' Not' : '' )
			);
		}

		return $image_sizes;
	}

}

new DSM_MasonryGallery();
