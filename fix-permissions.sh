#!/bin/bash

USER_ID=$(id -u)
GROUP_ID=$(id -g)

sudo chown -R $USER_ID:$GROUP_ID storage bootstrap/cache

chmod -R ug+rwX storage bootstrap/cache

