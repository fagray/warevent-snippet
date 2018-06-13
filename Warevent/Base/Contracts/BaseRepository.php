<?php

namespace Warevent\Base\Contracts;

interface BaseRepository  {

	/**
	 * Persist data
	 *
	 * @param      array  $params  
	 */
	public function create(array $params);

	/**
	 * Find resource by id
	 *
	 * @param      int  $id     
	 */
	public function findById($id);

}