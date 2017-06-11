#!/bin/sh

sudo -u postgres dropuser bestlyrics
sudo -u postgres dropdb bestlyrics
sudo -u postgres psql -c "create user bestlyrics password 'bestlyrics' superuser;"
sudo -u postgres createdb -O bestlyrics bestlyrics
