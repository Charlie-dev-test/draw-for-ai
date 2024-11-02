<?

namespace backend\helpers;

use Yii;
use backend\models\Languages;
use backend\models\Menus;
use backend\models\Issues;
use backend\models\Translates;

class Meta
{
  
	public static $LANG_ID = 1;
	
	public static $PAGE_MENU_ID = null;
	public static $PAGE_ISSUE_ID = null;
	public static $PAGE_MENU_URL = null;
	public static $PAGE_ISSUE_URL = null;
	
	public static $PAGE_SEO_DESCRIPTION = null;
	public static $PAGE_SEO_KEYWORDS = null;
	public static $PAGE_SEO_TITLE = null;

  public static function setMeta()
  {
  	//-- get language ID of the application
		self::$LANG_ID = 1;
		$lands = new Languages();
		$langCodeArrayList = $lands->fetchPairs(["code", "id"]);
		$langCode = Yii::$app->language;
		if(!empty($langCodeArrayList[$langCode])) {
			self::$LANG_ID = $langCodeArrayList[$langCode];
		}
  	
  	//-- get SEO meta-tags for Menus & Issues
		$menusModel = new Menus();
		$issuesModel = new Issues();
		$translatesModel = new Translates();
	  
		$fullUrl = "";
		self::$PAGE_MENU_ID = null;
		self::$PAGE_ISSUE_ID = null;
		self::$PAGE_MENU_URL = null;
		self::$PAGE_ISSUE_URL = null;
		
		$urlSlices = explode("/", substr(Yii::$app->request->url, 1));
		$title = "";
		foreach($urlSlices as $urlPiece) {
			$fullUrl .= "/".$urlPiece;
			$showAll = false;
			$row = $menusModel->getMenuByUrl($fullUrl, self::$LANG_ID, $showAll);
			if(!is_null($row)) {
				//-- TODO: flags "Add SEO description & SEO keywords"?
				self::$PAGE_MENU_ID = $row->id;
				self::$PAGE_MENU_URL = $row->url;
				self::$PAGE_SEO_DESCRIPTION = $row->seo_description;
				self::$PAGE_SEO_KEYWORDS = $row->seo_keywords;
				if(!empty($title)) {
					$title .= ". ";
				}
				$title .= $row->title;
			} else {
				$row = $issuesModel->getSmartAddress($urlPiece, null, self::$LANG_ID);
				if(!is_null($row)) {
					self::$PAGE_ISSUE_ID = $row->id;
					self::$PAGE_ISSUE_URL = $row->smart_address;
					self::$PAGE_SEO_DESCRIPTION = $row->seo_description;
					self::$PAGE_SEO_KEYWORDS = $row->seo_keywords;
					if(!empty($title)) {
						$title .= ". ";
					}
					$title .= $row->title;
				} else {
					$row = $translatesModel->getSmartAddress($urlPiece, null, self::$LANG_ID);
					if(!is_null($row)) {
						self::$PAGE_ISSUE_ID = $row->id;
						self::$PAGE_ISSUE_URL = $row->smart_address;
						self::$PAGE_SEO_DESCRIPTION = $row->seo_description;
						self::$PAGE_SEO_KEYWORDS = $row->seo_keywords;
						if(!empty($title)) {
							$title .= ". ";
						}
						$title .= $row->title;
					}
				}
			}
		}
		self::$PAGE_SEO_TITLE = $title;
  }

}