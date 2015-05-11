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

        $data['car_models'] = (new \models\cmodels())->getModels();
        $data['car_properties'] = (new \models\cproperties())->getProperties();
        $data['customers'] = (new \models\customers())->getAllCustomers();
		
		View::rendertemplate('header', $data);
		View::render('deals/index', $data);
		View::rendertemplate('footer', $data);
	}

    public function addPreference() {
        $preference = array(
            'PROPERTIES' => $_POST['properties'],
            'START_DATE' => $_POST['startDate'],
            'RENT_DURATION' => $_POST['duration'],
            'CAR_ID' => $_POST['car']
        );

        (new \models\preferences())->addPreference($preference);
        header('Location: '.DIR.'deals');
    }
}
