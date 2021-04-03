Feature:
  In order to use material in library
  As a patron of the library
  I need to be able to borrow this material for in-library use only

  Rule:
    - Accessories like calculators, mac VGA cables are only for in-library use only and can not be checked out.
    - Patron can borrow only 1 accessory at the time.
    - Accessories like phone chargers, calculators must be returned 1 half hour before closing.
    - Mac VGA adapters may be borrowed for no longer than 4h.

  Scenario: Only one calculator can be borrowed for in library use
    Given There is an calculator
    And I got 1 not overdue material
    When Me as a graduate_student borrow this material for in-library use
    Then I see error says "Items limit has been reached. Please return some items first."

  Scenario: Accessories must be returned half hour before closing
    Given There is an calculator
    And Library is closing at 17:00
    When Me as a graduate_student borrow this material for in-library use
    Then I must return that item at 16:30 the same day

  Scenario: Validate Mac VGA adapter can be borrowed for max 4 hours
    Given There is a Mac VGA adapter
    And The time is 10:00
    And Library is closing at 17:00
    When Me as a graduate_student borrow this material for in-library use
    Then I must return that item at 14:00 the same day

  Scenario: Validate Mac VGA adapter should be returned max half hour before end of business
    Given There is a Mac VGA adapter
    And The time is 15:00
    And Library is closing at 17:00
    When Me as a graduate_student borrow this material for in-library use
    Then I must return that item at 16:30 the same day
