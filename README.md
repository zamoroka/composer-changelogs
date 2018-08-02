# composer-changelogs

Provide information about package changes based on changelog files that are bundled with releases; 
introduces tools/commands for generating documentation files from changelog sources

## Configuration: overview

Environment variables can be defined as key value pairs in the project's composer.json

```json
{
  "extra": {
    "changelog": {
      "source": "changelog.json"
    }
  }
}
```

## Configuration: changelog format

The module expects certain conventions to be used when declaring new changelog records, which are based
on grouping the changes based on sematic versioning rules (+ provides some extra ones for even greater 
detail): breaking, feature, fix (extras: overview, maintenance). The extra keys are mostly meant for dumping
some data into the release notes about general theme of the new release or allowing some extra details to be 
added for the developers.

```json
{
    "1.0.0": {
        "overview": "Some general overarching description about this release",
        "breaking": [
            "code: Something changed in the sourcecode",
            "data: Something changed about the data format",
            "schema: Something changed about the database"
        ],
        "feature": [
            "short description about feature1",
            "short description about feature2"
        ],
        "fix": [
            "short description about fix1",
            "short description about fix2"
        ],
        "maintenance": [
            "short description about changing something about the architecture, etc"
        ]
    }
}
```

## Configuring generators

This example is based on making Sphinx documentation generation available

```json
{
  "extra": {
    "changelog": {
      "source": "changelog.json",
      "output": {
        "sphinx": "docs/changelog.rst"
      }
    }
  }
}
```
  
## Changelog 

_Changelog included in the composer.json of the package_
