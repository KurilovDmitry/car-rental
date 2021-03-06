<?php namespace controllers;
use core\view;
use models;

class Cars extends \core\controller{

	/**
	 * Call the parent construct
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Define Index page title and load template files
	 */
	public function index() {
        $data['nav_page'] = 'cars';
		$data['title'] = 'Автомобили';

        $cars = new \models\cars();
        $data['all_cars'] = $cars->getAllCars();
        $data['popular_cars'] = $cars->getPopularCars();
        $data['rented_cars'] = $cars->getRentedCars();
        $data['not_rented_cars'] = $cars->getNotRentedCars();

        $data['car_properties'] = (new \models\cproperties())->getProperties();
        $data['car_models'] = (new \models\cmodels())->getModels();

		View::rendertemplate('header', $data);
		View::render('cars/index', $data);
		View::rendertemplate('footer', $data);
	}

    public function add() {
        $car = array(
            'PROPERTIES' => $_POST['properties'],
            'MODEL_ID' => $_POST['carModel'],
            'COST' => $_POST['cost'],
        );

        if (!$car['PROPERTIES']) { header('Location: '.DIR.'cars?error='.urlencode('Необходимо выбрать свойства')); return; }
        if (!$car['MODEL_ID']) { header('Location: '.DIR.'cars?error='.urlencode('Необходимо выбрать модель')); return; }
        if (!is_numeric($car['COST'])) { header('Location: '.DIR.'cars?error='.urlencode('Необходимо ввести стоимость')); return; }

        (new \models\cars())->addCar($car);
        header('Location: '.DIR.'cars');
    }
}
