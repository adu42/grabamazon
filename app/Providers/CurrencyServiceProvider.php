<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ado\Models\Currency;
use App\Console\Commands\CurrencyCleanupCommand;
use App\Console\Commands\CurrencyUpdateCommand;

class CurrencyServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register providers.
		$this->registerCurrency();

		// Register commands.
		$this->registerCurrencyCommands();

		//extend blade engine by adding @currency compile function
		$this->app['view.engine.resolver']->resolve('blade')->getCompiler()->extend(function($view)
		{
			$html = "$1<?php echo Currency::format$2; ?>";
			return preg_replace("/(?<!\w)(\s*)@currency(\s*\(.*\))/", $html, $view);
		});

		// Assign commands.
		$this->commands(
			'currency.update',
			'currency.cleanup'
		);
	}

	/**
	 * Register currency provider.
	 *
	 * @return void
	 */
	public function registerCurrency()
	{
		$this->app['currency'] = $this->app->share(function($app)
		{
			return new Currency($app);
		});
	}

	/**
	 * Register generator of Currency.
	 *
	 * @return void
	 */
	public function registerCurrencyCommands()
	{
		$this->app['currency.update'] = $this->app->share(function($app)
		{
			return new CurrencyUpdateCommand($app);
		});

		$this->app['currency.cleanup'] = $this->app->share(function($app)
		{
			return new CurrencyCleanupCommand();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('currency');
	}

}