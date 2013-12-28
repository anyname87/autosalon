<?php

/**
 * This is the model class for table "{{request}}".
 *
 * The followings are the available columns in table '{{request}}':
 * @property integer $id
 * @property integer $group_request_id
 * @property string $title
 * @property string $name
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property string $age
 * @property string $phone
 * @property string $work_phone
 * @property string $home_phone
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property string $work_name
 * @property string $profit
 * @property string $experience
 * @property string $passport
 * @property string $driver_license
 * @property integer $is_kasko
 * @property string $type_auto
 * @property integer $mark_id
 * @property integer $model_id
 * @property string $compl
 * @property string $create_date
 * @property string $modify_date
 */
class Request extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, mark_id, model_id', 'required', 'message'=>'Неверно заполненные данные "{attribute}".'),
			array('group_request_id, country_id, city_id, is_kasko, mark_id, model_id', 'numerical', 'integerOnly'=>true),
			array('title, name, firstname, lastname, patronymic, work_name, profit', 'length', 'max'=>50),
			array('age, phone, work_phone, home_phone, experience, passport, driver_license, type_auto', 'length', 'max'=>20),
			array('address, compl', 'length', 'max'=>100),
			array('create_date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_request_id, title, name, firstname, lastname, patronymic, age, phone, work_phone, home_phone, country_id, city_id, address, work_name, profit, experience, passport, driver_license, is_kasko, type_auto, mark_id, model_id, compl, create_date, modify_date', 'safe', 'on'=>'search'),
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
			'groupRequest'=>array(self::BELONGS_TO, 'GroupRequest', 'group_request_id'),
			'mark'=>array(self::BELONGS_TO, 'Mark', 'mark_id'),
			'model'=>array(self::BELONGS_TO, 'AModel', 'model_id'),
			'country'=>array(self::BELONGS_TO, 'Country', 'country_id'),
			'city'=>array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID:',
			'group_request_id' => 'Статус заявки:',
			'title' => 'Заголовок:',
			'name' => 'ФИО:',
			'firstname' => 'Фамилия:',
			'lastname' => 'Имя:',
			'patronymic' => 'Отчество:',
			'age' => 'Возраст:',
			'phone' => 'Телефон:',
			'work_phone' => 'Рабочий телефон:',
			'home_phone' => 'Домашний телефон:',
			'country_id' => 'Страна:',
			'city_id' => 'Регион регистрации:',
			'address' => 'Адрес:',
			'work_name' => 'Место работы:',
			'profit' => 'Доход за прошлый месяц:',
			'experience' => 'Стаж работы:',
			'passport' => 'Номер паспорта:',
			'driver_license' => 'водительское удостоверение:',
			'is_kasko' => 'Заказать КАСКО:',
			'type_auto' => 'Тип авто:',
			'mark_id' => 'Марка:',
			'model_id' => 'Модель:',
			'compl' => 'Комплектация:',
			'create_date' => 'Дата создания:',
			'modify_date' => 'Дата модификации:',
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
		$criteria->compare('group_request_id',$this->group_request_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('work_phone',$this->work_phone,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('work_name',$this->work_name,true);
		$criteria->compare('profit',$this->profit,true);
		$criteria->compare('experience',$this->experience,true);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('driver_license',$this->driver_license,true);
		$criteria->compare('is_kasko',$this->is_kasko);
		$criteria->compare('type_auto',$this->type_auto,true);
		$criteria->compare('mark_id',$this->mark_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('compl',$this->compl,true);
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
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
