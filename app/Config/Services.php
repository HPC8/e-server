<?php

namespace Config;

use CodeIgniter\Config\Services as CoreServices;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends CoreServices
{

	public static function LINE_CLIENT_ID()
	{
		return  '1655086900';
	}
	public static function LINE_CLIENT_SECRET()
	{
		return  '69e1fa9458832c1d7b652eefdf41d66a';
	}
	public static function LINE_REDIRECT_URL()
	{
		return 'https://apps.anamai.moph.go.th/e-service/public/users/lineCallback';
	}
}
