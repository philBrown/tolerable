<?php
namespace Tolerable\PayPal\Request;

use \InvalidArgumentException;

class SetExpressCheckoutRequest extends ExpressCheckoutRequest
{
    const METHOD = 'SetExpressCheckout';
    
    const DISPLAY_SHIPPING_ADDRESS = 0;
    const HIDE_SHIPPING_ADDRESS    = 1;
    const DEFAULT_SHIPPING_ADDRESS = 2;
    
    const MAX_CALLBACK_TIMEOUT = 6;
    
    const RETURN_URL       = 'RETURNURL';
    const CANCEL_URL       = 'CANCELURL';
    const ALLOW_NOTE       = 'ALLOWNOTE';
    const LOCALE_CODE      = 'LOCALECODE';
    const SHOW_SHIPPING    = 'NOSHIPPING';
    const ADDRESS_OVERRIDE = 'ADDROVERRIDE';
    const CALLBACK         = 'CALLBACK';
    const CALLBACK_TIMEOUT = 'CALLBACKTIMEOUT';
    const CALLBACK_VERSION = 'CALLBACKVERSION';
    
    protected $method = self::METHOD;
    
    protected $showShipping = self::DEFAULT_SHIPPING_ADDRESS;
    
    protected $addressOverride = false;
    
    protected $returnUrl;
    
    protected $cancelUrl;
    
    protected $callback;
    
    protected $callbackTimeout = self::MAX_CALLBACK_TIMEOUT;
    
    protected $callbackVersion = self::API_CURRENT_VERSION;
    
    public function __construct($returnUrl, $cancelUrl)
    {
        $this->setReturnUrl($returnUrl)
             ->setCancelUrl($cancelUrl);
    }
    
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = (string) $returnUrl;
        return $this;
    }
    
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = (string) $cancelUrl;
        return $this;
    }
    
    public function setShowShipping($showShipping) {
        switch ($showShipping) {
            case self::DISPLAY_SHIPPING_ADDRESS :
            case self::HIDE_SHIPPING_ADDRESS :
            case self::DEFAULT_SHIPPING_ADDRESS :
                $this->showShipping = (int) $showShipping;
                break;
            default :
                throw new InvalidArgumentException($showShipping);
        }
        return $this;
    }
    
    public function setAddressOverride($addressOverride = true) {
        $this->addressOverride = (bool) $addressOverride;
        return $this;
    }
    
    public function setCallback($callback)
    {
        $this->callback = (string) $callback;
        return $this;
    }
    
    public function setCallbackTimeout($callbackTimeout)
    {
        $this->callbackTimeout = min((int) $callbackTimeout, self::MAX_CALLBACK_TIMEOUT);
        return $this;
    }
    
    public function toArray()
    {
        return array(
            self::RETURN_URL       => $this->returnUrl,
            self::CANCEL_URL       => $this->cancelUrl,
            self::ALLOW_NOTE       => 1,
            self::SHOW_SHIPPING    => $this->showShipping,
            self::LOCALE_CODE      => 'AU',
            self::ADDRESS_OVERRIDE => $this->addressOverride ? 1 : 0,
            self::CALLBACK         => $this->callback,
            self::CALLBACK_TIMEOUT => $this->callbackTimeout,
            self::CALLBACK_VERSION => $this->callbackVersion
        ) + parent::toArray();
    }
}
