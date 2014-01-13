<?php

class Tag extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'a_tag':
	 * @var integer $id
	 * @var string $name
	 * @var integer $frequency
	 */

	//Подключение класса для реализации функционала связи Многие ко Многим
	public function behaviors(){
    	return array('CAdvancedArBehavior'=> array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('frequency', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pages'=>array(self::MANY_MANY, 'Page', 'a_tag_page(tag_id, page_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'name' => Yii::t('label', 'Название'),
			'frequency' => Yii::t('label', 'Частота'),
		);
	}

	/**
	 * Возвращает ассоциативный массив тегов со значениями из частоты 
	 * Будут возвращены только наиболее часто используемые теги
	 * limit - максимальное количество возвращаемых тегов
	 * tags - ассоциативный массив с именами тегов к качестве индексов
	 */
	public function findTagWeights($limit=20)
	{
		//Получить наиболее часто используемые теги в сторону уменьшения частоты использования
		$models=$this->findAll(array(
			'order'=>'frequency DESC',
			'limit'=>$limit,
		));

		$total=0;
		foreach($models as $model)
			$total+=$model->frequency;

		$tags=array();
		if($total>0)
		{
			//Заумная магическая формула для вычисления частоты тегов в числовом выражении
			foreach($models as $model)
				$tags[$model->name]=8+(int)(16*$model->frequency/($total+10));
			ksort($tags);
		}
		return $tags;
	}

	/**
	 * Предлагает список существующих тегов соответствующие указанному ключевому слову.
	 * keyword - ключевое слово
	 * limit - максимальное количество возвращаемых тегов
	 * names - массив найденных тегов
	 */
	public function suggestTags($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'frequency DESC, Name',
			'limit'=>$limit,
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		foreach($tags as $tag)
			$names[]=$tag->name;
		return $names;
	}

	/**
	 * Функция конвертация строки с тегами в массив ("tag1, tag2, tag3" => array('0'=>'tag1', '1'=>'tag2', '2'=>'tag3'))
	 */
	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}

	/**
	 * Функция конвертация массива с тегами в строку (array('0'=>'tag1', '1'=>'tag2', '2'=>'tag3') => "tag1, tag2, tag3")
	 */
	public static function array2string($tags)
	{
		return implode(', ',$tags);
	}

	/**
	 * Процедура обновления "частоты" тегов 
	 * при изменении набора тегов определенной связанной записи
	 */
	public function updateFrequency($oldTags, $newTags)
	{
		$oldTags=self::string2array($oldTags);
		$newTags=self::string2array($newTags);
		//Добавить те теги, которых не было ранее
		$this->addTags(array_values(array_diff($newTags,$oldTags)));
		//Удалить те теги, которых были ранее, но в обновленной версии они отсутствуют
		$this->removeTags(array_values(array_diff($oldTags,$newTags)));
	}

	/**
	 * Процедура сохранения массива с тегами в таблицу тегов
	 */
	public function addTags($tags)
	{
		$criteria=new CDbCriteria;
		//Выбираем из таблицы только те строки, значение колонки 'name' которых совпадает с одним из значений множества $tags
		$criteria->addInCondition('name',$tags);
		//Увеличиваем счетчик "частоты" тех тегов, которые были переданы на вход процедуры
		$this->updateCounters(array('frequency'=>1),$criteria);
		foreach($tags as $name)
		{
			//Проверяет, существует ли текущий тег в таблице тегов, если он не был найден, то добавляем его
			if(!$this->exists('name=:name',array(':name'=>$name)))
			{
				$tag=new Tag;
				$tag->name=$name;
				$tag->frequency=1;
				$tag->save();
			}
		}
	}

	/**
	 * Процедура удаления массива с тегами из таблицы тегов
	 */
	public function removeTags($tags)
	{
		if(empty($tags))
			return;
		$criteria=new CDbCriteria;
		//Выбираем из таблицы только те строки, значение колонки 'name' которых совпадает с одним из значений множества $tags
		$criteria->addInCondition('name',$tags);
		//Уменьшаем счетчик "частоты" тех тегов, которые были переданы на вход процедуры
		$this->updateCounters(array('frequency'=>-1),$criteria);
		//Удаляем все теги из таблицы, "частота" которых стал либо равен нулю, либо меньше нуля
		$this->deleteAll('frequency<=0');
	}
}