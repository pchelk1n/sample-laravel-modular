#!/usr/bin/env bash

set -Eeuo pipefail

replace_env() {
    ./docker/bin/replace_env.bash "$@"
}

DOCKER_ENVIRONMENT_DIR="$(realpath ./docker/local/)"

COMPOSE_ENV_PATH="$(realpath ./.env)"
COMPOSE_DIST_ENV_PATH="$(realpath "${DOCKER_ENVIRONMENT_DIR}"/.env.dist)"

[ ! -f "${COMPOSE_ENV_PATH}" ] && cp "${COMPOSE_DIST_ENV_PATH}" "${COMPOSE_ENV_PATH}"

COMPOSE_FILE_PATH="$(realpath "${DOCKER_ENVIRONMENT_DIR}"/docker-compose.yml)"
replace_env "${COMPOSE_ENV_PATH}" 'COMPOSE_FILE' "${COMPOSE_FILE_PATH}"

replace_env "${COMPOSE_ENV_PATH}" 'USER_ID' "$(id -u)"
replace_env "${COMPOSE_ENV_PATH}" 'GROUP_ID' "$(id -g)"

replace_env "${COMPOSE_ENV_PATH}" 'NGINX_PORT' '8098'
replace_env "${COMPOSE_ENV_PATH}" 'PGSQL_PORT' '5438'

[ ! -f 'docker/local/pgsql/.env' ] && cp 'docker/local/pgsql/.env.dist' 'docker/local/pgsql/.env'

echo 'Envs set up!';
