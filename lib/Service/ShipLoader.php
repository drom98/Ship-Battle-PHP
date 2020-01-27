<?php

class ShipLoader {
  private $dbDsn;
  private $dbUser;
  private $dbPass;
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }
  
  public function getShips() {
    $shipsData = $this->queryForShips();
    $ships = array();

    foreach($shipsData as $shipData) {
      $ships[] = $this->createShipFromData($shipData);
    }
    return $ships;
  }

  public function findOneById($id) {
    $pdo = $this->getPDO();
    $stmt = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
    $stmt->execute(array('id' => $id));
    $shipArray = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$shipArray) {
      return null;
    }

    return $this->createShipFromData($shipArray);
  }

  private function createShipFromData(array $shipData) {
    if($shipData['team'] == 'rebel') {
      $ship = new RebelShip($shipData['name']);
    } else {
      $ship = new Ship($shipData['name']);
      $ship->setJediFactor($shipData['jedi_factor']);
    }

    $ship->setID($shipData['id']);
    $ship->setWeaponPower($shipData['weapon_power']);
    $ship->setStrength($shipData['strength']);

    return $ship;
  }

  private function queryForShips() {
    $pdo = $this->getPDO();
    $stmt = $pdo->prepare('SELECT * FROM ship');
    $stmt->execute();
    $shipsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $shipsArray;
  }

  /**
   * @return PDO
   */
  private function getPDO() {
    return $this->pdo;
  }
}