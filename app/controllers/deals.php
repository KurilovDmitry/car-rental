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
        $data['customers'] = (new \models\customers())->getAllCustomers();
		
		View::rendertemplate('header', $data);
		View::render('deals/index', $data);
		View::rendertemplate('footer', $data);
	}

    public function add() {
        if ($_GET['preference']) {
            $preference = (new \models\preferences())->getPreference($_GET['preference']);

            $data['preference'] = $preference;
            $data['finishDate'] = date('Y-m-d',
                strtotime(
                    $preference['START_DATE']. ' + '
                    .$preference['RENT_DURATION'].' days'));
            $data['cars'] = (new \models\cars())->getNotRentedCars();
            $data['customers'] = (new \models\customers())->getAllCustomers();

            View::rendertemplate('header', $data);
            View::render('deals/add', $data);
            View::rendertemplate('footer', $data);
        }
        else {
            if ($_POST['preference']) {
                $deal = array(
                    'PROPERTIES' => $_POST['properties'],
                    'START_DATE' => $_POST['startDate'],
                    'FINISH_DATE' => $_POST['finishDate'],
                    'CAR_ID' => $_POST['car'],
                    'CUSTOMER_ID' => $_POST['customer'],
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
            'CUSTOMER_ID' => $_POST['customer']
        );

        (new \models\preferences())->addPreference($preference);
        header('Location: '.DIR.'deals');
    }
}
