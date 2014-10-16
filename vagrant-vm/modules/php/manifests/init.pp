# == Class: php
#
# Installs PHP5 and necessary modules. Sets config files.
#
class php {

  package { ['php5-common',
             'php5-cli',
             'libapache2-mod-php5',
             'php5-xdebug'
    ]:
    ensure => latest;
  }

  file {
    '/etc/php5/apache2':
      ensure => directory,
      before => File ['/etc/php5/apache2/php.ini'];

    '/etc/php5/apache2/php.ini':
       source => 'puppet:///modules/php/apache2-php.ini',
       require => Package['php5-common'],
       notify => Service['apache2'];

    '/etc/php5/cli':
       ensure => directory,
       before => File ['/etc/php5/cli/php.ini'];

    '/etc/php5/cli/php.ini':
      source => 'puppet:///modules/php/cli-php.ini',
      require => Package['php5-cli'];

  }
}