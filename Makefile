all: clean build run

clean:
	-@# nothing
build:
	-@# nothing
run:
	-@docker compose exec dev php src/Main.php
