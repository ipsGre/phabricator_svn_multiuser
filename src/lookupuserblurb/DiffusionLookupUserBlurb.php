<?php
/**
 * Diffusion: Lookup User event listener for looking up a svn_user in blurb
 * field of all user profiles which looks like #svn_user#.
 *
 * Copyright 2015 Mickael Vanneufville (SOPRA STERIA group)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @group events
 */
final class DiffusionLookupUserBlurb extends PhabricatorEventListener {

  public function register() {
    // When your listener is installed, its register() method will be called.
    // You should listen() to any events you are interested in here.

    $this->listen(PhabricatorEventType::TYPE_DIFFUSION_LOOKUPUSER);
  }

  public function handleEvent(PhutilEvent $event) {
    // When an event you have called listen() for in your register() method
    // occurs, this method will be invoked. You should respond to the event.

    $userCommit = $event->getValue('query');

    $userProfiles = id(new PhabricatorUserProfile())->loadAllWhere(
      'blurb like %s',
      '%#'.$userCommit.'#%');

    if (count($userProfiles) >= 1) {
      foreach ($userProfiles as $userProfile) {
        $user = id(new PhabricatorUser())->loadOneWhere(
          'id = %s', $userProfile->getUserPHID());
        if ($user && !$user->getIsDisabled()) {
          $event->setValue('result', $user->getPHID());
          break;
        }
      }
    }
  }
}
