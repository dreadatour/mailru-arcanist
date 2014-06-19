<?php

/**
 * Basic lint engine which just applies several linters based on the file types
 *
 * @group linter
 */
final class MailruLintEngine extends ArcanistLintEngine {

  public function buildLinters() {
    $linters = array();

    $paths = $this->getPaths();

    foreach ($paths as $key => $path) {
      if (!$this->pathExists($path)) {
        unset($paths[$key]);
      }
      if (preg_match('@.+\.min\.(js|css)$@', $path)) {
        // Skip minified files.
        unset($paths[$key]);
      }
    }

    $text_paths = preg_grep('/\.css$/', $paths);
    $linters[] = id(new ArcanistGeneratedLinter())->setPaths($text_paths);
    $linters[] = id(new ArcanistNoLintLinter())->setPaths($text_paths);
    $linters[] = id(new ArcanistTextLinter())->setPaths($text_paths);

    $linters[] = id(new ArcanistFilenameLinter())->setPaths($paths);

    $linters[] = id(new ArcanistFlake8Linter())
      ->setPaths(preg_grep('/\.py$/', $paths));

    // $linters[] = id(new ArcanistJSHintLinter())
    //   ->setPaths(preg_grep('/\.js$/', $paths));

    return $linters;
  }

}
