<?php

namespace WPGMZA;

class ProPlugin extends Plugin
{
	public function __construct()
	{
		Plugin::__construct();
	}
	
	public function isProVersion()
	{
		return true;
	}
}
