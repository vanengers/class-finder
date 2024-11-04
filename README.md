# class-finder
Find classes (with namespaces) within folders

## Installation

```
composer require vanengers/class-finder
``` 

## Usage

```
$finder = new ClassFinder();
$classes = $finder->getAllNameSpaces('/path/to/folder/to/search');
```

### How it works.
Find all PHP classes in folder and subfolders. It will return an array with the full namespace of the class.