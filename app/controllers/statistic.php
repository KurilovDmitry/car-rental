<?php namespace controllers;
use core\view;
use models;

class Statistic extends \core\controller{

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
        $data['nav_page'] = 'statistic';
		$data['title'] = 'Статистика';

        $benefits = new \models\benefits();
        $date['total_revenue'] = $benefits->getTotalCash();
        $date['fine_quality'] = $benefits->testPunishmentSystem();
		
		View::rendertemplate('header', $data);
		View::render('statistic/index', $data);
		View::rendertemplate('footer', $data);
	}

}
