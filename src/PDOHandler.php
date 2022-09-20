<?php
namespace Nereare\Grimoire;

class PDOHandler extends \Monolog\Handler\AbstractProcessingHandler {

  private bool           $initialized = false;
  private string         $table;
  private \PDO           $db;
  private \PDOStatement  $stmt;

  public function __construct(\PDO $db, string $table, int|string|\Monolog\Level $level = \Monolog\Level::Debug, bool $bubble = true) {
    // Set \PDO database
    $this->db = $db;
    // Set table name for queries
    $this->table = $table;
    // Construct from parent
    parent::__construct($level, $bubble);
  }

  protected function write(\Monolog\LogRecord $record): void {
    // Initialize MySQL table and INSERT statement, if not already
    if ( !$this->initialized ) { $this->initialize(); }

    // Get context
    $context = $record->context;
    // Check if context includes user ID
    if ( isset( $context["user"] ) ) {
      $user = (int) $context["user"];
      unset( $context["user"] );
    } else {
      $user = null;
    }
    // Check if context includes IP
    if ( isset( $context["ip"] ) ) {
      $ip = $context["ip"];
      unset( $context["ip"] );
    } else {
      $ip = null;
    }
    // Check if context includes target
    if ( isset( $context["target"] ) ) {
      $target = $context["target"];
      unset( $context["target"] );
    } else {
      $target = null;
    }
    // Check if context includes action
    if ( isset( $context["action"] ) ) {
      $action = $context["action"];
      unset( $context["action"] );
    } else {
      $action = null;
    }

    // Execute saved \PDOStatement
    $this->stmt->execute(array(
      "channel"  => $record->channel,
      "level"    => $record->level->getName(),
      "message"  => $record->message,
      "user"     => $user,
      "target"   => $target,
      "action"   => $action,
      "ip"       => $ip,
      "context"  => json_encode($context)
    ));
  }

  private function initialize() {
    // Create table
    $this->db->exec(
      "CREATE TABLE IF NOT EXISTS " . $this->table . " (
        `id`       INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `channel`  VARCHAR(255) NOT NULL,
        `level`    VARCHAR(64) NOT NULL,
        `time`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `message`  LONGTEXT,
        `user`     INT UNSIGNED,
        `target`   VARCHAR(64),
        `action`   VARCHAR(64),
        `ip`       VARCHAR(64),
        `context`  JSON,
        PRIMARY KEY (`id`)
      )"
    );
    // Set \PDOStatement for later use
    $this->stmt = $this->db->prepare(
      "INSERT INTO " . $this->table . "
        (`channel`, `level`, `message`, `user`, `target`, `action`, `ip`, `context`)
        VALUES (
          :channel,
          :level,
          :message,
          :user,
          :target,
          :action,
          :ip,
          :context
        )"
    );
    // Save initialized state as true, from now on
    $this->initialized = true;
  }
}
