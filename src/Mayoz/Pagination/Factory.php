<?php namespace Mayoz\Pagination;

use Illuminate\Pagination\Factory as IlluminateFactory;

class Factory extends IlluminateFactory {

	/**
	 * Current route name.
	 *
	 * @var string
	 */
	protected $routeName;

	/**
	 * Current route parameters.
	 *
	 * @var array
	 */
	protected $routeParameters;

	/**
	 * Get a new paginator instance.
	 *
	 * @param  array  $items
	 * @param  int    $total
	 * @param  int|null  $perPage
	 * @return \App\Services\Pagination\Paginator
	 */
	public function make(array $items, $total, $perPage = null)
	{
		$paginator = new Paginator($this, $items, $total, $perPage);

		return $paginator->setupPaginationContext();
	}

	/**
	 * Set route name.
	 *
	 * $param  string  $name
	 * @return void
	 */
	public function setRouteName($name)
	{
		$this->routeName = $name;
	}

	/**
	 * Get route name.
	 *
	 * @return string
	 */
	public function getRouteName()
	{
		return $this->routeName;
	}

	/**
	 * Set route parameters.
	 *
	 * $param  array  $parameters
	 * @return void
	 */
	public function setRouteParameters(array $parameters = [])
	{
		$this->routeParameters = $parameters;
	}

	/**
	 * Get route parameters.
	 *
	 * @return array
	 */
	public function getRouteParameters()
	{
		return $this->routeParameters;
	}

	/**
	 * Get the number of the current page.
	 *
	 * @return int
	 */
	public function getCurrentPage()
	{
		$page = (int) $this->currentPage ?: array_get($this->routeParameters, 'page');

		if ($page < 1 || filter_var($page, FILTER_VALIDATE_INT) === false)
		{
			return parent::getCurrentPage();
		}

		return $page;
	}

}