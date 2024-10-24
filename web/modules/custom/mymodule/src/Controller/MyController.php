<?php
namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a controller to display questions and answers.
 */
class MyController extends ControllerBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs a new MyController object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Displays a list of questions and answers.
   *
   * @return array
   *   A renderable array containing the questions and answers.
   */
  public function displayData() {
    // Fetch data from the custom table.
    $query = $this->database->select('mymodule_questions', 'q')
      ->fields('q', ['question', 'answer', 'created'])
      ->orderBy('created', 'DESC')
      ->execute();
    
    $results = $query->fetchAll();

    // Prepare the render array.
    $header = [
      $this->t('Question'),
      $this->t('Answer'),
      $this->t('Created'),
    ];

    $rows = [];
    foreach ($results as $row) {
      $rows[] = [
        'data' => [
          $row->question,
          $row->answer,
          \Drupal::service('date.formatter')->format($row->created, 'short'),
        ],
      ];
    }

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No data available.'),
    ];
  }
}
