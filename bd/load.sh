#!/bin/sh

SCRIPT=$(readlink -f "$0")
DIR=$(dirname "$SCRIPT")
psql -U bestlyrics bestlyrics < $DIR/datosBestlyrics.sql
