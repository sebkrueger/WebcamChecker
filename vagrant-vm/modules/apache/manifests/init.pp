# == Class: apache
#
# Installs packages for Apache2, enables modules, and sets config files.
#
class apache {

  package { ['apache2']:
    ensure => present;
  }

  service { 'apache2':
    ensure => running,
    enable => true,    # Start always
    require => Package['apache2'],
  }

  apache::conf { ['apache2.conf']: }
  apache::enmode { ['expires.load', 'rewrite.load', 'autoindex.load', 'autoindex.conf']: }
  apache::dismode { ['userdir.load', 'userdir.conf',
                     'negotiation.load', 'negotiation.conf',
                     'setenvif.load', 'setenvif.conf',
                     'env.load']: }

  # Remove default index.html if created and remove it only when default index.html
  # NoOne need the default page ;)
  exec { 'remove-default-apache-index-page':
    command => "rm /var/www/index.html",
    path => ['/bin', '/usr/bin'],
    require => Package['apache2'],
    onlyif  => '[ "$(md5sum /var/www/index.html)" = "21dde95d9d269cbb2fa6560309dca40c  /var/www/index.html" ]';
  }

}