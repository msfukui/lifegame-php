all: clean build run

clean:
	-@# nothing
build:
	-@# nothing
run:
	-@docker compose exec dev php src/Main.php

format:
	-@docker compose exec dev vendor/bin/php-cs-fixer fix --dry-run --diff
test:
	-@docker compose exec dev vendor/bin/pest
