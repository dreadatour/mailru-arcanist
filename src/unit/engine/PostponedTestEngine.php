<?php

/**
 * @group unitrun
 */
final class PostponedTestEngine extends ArcanistBaseUnitTestEngine {

  public function run() {
    $result = id(new ArcanistUnitTestResult())
      ->setName('Test Report')
      ->setResult(ArcanistUnitTestResult::RESULT_POSTPONED);
    return array($result);
  }

}
