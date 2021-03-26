Feature:
  In order to borrow other materials and take it outside the library
  As a patron of the library
  I need to be able to borrow and use it in library

  Rule:
  - Accessories can be used only in library.
  - Patron can borrow only 1 accessory at the time.
  - When Patron have 1 other material overdue he is no longer allowed to borrow other materials.
  - Accessories like phone chargers, calculators must be returned 1 half hour before closing.
  - Mac VGA adapters may be borrowed for no longer than 4h.
  - Games may be checked out for 7 days.

  Scenario:
    Given There is an available calculator
    When Me as a graduate_student check out this accessory
    Then I see error says "You can borrow this item for in-library use only."
