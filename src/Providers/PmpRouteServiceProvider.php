<?php  
namespace Pmp\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;
use Plenty\Plugin\Routing\ApiRouter;


class PmpRouteServiceProvider extends RouteServiceProvider
{
	public function map(Router $router, ApiRouter $apiRouter) {

		$apiRouter->version(
			['v1'],
			['namespace' => 'Pmp\Controllers', 'middleware' => 'oauth'],
			function ($apiRouter) {
				$apiRouter->post('payment/pmp/settings/', 'SettingsController@saveSettings');
				$apiRouter->get('payment/pmp/settings/{settingType}', 'SettingsController@loadSettings');
				$apiRouter->get('payment/pmp/setting/{plentyId}/{settingType}', 'SettingsController@loadSetting');
			}
		);

		// Routes for display General settings
		$router->get('pmp/settings/{settingType}','Pmp\Controllers\SettingsController@loadConfiguration');

		// Routes for 
		$router->post('pmp/settings/save','Pmp\Controllers\SettingsController@saveConfiguration');

		// Routes for Pmp payment widget
		// $router->get('payment/pmp/pay', 'Pmp\Controllers\PaymentController@handlePayment');
	}
}

?>