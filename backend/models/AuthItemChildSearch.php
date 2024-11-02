<?

namespace backend\models;

class AuthItemChildSearch extends AuthItemChild
{
  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   * @param Model $parentObj
   *
   * we have to send the "parentObj" parameter as $this one:
   * to store all filter values (taken from the parameters) in our GridView
   * use AbstractModelSearch::search method to handle all parameters
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
  	return (new AbstractModelSearch)->search($params, $this);
  }
}
