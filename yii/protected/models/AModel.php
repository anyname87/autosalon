<?php

/**
 * This is the model class for table "{{model}}".
 *
 * The followings are the available columns in table '{{model}}':
 * @property integer $id
 * @property integer $group_id
 * @property integer $gallery_id
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property integer $priority
 * @property string $full_img
 * @property integer $is_index_page
 * @property integer $is_visible
 */
class AModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{model}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, title, priority', 'required'),
			array('group_id, gallery_id, price, priority, is_index_page, is_visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'length', 'max'=>5000),
			array('full_img', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, gallery_id, title, description, price, priority, full_img, is_index_page, is_visible', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        try {
	        if(($this->scenario=='insert' || $this->scenario=='update') &&
	            ($picture=CUploadedFile::getInstance($this,'picture'))){
	        	$md5picture = md5($picture.microtime()).'.'.$picture->getExtensionName();
	        	$uploadPath=Yii::getPathOfAlias('webroot.assets.auto.catalog').DIRECTORY_SEPARATOR.$this->group_id.DIRECTORY_SEPARATOR.$md5picture;
	        	$this->deleteFile(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->full_img); // старый файл удалим, потому что загружаем новый
		        if(!$picture->saveAs($uploadPath))
		        	throw new Exception("Could not save the picture file!");
	            $this->full_img='/assets/auto/catalog/'.$this->group_id.'/'.$md5picture;
	        }
	    } 
        catch (Exception $e) {
        	echo "При сохранении модели авто файл с картинкой не был сохранен";
        }
        return true;
    }

	public function deleteFile($uploadPath){
		try {
	        if(is_file($uploadPath)) {
	            if(!unlink($uploadPath)) 
	            	throw new Exception("Could not delete the file!");
	        }
	    } 
        catch (Exception $e) {
        	echo "При удалении файла произошла ошибка";
        }
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'modelCount'=>array(self::STAT, 'AModel', 'id'),
			'mark'=>array(self::BELONGS_TO, 'Mark', 'group_id'),
			'complect'=>array(self::HAS_MANY, 'Complect', 'model_id'),
			'complectCount'=>array(self::STAT, 'Complect', 'model_id'),
			'action' => array(self::HAS_ONE, 'Action', 'second_id'),
			'request'=>array(self::HAS_MANY, 'Request', 'model_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Марка',
			'gallery_id' => 'Галлерея',
			'title' => 'Название',
			'description' => 'Описание',
			'price' => 'Стоимость',
			'priority' => 'Вес',
			'full_img' => 'Картинка',
			'is_index_page' => 'На главной странице',
			'is_visible' => 'Статус',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('full_img',$this->full_img,true);
		$criteria->compare('is_index_page',$this->is_index_page);
		$criteria->compare('is_visible',$this->is_visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
