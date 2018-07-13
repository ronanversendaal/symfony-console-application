# Symfony Console Application
Reads and writes entries to a CSV file.

## Installation
- Download or clone the project
- From within a terminal, navigate to the project directory
- Run `composer install`.


## Usage


### Reading
```
./console data:read
```
Read the CSV file and output its contents.


### Writing
```
./console data:write <name> <age> <location>
```
Takes arguments and writes these as an entry to the CSV file. If any of the arguments are not given, they will be asked for.

### Other 
Use `./console list` for a list of available commands. Add the `--help` flag to a command for additional info.