<?php

namespace Schoolnet\Routes;

interface Route
{
	public function execute($userId);
}