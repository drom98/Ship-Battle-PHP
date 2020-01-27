<?php

class Ship extends AbstractShip
{   
	private $jediFactor = 0;

	public function __construct($name)
	{
		parent::__construct($name);
		// randomly put this ship under repair
		$this->underRepair = mt_rand(1, 100) < 30;
	}
	
	/**
  * @return int
  */
  public function getJediFactor()
  {
    return $this->jediFactor;
	}
	
	/**
  * @param integer $jediFactor
  */
  public function setJediFactor($jediFactor)
  {
    $this->jediFactor = $jediFactor;
	}

	public function getType() 
	{
		return 'Empire';
	}
}
