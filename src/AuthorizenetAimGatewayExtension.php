<?php namespace Anomaly\AuthorizenetAimGatewayExtension;

use Anomaly\AuthorizenetAimGatewayExtension\Command\MakeAuthorizenetAimGateway;
use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Omnipay\Common\AbstractGateway;

/**
 * Class AuthorizenetAimGatewayExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AuthorizenetAimGatewayExtension
 */
class AuthorizenetAimGatewayExtension extends GatewayExtension
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
        return $this->dispatch(new MakeAuthorizenetAimGateway($gateway));
    }

}
