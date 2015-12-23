<?php namespace Anomaly\AuthorizenetAimGatewayExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\EncryptedFieldType\EncryptedFieldTypePresenter;
use Anomaly\PaymentsModule\Gateway\Contract\GatewayInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Omnipay\AuthorizeNet\AIMGateway;
use Omnipay\AuthorizeNet\SIMGateway;

/**
 * Class MakeAuthorizenetAimGateway
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AuthorizenetAimGatewayExtension\Command
 */
class MakeAuthorizenetAimGateway implements SelfHandling
{

    /**
     * The gateway instance.
     *
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * Create a new MakePaypalGateway instance.
     *
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
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
            'anomaly.extension.authorizenet_aim_gateway::api_login_id',
            $this->gateway->getSlug()
        );
        $key  = $configuration->presenter(
            'anomaly.extension.authorizenet_aim_gateway::transaction_key',
            $this->gateway->getSlug()
        );
        $mode = $configuration->get(
            'anomaly.extension.authorizenet_aim_gateway::test_mode',
            $this->gateway->getSlug()
        );

        $gateway = new AIMGateway();

        $gateway->setTransactionKey($key->decrypted());
        $gateway->setDeveloperMode($mode->getValue());
        $gateway->setApiLoginId($id->decrypted());
        $gateway->setTestMode($mode->getValue());

        return $gateway;
    }
}
