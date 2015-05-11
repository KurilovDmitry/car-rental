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
		
		View::rendertemplate('header', $data);
		View::render('cars/index', $data);
		View::rendertemplate('footer', $data);
	}

}
