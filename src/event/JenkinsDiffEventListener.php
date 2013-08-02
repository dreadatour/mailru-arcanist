<?php


class JenkinsDiffEventListener extends PhutilEventListener {

  public function register() {
    $this->listen(ArcanistEventType::TYPE_DIFF_WASCREATED);
  }

  public function handleEvent(PhutilEvent $event) {
    $diff_id = $event->getValue('diffID');

    /* Need to send a get request to jenkins to trigger the job. We pass the
     * diff id to jenkins via its api.
     */
    $workflow = $event->getValue('workflow');
    $uri = $workflow->getConfigFromWhateverSourceAvailiable('jenkins.uri');
    $job = $workflow->getConfigFromWhateverSourceAvailiable('jenkins.job');
    $token = $workflow->getConfigFromWhateverSourceAvailiable('jenkins.token');

    if (!$uri || !$job || !$token) {
      return;
    }

    $cmd = "curl -s ".$uri."/job/".$job."/buildWithParameters\?DIFF_ID\=".$diff_id."\&token\=".$token;
    exec($cmd);
  }
}
