<?php namespace Anomaly\AuthorizenetGatewayExtension\Command;

use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Omnipay\AuthorizeNet\AIMGateway;
use Omnipay\AuthorizeNet\SIMGateway;

/**
 * Class MakeAuthorizenetGateway
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AuthorizenetGatewayExtension\Command
 */
class MakeAuthorizenetGateway implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param SettingRepositoryInterface $settings
     * @return SIMGateway
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        /* @var EncryptedFieldTypePresenter $id */
        /* @var EncryptedFieldTypePresenter $key */
        /* @var EncryptedFieldTypePresenter $secret */
        /* @var SettingInterface $mode */
        $id   = $settings->presenter('anomaly.extension.authorizenet_gateway::api_login_id');
        $key  = $settings->presenter('anomaly.extension.authorizenet_gateway::transaction_key');
        $mode = $settings->get('anomaly.extension.authorizenet_gateway::test_mode');

        $gateway = new AIMGateway();

        $gateway->setApiLoginId($id->decrypted());
        $gateway->setTransactionKey($key->decrypted());
        $gateway->setTestMode($mode->getValue());
        $gateway->setDeveloperMode($mode->getValue());

        return $gateway;
    }
}
