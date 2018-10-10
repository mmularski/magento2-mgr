<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

   /**
    * Define custom actions here
    */

    public function waitForPageLoad($timeout = 30)
    {
        $this->waitForJS('return document.readyState == "complete"', $timeout);

        try {
            $this->waitForJS('return !!window.jQuery && window.jQuery.active == 0;', $timeout);
        } catch (\Exception $exception) {
            $this->wait($timeout);
        }

        $this->wait(1);
    }
}
