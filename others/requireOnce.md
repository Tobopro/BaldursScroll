pour la pagination
composer require knplabs/knp-paginator-bundle

pour les fixture
composer require --dev doctrine/doctrine-fixtures-bundle
pour creer une fixture
symfony console make:fixture

faker pour les ficture
composer require fzaninotto/faker
pour lancer la fixture (attention ça purge toute la bdd )
symfony console doctrine:fixtures:load
