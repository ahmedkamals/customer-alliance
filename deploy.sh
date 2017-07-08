#!/usr/bin/env bash

bin/console doctrine:database:create
bin/console doctrine:schema:update --dump-sql --force