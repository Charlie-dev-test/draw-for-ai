<?

namespace backend\models;

use backend\components\ActiveRecord;

/**
 * Description of AbstractModelExtraFields class:
 * 
 * Needs to declare aliases of the custom columns
 * (usualy uses for joins)
 * 
 */
class AbstractModelExtraFields extends ActiveRecord
{
 	
 	public $langname;
 	public $langlist;
 	public $parentfield = null;
 	public $equips; //-- uses for RUS.SUPPORT only
 	public $openpasswordfield;

}
