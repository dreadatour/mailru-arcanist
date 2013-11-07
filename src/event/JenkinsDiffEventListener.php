<?php


class JenkinsDiffEventListener extends PhutilEventListener {

  public function register() {
    $this->listen(ArcanistEventType::TYPE_DIFF_WASCREATED);
  }

  public function handleEvent(PhutilEvent $event) {
    $diff_id = $event->getValue('diffID');

    $workflow = $event->getValue('workflow');
    $uri = $workflow->getConfigFromAnySource('jenkins.uri');
    $job = $workflow->getConfigFromAnySource('jenkins.job');
    $token = $workflow->getConfigFromAnySource('jenkins.token');

    if (!$uri || !$job || !$token) {
      return;
    }

    $cmd = "curl -s ".$uri."/job/".$job."/buildWithParameters\?DIFF_ID\=".$diff_id."\&token\=".$token;
    exec($cmd);
  }
}
