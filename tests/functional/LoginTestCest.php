<?php


class LoginTestCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('customer/account/login/');
        $I->fillField(['id' => 'email'], 'mmularczyk9@gmail.com');
        $I->fillField(['id' => 'pass'], 'Admin123');
        $I->clickWithLeftButton('#send2');
        $I->waitForElement("//div[@class='panel header']//li[@class='greet welcome']//span[1][contains(text(),'Marek Mularczyk')]", 60);
        $I->seeElement("//div[@class='panel header']//li[@class='greet welcome']//span[1][contains(text(),'Marek Mularczyk')]");
    }
}
