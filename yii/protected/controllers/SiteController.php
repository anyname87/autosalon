<?php

class SiteController extends Controller
{
	const ERROR_MARK_NOT_FOUND = 'Марка автомобиля не найдена.';
	const ERROR_MODEL_NOT_FOUND = 'Модель автомобиля не найдена.';
	const ERROR_MODIFY_NOT_FOUND = 'Модификация автомобиля не найдена.';
	const ERROR_COMPLECT_NOT_FOUND = 'Комплектация автомобиля не найдена.';
	const ERROR_SERVER_503 = 'Мы приносим свои извинения, но в данный момент у нас технические проблемы в работе сервера. Если в течении минуты проблема не будет устранена, попробуйте позже.';

	public $layout='content';

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
	 * This is the action to handle external exceptions.
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
	 * Во вьюшку передаются модели: Марки авто и Акции
	 */
	public function actionIndex()
	{
		$mark= Mark::model()->with(array(
			'model'=>array('condition'=>'model.full_img != ""')
			))->findAll('small_img != ""');
		$groupAction= GroupAction::model()->with('action')->find('for_table = "'.AModel::tableName().'"');
		if(!empty($groupAction->action))
			$action= $groupAction->action;
		$page= Page::model()->findAll(array(
											'condition'=>"group_page_id=:id AND is_visible IS TRUE", 
											'params'=>array(":id"=>3)));
		/**
		 * Обрабатываем исключения
		 */
		if(empty($mark)){
			throw new CHttpException(503,self::ERROR_SERVER_503);
		}
		$this->render('index', array(
			'mark'=>$mark,
			'action'=>$action,
			'page'=>$page
		));
	}

	/**
	 * Отобразить страницу каталога авто
	 * Во вьюшку передаются модели: Марки авто (+модели)
	 */
	public function actionCatalog()
	{
		$mark= Mark::model()->with('model')->findAll();

		/**
		 * Обрабатываем исключения
		 */
		if(empty($mark)) {
			throw new CHttpException(503,self::ERROR_SERVER_503);
		};
		$this->render('catalog', array(
			'mark'=>$mark
		));
	}

	/**
	 * Отобразить детальную страницу с автомобилем
	 * Во вьюшку передаются модели: Модели авто
	 */
	public function actionDetail($id)
	{
		$model= AModel::model()->with('mark')->findByPk($id);
		/**
		 * Обрабатываем исключения
		 */
		if(empty($model))
			throw new CHttpException(404, self::ERROR_MODEL_NOT_FOUND);
		$this->render('detail', array(
			'model'=>$model
		));
	}
	
	/**
	 * Отобразить страницу Online-кредита
	 * Во вьюшку передаются модели: Запроса, Марки авто, Модели авто, 
	 * Комплектации модели авто и Регионы регистрации
	 * Активирована AJAX-валидация
	 */
	public function actionRequest()
	{
		$request= new Request();

		$this->performAjaxValidation($request);

		/**
		 * Вывести список только тех марок, которые имеют модели с комплектациями.
		 * Другими словами, если, например, у марки Nisan хоть и есть 
		 * соответствующие модели "Qashqai 2" и "Nissan Х-Тrail", но у этих моделей нет
		 * соответствующие им комплектации, то такая марка не будет выведена в список онлайн-заявки
		 */
		$mark= CHtml::listData(Mark::model()->with(array(
												    'complect'=>array(
												        // записи нам не нужны
												        'select'=>false,
												        // но нужно выбрать модели у которых есть комплектации
												        'joinType'=>'INNER JOIN',
												        'condition'=>'complect.price>0',
												    ),
												))->findAll(), 'id', 'title');
		// если был передан массив с атрибутами из формы создания "заявки",
		// то присваиваем атрибуты переданной формы атрибутам модели "заявки" и вызываем метод сохранения
		if(isset($_POST['Request']))
		{
			$request->attributes=$_POST['Request'];
			if($request->save())
				$this->redirect(array('index'));
		}

		if(!empty($request->mark_id)){
			/**
			 * В данном запросе используюется тот же принцип, что и при выборе марок авто.
			 * Проверка на соответствие id марки авто не проводится по причине своей не критичности
			 */
			$model= CHtml::listData(AModel::model()->with(array(
															    'complect'=>array(
															        // записи нам не нужны
															        'select'=>false,
															        // но нужно выбрать модели у которых есть комплектации
															        'joinType'=>'INNER JOIN',
															        'condition'=>'complect.price>0',
															    ),
															))->findAll("group_id = '{$request->mark_id}'"), 'id', 'title');
			
		}

		$compl= array('empty'=>'Выберите комплектацию');
		if(!empty($request->model_id)){
			$complect= Complect::model()->with('modify')->findAll("model_id = '{$request->model_id}'");
			if(!empty($complect)){
		        foreach($complect as $ckey=>$c)
		        {
		        	$compl[CHtml::encode("{$c->modify->title} {$c->title} ({$c->price} руб.)")]= "{$c->modify->title} {$c->title} ({$c->price} руб.)";
		        }
	    	}
		}

		$city= CHtml::listData(City::model()->findAll(), 'id', 'title');

		/**
		 * Обрабатываем исключения
		 */
		if(empty($mark)||empty($city)){
			throw new CHttpException(503,self::ERROR_SERVER_503);
		}
		if(empty($model))
			$model= array('empty'=>'Выберите модель');

		$this->render('request', array(
			'request'=>$request,'mark'=>$mark, 'model'=>$model, 'city'=>$city, 'compl'=>$compl
		));
	}

	/**
	 * Displays the contact page
	 */
	public function actionContacts()
	{
		$page=new Page;
		$page= $page->findAll(array(
									'condition'=>"group_page_id=:group_page_id AND is_visible IS TRUE", 
									'params'=>array(":group_page_id"=>1)
							  ));
		
		$this->render('contacts',array('page'=>$page));
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionNews($id = null)
	{
		$criteria= new CDbCriteria();
		$criteria->condition= 'group_page_id=:group_page_id AND is_visible IS TRUE';
		$criteria->params= array(':group_page_id'=>2);
		
		$count= Page::model()->count($criteria);

		$pages= new CPagination($count);		

		$pages->pageSize= 5;
		$pages->applyLimit($criteria);

		$page= Page::model()->findAll($criteria);

		$this->render('news',array('page'=>$page, 'pages'=>$pages));
	}

	/**
	 * Displays the login page
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
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Реализация ajax-запроса связанных выпадающих списков в форме заполнения заявки.
	 * Выбираем в форме элемент (option) списка марки и отправляем значение (value) выбранного элемента
	 * По этому присланному значению мы выбираем данные из таблицы моделей, описание марки авто и картинка марки 
	 * и распечатываем прямо в выходной поток элементы для дочернего списка и детальной информации по заявке
	 */
	public function actionAjaxGetModels() 
	{
		$mark_id= htmlspecialchars($_POST['id']);

		$mark= Mark::model()->findByPk($mark_id);
		if(!empty($mark)){
			$mark_img= $mark->full_img;
			$mark_description= $mark->description;

			$model= CHtml::listData(AModel::model()->with(array(
															    'complect'=>array(
															        // записи нам не нужны
															        'select'=>false,
															        // но нужно выбрать модели у которых есть комплектации
															        'joinType'=>'INNER JOIN',
															        'condition'=>'complect.price>0',
															    ),
															))->findAll("group_id = '$mark_id'"), 'id', 'title');
			if(!empty($model)){
				echo CJSON::encode(array(
										'mark_img'=>$mark_img,
										'mark_description'=>$mark_description,
										'model'=>$model,
										));
			}else{
				throw new CException(self::ERROR_MODEL_NOT_FOUND);
			}
		}else{
			throw new CException(self::ERROR_MARK_NOT_FOUND);
		}
	}

	/**
	 * Реализация ajax-запроса связанных выпадающих списков в форме заполнения заявки.
	 * Выбираем в форме элемент (option) списка моделей и отправляем значение (value) выбранного элемента
	 * По этому присланному значению мы выбираем данные из таблицы комплектаций, картинку модели авто 
	 * и распечатываем прямо в выходной поток элементы для дочернего списка и детальной информации по заявке
	 */
	public function actionAjaxGetComplects() 
	{
		$model_id= htmlspecialchars($_POST['id']);
		$model= AModel::model()->findByPk($model_id, 'is_visible IS TRUE');
		if(!empty($model)){
			$model_img= empty($model->full_img) ? '' : $model->full_img;
			$compl= Complect::model()->with('modify')->findAll(array(
																	'condition'=>"t.model_id=:model_id AND t.is_visible IS TRUE", 
																	'params'=>array(":model_id"=>$model_id)));
			if(!empty($compl)){
		        foreach($compl as $ckey=>$c)
		        {
		        	$complect["{$c->price} руб."]= "{$c->modify->title} {$c->title} ({$c->price} руб.)";
		        }
				echo CJSON::encode(array('model_img'=>$model_img, 'complect'=>$complect));
			}else{
				throw new CException(self::ERROR_COMPLECT_NOT_FOUND);
			}
		}else{
			throw new CException(self::ERROR_MODEL_NOT_FOUND);
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mark $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
