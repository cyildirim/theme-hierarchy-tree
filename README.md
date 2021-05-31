#Theme Hierarchy Tree for CLI

This module prints hierarchy tree for all themes installed in m2 instance.


## Install 
```shell
composer require --dev fetchtex/theme-hierarchy-tree 
bin/magento module:enable Fetchtex_ThemeHierarchyTree
bin/magento setup:upgrade
```


## Command

```shell
 bin/magento theme:tree
```

Sample output:

```shell
.
│
├── Magento/blank
│   ├── Magento/luma
│   └── Customer/fashion
│       ├── Custom/fashion_shoe
└── Magento/backend
```
