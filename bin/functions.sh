#!/usr/bin/env bash

CURRENT_BASH=$(ps -p $$ | awk '{ print $4}' | tail -n 1)
case "$CURRENT_BASH" in
	-zsh|zsh)
		CURRENT_DIR=$( cd "$( dirname $0 )" && pwd )
		;;
	bash)
		CURRENT_DIR=$( cd "$( dirname ${BASH_SOURCE[0]} )" && pwd )
		;;
	*)
		echo 1>&2
		echo -e "\033[0;31m\`${CURRENT_BASH}\` does not seems to be supported\033[0m" 1>&2
		echo 1>&2
		return 1
		;;
esac

unalias php 2> /dev/null > /dev/null || true
php() {
	docker exec -it pomm_issue_php sh -c "php $*"
}
export -f php

unalias composer 2> /dev/null > /dev/null || true
composer() {
	docker exec -it pomm_issue_composer sh -c "COMPOSER_MEMORY_LIMIT=-1 composer $*"
}
export -f composer

unalias pomm 2> /dev/null > /dev/null || true
pomm() {
	docker exec -it pomm_issue_php sh -c "./vendor/bin/pomm.php $*"
}
export -f pomm

unalias pgsql 2> /dev/null > /dev/null || true
pgsql() {
    source "${CURRENT_DIR}/postgres.env"
	docker exec -ti pomm_issue_postgres sh -c "psql -U ${POSTGRES_USER} -d ${POSTGRES_DB} $*"
}
export -f pgsql

unalias redis 2> /dev/null > /dev/null || true
redis() {
	docker exec -it pomm_issue_redis sh -c "redis-cli $*"
}
export -f redis
