<?php namespace Anomaly\AuthorizenetGatewayExtension;

use Anomaly\AuthorizenetGatewayExtension\Command\MakeAuthorizenetGateway;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Omnipay\AuthorizeNet\AIMGateway;

/**
 * Class AuthorizenetGatewayExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AuthorizenetGatewayExtension
 */
class AuthorizenetGatewayExtension extends GatewayExtension
{

    /**
     * This extension provides the Authorize.net
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::payment_gateway.authorizenet';

    /**
     * Return the gateway.
     *
     * @return AIMGateway
     */
    public function make()
    {
        return $this->dispatch(new MakeAuthorizenetGateway());
    }

}
