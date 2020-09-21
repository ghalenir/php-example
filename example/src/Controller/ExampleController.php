<?php

namespace Drupal\example\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for example routes.
 */
class ExampleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build($tags) {

    // Build parameter for the function
    $tags_array = explode(",",$tags);
    $content_array = [];

    // Call the service function
    $result = \Drupal::service("example.json_parser")->rank_tagged_content($content_array,$tags_array);
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t(json_encode($result)),
    ];
    return $build;
  }

}
