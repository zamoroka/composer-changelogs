# Changelog

This file has been auto-generated from the contents of changelog.json

## 0.12.0

### Feature

* allow specifying repository url with changelog:generate command argument --url to provide custom url in cases where no other source for resolving it is available

### Maintenance

* allow the commands that this plugin repository provides to be used on itself


## 0.11.0

### Feature

* add repository from version to version diff links when module has repository reference in composer.json or when one provided via call argument (with optional variable replacement options); Currently only features BitBucket support. See the topic 'Feature: repository links' for more information.
* add repository versioned source links when module has repository reference in composer.json or when one provided via call argument (with optional variable replacement options); Currently only features BitBucket support. See the topic 'Feature: release dates' for more information.
* add release date next to the version when repository present and there's a matching tag available for a changelog record.

### Fix

* no extra line before summary when release has no overview
* yml format error when using summary due to a colon within the value with no wrapping quotes
* corrupt yml format on full changelog generation where nesting level did not get correctly reset for every release but the first


## 0.10.1

### Fix

* the 'overview-reduced' not considered as something that is not a changes group type
* the value of overview-reduced not composed correctly: some words merged together without whitespace


## 0.10.0

### Feature

* --segments argument added for changelog:version to be able to query for the latest MAJOR version from changelog


## 0.9.4

### Fix

* slack format to use overview info a bit differently to avoid odd line wrapping: lines are merged, only totally new lines are respected and paragraph separators


## 0.9.3

### Fix

* formatting fixes to templates when used for full documentation generation (whitespace missing between certain titles in some cases)
* version wrapper for TXT changelog template


## 0.9.2

### Fix

* minor whitespace issues with Slack changelog release info templates; too many empty lines when overview not present


## 0.9.1

### Fix

* whitespace usage in certain formats (sphinx) caused generated documentation to be incorrect
* summary merged into overview, which made it impossible to properly format summarized version changelog output


## 0.9.0

### Feature

* new output format: slack (formatting markup for Slack)


## 0.8.0

### Feature

* new output format: txt (no formatting markup)

### Fix

* output format types could not be used with ':info' even when output file was not defined
* removed excess whitespace from changelog output (for both ':info' and ':generate')
* undefined array key crash when configuring custom templates for changelog output within the package that owns the changelog


## 0.7.0

### Feature

* added .md, .yml and .rst format options for info command
* sphinx template upgraded to take use of some it's more advanced features (overview decorated and made to stand out more)

### Fix

* the reason for changelog not being valid not shown when running in non-verbose mode, leaving the user wondering what went wrong (now lists all reasons)
* bug in html output template (list item tag never closed on changelog release listing level)


## 0.6.4

### Fix

* removed code that was incompatible with 5.3


## 0.6.3

### Fix

* composer run crashes when changelog plugin gets uninstalled while running (when defined under require-dev and running with --no-dev)


## 0.6.2

### Fix

* url-decoded branch names not dealt with correctly when provided as branch variables


## 0.6.1

### Fix

* treat 'master' and 'default' branches also match with changelog records that don't have branch specified (these branch names CAN still be used on changelog items)
* changelog:version --upcoming not taking --branch config into account


## 0.6.0

### Feature

* support for using changelog-based releases on multiple branches (--branch option added, version command now return version that either has no branch or matches branch)
* added 'upcoming' support for changelog:info command


## 0.5.2

### Fix

* avoid loud crash when changelog file has syntax errors; proper error handling and validation introduced instead


## 0.5.1

### Fix

* validation exited with wrong exit code on failure


## 0.5.0

### Feature

* added new command to validate the changelog's contents


## 0.4.0

### Feature

* format option added for version command
* upcoming version output added to version command

### Fix

* info command was missing one formatting option
* improved error management


## 0.3.1

### Fix

* brief changelog info mode added overview separator even when there was no overview set


## 0.3.0

### Feature

* new command added for acquiring information about specific release: changelog:info
* allow multi-line contents for 'overview'

### Fix

* template overrides not properly applied (over the ones that ship with the plugin)

### Maintenance

* output templating changed to be more granular to allow same templates to be used for both changelog:info output and for documentation generation


## 0.2.0

### Feature

* new command added for reporting latest valid version tag from changelog: changelog:version


## 0.1.2

### Fix

* wrong path resolved for root package (causing event handler to fail and no docs to be generated)
* generate command failure printed out whole exception rather than just it's message


## 0.1.1

### Fix

* fixed a typo in plugin's event observer name (changelog bot generated when package installed as root package)


## 0.1.0

### Feature

* allow Sphinx documentation file to be generated from changelog contents ('changelog:generate' command)
* generate changelog for root package on install/update