Feature: Add a todo

In order to organize my todos
As a user 
I need to be able to add todos

Rules:
- Todo must have a name
- Todo must have an owner
- The current user who added the todo is the owner


--------------------------------

Feature: Mark a todo as done

In order to know which todos are done
As a todo owner 
I need to be able to mark todo as done

Rules:
- Todo must be open
- Todo can only be marked as done by its owner

---------------------------------
Feature: Reopen a todo

In order redo a todo
As a todo owner 
I need to be able to reopen a todo

Rules:
- Todo must be marked as done
- Todo can only be reopened by its owner

---------------------------------

Feature: Add a deadline to a todo

In order to remember when a todo should be shipped
As a todo owner 
I need to be able add a deadline to the todo

Rules:
- Todo deadline must be in the future
- Todo deadline can only be added by its owner

---------------------------------

Feature: Add a reminder to todo

In order to remember the todo deadline
As a todo owner 
I need to be able to add a reminder to a todo

Rules:
- Todo reminder must be in the future
- Todo reminder can only be added by its owner