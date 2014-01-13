<?php

/**
 * This is the model class for table "{{mark}}".
 *
 * The followings are the available columns in table '{{mark}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $small_img
 * @property string $full_img
 * @property integer $group_cars_id
 * @property integer $gallery_id
 * @property integer $priority
 * @property integer $is_visible
 */
class Mark extends CActiveRecord
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
		return '{{mark}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, priority', 'required'),
			array('group_cars_id, gallery_id, priority, is_visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'length', 'max'=>5000),
			array('small_img, full_img', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, small_img, full_img, group_cars_id, gallery_id, priority, is_visible', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        try {
        	if(($this->scenario=='insert' || $this->scenario=='update') &&
	            ($icon=CUploadedFile::getInstance($this,'icon'))){
	        	$md5icon = md5($icon.microtime()).'.'.$icon->getExtensionName();
	        	$uploadPath=Yii::getPathOfAlias('webroot.assets.marks.small').DIRECTORY_SEPARATOR.$md5icon;
	        	$this->deleteFile(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->small_img); // старый файл удалим, потому что загружаем новый
	            if(!$icon->saveAs($uploadPath)) 
	            	throw new Exception("Could not save the icon file!");
	            $this->small_img='/assets/marks/small/'.$md5icon;
        	}
        } 
        catch (Exception $e) {
        	echo "При сохранении марки авто файл с иконкой не был сохранен";
        }

        try {
	        if(($this->scenario=='insert' || $this->scenario=='update') &&
	            ($picture=CUploadedFile::getInstance($this,'picture'))){
	        	$md5picture = md5($picture.microtime()).'.'.$picture->getExtensionName();
	        	$uploadPath=Yii::getPathOfAlias('webroot.assets.marks').DIRECTORY_SEPARATOR.$md5picture;
	        	$this->deleteFile(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->full_img); // старый файл удалим, потому что загружаем новый
	            if(!$picture->saveAs($uploadPath))
	            	throw new Exception("Could not save the picture file!");
	            $this->full_img='/assets/marks/'.$md5picture;
	        }
	    } 
        catch (Exception $e) {
        	echo "При сохранении марки авто файл с картинкой не был сохранен";
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
			'markCount'=>array(self::STAT, 'Mark', 'id'),
			'model'=>array(self::HAS_MANY, 'AModel', 'group_id'),
			'modelCount'=>array(self::STAT, 'AModel', 'group_id'),
			'complect'=>array(self::HAS_MANY,'Complect',array('id'=>'model_id'),'through'=>'model'),
			'request'=>array(self::HAS_MANY, 'Request', 'mark_id'),
			'counters'=>array(self::MANY_MANY, 'Counter', 'a_counter_mark(mark_id, counter_id)', 'order'=>'counters.group_counter_id ASC'),
			'countersCount'=>array(self::STAT, 'Counter', 'a_counter_mark(mark_id, counter_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t('label', 'Название'),
			'description' => Yii::t('label', 'Описание'),
			'small_img' => Yii::t('label', 'Иконка'),
			'full_img' => Yii::t('label', 'Картинка'),
			'icon' => Yii::t('label', 'Иконка'),
			'picture' => Yii::t('label', 'Картинка'),
			'group_cars_id' => Yii::t('label', 'Группа авто'),
			'gallery_id' => Yii::t('label', 'Галлерея'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('small_img',$this->small_img,true);
		$criteria->compare('full_img',$this->full_img,true);
		$criteria->compare('group_cars_id',$this->group_cars_id);
		$criteria->compare('gallery_id',$this->gallery_id);
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
	 * @return Mark the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
