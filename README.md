# covid19-cli
Simple CLI tool for displaying COVID-19 statistics.

![Screenshot](https://i.imgur.com/q2x1GZZ.png)  

[![GitHub license](https://img.shields.io/github/license/ABGEO07/covid19-cli.svg)](https://github.com/ABGEO07/covid19-cli/blob/master/LICENSE)
[![GitHub release](https://img.shields.io/github/release/ABGEO07/covid19-cli.svg)](https://github.com/ABGEO07/covid19-cli/releases)
[![Packagist Version](https://img.shields.io/packagist/v/abgeo/covid19-cli.svg "Packagist Version")](https://packagist.org/packages/abgeo/covid19-cli "Packagist Version")

## Installation

You can install this library with [Composer](https://getcomposer.org/):

- `composer global require abgeo/covid19-cli`

## Usage

To use `covid` command, make sure you add` ~/composer/vendor/bin` to your `PATH` environment variable. 
See the below example. The line can be added to your `.bashrc` file.  
`export PATH="$HOME/.composer/vendor/bin:$PATH"`

Run `covid` command in your terminal for starting application or 
`covid help` for displaying all available commands.

## Example

### Display Statistics about COVID-19 in Georgia

`covid display georgia`

You can see all available country slugs by running `covid countries`


## Authors

* **Temuri Takalandze** - *Initial work* - [ABGEO](https://abgeo.dev)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
