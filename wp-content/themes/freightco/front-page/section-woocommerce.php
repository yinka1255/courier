<div class="front_page_section front_page_section_woocommerce<?php
			$freightco_scheme = freightco_get_theme_option('front_page_woocommerce_scheme');
			if (!freightco_is_inherit($freightco_scheme)) echo ' scheme_'.esc_attr($freightco_scheme);
			echo ' front_page_section_paddings_'.esc_attr(freightco_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$freightco_css = '';
		$freightco_bg_image = freightco_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($freightco_bg_image)) 
			$freightco_css .= 'background-image: url('.esc_url(freightco_get_attachment_url($freightco_bg_image)).');';
		if (!empty($freightco_css))
			echo ' style="' . esc_attr($freightco_css) . '"';
?>><?php
	// Add anchor
	$freightco_anchor_icon = freightco_get_theme_option('front_page_woocommerce_anchor_icon');	
	$freightco_anchor_text = freightco_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($freightco_anchor_icon) || !empty($freightco_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($freightco_anchor_icon) ? ' icon="'.esc_attr($freightco_anchor_icon).'"' : '')
										. (!empty($freightco_anchor_text) ? ' title="'.esc_attr($freightco_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (freightco_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' freightco-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$freightco_css = '';
			$freightco_bg_mask = freightco_get_theme_option('front_page_woocommerce_bg_mask');
			$freightco_bg_color = freightco_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($freightco_bg_color) && $freightco_bg_mask > 0)
				$freightco_css .= 'background-color: '.esc_attr($freightco_bg_mask==1
																	? $freightco_bg_color
																	: freightco_hex2rgba($freightco_bg_color, $freightco_bg_mask)
																).';';
			if (!empty($freightco_css))
				echo ' style="' . esc_attr($freightco_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$freightco_caption = freightco_get_theme_option('front_page_woocommerce_caption');
			$freightco_description = freightco_get_theme_option('front_page_woocommerce_description');
			if (!empty($freightco_caption) || !empty($freightco_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($freightco_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($freightco_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($freightco_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($freightco_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($freightco_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($freightco_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$freightco_woocommerce_sc = freightco_get_theme_option('front_page_woocommerce_products');
				if ($freightco_woocommerce_sc == 'products') {
					$freightco_woocommerce_sc_ids = freightco_get_theme_option('front_page_woocommerce_products_per_page');
					$freightco_woocommerce_sc_per_page = count(explode(',', $freightco_woocommerce_sc_ids));
				} else {
					$freightco_woocommerce_sc_per_page = max(1, (int) freightco_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$freightco_woocommerce_sc_columns = max(1, min($freightco_woocommerce_sc_per_page, (int) freightco_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$freightco_woocommerce_sc}"
									. ($freightco_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($freightco_woocommerce_sc_ids).'"' 
											: '')
									. ($freightco_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(freightco_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($freightco_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(freightco_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(freightco_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($freightco_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($freightco_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>