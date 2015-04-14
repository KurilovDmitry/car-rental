<?php namespace controllers;
use core\view;

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
		$data['title'] = 'Subpage hey hey';
		$data['welcome_message'] = 'Welcome message on subpage';
		
		View::rendertemplate('header', $data);
		View::render('welcome/subpage', $data);
		View::rendertemplate('footer', $data);
	}
}
