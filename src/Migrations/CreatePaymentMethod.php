<?php  
namespace Pmp\Migrations;

use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;

use Pmp\Helper\PaymentHelper;

/**
* 
*/
class CreatePaymentMethod
{
	
	/**
	 * @var PaymentMethodRepositoryContract
	 */
	private $paymentMethodRepository;

	/**
	 * @var PaymentHelper
	 */
	private $paymentHelper;


	public function __construct(
		PaymentMethodRepositoryContract $paymentMethodRepository, 
		PaymentHelper $paymentHelper
	) {
		$this->paymentMethodRepository = $paymentMethodRepository;
		$this->paymentHelper = $paymentHelper;
	}

	public function run() {
		$this->createPaymentMethodByPaymentKey('PMP_ACC', 'Credit Card Payment Methods');
	}

	/**
	 * Create payment method with given parameters if it doesn't exist
	 *
	 * @param string $paymentKey
	 * @param string $name
	 */
	private function createPaymentMethodByPaymentKey($paymentKey, $name)
	{
		// Check whether the ID of the PmPay payment method has been created
		$paymentMethod = $this->paymentHelper->getPaymentMethodByPaymentKey($paymentKey);
		if (is_null($paymentMethod))
		{
			$this->paymentMethodRepository->createPaymentMethod(
							[
								'pluginKey' => 'pmp',
								'paymentKey' => (string) $paymentKey,
								'name' => $name
							]
			);
		}
	}
}

?>