<?php namespace controllers;
use core\view;
use models;

class Deals extends \core\controller{

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
		
		View::rendertemplate('header', $data);
		View::render('deals/index', $data);
		View::rendertemplate('footer', $data);
	}

}
