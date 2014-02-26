<?php
/*------------------------------------------------------------------------
 # SM sport - Version 1.1
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Sport_Model_System_Config_Source_ListImageType
{
	public function toOptionArray()
	{	
		return array(
			array('value'=>'thumbnail', 'label'=>Mage::helper('sport')->__('Thumbnail')),
			array('value'=>'small_image', 'label'=>Mage::helper('sport')->__('Small Image')),
			array('value'=>'image', 'label'=>Mage::helper('sport')->__('Base Image')),
		);
	}
}
