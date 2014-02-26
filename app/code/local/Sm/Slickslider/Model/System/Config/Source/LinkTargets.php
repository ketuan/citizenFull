<?php
/*------------------------------------------------------------------------
 # SM Slick Slider - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Slickslider_Model_System_Config_Source_LinkTargets
{
	public function toOptionArray()
	{
		return array(
			array('value'=>'_self',	'label'=>Mage::helper('slickslider')->__('Same Window')),
        	array('value'=>'_blank','label'=>Mage::helper('slickslider')->__('New Window')),
			array('value'=>'_popup','label'=>Mage::helper('slickslider')->__('Popup Window'))
		);
	}
}
