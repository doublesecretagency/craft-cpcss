# Changelog

## 2.6.0 - 2022-12-15

### Changed
- The "Additional CSS" field is now powered by the [Code Editor](https://github.com/nystudio107/craft-code-editor) package. (thanks @khalwat)

## 2.5.0 - 2022-04-02

### Added
- Craft 4 compatibility.

## 2.4.0 - 2021-09-21

### Added
- Added `cacheBusting` config setting to enable/disable hash-based cache busting. 
- Now logs warnings if unable to generate a hash for cache busting.

### Changed
- Split up `sha1_file` in order to reduce risk of CP hanging while generating a hash.

## 2.3.1 - 2021-08-20

### Fixed
- Prevents Matrix fields from reloading CSS on each block. (thanks @bencroker)

## 2.3.0 - 2020-12-18

### Added
- Now allows for multiple, comma-separated file paths. (thanks @nickolasjadams)

## 2.2.1 - 2020-04-04

### Changed
- Made the viewing area larger. (thanks @SayChi)

## 2.2.0 - 2019-06-24

### Added
- File path now includes proper support for [environmental values](https://docs.craftcms.com/v3/config/environments.html).

## 2.1.0 - 2018-01-01

### Added
- Custom CSS now loads _after_ the default Craft CSS.

### Changed
- Refactored to make better use of Asset Bundles.
- Refactored to load custom CSS just before template loads.
- Updated sample CSS in README (no longer needs `!important`).

## 2.0.1 - 2017-12-30

### Changed
- Updated minimum required version of Craft.
- Now references `hasCpSettings` from PHP instead of Composer.
- Minor adjustment to sample CSS.

## 2.0.0 - 2017-11-29

### Added
- Craft 3 compatibility.

## 1.1.0 - 2015-11-28

### Added
- Craft 2.5 compatibility.

## 1.0.6 - 2014-12-20

### Changed
- Formatted `additionalCss` field using [CodeMirror](http://codemirror.net/).

## 1.0.5 - 2014-08-22

### Changed
- Removed useless error message.

## 1.0.4 - 2014-08-10

### Added
- Formatted `additionalCss` field to nicely display code snippets.

## 1.0.3 - 2014-08-07

### Changed
- Improved error messaging.

## 1.0.2 - 2014-07-15

### Added
- Added cache busting for file-based CSS.

## 1.0.1 - 2014-05-16

### Added
- Added ability to save CSS in a file.

## 1.0.0 - 2014-05-13

Initial release.
