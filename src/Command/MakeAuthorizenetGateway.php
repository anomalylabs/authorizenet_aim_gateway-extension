<?php namespace Anomaly\AuthorizenetGatewayExtension\Command;

use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Omnipay\AuthorizeNet\AIMGateway;
use Omnipay\Common\GatewayInterface;

/**
 * Class MakeAuthorizenetGateway
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MakeAuthorizenetGateway
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @return GatewayInterface
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        /* @var EncryptedFieldTypePresenter $id */
        /* @var EncryptedFieldTypePresenter $key */
        /* @var SettingInterface $mode */
        $debug = $settings->get('anomaly.extension.authorizenet_gateway::debug_mode');
        $id    = $settings->presenter('anomaly.extension.authorizenet_gateway::api_login_id');
        $key   = $settings->presenter('anomaly.extension.authorizenet_gateway::transaction_key');

        $gateway = new AIMGateway();

        $gateway->setTransactionKey($key->decrypt());
        $gateway->setTestMode($debug->getValue());
        $gateway->setApiLoginId($id->decrypt());
        $gateway->setDeveloperMode(false);

        return $gateway;
    }
}
