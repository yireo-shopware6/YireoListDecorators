# YireoListDecorators

**Shopware plugin to list all service decorators from a CLI `debug:decorators`**

In Symfony, decorators can be shown with the command `bin/console debug:container --tag container.decorator`.
However, this only dumps a list of all decorator class and does not show what they are actually decorating.
This Shopware plugin adds another command `debug:decorators` to list all decorator classes with their
corresponding original service. Plus a column to indicate whether the decorator implements the parent interface
(which would be nice) or extends the parent class (which could lead to potential bugs).

## Installation
```bash
composer require yireo/shopware6-list-decorators
bin/console plugins:refresh
bin/console plugins:install --activate YireoListDecorators
bin/console debug:decorators
```
