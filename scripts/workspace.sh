#!/bin/sh

cd `dirname $0`
. ../.env

docker-compose exec workspace bash

