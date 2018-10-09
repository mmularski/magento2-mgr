Feature: Check Reorder Products
  Aby moc zamowic ponownie produkty
  Jako Klient
  Chce zalogowac sie do panelu kleinckiego, wejsc w zakladke "Reorder products" aby moc dodac produkty do koszyka

  Scenario: Check list of products
    Given I am in login page
    When I fill email with "mmularczyk9@gmail.com"
    And I fill password with "Admin123"
    And I click login
    And I am in reorder products page
    Then I do not see empty list message