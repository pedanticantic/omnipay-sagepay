<?php

namespace Omnipay\SagePay;

use Omnipay\Common\AbstractGateway;

/**
 * Sage Pay Direct Gateway
 */
class DirectGateway extends AbstractGateway
{
    // Gateway identification.

    public function getName()
    {
        return 'Sage Pay Direct';
    }

    public function getDefaultParameters()
    {
        return array(
            'vendor' => '',
            'testMode' => false,
            'referrerId' => '',
            'continuousAccountAvailable' => false,
            'motoAccountAvailable' => false,
        );
    }

    // Vendor identification.

    public function getVendor()
    {
        return $this->getParameter('vendor');
    }

    public function setVendor($value)
    {
        return $this->setParameter('vendor', $value);
    }

    public function setUseOldBasketFormat($value)
    {
        $value = (bool)$value;

        return $this->setParameter('useOldBasketFormat', $value);
    }

    public function getUseOldBasketFormat()
    {
        return $this->getParameter('useOldBasketFormat');
    }

    // Access to the HTTP client for debugging.
    // NOTE: this is likely to be removed or replaced with something
    // more appropriate.

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    // Available services.
    public function getReferrerId()
    {
        return $this->getParameter('referrerId');
    }

    public function setReferrerId($value)
    {
        return $this->setParameter('referrerId', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectCompleteAuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\RefundRequest', $parameters);
    }

    /**
     * @deprecated use repeatAuthorize() or repeatPurchase()
     */
    public function repeatPayment(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectRepeatPaymentRequest', $parameters);
    }

    public function repeatAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectRepeatAuthorizeRequest', $parameters);
    }

    public function repeatPurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\DirectRepeatPurchaseRequest', $parameters);
    }

    public function getContinuousAccountAvailable()
    {
        return $this->getParameter('continuousAccountAvailable');
    }

    /**
     * Pass in a truthy or falsey value that says whether or not the merchant account supports repeat
     * transactions (continuous authority).
     * I would have cast the argument to boolean before storing it, but the unit tests insist
     * that the getter returns exactly the same value, so I couldn't.
     * @param $value
     * @return $this
     */
    public function setContinuousAccountAvailable($value)
    {
        return $this->setParameter('continuousAccountAvailable', $value);
    }

    public function getMotoAccountAvailable()
    {
        return $this->getParameter('motoAccountAvailable');
    }

    /**
     * Pass in a truthy or falsey value that says whether or not the merchant account supports telephone (Moto)
     * transactions.
     * I would have cast the argument to boolean before storing it, but the unit tests insist
     * that the getter returns exactly the same value, so I couldn't.
     * @param $value
     * @return $this
     */
    public function setMotoAccountAvailable($value)
    {
        return $this->setParameter('motoAccountAvailable', $value);
    }
}
