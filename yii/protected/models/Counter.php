<?php

/**
 * This is the model class for table "{{counter}}".
 *
 * The followings are the available columns in table '{{counter}}':
 * @property integer $id
 * @property integer $group_counter_id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $url
 * @property string $login
 * @property string $password
 * @property integer $is_visible
 * @property string $create_date
 * @property string $modify_date
 */
class Counter extends CActiveRecord
{
	public function behaviors(){
    	return array('CAdvancedArBehavior'=> array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{counter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('group_counter_id, title, code', 'required'),
			array('id, group_counter_id, is_visible', 'numerical', 'integerOnly'=>true),
			array('title, login', 'length', 'max'=>50),
			array('description, code, url', 'length', 'max'=>1000),
			array('password', 'length', 'max'=>64),
			array('create_date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_counter_id, title, description, code, url, login, password, is_visible, create_date, modify_date', 'safe', 'on'=>'search'),
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
			'group'=>array(self::BELONGS_TO, 'GroupCounter', 'group_counter_id'),
			'marks'=>array(self::MANY_MANY, 'Mark', 'a_counter_mark(counter_id, mark_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_counter_id' => Yii::t('label', 'Группа счетчиков'),
			'title' => Yii::t('label', 'Название'),
			'description' => Yii::t('label', 'Описание'),
			'code' => Yii::t('label', 'Код'),
			'url' => Yii::t('label', 'URL-адрес'),
			'login' => Yii::t('label', 'Логин'),
			'password' => Yii::t('label', 'Пароль'),
			'is_visible' => Yii::t('label', 'Статус'),
			'create_date' => Yii::t('label', 'Дата создания'),
			'modify_date' => Yii::t('label', 'Дата изменения'),
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
		$criteria->compare('group_counter_id',$this->group_counter_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_visible',$this->is_visible);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Counter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
