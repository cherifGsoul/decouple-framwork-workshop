title: Decouple the business logic from the framework
author:
  name: Cherif BOUCHELAGHEM
  twitter: cherif_b
  github: cherifGsoul
output: index.html

--

# Decouple the business logic from the framework
## From Domain Modeling to framework integration

--

### What is decoupling?

- __It doesn't mean DON'T USE A FRAMEWORK__
- Write the software or part of it independently from the framework.
- The framework should be client to the decoupled code
- In other words, the decoupled code should be a dependency for the framework.

--

### Decoupling? Why?

- Have a better communication with stackholders
- Focus on the business problems instead of the technical problems
- Protect invariants
- Have a single source of truth
- Separate processes from side-effects
- Maintainability
- Testability
- Write scalable application
- Better management of trade-offs
- Delay technical decisions

--

### Decoupling? Why?

- Frameworks can only help us on technical parts
- Technical parts are generic
- Business logic is specific
- No body can give you answer about the business logic on Stackoverflow

--

### How to decouple?

Using some __GOOD__ practices like:

- Domain Modeling
- Clean architecture, Onion Architecture or Hexagonal architecture (Ports and adapters)
- Test Driven Developement
- Behavior (AKA Business) Driven Developement, "BDD", (if possible), __je parle pas de Base De Données__

--

### What should be decoupled?

- The business logic AKA 

--

### A typical software archictecture

Layered architecture

<center>
	<img src="img/layered.png" width="60%"/>
</center>

--

### Where a framework can help?

Framework intervention area

<center>
	<img src="img/framework-stuff.png" width="60%"/>
</center>

--

### What is the business logic?

Business logic is that portion of an enterprise system which determines how data is:
Transformed and/or calculated. 

For example, business logic determines how a tax total is calculated from invoice line items.

Routed to people or software systems, aka workflow.

`Source: http://wiki.c2.com/?BusinessLogicDefinition`
--

### When we should not do it?

- When the business domain is not clear
- When the software is not valuable (Trivial applications, prototypes, simple blogs ...etc)
- When the developer is not working on the core domain/subdomain part


--

### It is time consuming, right?
## Yes and No

- Yes, in the begining, we are not familiar with the approach yet.
- No for the long run, this approach helps to keep applications live longer over the years, no matter how the world changes (Except the programming language)

--

### Steps towards decoupling

- Decouple the namespace (App is not the business name)
- Domain Modeling (Modeling with code)
- Application Service (AKA Application APIs)
- Framework or Libraries integration
- Database integration
- Infrastructure services integration

--

### Talk is cheap show me the code

<center>
	<img src="img/linus-small.jpeg" />
</center>

--

### Our example

# A Todolist

--

### Project initialization

```shell
$ composer init
```

```shell
$ Package name (<vendor>/<name>) [cherif_b/todo]: cherif/todo
```

Keep press enter for the rest

--

### Decouple the namespace

```json
{
    "name": "cherif/todo",
    "authors": [
        {
            "name": "Cherif BOUCHELAGHEM",
            "email": "cherif.bouchelaghem@gmail.com"
        }
    ],
    "require": {},
    "autoload": {
        "psr-4": {
            "Todo\\": "src/Todo"
        }
    }
}
```

To autoload classes in the namespace, run:

```shell
$ composer dumpautoload
```

--
### Domain Modeling (Domain layer), to decouple the business logic

Idealy, it depends on the programming language only, sometimes, some implementations needs external libraries in order to not invent the wheel.

--

### Domain Modeling (Domain layer), to decouple the business logic

- __Value Objects__: is not just a thing in your domain, it measures,
quantifies, or describes something. They can be seen as small, simple objects such as money or a
date range - whose equality is not based on identity, but instead on the content held, value objects are immutable.

- __Entities__: Encapsulates business rules, The comparison between objects based on their identity, entities are stateful.
 
--

### Domain Modeling (Domain layer)
- __Repositories__: Object with collection like behavior to abstract away the persistence mechanism, repositories act as storage locations, where a retrieved object is returned in the exact same state it was persisted in - making them very easy to reason about.

- __Domain services__: Stateless objects, if a domain behavior/feature don't belong to an entity or a value object it could be a domain service.

--

### Domain Modeling (Domain layer), to decouple the business logic

``` A note on decoupling the database```

- Auto-increment entity IDs means there's a tight coupling with the persistence system.

- In short auto-increment IDs is a __NO__ __NO__.

- use UUID if there's no codification rule.

--

### Application Services, AKA Application APIs (Application layer)
Are the middleware between the outside world and the domain logic. 

The purpose of such a mechanism is to transform data from the outside world into meaningful
domain instructions.

Depends on the domain layer, persistence layer and/or infrastructure layer

--

### Frameworks or Libraries integration (Infrastructure layer)

- Bind/glue services and repositories with the help of Dependency injection container.

- In MVC structured application the Controller interacts with Application Services only.

- It receives the data in the desired format.

- For complicated data structure it can get the help from view-models or/and presenters.

--

### Database/Persistence integration (Infrastructure layer)

- Where the ORM specific metadata should be, like doctrine mapping files.

- Implements Repository interfaces, for PDO, doctrine, Capsule ... etc

--

### Infrastructure services integration (Infrastructure layer)

- Hold components responsible for technical stuff, hashing password, notifications, emailing ... etc

- Implements needed domain services which translate coming data to domain objects.

--

### Books

<center>
    <img src="img/ddd-blue.jpg" width="26%" />
    <img src="img/implemeting-ddd.jpeg" width="25%"/>
    <img src="img/domain_driven_design_in_php.png" width="26.5%"/>
    <img src="img/swdddf.jpg" width="26.5%"/>
    <img src="img/net-ddd.jpeg"/>
    <img src="img/ebook-domain-driven-design-2.jpg" width="24%"/>
    
</center>


### Summary

- The web/UI, is just a delivery mechanisme (PIPE).
- Database is just a detail.
- The framework is not the heart of your application.
- Software engineering is about handling trade-offs.