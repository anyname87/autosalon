<?php

/**
 * This is the model class for table "{{configure}}".
 *
 * The followings are the available columns in table '{{configure}}':
 * @property integer $id
 * @property string $theme
 * @property string $language
 * @property string $time_zone
 * @property integer $row_count
 * @property string $yandex
 * @property string $google
 * @property string $liveinternet
 */
class Configure extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{configure}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('row_count', 'numerical', 'integerOnly'=>true),
			array('theme, language', 'length', 'max'=>50),
			array('time_zone', 'length', 'max'=>10),
			array('yandex, google, liveinternet, yandex_map', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, theme, language, time_zone, row_count, yandex, google, liveinternet, yandex_map', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'theme' => 'Theme',
			'language' => 'Language',
			'time_zone' => 'Time Zone',
			'row_count' => 'Row Count',
			'yandex' => 'Yandex',
			'google' => 'Google',
			'liveinternet' => 'LiveInternet',
			'yandex_map' => 'Yandex-map',
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
		$criteria->compare('theme',$this->theme,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('time_zone',$this->time_zone,true);
		$criteria->compare('row_count',$this->row_count);
		$criteria->compare('yandex',$this->yandex,true);
		$criteria->compare('google',$this->google,true);
		$criteria->compare('liveinternet',$this->liveinternet,true);
		$criteria->compare('yandex_map',$this->yandex_map,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Configure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
