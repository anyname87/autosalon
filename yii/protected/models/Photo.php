<?php

/**
 * This is the model class for table "{{photo}}".
 *
 * The followings are the available columns in table '{{photo}}':
 * @property integer $id
 * @property integer $gallery_id
 * @property string $title
 * @property string $description
 * @property string $src
 * @property integer $is_visible
 */
class Photo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{photo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gallery_id', 'required'),
			array('gallery_id, is_visible', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			array('description', 'length', 'max'=>5000),
			array('src', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gallery_id, title, description, src, is_visible', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        try {
	        if(($this->scenario=='insert' || $this->scenario=='update') &&
	            ($picture=CUploadedFile::getInstance($this,'picture'))){
	        	$md5picture = md5($picture.microtime()).'.'.$picture->getExtensionName();
	        	$uploadPath=Yii::getPathOfAlias('webroot.assets.gallery').DIRECTORY_SEPARATOR.$this->gallery_id.DIRECTORY_SEPARATOR.$md5picture;
	        	$this->deleteFile(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.$this->src); // старый файл удалим, потому что загружаем новый
	            if(!$picture->saveAs($uploadPath))
			        	throw new Exception("Could not save the picture file!");
	            $this->src='/assets/gallery/'.$this->gallery_id.'/'.$md5picture;
	        }
	    } 
        catch (Exception $e) {
        	echo "При сохранении фотографии галлереи файл с картинкой не был сохранен";
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
			'gallery'=>array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gallery_id' => 'Галлерея',
			'title' => 'Название',
			'description' => 'Описание',
			'src' => 'Фотография',
			'is_visible' => 'Видимость',
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
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('src',$this->src,true);
		$criteria->compare('is_visible',$this->is_visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
