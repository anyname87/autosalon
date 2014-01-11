<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property integer $group_page_id
 * @property string $preview
 * @property string $title
 * @property string $text
 * @property integer $is_visible
 * @property string $create_date
 * @property string $modify_date
 */
class Page extends CActiveRecord
{

	//Подключение класса для реализации функционала связи Многие ко Многим
	public function behaviors(){
    	return array('CAdvancedArBehavior'=> array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,preview, text, group_page_id', 'required'),
			array('group_page_id, is_visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('create_date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_page_id, preview, title, text, is_visible, create_date, modify_date', 'safe', 'on'=>'search'),
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
			'groupPage'=>array(self::BELONGS_TO, 'GroupPage', 'group_page_id'),
			'tags'=>array(self::MANY_MANY, 'Tag', 'a_tag_page(page_id, tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_page_id' => 'Group Page',
			'title' => 'Title',
			'preview' => 'Preview',
			'text' => 'Text',
			'is_visible' => 'Is Visible',
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
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
		$criteria->compare('group_page_id',$this->group_page_id);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
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
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
