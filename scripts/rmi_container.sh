#!/bin/sh

docker ps -aq | xargs docker stop | xargs docker rm
docker image ls -aq | xargs docker rmi

