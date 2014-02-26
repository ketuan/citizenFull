<?php
/*------------------------------------------------------------------------
 # SM Slider - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Slider_Model_System_Config_Source_OrderDirection
{
	public function toOptionArray()
	{
		return array(
			array('value' => 'asc',			'label' => Mage::helper('slider')->__('Asc')),
			array('value' => 'desc', 		'label' => Mage::helper('slider')->__('Desc'))
		);
	}
}
