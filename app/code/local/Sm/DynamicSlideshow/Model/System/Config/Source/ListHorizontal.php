<?php
/*------------------------------------------------------------------------
 # SM Dynamic Slideshow - Version 1.0.0
 # Copyright (c) 2013 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_DynamicSlideshow_Model_System_Config_Source_ListHorizontal
{
	public function toOptionArray()
	{
		return array(
		array('value'=>'top', 'label'=>Mage::helper('dynamicslideshow')->__('Top')),
		array('value'=>'center', 'label'=>Mage::helper('dynamicslideshow')->__('Center')),
		array('value'=>'bottom', 'label'=>Mage::helper('dynamicslideshow')->__('Bottom')),
		);
	}
}
