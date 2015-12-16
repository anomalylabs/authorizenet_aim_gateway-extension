<?php namespace Anomaly\AuthorizenetGatewayExtension;

use Anomaly\AuthorizenetGatewayExtension\Command\MakeAuthorizenetGateway;
use Anomaly\PaymentsModule\Account\Contract\AccountInterface;
use Anomaly\PaymentsModule\Gateway\GatewayExtension;
use Omnipay\Common\AbstractGateway;

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
    protected $provides = 'anomaly.module.payments::gateway.authorizenet';

    /**
     * Return an Omnipay gateway.
     *
     * @param AccountInterface $account
     * @return AbstractGateway
     * @throws \Exception
     */
    public function make(AccountInterface $account)
    {
        return $this->dispatch(new MakeAuthorizenetGateway($account));
    }

}
