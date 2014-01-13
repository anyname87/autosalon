<?php

/**
 * This is the model class for table "{{complect}}".
 *
 * The followings are the available columns in table '{{complect}}':
 * @property integer $id
 * @property integer $modify_id
 * @property integer $model_id
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property integer $priority
 * @property integer $is_visible
 */
class Complect extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{complect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modify_id, model_id, title', 'required'),
			array('modify_id, model_id, price, priority, is_visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, modify_id, model_id, title, description, price, priority, is_visible', 'safe', 'on'=>'search'),
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
			'modify'=>array(self::BELONGS_TO, 'Modify', 'modify_id'),
			'model'=>array(self::BELONGS_TO, 'AModel', 'model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'modify_id' => Yii::t('label', 'Модификация'),
			'model_id' => Yii::t('label', 'Модель'),
			'title' => Yii::t('label', 'Название'),
			'description' => Yii::t('label', 'Описание'),
			'price' => Yii::t('label', 'Стоимость'),
			'priority' => Yii::t('label', 'Приоритетность'),
			'is_visible' => Yii::t('label', 'Статус'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('modify_id',$this->modify_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('is_visible',$this->is_visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Complect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
