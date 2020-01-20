<?php

class ShipLoader {

  private $pdo;

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
    $ship = new Ship($shipData['name']);
    $ship->setID($shipData['id']);
    $ship->setWeaponPower($shipData['weapon_power']);
    $ship->setJediFactor($shipData['jedi_factor']);
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
    if($this->pdo === null) {
      $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $this->pdo = $pdo;
    }

    return $this->pdo;
  }
}