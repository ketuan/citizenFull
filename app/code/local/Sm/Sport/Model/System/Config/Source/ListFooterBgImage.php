<?php
/*------------------------------------------------------------------------
 # SM sport - Version 1.1
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Sport_Model_System_Config_Source_ListFooterBgImage
{
	public function toOptionArray()
	{	
		return array(
			array('value'=>'1', 'label'=>Mage::helper('sport')->__('Fpattern1')),
			array('value'=>'2', 'label'=>Mage::helper('sport')->__('Fpattern2')),
			array('value'=>'3', 'label'=>Mage::helper('sport')->__('Fpattern3')),
			array('value'=>'4', 'label'=>Mage::helper('sport')->__('Fpattern4')),
			array('value'=>'5', 'label'=>Mage::helper('sport')->__('Fpattern5')),
			array('value'=>'6', 'label'=>Mage::helper('sport')->__('None'))
		);
	}
}
