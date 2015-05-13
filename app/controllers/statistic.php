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
        $data['total_revenue'] = $benefits->getTotalCash()[0]->TOTAL;
        $data['fine_quality_1'] = $benefits->testPunishmentSystem()[0]->COUNT1;
        $data['fine_quality_2'] = $benefits->testPunishmentSystem()[0]->COUNT2;
		
		View::rendertemplate('header', $data);
		View::render('statistic/index', $data);
		View::rendertemplate('footer', $data);
	}

}
