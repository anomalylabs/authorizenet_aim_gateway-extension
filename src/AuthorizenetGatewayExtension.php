<?php namespace Anomaly\AuthorizenetGatewayExtension;

use Anomaly\AuthorizenetGatewayExtension\Command\MakeAuthorizenetGateway;
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
     * The supported methods.
     *
     * @var array
     */
    protected $supports = [
        'authorize',
        'purchase',
        'refund',
//        'create_card',
//        'delete_card',
    ];

    /**
     * This extension provides the Authorize.net
     * payment gateway for the Payments module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.payments::gateway.authorizenet';

    /**
     * Return an Omnipay gateway.
     *
     * @param GatewayInterface $gateway
     * @return AbstractGateway
     * @throws \Exception
     */
    public function omnipay()
    {
        return $this->dispatch(new MakeAuthorizenetGateway());
    }

}
