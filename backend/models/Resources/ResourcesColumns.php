<?

namespace backend\models\Resources;

use backend\models\Resources;
use backend\models\AbstractModel;

class ResourcesColumns extends Resources
{
    public static $gridViewFilterTypes = [
    	'checkbox'                          => "FILTER_CHECKBOX",
			//'radio'                             => "FILTER_RADIO",
			'\kartik\select2\Select2'           => "FILTER_SELECT2",
			'\kartik\typeahead\Typeahead'       => "FILTER_TYPEAHEAD",
			'\kartik\switchinput\SwitchInput'   => "FILTER_SWITCH",
			'\kartik\touchspin\TouchSpin'       => "FILTER_SPIN",
			'\kartik\rating\StarRating'         => "FILTER_STAR",
			'\kartik\date\DatePicker'           => "FILTER_DATE",
			'\kartik\time\TimePicker'           => "FILTER_TIME",
			'\kartik\datetime\DateTimePicker'   => "FILTER_DATETIME",
			'\kartik\daterange\DateRangePicker' => "FILTER_DATE_RANGE",
			//'\kartik\sortinput\SortableInput'   => "FILTER_SORTABLE",
			'\kartik\range\RangeInput'          => "FILTER_RANGE",
			'\kartik\color\ColorInput'          => "FILTER_COLOR",
			'\kartik\slider\Slider'             => "FILTER_SLIDER",
			'\kartik\money\MaskMoney'           => "FILTER_MONEY",
			'\kartik\number\NumberControl'      => "FILTER_NUMBER",
			'\kartik\checkbox\CheckboxX'        => "FILTER_CHECKBOX_X",
    ];
    
    public static function tableName()
    {
      return 'z_resources_columns';
    }
    
    /*
    * @return аттрибуты
    */
    public function attributeLabels()
    {
        return [
          'id'                   => "ID",
          'orderid'              => "Сортировка",
          'resourceid'           => "Идентификатор",
          'title'                => "Название",
          'width'                => "Ширина",
          'field'                => "Поле в БД",
          'filter_type'          => "Тип фильтра",
          'filter'               => "Список значений фильтра",
          'filter_flag'          => "Фильтровать?",
          'sort_flag'            => "Сортировать?",
          'orderlink'            => "Использовать для сортировки",
          'template'             => "Шаблон",
          'filter_query'         => "Фильтр",
          'filter_items'         => "Элементы для фильтра с выбором",
          'eval'                 => "Функция для eval",
          'escape'               => "Escape",
          'on_have_subcat'       => "Показывать для разделов",
          'visible'              => "Видимая",
          'parentid'             => "Родитель",
          'active'               => 'Активность',
        ];
    }

    /**
   	* Declares attribute hints.
   	*/
    public function attributeHints()
    {
    	return [
        'id'             => "",
        'orderid'        => "",
        'resourceid'     => "",
        'title'          => "",
        'width'          => "Ширина колонки в процентах или пикселях.<br/>Пример: <b>1%</b> или <b>50px</b>",
        'field'          => "Начните вводить имя поля или его наименование... и выберите поле из списка",
        'filter_type'    => "Построение выборки в GridView, исходя из устанавливаемых значений фильтров колонок.<br/>Пустой фильтр означает текстовое поле или выпадающий список (при заполнении массивом поля \"Список значений фильтра\").",
        'filter'         => "Возвращает список значений для фильтра (если необходимо) - обычно в виде массива.<br/>Пример:<br/>return [\"0\" => \"Inactive\", \"1\" => \"Active\"];",
        'filter_flag'    => "Показывать или нет блок фильтров для колонки",
        'sort_flag'      => "Показывать или нет ссылку сортировки для колонки",
        'orderlink'      => "",
        'template'       => "",
        'filter_query'   => "Условие для SQL. Пример: \"id=?\" или \"title LIKE ?\"",
        'filter_items'   => "Этот PHP код должен вернуть ассоцитиативный массив",
        'eval'           => "Возвращает значение в поле для каждой записи, исходя из выполнения условия.<br/>Пример (здесь {{id}} заменяется значением поля \"id\"):<br/>\$trans = new backend\\models\\Translates();<br/>return \$trans->getSourceTranslatedList('{{id}}', 'menu');",
        'escape'         => "Экранирует значение для вывода в скрипте представления",
        'on_have_subcat' => "Только для каталога.<br/>Если флажок установлен, то эта колонка будет показываться для всех разделов каталога.<br/>Если флажок снят, то колонка будет показываться только для \"листьев\" дерева каталога.",
        'visible'        => "Если не установлен флажок, то колонка не будет видна в списке, но останется в фильтрах",
        'parentid'       => "",
        'active'         => 'Отображать или нет колонку в GridView',
      ];
    }

    public function beforeSave($insert)
    {
      //if($insert) {
      	$this->filter = !empty($this->filter) ? $this->filter : "";
      	$this->filter_type = !empty($this->filter_type) ? $this->filter_type : "";
        $this->filter_query = !empty($this->filter_query) ? $this->filter_query : "";
        $this->template = !empty($this->template) ? $this->template : "";
        $this->eval = !empty($this->eval) ? $this->eval : "";
        $this->filter_items = !empty($this->filter_items) ? $this->filter_items : "";
        $this->width = !empty($this->width) ? $this->width : "";
      //} else {
        
      //}
      return AbstractModel::beforeSave($insert);
		}

}
