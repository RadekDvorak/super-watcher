#!/usr/bin/env bash

SCRIPT=$(readlink -f "${0}")
SCRIPT_PATH=$(dirname "${SCRIPT}")
BOOTSTRAP="${SCRIPT_PATH}/../src/main/php/bootstrap.php"

/usr/bin/env php "$BOOTSTRAP" superman:notify -v
