<?php
/*------------------------------------------------------------------------
 # SM sport - Version 1.0
 # Copyright (c) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Sport_Model_System_Config_Source_ListColor
{
	public function toOptionArray()
	{	
		return array(
		array('value'=>'tomato', 'label'=>Mage::helper('sport')->__('Tomato')),
		array('value'=>'boocdo', 'label'=>Mage::helper('sport')->__('Boocdo')),
		array('value'=>'blue', 'label'=>Mage::helper('sport')->__('Blue')),
		array('value'=>'cyan', 'label'=>Mage::helper('sport')->__('Cyan')),
		array('value'=>'orange', 'label'=>Mage::helper('sport')->__('Orange'))
		);
	}
}
