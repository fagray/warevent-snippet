<?php

namespace Warevent\AccessValidator\Repositories;

use Warevent\AccessValidator\Contracts\AccessValidatorRepository;

class AccessValidatorEloquentRepository implements AccessValidatorRepository {

	/**
	 * Determines if the user is authorize to perform the specified action.
	 *
	 * @param      string   $ability  
	 *
	 * @return     boolean  True if authorize to, False otherwise.
	 */
	public function isAuthorizeTo($ability)
	{
		$user = \JWTAuth::parseToken()->authenticate();
		if ( ! $user->can( [$ability] )) {
            return  false;
        }
        return true;
	}
}