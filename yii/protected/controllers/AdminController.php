<?php

class AdminController extends Controller
{
	public $layout='content_admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				'users'=>array('admin@google.com'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Отобразить страницу с описание возникшего исключения при выполнении action
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Отобразить индексную страницу
	 * Вывести список последних десяти онлайн-заявок и отзывов
	 */
	public function actionIndex()
	{
		$request= Request::model()->with('groupRequest')->findAll(array('order'=>'create_date DESC', 'limit'=>10));
		$group_request= CHtml::listData(GroupRequest::model()->findAll(), 'id', 'title');
		$this->render('index/index', array(
			'request'=>$request,'group_request'=>$group_request
		));
	}

	/**
	 * Отобразить страницу со список заявок
	 */
	public function actionRequest($id = null)
	{
		$group_request= CHtml::listData(GroupRequest::model()->findAll(), 'id', 'title');

		if(empty($id)){
			$request= Request::model()->with('groupRequest')->findAll(array('order'=>'create_date DESC'));
			$details= false;
		}else{
			$request=Request::model()->findByPk($id);
			$details= true;
		}
		$this->render('request/request', array(
			'request'=>$request,'group_request'=>$group_request, 'details'=>$details
		));
	}

	/**
	 * Отобразить страницу со списком марок авто
	 */
	public function actionMark()
	{
		// получаем список моделей марок авто + общее количество марок в таблице марок авто
		if($mark= Mark::model()->with('modelCount')->findAll()) {
		};
		// отрендерить вьюшку марок с переданным списком моделей
		$this->render('mark/mark', array(
			'mark'=>$mark
		));
	}

	/**
	 * Отобразить форму добавления модели Mark (марки авто) 
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Mark
	 */
	public function actionCreateMark()
	{
		// создаем модель "марки авто", получаем общее количество "марок"" в базе данных
		$mark=new Mark;
		$mark->markCount=Mark::model()->count();

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		
		// если был передан массив с атрибутами из формы создания/редактирования "марки авто",
		// то присваиваем атрибуты переданной формы атрибутам модели "марки авто"" и вызываем метод сохранения
		if(isset($_POST['Mark']))
		{
			$mark->attributes=$_POST['Mark'];
			if($mark->save())
				$this->redirect(array('mark'));
		}
		// отрендерить вьюшку формы создания/редактирования "марки авто" с переданной моделью марки
		$this->render('mark/createMark',array(
			'mark'=>$mark, 'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить форму изменения модели Mark (марки авто)
	 * с предустановленными атрибутами модели полученных из БД по id
	 * и сохранить обновленные атрибуты в базе данных посредством
	 * методов модели Mark
	 */
	public function actionUpdateMark($id)
	{
		$mark=Mark::model()->findByPk($id);

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');

		if(isset($_POST['Mark']))
		{
			$mark->attributes=$_POST['Mark'];
			if($mark->save())
				$this->redirect(array('mark'));
		}

		$this->render('mark/updateMark',array(
			'mark'=>$mark, 'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить страницу либо со всеми моделями 
	 * либо с моделями определенной марки
	 */
	public function actionModel($id = null)
	{
		if(!empty($id)){
			if($model= AModel::model()->with('mark')->findAll('group_id = "'.$id.'"')) {
			};
		}else{
			if($model= AModel::model()->with('mark')->findAll()) {
			};
		}
		
		$this->render('model/model', array(
			'model'=>$model,
			'group_id'=>$id,
		));
	}

	/**
	 * Отобразить форму добавления модели AModel (модель авто)
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели AModel
	 */
	public function actionCreateModel($id = null)
	{
		$model=new AModel;

		if(!empty($id))
		{
			$model->modelCount=AModel::model()->count('group_id = "'.$id.'"');
			$model->group_id=$id;
		}

		$mark= CHtml::listData(Mark::model()->findAll(), 'id', 'title');
		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');

		if(isset($_POST['AModel']))
		{
			$model->attributes=$_POST['AModel'];
			if($model->save())
				$this->redirect(array('model'));
		}

		$this->render('model/createModel',array(
			'model'=>$model,'mark'=>$mark, 'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить форму изменения модели Model (модели авто)
	 * с предустановленными атрибутами модели полученных из БД по id
	 * и сохранить обновленные атрибуты в базе данных посредством
	 * методов модели Model
	 */
	public function actionUpdateModel($id)
	{
		$model=AModel::model()->findByPk($id);

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');

		if(isset($_POST['AModel']))
		{
			$model->attributes=$_POST['AModel'];
			if($model->save())
				$this->redirect(array('model'));
		}

		$this->render('model/updateModel',array(
			'model'=>$model, 'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить страницу либо со всеми галлереями 
	 */
	public function actionGallery()
	{
		if($gallery= Gallery::model()->with('photoCount')->findAll()) {
		};
		
		$this->render('gallery/gallery', array(
			'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить форму добавления модели Gallery
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Gallery
	 */
	public function actionCreateGallery()
	{
		$gallery=new Gallery;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
			$gallery->attributes=$_POST['Gallery'];
			if($gallery->save())
				$this->redirect(array('gallery'));
		}

		$this->render('gallery/createGallery',array(
			'gallery'=>$gallery,
		));
	}

	/**
	 * Отобразить страницу с фотографиями определенной галлереи
	 */
	public function actionPhoto($id)
	{
		if(!empty($id)){
			if($photo= Photo::model()->with('gallery')->findAll('gallery_id = "'.$id.'"')) {	
			}
			$gallery_id=$id;
		}
		$this->render('photo/photo', array(
			'photo'=>$photo,
			'gallery_id'=>$gallery_id
		));
	}

	/**
	 * Отобразить форму добавления модели Photo
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Photo
	 */
	public function actionCreatePhoto($id)
	{
		$photo=new Photo;
		$photo->gallery_id=$id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photo']))
		{
			$photo->attributes=$_POST['Photo'];
			if($photo->save())
				$this->redirect(array('photo'));
		}

		$this->render('photo/createPhoto',array(
			'photo'=>$photo,
		));
	}

	/**
	 * Отобразить страницу со списком модификаций авто
	 */
	public function actionModify()
	{
		// получаем список модификаций авто
		if($modify= Modify::model()->findAll()) {
		};
		// отрендерить вьюшку модификаций с переданным списком моделей
		$this->render('modify/modify', array(
			'modify'=>$modify
		));
	}

	/**
	 * Отобразить форму добавления модели Modify (модификаций авто) 
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Modify
	 */
	public function actionCreateModify()
	{
		// создаем модель "модификации авто"
		$modify=new Modify;
		
		// если был передан массив с атрибутами из формы создания/редактирования "модификации авто",
		// то присваиваем атрибуты переданной формы атрибутам модели "модификации авто"" и вызываем метод сохранения
		if(isset($_POST['Modify']))
		{
			$modify->attributes=$_POST['Modify'];
			if($modify->save())
				$this->redirect(array('modify'));
		}
		// отрендерить вьюшку формы создания/редактирования "модификации авто" с переданной моделью модификации
		$this->render('modify/createModify',array(
			'modify'=>$modify
		));
	}

	/**
	 * Отобразить форму изменения модели Modify (модификации авто)
	 * с предустановленными атрибутами модели полученных из БД по id
	 * и сохранить обновленные атрибуты в базе данных посредством
	 * методов модели Modify
	 */
	public function actionUpdateModify($id)
	{
		$modify=Modify::model()->findByPk($id);

		if(isset($_POST['Modify']))
		{
			$modify->attributes=$_POST['Modify'];
			if($modify->save())
				$this->redirect(array('modify'));
		}

		$this->render('modify/updateModify',array(
			'modify'=>$modify
		));
	}

	/**
	 * Отобразить страницу со списком комплектации авто
	 */
	public function actionComplect()
	{
		// получаем список модификаций авто
		if($complect= Complect::model()->findAll()) {
		};
		// отрендерить вьюшку модификаций с переданным списком моделей
		$this->render('complect/complect', array(
			'complect'=>$complect
		));
	}

	/**
	 * Отобразить форму добавления модели Complect (комплектации авто) 
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Complect
	 */
	public function actionCreateComplect()
	{
		// создаем модель "комплектации авто"
		$complect=new Complect;
		
		$modify= CHtml::listData(Modify::model()->findAll(), 'id', 'title');
		$mark= Mark::model()->findAll();
		$model= array();
		foreach ($mark as $mkey => $m){
			if($m->modelCount > 0){
				$models = $m->model;
				foreach ($models as $modkey => $mod) {
					$model[$m->title][$mod->id]= $mod->title;
				}
				
			}
		}

		// если был передан массив с атрибутами из формы создания/редактирования "комплектации авто",
		// то присваиваем атрибуты переданной формы атрибутам модели "комплектации авто"" и вызываем метод сохранения
		if(isset($_POST['Complect']))
		{
			$complect->attributes=$_POST['Complect'];
			if($complect->save())
				$this->redirect(array('complect'));
		}
		// отрендерить вьюшку формы создания/редактирования "комплектации авто" с переданной моделью комплектации
		$this->render('complect/createComplect',array(
			'complect'=>$complect, 'modify'=>$modify, 'model'=>$model
		));
	}

	/**
	 * Отобразить форму изменения модели Complect (комплектации авто)
	 * с предустановленными атрибутами модели полученных из БД по id
	 * и сохранить обновленные атрибуты в базе данных посредством
	 * методов модели Complect
	 */
	public function actionUpdateComplect($id)
	{
		$complect=Complect::model()->findByPk($id);

		$modify= CHtml::listData(Modify::model()->findAll(), 'id', 'title');
		$mark= Mark::model()->findAll();
		$model= array();
		foreach ($mark as $mkey => $m){
			if($m->modelCount > 0){
				$models = $m->model;
				foreach ($models as $modkey => $mod) {
					$model[$m->title][$mod->id]= $mod->title;
				}
				
			}
		}

		if(isset($_POST['Complect']))
		{
			$complect->attributes=$_POST['Complect'];
			if($complect->save())
				$this->redirect(array('complect'));
		}

		$this->render('complect/updateComplect',array(
			'complect'=>$complect, 'modify'=>$modify, 'model'=>$model
		));
	}

	/**
	 * Отобразить страницу с настройками "Контактов"
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Отобразить страницу с формой аутентификации
	 */
	public function actionLogin()
	{
		
		
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Выйти из под пользователя и вернуться на главную страницу
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Реализация ajax-запроса связанных выпадающих списков в форме заполнения заявки.
	 * Выбираем в форме элемент (option) главного списка select (select) и отправляем значение (value) выбранного элемента
	 * По данному присланному значению мы выбираем данные из таблицы и распечатываем прямо в выходной поток элементы для дочернего списка
	 */
	public function actionAjaxGetCountModels() 
	{
		$mark_id= $_POST['id'];
		$model= new AModel();
		$model= $model->count('group_id = "'.$mark_id.'"');
		if((empty($model))||($model == 0)){
	        echo "1";
		}else{
			$model++;
	    	echo $model;
	    }
	}

	/**
	 * Реализация ajax-запроса при выборе статуса заявки.
	 * Выбираем на странице элемент списка статусов заявки и отправляем значение выбранного элемента 
	 * и id текущей обрабатываемой записи заявки.
	 * По данным присланным значениям мы проверяем их наличие в соответствующих таблицах  
	 * и присваиваем значение статуса в соответствующее поле обрабатываемой записи заявки
	 */
	public function actionAjaxSetStatusRequest() 
	{
		$request_id= $_POST['id'];
		$status= $_POST['status'];

		$request= new Request();
		$group_request= new GroupRequest();

		$request= $request->findByPk($request_id);
		$group_request= $group_request->findByPk($status);

		if((!empty($request))&&(!empty($group_request))){
			$request->group_request_id= $status;
			$request->save();
		}
	}
}
