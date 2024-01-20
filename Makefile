all: clean build run

clean:
	-@# nothing
build:
	-@# nothing
run:
	-@docker compose exec dev php src/Main.php

ci: analyze format test

analyze:
	-@docker compose exec dev vendor/bin/phpmd src text phpmd.xml
format:
	-@docker compose exec dev vendor/bin/php-cs-fixer fix --dry-run --diff
test:
	-@docker compose exec dev vendor/bin/pest

sample:
	-@docker compose exec dev php src/Sample.php
