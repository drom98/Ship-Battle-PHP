<?php

class BattleResult {

  private $usedJediPowers;
  private $winningShip;
  private $losingShip;

  public function __construct(bool $usedJediPowers, Ship $winningShip, Ship $losingShip)
  {
    $this->usedJediPowers = $usedJediPowers;
    $this->winningShip = $winningShip;
    $this->losingShip = $losingShip;
  }

  /** 
   * @return boolean
  */
  public function wereJediPowersUsed() {
    return $this->usedJediPowers;
  }

  /**
   * @return Ship
   */
  public function getWinningShip() {
    return $this->winningShip;
  }

  /**
   * @return Ship
   */
  public function getLosingShip() {
    return $this->losingShip;
  }

}