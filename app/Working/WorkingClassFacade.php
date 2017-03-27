<?php 
	namespace App\Working;
	use Illuminate\Support\Facades\Facade;
	class WorkingClassFacade extends Facade{
	    protected static function getFacadeAccessor() { return 'workingclass'; }
	}
 ?>