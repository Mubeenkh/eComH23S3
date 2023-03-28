Feature: google
  In order to find stuff on the web
  As a generic person on Google
  I need to be able to input text and get results

  Scenario: try google
  	GIVEN I am on Google
  	WHEN I input "dog" in "q"
  	AND I press "Search"
  	THEN I see "dog" 
