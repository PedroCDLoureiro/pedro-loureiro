<?php
/**
 * B2W Digital - Companhia Digital
 *
 * Do not edit this file if you want to update this SDK for future new versions.
 * For support please contact the e-mail bellow:
 *
 * sdk@e-smart.com.br
 *
 * @category  SkuHub
 * @package   SkuHub
 *
 * @copyright Copyright (c) 2018 B2W Digital - BSeller Platform. (http://www.bseller.com.br).
 *
 * @author    Tiago Sampaio <tiago.sampaio@e-smart.com.br>
 */

namespace SkyHub\Api\EntityInterface\Catalog\Product;

trait MutualMethods
{
    
    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->data['sku'] = (string) $sku;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getSku()
    {
        return $this->getData('sku');
    }
    
    
    /**
     * @param float $qty
     *
     * @return $this
     */
    public function setQty($qty)
    {
        $this->data['qty'] = (float) $qty;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getQty()
    {
        return (int) $this->getData('qty');
    }
    
    
    /**
     * @param int $ean
     *
     * @return $this
     */
    public function setEan($ean)
    {
        $this->data['ean'] = (string) $ean;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getEan()
    {
        return (string) $this->getData('ean');
    }
    
    
    /**
     * @return array
     */
    public function getImages()
    {
        return (array) $this->getData('images');
    }
    
    
    /**
     * @param string $source
     *
     * @return $this
     */
    public function addImage($source)
    {
        $images   = $this->getImages();
        $images[] = $source;
        
        $this->setData('images', $images);
        
        return $this;
    }
    
    
    /**
     * @return array
     */
    public function getSpecifications()
    {
        return (array) $this->getData('specifications');
    }
    
    
    /**
     * @param string $code
     * @param string $value
     *
     * @return $this
     */
    public function addSpecification($code, $value)
    {
        $data = (array) $this->getSpecifications();
        $data[] = [
            'key'   => $code,
            'value' => $value,
        ];
        
        $this->setData('specifications', $data);
        
        return $this;
    }
}
