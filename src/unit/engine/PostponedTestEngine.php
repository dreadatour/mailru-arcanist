<?php

/**
 * @group unitrun
 */
final class PostponedTestEngine extends ArcanistUnitTestEngine {

  public function run() {
    $result = id(new ArcanistUnitTestResult())
      ->setName('Test Report')
      ->setResult(ArcanistUnitTestResult::RESULT_POSTPONED);
    return array($result);
  }

}
