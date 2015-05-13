<?php namespace controllers;
use core\view;
use models;

class Deals extends \core\controller {

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
        $data['nav_page'] = 'deals';
		$data['title'] = 'Заказы';

        $data['preferences'] = (new \models\preferences())->getPreferences();
        $data['deals'] = (new \models\deals())->getDeals();

        $data['car_properties'] = (new \models\cproperties())->getProperties();
        $data['car_models'] = (new \models\cmodels())->getModels();
        $data['customers'] = (new \models\customers())->getAllCustomers();
		
		View::rendertemplate('header', $data);
		View::render('deals/index', $data);
		View::rendertemplate('footer', $data);
	}

    public function add() {
        if ($_GET['preference']) {
            $data['title'] = 'Добавление сделки';

            $preference = (new \models\preferences())->getPreference($_GET['preference'])[0];

            $data['preference'] = $preference;
            $data['finishDate'] = date('Y-m-d',
                strtotime(
                    $preference->START_DATE. ' + '
                    .$preference->RENT_DURATION.' days'));
            $data['cars'] = (new \models\cars())->getNotRentedCars();
            $data['customers'] = (new \models\customers())->getAllCustomers();

            View::rendertemplate('header', $data);
            View::render('deals/add', $data);
            View::rendertemplate('footer', $data);
        }
        else {
            if ($_POST['preference']) {
                $deal = array(
                    'START_DATE' => $_POST['startDate'],
                    'FINISH_DATE' => $_POST['finishDate'],
                    'CAR_ID' => $_POST['car'],
                    'CLIENT_ID' => $_POST['customer'],
                    'PREFERENCE_ID' => $_POST['preference']
                );

                (new \models\deals())->addDeal($deal);
                header('Location: ' . DIR . 'deals');
            }
        }
    }

    public function addPreference() {
        $preference = array(
            'PROPERTIES' => $_POST['properties'],
            'START_DATE' => $_POST['startDate'],
            'RENT_DURATION' => $_POST['duration'],
            'CLIENT_ID' => $_POST['customer'],
            'MODELS' => $_POST['carModels']
        );

        (new \models\preferences())->addPreference($preference);
        header('Location: '.DIR.'deals');
    }

    public function returnCar() {
        $data['title'] = 'Возврат автомобиля';

        $dealId = $_GET['dealId'];     // id of deal
        $data['dealId'] = $dealId;

        View::rendertemplate('header', $data);
        View::render('deals/returnCar', $data);
        View::rendertemplate('footer', $data);
    }

    public function carReturned() {
        $dealId = $_POST['dealId'];     // id of deal
        $fineType = $_POST['fineType'];
        $damageFineValue = $_POST['damageFineValue'];
        // 0 - no
        // 1 - warning
        // 2 - time
        // 3 - damage

//        $dealsModel = new \models\deals();
//        $deal = $dealsModel->getDeal($dealId);
//
//        $now = time();
//        $startDate = strtotime($deal->START_DATE);
//        $finishDate = strtotime($deal->FINISH_DATE);
//        $dealTime = $finishDate - $startDate;
//        $fineTime = $now - $finishDate;
//        $paymentModel = new \models\payment();
//        $paymentModel->addPayment();
//
//        $dealsModel->updateDeal($deal);

        $data['totalPayment'] = 1000;   // including fine
        $data['fine'] = 100;

        $data['title'] = 'Возврат автомобиля';

        View::rendertemplate('header', $data);
        View::render('deals/carReturned', $data);
        View::rendertemplate('footer', $data);
    }
}
