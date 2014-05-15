<?php namespace Services;

use Illuminate\Support\Str;

class CamelCaseSerializer
{
	protected $modelTransformer = null;

	public function __construct(Str $str)
	{
		$this->str = $str;
	}

	public function setModelTransformer($transformer)
	{
		$this->modelTransformer = $transformer;
	}

	public function serialize($data)
	{
		if (is_a($data, 'Illuminate\\Support\\Collection')) {
			return $this->serializeCollection($data);
		} elseif (is_a($data, 'Illuminate\\Database\\Eloquent\\Model')) {
			return $this->serializeEloquentModel($data);
		} elseif (is_array($data)) {
			return $this->serializeArray($data);
		} else {
			return $data;
		}
	}

	public function normalize($data)
	{
		if (is_array($data)) {
			return $this->normalizeArray($data);
		} else {
			return $data;
		}
	}

	public function normalizeKey($key)
	{
		return $this->str->snake($key);
	}

	public function serializeKey($key)
	{
		return $this->str->camel($key);
	}

	protected function serializeCollection($collection)
	{
		return $collection->map(function($data) {
			return $this->serialize($data);
		});
	}

	protected function serializeEloquentModel($model)
	{
		if ($this->modelTransformer) {
			$data = call_user_func($this->modelTransformer, $model);
		} else {
			$data = $model->toArray();
		}

		return $this->serializeArray($data);
	}

	protected function serializeArray(array $data)
	{
		$serializedData = array();

		foreach ($data as $key => $value) {
			$key = $this->serializeKey($key);
			$value = $this->serialize($value);

			$serializedData[$key] = $value;
		}

		return $serializedData;
	}

	protected function normalizeArray(array $data)
	{
		$normalizedData = array();

		foreach ($data as $key => $value) {
			$key = $this->normalizeKey($key);
			$value = $this->normalize($value);

			$normalizedData[$key] = $value;
		}

		return $normalizedData;
	}
}
