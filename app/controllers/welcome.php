<?php namespace controllers;
use core\view;
use models;

class Welcome extends \core\controller{

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
		$data['title'] = 'This is a title';
		$data['welcome_message'] = 'WEELOME BAAACK';
		
		View::rendertemplate('header', $data);
		View::render('welcome/welcome', $data);
		View::rendertemplate('footer', $data);
	}

	/**
	 * Define Subpage page title and load template files
	 */
	public function subpage() {
        $car = new \models\cars();
        $allCars = $car->getCars();

		$data['title'] = $allCars[0]->Model;
		$data['welcome_message'] = $allCars[0]->Cost;
		
		View::rendertemplate('header', $data);
		View::render('welcome/subpage', $data);
		View::rendertemplate('footer', $data);
	}
}
