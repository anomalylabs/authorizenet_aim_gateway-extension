<?php namespace Anomaly\AuthorizenetGatewayExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\PaymentsModule\Account\Contract\AccountInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
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
     * The account instance.
     *
     * @var AccountInterface
     */
    protected $account;

    /**
     * Create a new MakePaypalGateway instance.
     *
     * @param AccountInterface $account
     */
    public function __construct(AccountInterface $account)
    {
        $this->account = $account;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @return SIMGateway
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        /* @var EncryptedFieldTypePresenter $id */
        /* @var EncryptedFieldTypePresenter $key */
        /* @var EncryptedFieldTypePresenter $secret */
        /* @var SettingInterface $mode */
        $id   = $configuration->presenter(
            'anomaly.extension.authorizenet_gateway::api_login_id',
            $this->account->getSlug()
        );
        $key  = $configuration->presenter(
            'anomaly.extension.authorizenet_gateway::transaction_key',
            $this->account->getSlug()
        );
        $mode = $configuration->get('anomaly.extension.authorizenet_gateway::test_mode', $this->account->getSlug());

        $gateway = new AIMGateway();

        $gateway->setTransactionKey($key->decrypted());
        $gateway->setDeveloperMode($mode->getValue());
        $gateway->setApiLoginId($id->decrypted());
        $gateway->setTestMode($mode->getValue());

        return $gateway;
    }
}
