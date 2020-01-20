<?php

class Container 
{
  private $configuration;
  private $pdo;

  public function __construct(array $configuration)
  {
    $this->configuration = $configuration;
  }
  public function getPDO() 
  {
    $pdo = new PDO(
      $this->configuration['db_dsn'],
      $this->configuration['db_user'],
      $this->configuration['db_pass']
  );
  return $pdo;
  }
}