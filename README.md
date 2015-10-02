libphlookupuserblurb
====================

This extension to [Phabricator](http://phabricator.org/) looks up commit users
in the blurb field of all user profiles which looks like #commit_user#, in order
to map them to phabricator users.
If multiples phabricator users use the same commit user (in blurb field),
then the first user found is used.

Disabled phabricator users are now ignored for the mapping.
So you can have multiples phabricator users that use the same commit user
if only one is active.


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
