<?php namespace Anomaly\AuthorizenetGatewayExtension;

use Anomaly\AuthorizenetGatewayExtension\Command\MakeAuthorizenetGateway;
use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Anomaly\PaymentsModule\Gateway\Provider\ProviderExtension;
use Omnipay\Common\AbstractGateway;

/**
 * Class AuthorizenetGatewayExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AuthorizenetGatewayExtension
 */
class AuthorizenetGatewayExtension extends ProviderExtension
{

    /**
     * This extension provides the Authorize.net
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::payment_gateway.authorizenet';

    /**
     * Return an Omnipay gateway.
     *
     * @param GatewayInterface $gateway
     * @return AbstractGateway
     * @throws \Exception
     */
    public function make(GatewayInterface $gateway)
    {
        return $this->dispatch(new MakeAuthorizenetGateway());
    }

}
