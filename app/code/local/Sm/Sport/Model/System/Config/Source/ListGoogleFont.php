<?php
/*------------------------------------------------------------------------
 # SM sport - Version 1.1
 # Copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 # @license - Copyrighted Commercial Software
 # Author: YouTech Company
 # Websites: http://www.magentech.com
-------------------------------------------------------------------------*/

class Sm_Sport_Model_System_Config_Source_ListGoogleFont
{
	public function toOptionArray()
	{	
		return array(
			array('value'=>'Questrial', 'label'=>Mage::helper('sport')->__('Questrial')),
			array('value'=>'Open Sans', 'label'=>Mage::helper('sport')->__('Open Sans')),
			array('value'=>'BenchNine', 'label'=>Mage::helper('sport')->__('BenchNine')),
			array('value'=>'Droid Sans', 'label'=>Mage::helper('sport')->__('Droid Sans')),
			array('value'=>'Droid Serif', 'label'=>Mage::helper('sport')->__('Droid Serif')),
			array('value'=>'PT Sans', 'label'=>Mage::helper('sport')->__('PT Sans')),
			array('value'=>'Vollkorn', 'label'=>Mage::helper('sport')->__('Vollkorn')),
			array('value'=>'Ubuntu', 'label'=>Mage::helper('sport')->__('Ubuntu')),
			array('value'=>'Neucha', 'label'=>Mage::helper('sport')->__('Neucha')),
			array('value'=>'Cuprum', 'label'=>Mage::helper('sport')->__('Cuprum'))	
		);
	}
}
