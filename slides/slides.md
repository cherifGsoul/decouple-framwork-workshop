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

- Frameworks can only help us on those parts
- Those parts are generic
- Business logic is specific
- No body can give you answer about the business logic on Stackoverflow

--

### How to decouple?

Using some __GOOD__ practices like:

- Domain Modeling
- Clean architecture, Onion Architecture or Hexagonal architecture (Ports and adapters)
- Test Driven Developement
- Behavior (AKA Business) Driven Developement, "BDD", (if possible), je parle pas de Base De Données

--

### What should be decoupled?

- The business logic

--

### What is the business logic?
## Wikipedia is totaly wrong

--

### When we should not do it?

- When the business domain is not clear
- When the software is not valuable (simple blogs ...etc)
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


### Domain Modeling (Domain layer)
- __Value Objects__: is not just a thing in your domain, it measures,
quantifies, or describes something. They can be seen as small, simple objects such as money or a
date range - whose equality is not based on identity, but instead on the content held, value objects are immutable.
- __Entities__: The comparison between objects based on their identity, entities are stateful
- __Repositories__: Object with collection like behavior to abstract away the persistence mechanism.
- __Domain services__: Stateless objects, if a domain behavior/feature don't belong to an entity or a value object it could be a domain service.

--

### Application Services, AKA Application APIs (Application layer)
Are the middleware between the outside world and the domain logic. The
purpose of such a mechanism is to transform data from the outside world into meaningful
domain instructions.
--

### Frameworks or Libraries integration (Infrastructure layer)

--

### Database/Persistence integration (Infrastructure layer)

--

### Infrastructure services integration (Infrastructure layer)

--
