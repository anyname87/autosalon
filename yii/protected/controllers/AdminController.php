<?php

class AdminController extends Controller
{
	const ERROR_MARK_NOT_FOUND = 'Марка автомобиля не найдена.';
	const ERROR_MODEL_NOT_FOUND = 'Модель автомобиля не найдена.';
	const ERROR_MODIFY_NOT_FOUND = 'Модификация автомобиля не найдена.';
	const ERROR_COMPLECT_NOT_FOUND = 'Комплектация автомобиля не найдена.';
	const ERROR_GALLERY_NOT_FOUND = 'Галлерея автомобиля не найдена.';
	const ERROR_COUNTER_NOT_FOUND = 'Счетчик не найден.';
	const ERROR_SERVER_503 = 'Мы приносим свои извинения, но в данный момент у нас технические проблемы в работе сервера. Если в течении минуты проблема не будет устранена, попробуйте позже.';

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
			$request= Request::model()->findByPk($id);
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
		// получаем список моделей марок авто + общее количество моделей авто данной марки
		$mark= Mark::model()->with('modelCount')->findAll();

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
		//Если галлереи автомобиля не являются массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

		$counter= new Counter;
		$counters= CHtml::listData(Counter::model()->findAll(array('order'=>'group_counter_id ASC')), 'id', 'title', 'group.title');
		//Если счетчики не являются массивом, вызываем исключение
		if(!is_array($counters))
			throw new CHttpException(404, self::ERROR_COUNTER_NOT_FOUND);

		// если был передан массив с атрибутами из формы создания/редактирования "марки авто",
		// то присваиваем атрибуты переданной формы атрибутам модели "марки авто"" и вызываем метод сохранения
		if(isset($_POST['Mark']))
		{
			$mark->attributes=$_POST['Mark'];
			// если при создании марки был выбран связанный счетчик, то привязываем данный счетчик к модели марки

			if(isset($_POST['Counter']))
			{
				//TODO: Реализовать сохранение сразу нескольких счетчиков
				$counter->attributes=$_POST['Counter'];
				$mark->counters= $counter->id;
			}
			if($mark->save())
				$this->redirect(array('mark'));
		}
		// отрендерить вьюшку формы создания/редактирования "марки авто" с переданной моделью марки
		$this->render('mark/createMark',array(
			'mark'=>$mark, 'gallery'=>$gallery, 'counter'=>$counter, 'counters'=>$counters,
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
		//Получаем модель марки авто и связанный с ним счетчик
		if(!empty($id))
			$mark=Mark::model()->with('counters','countersCount')->findByPk($id);
		
		//Если марка автомобиля не найдена, вызываем исключение
		if(empty($mark))
			throw new CHttpException(404, self::ERROR_MARK_NOT_FOUND);

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		//Если галлереи автомобиля не является массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

		// если полученная модель марки авто имеет связанные счетчики
		if($mark->countersCount>0)
			$counter= $mark->counters;
		else
			$counter= new Counter;
		$counters= CHtml::listData(Counter::model()->findAll(array('order'=>'group_counter_id ASC')), 'id', 'title', 'group.title');
		
		//Если счетчики не являются массивом, вызываем исключение
		if(!is_array($counters))
			throw new CHttpException(404, self::ERROR_COUNTER_NOT_FOUND);

		if(isset($_POST['Mark']))
		{
			$mark->attributes=$_POST['Mark'];
			// если при изменении марки был выбран связанный счетчик, то привязываем данный счетчик к модели марки
			if(isset($_POST['Counter']))
			{
				$counter= new Counter;
				$counter->attributes=$_POST['Counter'];
				//TODO: Реализовать изменение сразу нескольких счетчиков
				//TODO: Проверить удаляются ли старые записи из связывающей таблицы (не удаляются, но counter_id счетчика становится равен 0)
				$mark->counters= $counter->id;
			}
			if($mark->save())
				$this->redirect(array('mark'));
		}

		$this->render('mark/updateMark',array(
			'mark'=>$mark, 'gallery'=>$gallery, 'counter'=>$counter, 'counters'=>$counters,
		));
	}

	/**
	 * Удаление марки автомобиля
	 */
	public function actionDeleteMark($id)
	{
		$mark= Mark::model()->findByPk($id);
		if($mark->delete())
			$this->redirect(array('mark'));
	}

	/**
	 * Отобразить страницу либо со всеми моделями 
	 * либо с моделями определенной марки
	 */
	public function actionModel($id = null)
	{
		if(!empty($id))
			$model= AModel::model()
			->with('mark','complectCount')
			->findAll(array(
							'condition'=>"group_id=:group_id", 
							'params'=>array(":group_id"=>$id)));
		else
			$model= AModel::model()->with('complectCount')->findAll();

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
			$model->modelCount=AModel::model()->count(array(
															'condition'=>"group_id=:group_id", 
															'params'=>array(":group_id"=>$id)));
			$model->group_id=$id;
		}

		$mark= CHtml::listData(Mark::model()->findAll(), 'id', 'title');
		//Если марки автомобилей не найдены, вызываем исключение
		if(empty($mark)||!is_array($mark))
			throw new CHttpException(404, self::ERROR_MARK_NOT_FOUND);

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		//Если галлереи автомобиля не является массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

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
		if(!empty($id))
			$model=AModel::model()->findByPk($id);
		//Если модель автомобиля не найдена, вызываем исключение
		if(empty($model))
			throw new CHttpException(404, self::ERROR_MODEL_NOT_FOUND);

		$mark= CHtml::listData(Mark::model()->findAll(), 'id', 'title');
		//Если марки автомобилей не найдены, вызываем исключение
		if(empty($mark)||!is_array($mark))
			throw new CHttpException(404, self::ERROR_MARK_NOT_FOUND);

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		//Если галлереи автомобиля не является массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

		if(isset($_POST['AModel']))
		{
			$model->attributes=$_POST['AModel'];
			if($model->save())
				$this->redirect(array('model'));
		}

		$this->render('model/updateModel',array(
			'model'=>$model,'mark'=>$mark, 'gallery'=>$gallery
		));
	}

	/**
	 * Удаление модели автомобиля
	 */
	public function actionDeleteModel($id)
	{
		$model= AModel::model()->findByPk($id);
		if($model->delete())
			$this->redirect(array('model'));
	}

	/**
	 * Отобразить страницу либо со всеми галлереями 
	 */
	public function actionGallery()
	{
		$gallery= Gallery::model()->with('mark','model','photoCount')->findAll();

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
	 * Отобразить форму изменения модели Gallery
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Gallery
	 */
	public function actionUpdateGallery($id)
	{
		$gallery=Gallery::model()->findByPk($id);
		
		if(isset($_POST['Gallery']))
		{
			$gallery->attributes=$_POST['Gallery'];
			if($gallery->save())
				$this->redirect(array('gallery'));
		}

		$this->render('gallery/updateGallery',array(
			'gallery'=>$gallery,
		));
	}

	/**
	 * Удаление галлереи автомобиля
	 */
	public function actionDeleteGallery($id)
	{
		$gallery= Gallery::model()->findByPk($id);
		if($gallery->delete())
			$this->redirect(array('gallery'));
	}

	/**
	 * Отобразить страницу с фотографиями определенной галлереи
	 */
	public function actionPhoto($id = null)
	{
		if(!empty($id)){
			$photo= Photo::model()->with('gallery')->findAll(array(
															'condition'=>"gallery_id=:gallery_id", 
															'params'=>array(":gallery_id"=>$id)));
			$gallery_id=$id;
		}else{
			$photo= Photo::model()->with('gallery')->findAll();
			$gallery_id= Null;
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
	public function actionCreatePhoto($id = null)
	{
		$photo=new Photo;
		//TODO: Реализовать возможность выбора галлереи, если ее id не был передан заранее
		if(isset($id))
			$photo->gallery_id=$id;

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		//Если галлереи автомобиля не являются массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

		if(isset($_POST['Photo']))
		{
			$photo->attributes=$_POST['Photo'];
			if($photo->save())
				$this->redirect(array('photo'));
		}

		$this->render('photo/createPhoto',array(
			'photo'=>$photo, 'gallery'=>$gallery
		));
	}

	/**
	 * Отобразить форму изменении модели Photo
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Photo
	 */
	public function actionUpdatePhoto($id = null)
	{
		$photo= Photo::model()->findByPk($id);;

		$gallery= CHtml::listData(Gallery::model()->findAll(), 'id', 'title');
		//Если галлереи автомобиля не являются массивом, вызываем исключение
		if(!is_array($gallery))
			throw new CHttpException(404, self::ERROR_GALLERY_NOT_FOUND);

		if(isset($_POST['Photo']))
		{
			$photo->attributes=$_POST['Photo'];
			if($photo->save())
				$this->redirect(array('photo'));
		}

		$this->render('photo/updatePhoto',array(
			'photo'=>$photo, 'gallery'=>$gallery
		));
	}

	/**
	 * Удаление фотографии галлереи
	 */
	public function actionDeletePhoto($id)
	{
		$photo= Photo::model()->findByPk($id);
		if($photo->delete())
			$this->redirect(array('photo'));
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
	 * Удаление модификации автомобиля
	 */
	public function actionDeleteModify($id)
	{
		$modify= Modify::model()->findByPk($id);
		if($modify->delete())
			$this->redirect(array('modify'));
	}

	/**
	 * Отобразить страницу со списком комплектации авто
	 */
	public function actionComplect($id = null, $model = null)
	{
		// получаем список комплектаций авто
		if(isset($id))
			$complect= Complect::model()->with('model', 'modify')->findAll(array(
																				'condition'=>"modify_id=:modify_id", 
																				'params'=>array(":modify_id"=>$id)));
		elseif(isset($model))
			$complect= Complect::model()->with('model', 'modify')->findAll(array(
																				'condition'=>"model_id=:model_id", 
																				'params'=>array(":model_id"=>$model)));
		else
			$complect= Complect::model()->with('model', 'modify')->findAll();

		// отрендерить вьюшку комплектаций с переданным списком моделей
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
	 * Удаление комплектации автомобиля
	 */
	public function actionDeleteComplect($id)
	{
		$complect= Complect::model()->findByPk($id);
		if($complect->delete())
			$this->redirect(array('complect'));
	}

	/**
	 * Отобразить страницу либо с заголовками всех страниц 
	 * либо с контентом определенной страницы
	 */
	public function actionPage($id = null)
	{
		if(!empty($id)){
			$page= Page::model()->with('groupPage', 'tags')->findAll(array(
																   'condition'=>"id=:id", 
																   'params'=>array(":id"=>$id)));
		}else{
			$page= Page::model()->with('groupPage', 'tags')->findAll();
		}
		
		$this->render('page/page', array(
			'page'=>$page,
		));
	}

	/**
	 * Отобразить форму добавления модели Page (модель контента страниц)
	 * и сохранить переданные атрибуты в базе данных посредством
	 * методов модели Page
	 */
	public function actionCreatePage($id = null)
	{
		$group_page= CHtml::listData(GroupPage::model()->findAll(), 'id', 'title');
		$tags= CHtml::listData(Tag::model()->findAll(), 'id', 'name');
		
		$page= new Page;
		$tag= new Tag;

		if(isset($_POST['Tag']))
		{
			$tag->attributes=$_POST['Tag'];
			$atags= $tag->string2array($tag->name);
			$tag->addTags($atags);
		}
		
		if(isset($_POST['Page']))
		{
			$page->attributes=$_POST['Page'];
			if(!empty($atags)) {
				$criteria=new CDbCriteria;
				//Выбираем из таблицы только те строки, значение колонки 'name' которых совпадает с одним из значений множества $tags
				$criteria->addInCondition('name',$atags);
				$page->tags=$tag->findAll($criteria);
			}
			if($page->save())
				$this->redirect(array('page'));
			
		}

		$this->render('page/createPage',array(
			'page'=>$page,
			'tag'=>$tag,
			'group_page'=>$group_page,
			'tags'=>$tags,
		));
	}

	/**
	 * Удаление страницы
	 */
	public function actionDeletePage($id)
	{
		$page= Page::model()->findByPk($id);
		if($page->delete())
			$this->redirect(array('page'));
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
		$model= $model->count(array(
									'condition'=>"group_id=:mark_id", 
									'params'=>array(":group_id"=>$mark_id)));
		
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

	/**
	 * Реализация загрузки изображения через ckeditor
	 * ВСКРЫТЬ, ЕСЛИ ВДРУГ, ЧТО СЛУЧИТСЯ!
	 */
	/*
	public function actionCkUpload()
    {
        //номер функции обратного вызова
        $callback = $_GET['CKEditorFuncNum'];
        $picture=CUploadedFile::getInstanceByName('upload');
	    $md5picture=md5($picture.microtime()).'.'.$picture->getExtensionName();
	    $uploadPath=Yii::getPathOfAlias('webroot.assets.page').DIRECTORY_SEPARATOR.$md5picture;
		if(!$picture->saveAs($uploadPath))
			$error = 'Could not save the picture file!';
		else 
			$error = '';
	    $http_path='/assets/page/'.$md5picture;
        echo "<script type=\"text/javascript\">
                 window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );
              </script>";
    }
    */
}
