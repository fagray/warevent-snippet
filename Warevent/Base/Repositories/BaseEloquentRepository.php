<?php

namespace Warevent\Base\Repositories;

use Warevent\Base\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseEloquentRepository implements BaseRepository {

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function create(array $params) : Collection
	{
		return $this->model->create($params);
	}

	/**
	 * Find resource by id.
	 *
	 * @param      int   $id     
	 *
	 * @return     boolean  
	 */
	public function findById($id = null )
	{
		if( ! is_null($id) ){

			return $this->model->find($id)->first();

		}

		return false; 
	}
}