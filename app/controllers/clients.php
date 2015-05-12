<?php namespace controllers;
use core\view;
use models;

class Clients extends \core\controller{

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
        $data['nav_page'] = 'clients';
		$data['title'] = 'Клиенты';

        $customers = new \models\customers();
        $data['all_customers'] = $customers->getAllCustomers();
        $data['regular_customers'] = $customers->getRegularCustomers();
        $data['most_profitable_customers'] = $customers->getTheMostProfitableCustomers();
		
		View::rendertemplate('header', $data);
		View::render('clients/index', $data);
		View::rendertemplate('footer', $data);
	}

    public function add() {
        $customer = array(
            'FIRST_NAME' => $_POST['firstName'],
            'LAST_NAME' => $_POST['lastName'],
            'MIDDLE_NAME' => $_POST['middleName'],
            'PASSPORT' => $_POST['passport'],
            'PHONE_NUMBER' => $_POST['phoneNumber']
        );
        (new \models\customers())->addCustomer($customer);
        header('Location: '.DIR.'clients');
    }
}
