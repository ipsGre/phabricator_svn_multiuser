libphlookupuserblurb
====================

This extension to [Phabricator](http://phabricator.org/) looks up svn_users in
the blurb field of all user profiles which looks like #svn_user#, in order to
map them to phabricator users.

Installation
------------

To install this library, simply copy this folder (libphlookupuserblurb)
alongside your phabricator installation:
   cd /path/to/install
   copy this folder (libphlookupuserblurb)

Then simply add the path to this library to your phabricator configuration:
   cd /path/to/install/phabricator
   ./bin/config set load-libraries '["libphlookupuserblurb/src"]'
   ./bin/config set events.listeners '["DiffusionLookupUserBlurb"]'
