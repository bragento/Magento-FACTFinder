<?php
/**
 * Flagbit_FactFinder
 *
 * @category  Mage
 * @package   Flagbit_FactFinder
 * @copyright Copyright (c) 2010 Flagbit GmbH & Co. KG (http://www.flagbit.de/)
 */

/**
 * Provides advisory hints to the product view page
 * 
 * @category  Mage
 * @package   Flagbit_FactFinder
 * @copyright Copyright (c) 2012 Flagbit GmbH & Co. KG (http://www.flagbit.de/)
 * @author    Mike Becker <mike.becker@flagbit.de>
 * @version   $Id$
 */
class Flagbit_FactFinder_Block_Campaign_Product_Feedback extends Mage_Core_Block_Template
{
    protected $_productCampaignHandler;

    protected function _prepareLayout()
    {
        $productIds = array(
            Mage::registry('current_product')->getData(Mage::helper('factfinder/search')->getIdFieldName())
        );
        $this->_productCampaignHandler = Mage::getSingleton('factfinder/handler_productDetailCampaign', $productIds);
        return parent::_prepareLayout();
    }

    /**
    * get campaign feedback
    *
    * @return array $feedback
    */
    public function getActiveFeedback()
    {
        $feedback = array();
        
        if (Mage::helper('factfinder/search')->getIsEnabled(false, 'campaign') && Mage::registry('current_product')) {
            $_campaigns = $this->_productCampaignHandler->getCampaigns();
            
            if($_campaigns && $_campaigns->hasFeedback()){
                $feedback = $_campaigns;
            }
        }

        return $feedback;
    }
}