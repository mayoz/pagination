<?php namespace Mayoz\Pagination;

use Illuminate\Pagination\Paginator as IlluminatePaginator;

class Paginator extends IlluminatePaginator {

	/**
	 * Get a URL for a given page number.
	 *
	 * @param  int  $page
	 * @return string
	 */
	public function getUrl($page)
	{
		$parameters = $this->factory->getRouteParameters();

		// bind current page
		$parameters[$this->factory->getPageName()] = $page;

		// bind get query
		if (count($this->query) > 0)
		{
			$parameters = array_merge($this->query, $parameters);
		}

		$route = route($this->factory->getRouteName(), $parameters);

		return preg_replace('#\/1$#is', '', $route);
	}

	/**
	 * Set route name and route parameters.
	 *
	 * $param  string  $name
	 * $param  array   $parameters
	 * @return static
	 */
	public function route($name, array $parameters = [])
	{
		$this->factory->setRouteName($name);
		$this->factory->setRouteParameters($parameters);

		return $this;
	}

}