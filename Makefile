all: clean build run

clean:
	-@# nothing
build:
	-@# nothing
run:
	-@docker compose exec dev php src/Main.php
test:
	-@docker compose exec dev vendor/bin/pest
