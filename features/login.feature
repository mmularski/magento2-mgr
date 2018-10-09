Feature: Login to account
  Aby moc kupic produkty
  Jako Klient
  Chce zalogowac sie do panelu kleinckiego

  Scenario: Login to page
    Given I am in login page
    When I fill email with "mmularczyk9@gmail.com"
    And I fill password with "Admin123"
    And I click login
    Then I should see text "Marek Mularczyk"