Feature:
  In order to borrow other materials and take it outside the library
  As a patron of the library
  I need to be able to borrow this material

  Rule:
  - Accessories can be used only in library.
  - Game can be checked out for max 7 days and the limit is 2. Overdue items limit is 1
  - When Patron have 1 other material overdue he is no longer allowed to borrow other materials.
  - Games may be checked out for 7 days.

    Scenario: Checking out material
      Given There is a game
      When Me as a graduate_student check out this material
      Then This material is borrowed by me
      And I got 7 days to return it

    Scenario: Checking out game with maximum borrow limit
      Given There is a game
      And I got 1 not overdue material
      When Me as a graduate_student check out this material
      Then This material is borrowed by me

    Scenario: Checking out game when borrowed games limit is exceeded
      Given There is a game
      And I got 2 not overdue material
      When Me as a graduate_student check out this material
      Then I see error says "Items limit has been reached. Please return some items first."

    Scenario: Checking out game when borrowed games limit is exceeded
      Given There is a game
      And I got 1 overdue material
      When Me as a graduate_student check out this material
      Then I see error says "Too many overdue items. Please return items and clear your dues first."

    Scenario: Checking out material for in-library use only
      Given There is an calculator
      When Me as a graduate_student check out this material
      Then I see error says "You can borrow this item for in-library use only."
