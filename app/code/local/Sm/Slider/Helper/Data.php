<?php
/*------------------------------------------------------------------------
 # SM Slider - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Slider_Helper_Data extends Mage_Core_Helper_Abstract {
	public function __construct(){
		$this->defaults = array(
			/* general options */
			'isenabled'		=> '1',
			'title' 		=> 'SM Slider',
			/* Module options */
			'module_width' 		=> '',
			'theme' 			=> 'theme1',	
			/* slider options*/
			'autoplay'								=> '1',
			'duration'								=> '2000',
			'control'								=> '1',				//showbutton
			'interval'								=> '500',
			'show_title_slider'						=> '1',
			'title_slider'							=> 'SM Slider',
			'item_per_page'							=> '3',
			'item_per_scroll'						=> '1',
			
			/* product query */
			'product_source'		=> 'catalog',		//datatype	
			'product_category' 		=> array(),				
			'product_ids'			=> '',
			'product_order_by'		=> '',					
			'product_order_dir' 	=> '',					
			'product_limitation' 	=> '10',  			//quantityItems				
			'start_item'			=> '1',				//startItem

			/* product images */
			'product_image_disp'	=> '1',
			'product_image_linkable'=> '1',
			'product_image_width'	=> '199',			//product_thumbnail_width
			'product_image_height'	=> '150',			//product_thumbnail_height
			
			/* product details */
			'product_title_disp'	=> '1',
			'product_title_linkable'=> '1',
			'product_title_color'	=> '#000000',			// title_color
			'product_title_max_characters'=> '',			//product_title_maxchars


			/* other options*/
			'product_description_disp' 				=> '1',			//product_short_description_disp
			'product_description_color'				=> '#000000',	// description_color
			'product_description_max_characters' 	=> '100',		//product_short_description_maxchars
			//'show_description_when'					=> 'always',
			'product_details_page_link_disp' 		=> '1',
			'product_details_page_link_text' 		=> 'See details',
					
			'product_links_target'					=> '_self',
			
			'product_price_disp'	=> '1',
			// 'product_reviews_count'	=> '1',
			// 'product_views_count'	=> '1',
			// 'product_sales_count'	=> '1',
			// 'product_stock_status'	=> '1',
		
			/* Tooltip options */
			// 'tooltip_disp'			=> '1',			
			// 'tooltip_width'			=> '360',
			// 'tooltip_image_maxwidth'=> '120',
			// 'tooltip_description_max_characters' => '',
			
			'include_jquery'	=> '1',
			'pretext'			=> '',
			'posttext'			=> ''
			

			/**config_fields**/
		);
	}

	function get($attributes=array())
	{
		$data = $this->defaults;
		$general 					= Mage::getStoreConfig("slider_cfg/general");
		$module_setting				= Mage::getStoreConfig("slider_cfg/module_setting");
		$product_selection 			= Mage::getStoreConfig("slider_cfg/product_selection");
		$product_display_setting 	= Mage::getStoreConfig("slider_cfg/product_display_setting");
		$advanced 					= Mage::getStoreConfig("slider_cfg/advanced");
		if (!is_array($attributes)) {
			$attributes = array($attributes);
		}
		if (is_array($general))					$data = array_merge($data, $general);
		if (is_array($module_setting)) 			$data = array_merge($data, $module_setting);
		if (is_array($product_selection)) 		$data = array_merge($data, $product_selection);
		if (is_array($product_display_setting)) $data = array_merge($data, $product_display_setting);
		if (is_array($advanced)) 				$data = array_merge($data, $advanced);
		
		return array_merge($data, $attributes);;
	}
}
?>