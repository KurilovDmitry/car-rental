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
		
		View::rendertemplate('header', $data);
		View::render('deals/index', $data);
		View::rendertemplate('footer', $data);
	}

}
