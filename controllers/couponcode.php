<?php
// TODO write test cases
class CouponCode extends Controller
{

	private $codeGenerator;
	const LENGHT = 10;
	const PREFIX = 'IA';
	const NOOFCODES = 250;

	function __construct()
	{
		parent::__construct();
		$this->codeGenerator = new CodeGenerator(self::LENGHT, self::PREFIX, self::NOOFCODES);
	}

	/**
	 * Generate Coupon Codes on load
	 *
	 * @return void
	 */
	function index()
	{
		$this->view->title = 'Generate Coupon Codes';
		$this->view->codes = $this->codeGenerator->getCodes();
		$this->writeToAFile('test2.txt',$this->view->codes);
		$this->view->render('couponcode/index');
	}

	/**
	 * Write array to a file
	 *
	 * @param string $file
	 * @param array $array
	 * @return void
	 */
	function writeToAFile(string $file,array $array)
	{
		return file_put_contents($file,  implode("\n",$array));
	}
}
