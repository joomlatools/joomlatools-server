#!/usr/bin/with-contenv bash

### default
if [[ ! -d $APP_DISK/default/log ]]; then
  mkdir -p $APP_DISK/default/log
fi