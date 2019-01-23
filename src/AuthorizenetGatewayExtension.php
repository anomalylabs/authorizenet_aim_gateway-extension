<?php namespace Anomaly\AuthorizenetGatewayExtension;

use Anomaly\AuthorizenetAimGatewayExtension\Command\MakeAuthorizenetGateway;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\GatewayInterface;

/**
 * Class AuthorizenetGatewayExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizenetGatewayExtension extends GatewayExtension
{

    /**
     * This extension provides the Authorize.net
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::gateway.authorizenet_aim';

    /**
     * Return an Omnipay gateway.
     *
     * @param GatewayInterface $gateway
     * @return AbstractGateway
     * @throws \Exception
     */
    public function make(GatewayInterface $gateway)
    {
        return $this->dispatch(new MakeAuthorizenetGateway($gateway));
    }

}
