<?php

use Illuminate\Support\Collection;

abstract class BaseController extends Controller
{
	protected $serializer = 'Services\\EmberSerializer';

	protected $requiredRole = null;

	protected $hasKey = null;

	public function userCheck()
	{
		$auth = app('VintageRegistry\\Services\\TokenAuth');
		$token = \Request::header('Authorization');
		$user = $auth->userForToken($token);

		if (!$user) {
			app()->abort(401, 'Unauthorized access');
		}

		if ($this->requiredRole) {
			if (!$user->hasRole($this->requiredRole)) {
				app()->abort(401, 'Unauthorized access');
			}
		}
	}

	protected function serializeOutput($values)
	{
		return $this->serializer->serialize($values);
	}

	protected function normalize($values)
	{
		return $this->serializer->normalize($values);
	}

	protected function needsSerialization($response)
	{
		return		is_array($response)
				|| 	is_a($response, 'Illuminate\\Support\\Collection')
				|| 	is_a($response, 'Illuminate\\Database\\Eloquent\\Model');
	}

	protected function addOutputKey($response)
	{
		if (is_a($response, 'Illuminate\\Database\\Eloquent\\Model')) {
			$key = $this->getSingularOutputKey();
		} else {
			$key = $this->getPluralOutputKey();
		}

		return array($key => $response);
	}

	protected function getSingularOutputKey()
	{
		$key = str_singular(class_basename($this));

		return $this->serializer->serializeKey($key);
	}

	protected function getPluralOutputKey()
	{
		$key = str_plural(class_basename($this));

		return $this->serializer->serializeKey($key);
	}

	/**
	 * Execute an action on the controller.
	 *
	 * @param string  $method
	 * @param array   $parameters
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function callAction($method, $parameters)
	{
		$this->setupSerializer();

		$response = call_user_func_array(array($this, $method), $parameters);

		// Check if the response should be serialized
		if ($this->needsSerialization($response))
		{
			if ($this->hasKey) {
				$response = $this->addOutputKey($response);
			}

			$response = $this->serializeOutput($response);

			if (is_array($response)) {
				$response = new Collection($response);
			} elseif (is_a($response, 'Illuminate\\Support\\Collection')) {
				$response = $response->toArray();
			}
		}

		return $response;
	}

	protected function setupSerializer()
	{
		$this->serializer = app($this->serializer);
		$this->serializer->setModelTransformer($this->getModelTransformer());
	}

	protected function getModelTransformer()
	{
		if (method_exists($this, 'modelTransformer')) {
			return array($this, 'modelTransformer');
		}
	}
}
