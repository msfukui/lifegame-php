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

blinker:
	-@docker compose exec dev php src/Blinker.php
clock:
	-@docker compose exec dev php src/Clock.php
toad:
	-@docker compose exec dev php src/Toad.php
beacon:
	-@docker compose exec dev php src/Beacon.php
