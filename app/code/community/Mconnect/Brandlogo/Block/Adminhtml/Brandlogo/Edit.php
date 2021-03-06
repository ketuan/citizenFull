<?php
/**
 * M-Connect Solutions.
 * 
 *
 * NOTICE OF LICENSE
 *
 *
 * It is also available through the world-wide-web at this URL:
 * http://www.mconnectsolutions.com/lab/
 *
 * @category   M-Connect
 * @package    M-Connect
 * @copyright  Copyright (c) 2009-2010 M-Connect Solutions. (http://www.mconnectsolutions.com)
 */
?>
<?php

class Mconnect_Brandlogo_Block_Adminhtml_Brandlogo_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'brandlogo';
        $this->_controller = 'adminhtml_brandlogo';
        
        $this->_updateButton('save', 'label', Mage::helper('brandlogo')->__('Save Brand Logo'));
        $this->_updateButton('delete', 'label', Mage::helper('brandlogo')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('brandlogo_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'brandlogo_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'brandlogo_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('brandlogo_data') && Mage::registry('brandlogo_data')->getId() ) {
            return Mage::helper('brandlogo')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('brandlogo_data')->getTitle()));
        } else {
            return Mage::helper('brandlogo')->__('Add Brand Logo');
        }
    }
}