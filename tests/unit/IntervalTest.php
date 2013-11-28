<?php
namespace Gufy\Test;

use Gufy\DateInterval;
class IntervalTest extends \PHPUnit_Framework_TestCase
{
	public function testSeconds()
	{
		// interval is in seconds
		$interval = 915817;
		$class = new DateInterval($interval);
		$seconds = $class->getSeconds();
		$this->assertEquals($interval/1000, $seconds);

	}
	public function testMinutes()
	{
		$interval = 915817;
		$class = new DateInterval($interval);
		$minutes = $class->getMinutes();
		$this->assertEquals(($interval/1000)/60, $minutes);
	}
	public function testHours()
	{
		$interval = 915817;
		$class = new DateInterval($interval);
		$hours = $class->getHours();
		$this->assertEquals((($interval/1000)/60)/60, $hours);
	}
	public function testSecondsRound()
	{
		$interval = 915817;
		$class = new DateInterval($interval);
		$seconds = $class->getSeconds(PHP_ROUND_HALF_UP);
		$this->assertEquals(ceil($interval/1000), $seconds);

		$class = new DateInterval($interval);
		$seconds = $class->getSeconds(PHP_ROUND_HALF_DOWN);
		$this->assertEquals(floor(($interval/1000)), $seconds);
	}
	public function testMinutesRound()
	{
		$interval = 915817;
		$class = new DateInterval($interval);
		$seconds = $class->getMinutes(PHP_ROUND_HALF_UP);
		$this->assertEquals(ceil(($interval/1000)/60), $seconds);

		$class = new DateInterval($interval);
		$seconds = $class->getMinutes(PHP_ROUND_HALF_DOWN);
		$this->assertEquals(floor(($interval/1000)/60), $seconds);
	}
	public function testHoursRound()
	{
		$interval = 9360015817;
		$class = new DateInterval($interval);
		$seconds = $class->getHours(PHP_ROUND_HALF_UP);
		$this->assertEquals(ceil((($interval/1000)/60)/60), $seconds);

		$class = new DateInterval($interval);
		$seconds = $class->getHours(PHP_ROUND_HALF_DOWN);
		$this->assertEquals(floor((($interval/1000)/60)/60), $seconds);
	}

	public function testFormatting()
	{
		$interval = 14400;
		$class = new DateInterval($interval);
		$format = "{hours} hours {minutes} minutes {seconds} seconds";
		$actual = $class->format($format);
		$hours = floor($interval/(1000*60*60));
		$left = $interval%(1000*60*60);
		$minutes = floor($left/(1000*60));
		$left = $interval%(1000*60);
		$seconds = floor($left/(1000));
		$result = strtr($format, array(
			'{hours}'=>$hours,
			'{minutes}'=>$minutes,
			'{seconds}'=>$seconds,
		));
		$this->assertEquals($result, $actual);
	}

	public function testFormattingWithArrayOptions()
	{
		$interval = 14400;
		$class = new DateInterval($interval);
		$format = array(
			'template'=>'{hours} {minutes} {seconds}',
			'hours'=>'{hours} hours',
			'minutes'=>'{minutes} minutes',
			'seconds'=>'{seconds} seconds',
		);
		$actual = $class->format($format);
		$hours = floor($interval/(1000*60*60));
		$left = $interval%(1000*60*60);
		$minutes = floor($left/(1000*60));
		$left = $interval%(1000*60);
		$seconds = floor($left/(1000));
		$result = '4 hours';
		$this->assertEquals($result, $actual);
	}

	public function testIntervalUsingDate()
	{
		$firstDate = new \DateTime();
		$lastDate = new \DateTime('+4 hours');
		$interval = gmdate($lastDate->format('Y-m-d H:i:s'))-gmdate($firstDate->format('Y-m-d H:i:s'));
		$class = new DateInterval($firstDate, $lastDate);
		$format = "{hours} hours {minutes} minutes {seconds} seconds";
		$actual = $class->format($format);
		$hours = floor($interval/(1000*60*60));
		$left = $interval%(1000*60*60);
		$minutes = floor($left/(1000*60));
		$left = $interval%(1000*60);
		$seconds = floor($left/(1000));
		$result = strtr($format, array(
			'{hours}'=>$hours,
			'{minutes}'=>$minutes,
			'{seconds}'=>$seconds,
		));
		$this->assertEquals($result, $actual);
	}
}