<?php namespace Mayoz\Pagination;

use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('mayoz/pagination');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['paginator'] = $this->app->share(function($app) {
			$paginator = new Factory($app['request'], $app['view'], $app['translator']);
			$paginator->setViewName($app['config']['view.pagination']);
			$paginator->setRouteName($app['router']->currentRouteName());
			$paginator->setRouteParameters($app['router']->current()->parameters());
			$paginator->setCurrentPage($paginator->getCurrentPage());

			return $paginator;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('paginator');
	}

}
