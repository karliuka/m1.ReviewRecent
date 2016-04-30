<?php
/**
 * Faonn
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_ReviewRecent
 * @copyright   Copyright (c) 2015 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Faonni_ReviewRecent_Model_Adminhtml_System_Config_Source_Sidebar
	extends Varien_Object
{
    /**
     * Retrieve review recent sidebar options as array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Faonni_ReviewRecent_Model_Sidebar::LEFT,
                'label' => Mage::helper('faonni_reviewrecent')->__('Left')
            ),		
            array(
                'value' => Faonni_ReviewRecent_Model_Sidebar::RIGHT,
                'label' => Mage::helper('faonni_reviewrecent')->__('Right')
            )
        );	
    }
}
