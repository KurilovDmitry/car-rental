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
//        $fineType = $_POST['fine-0'] == 1 ? 0 : ($_POST['fine-1'] == 1 ? 1 : ($_POST['fine-2'] == 1 ? 2 : 3));
        $fineType = $_POST['fineType'];
        $damageFineValue = $_POST['damageFineValue'];
        // 0 - no
        // 1 - warning
        // 2 - time
        // 3 - damage

        $dealsModel = new \models\deals();
        $deal = $dealsModel->getDeal($dealId)[0];
        $deal->RETURN_DATE = time();

        $carModel = new \models\cars();
        $car = $carModel->getCar($deal->CAR_ID)[0];
        $carCost = $car->COST;

        $returnDate = $deal->RETURN_DATE;
        $startDate = strtotime($deal->START_DATE);
        $finishDate = strtotime($deal->FINISH_DATE);
        $dealTime = $finishDate - $startDate;
        $fineTime = $returnDate - $finishDate;
        $finalCost = $dealTime * $carCost / 60 / 60 / 24;
        $fineCost = 0;
        if ($fineTime > 0) {
            if ($fineType > 2) {
                $fineCost += $damageFineValue;
            } elseif ($fineType > 1) {
                $fineCost += $fineTime * $carCost * 0.1 / 60 / 60 / 24;
            }
        }
        $finalCost += $fineCost;

        if ($fineType == 0) {
            $fineType = NULL;
        }

        $fineModel = new \models\fine();
        $fine = array('FINE_TYPE' => $fineType,
                        'FINE_COST' => $fineCost);
        $fineId = NULL;
        if ($fineType != NULL) {
            $fineId = $fineModel->addFine($fine);
        }

        $payment = array('DEAL_ID' => $dealId,
                            'FINE_ID' => $fineId,
                            'FINAL_COST' => $finalCost);

        $paymentModel = new \models\payment();
        $paymentModel->addPayment($payment);

        $dealsModel->updateDeal(
            $dealId,
            array(
            'RETURN_DATE'=> date('Y-m-d G:i:s', $deal->RETURN_DATE)));

        $data['totalPayment'] = $finalCost;   // including fine
        $data['fine'] = $fineCost;

        $data['title'] = 'Возврат автомобиля';

        View::rendertemplate('header', $data);
        View::render('deals/carReturned', $data);
        View::rendertemplate('footer', $data);
    }
}
