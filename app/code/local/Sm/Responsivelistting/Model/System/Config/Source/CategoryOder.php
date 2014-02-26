<?php
/*------------------------------------------------------------------------
 # SM Responsive Listting - Version 1.0
 # Copyright (c) 2013 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/
class Sm_Responsivelistting_Model_System_Config_Source_CategoryOder
{
	public function toOptionArray()
	{	
		return array(
		array('value'=>'title', 'label'=>Mage::helper('responsivelistting')->__('Title')),
		array('value'=>'random', 'label'=>Mage::helper('responsivelistting')->__('Random')),
		);
	}
}
