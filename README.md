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

    BoShurik\Constraints\BikValidator: ~
    BoShurik\Constraints\InnValidator: ~
    BoShurik\Constraints\KppValidator: ~
    BoShurik\Constraints\KsValidator: ~
    BoShurik\Constraints\OgrnipValidator: ~
    BoShurik\Constraints\OgrnValidator: ~
    BoShurik\Constraints\RsValidator: ~
    BoShurik\Constraints\SnilsValidator: ~
```

without `autoconfigure`:

```yaml
services:
    BoShurik\Constraints\BikValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\InnValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\KppValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\KsValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\OgrnipValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\OgrnValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\RsValidator:
        tags: ['validator.constraint_validator']
    BoShurik\Constraints\SnilsValidator:
        tags: ['validator.constraint_validator']
```

