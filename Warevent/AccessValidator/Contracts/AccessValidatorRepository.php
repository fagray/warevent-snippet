<?php

namespace Warevent\AccessValidator\Contracts;

interface AccessValidatorRepository {
	
	/**
	 * Determines if the user is authorize to perform the specified ability.
	 */
	public function isAuthorizeTo($ability);
}