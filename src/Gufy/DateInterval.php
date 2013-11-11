<?php
/**
* A simple class to convert timestamp interval to human readable interval
* @package Gufy
* @class DateInterval
* @author Mochamad Gufron
* @link mgufron.com
* @contact mgufronefendi@gmail.com
*/

namespace Gufy;

class DateInterval 
{
	/**
	* @var int $interval timestamp interval
	*/
	public $interval=0;
	/**
	* @var int $interval save interval when using format mode
	*/
	private $tempInterval=0;
	/**
	* @param int $interval timestamp interval
	* @param DateTime $interval the first date 
	* @param DateTime $last_date the last date so we can find the interval of the first and the last date 
	*/
	public function __construct($interval=0,\DateTime $last_date=null)
	{
		if($interval instanceof \DateTime)
		{
			$first_interval = strtotime($interval->format('Y-m-d H:i:s'));
			$last_interval = strtotime($interval->format('Y-m-d H:i:s'));
			$interval = $last_interval - $first_interval;
		}
		$this->interval = $interval;
	}

	/**
	* @param int $round_method rounding method after we reveal the readable interval. You can use PHP_ROUND_HALF_UP and PHP_ROUND_HALF_DOWN
	*/
	public function getSeconds($round_method=null)
	{
		$result = $this->interval/1000;
		return $this->round($result,$round_method);
	}
	/**
	* @param int $round_method rounding method after we reveal the readable interval. You can use PHP_ROUND_HALF_UP and PHP_ROUND_HALF_DOWN
	*/
	public function getMinutes($round_method=null)
	{
		$result = ($this->interval/1000)/60;
		return $this->round($result,$round_method);
	}
	/**
	* @param int $round_method rounding method after we reveal the readable interval. You can use PHP_ROUND_HALF_UP and PHP_ROUND_HALF_DOWN
	*/
	public function getHours($round_method=null)
	{
		$result = (($this->interval/1000)/60)/60;
		return $this->round($result,$round_method);
	}
	/**
	* @param string $format rounding method after we reveal the readable interval. You can use PHP_ROUND_HALF_UP and PHP_ROUND_HALF_DOWN
	*/
	public function format($format)
	{
		$this->tempInterval = $this->interval;
		$hours = $this->getHours(PHP_ROUND_HALF_DOWN);

		$this->interval = $this->tempInterval%(1000*60*60);
		$minutes = $this->getMinutes(PHP_ROUND_HALF_DOWN);

		$this->interval = $this->tempInterval%(1000*60);
		$seconds = $this->getSeconds(PHP_ROUND_HALF_DOWN);

		$this->interval = $this->tempInterval;
		$result = strtr($format, array(
			'{hours}'=>$hours,
			'{minutes}'=>$minutes,
			'{seconds}'=>$seconds,
		));
		return $result;
	}
	/**
	* @param int $round_method rounding method after we reveal the readable interval. You can use PHP_ROUND_HALF_UP and PHP_ROUND_HALF_DOWN
	*/
	private function round($result, $round_method=null)
	{
		if($round_method===PHP_ROUND_HALF_UP)
			$result = ceil($result);
		elseif($round_method===PHP_ROUND_HALF_DOWN)
			$result = floor($result);
		return $result;
	}
}