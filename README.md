# Symfony Constraints [![Build Status](https://travis-ci.com/BoShurik/symfony-constraints.svg?branch=master)](https://travis-ci.com/BoShurik/symfony-constraints)

Port of [php-data-validation](https://github.com/Kholenkov/php-data-validation)

- Bik
- Inn
- Kpp
- Ogrn
- Ogrnip
- Snils
- Ks
- Rs

## Symfony integration

```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true

    BoShurik\Constraints\Ru\BikValidator: ~
    BoShurik\Constraints\Ru\InnValidator: ~
    BoShurik\Constraints\Ru\KppValidator: ~
    BoShurik\Constraints\Ru\KsValidator: ~
    BoShurik\Constraints\Ru\OgrnipValidator: ~
    BoShurik\Constraints\Ru\OgrnValidator: ~
    BoShurik\Constraints\Ru\RsValidator: ~
    BoShurik\Constraints\Ru\SnilsValidator: ~
```

without `autoconfigure`:

```yaml
services:
    BoShurik\Constraints\Ru\BikValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\InnValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\KppValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\KsValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\OgrnipValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\OgrnValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\RsValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\Ru\SnilsValidator:
        tags: ['validator.constraint_validator']
```

