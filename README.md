# amazeeio-gdpr-dump

This is simply a thin layer over https://github.com/machbarmacher/gdpr-dump
It wraps and customizes the behaviour of its components to work well with the Amazeeio subsystem.
It also allows us to run ahead of the official development of the Drupal GDPR solutions.



#TODO

* Introduce support for missing option "defaults-extra-table"
* Introduce support for missing option "ignore-table"
* UPSTREAM: There is an issue with the fact that gdpr-dump relies on a function proposed in https://github.com/ifsnop/mysqldump-php/issues/136 that isn't going to happen, we need to work out another way of achieving the same functionality
