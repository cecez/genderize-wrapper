# genderize-wrapper
Projeto/Pacote para informar se um nome é masculino/feminino/desconhecido.

```php

use Cecez\GenderizeWrapper\GenderizeWrapper;

GenderizeWrapper::getGender('Cezar'); // retorna GENDER_MALE, GENDER_FEMALE ou GENDER_UNKNOWN;

```

```shell
# rodando phpunit
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli /bin/bash

# dentro do contêiner
vendor/bin/phpunit
```

https://api.genderize.io/?name=cezar
