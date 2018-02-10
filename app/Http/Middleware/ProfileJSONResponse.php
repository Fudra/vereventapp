<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

/**
 * This class is helpful to Profiling api request of your application.
 * to append the profiling information to the response just append
 * `?profiling` to the request.
 *
 * To filter the request down, you can add the needed profiling
 * information to the query. ie: ?profiling=time,queries
 *
 * Available information are:
 * __meta, php, messages, time, memory
 * exceptions, views, route, queries
 * swiftmailer_mails, auth, gate
 * session, request.
 *
 * Class ProfileJSONResponse
 * @package App\Http\Middleware
 */
class ProfileJSONResponse {

	protected $profilingData = [];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$response = $next( $request );

		if ( ! app()->bound( 'debugbar' ) || ! app( 'debugbar' )->isEnabled() ) {
			return $response;
		}

		if ( $response instanceof JsonResponse && $request->has( 'profiling' ) ) {

			$this->getProfilingDetails( $request->get('profiling'));

			/*
			 * This setup is tailored for the 'spatie/laravel-fractal'
			 * package and is required.
			 *
			 * see the following links:
			 * https://fractal.thephpleague.com/transformers/
			 * https://github.com/spatie/laravel-fractal
			 *
			 */
			$response->setData(
				[
					'data' => $response->getData()->data,
					'_debugbar' => $this->getProfilingData()
				]
			);
		}

		return $response;
	}

	/**
	 * Get profiling data
	 *
	 * @return array
	 */
	protected function getProfilingData() {

		if ( empty( $this->profilingData ) ) {
			return app( 'debugbar' )->getData();
		}

		return array_only( app( 'debugbar' )->getData(), $this->profilingData );
	}

	/**
	 * Get Request profiling data from URI
	 *
	 * @param string $requestProfilingData
	 */
	protected function getProfilingDetails($requestProfilingData) {
		if($requestProfilingData == null ) {
			$this->profilingData = [];
		} else {
			$this->profilingData = explode(",", $requestProfilingData);
		}
	}
}
