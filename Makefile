.PHONY: install reproducer

start:
	composer install
	symfony server:start -d --port 8000

stop:
	symfony server:stop

reproducer:
	rm -rf var/log/dev.log
	bin/console -n app:reproducer
