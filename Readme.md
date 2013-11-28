# Time Interval to Human Readable Time Interval PHP Class

| Build |
|:------|
| [![Build Status](https://travis-ci.org/mgufrone/date-interval.png?branch=master)](https://travis-ci.org/mgufrone/date-interval) |
To use this class you just simply add this class via composer

	{
		"require":{
			...
			"gufy/date-interval":"dev-master"
			...
		}
	}

# Usage

Let's have fun. Here is the sample code
	
	<?php
	// add this if you are using composer
	require 'vendor/autoload.php';

	$interval = 14400; // note that the interval is in miliseconds
	$class = new \Gufy\DateInterval($interval);

	// or you can manually set the interval using this
	$class->setInterval($interval);

	// get the seconds 
	$class->getSeconds();

	// if you want the output is in integer, you could use PHP_ROUND_HALF_UP or PHP_ROUND_HALF_DOWN constant while calling it

	$class->getSeconds(PHP_ROUND_HALF_DOWN); 

	// get the minutes
	$class->getMinutes();

	// get the hours 
	$class->getHours();

	// if you want format it just use this thing
	$format = "{hours} hours {minutes} minutes {seconds} seconds";
	$class->format($format);

	// above will print out every thing, even hours or minutes or seconds is zero (0).
	// if you want to ignore that, you can do this thing

	$format = array(
		'template'=>'{hours} {minutes} {seconds}',
		'{hours}'=>'{hours} hours',
		'{minutes}'=>'{minutes} minutes',
		'{seconds}'=>'{seconds} seconds'
	);

# Next Feature
	- Add date capability, currently only time that can cover by this class
	- Add more lexer on format

# Support
If you have something wrong or messy thing, you can report it by send an issue on this repo or email me at `mgufronefendi@gmail.com`. And contribution are welcome. First fork this repo and make it suitable with your need then send a pull request to this repo. 

Thanks
