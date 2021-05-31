# Theme Hierarchy Tree for CLI

[![Latest Stable Version](https://poser.pugx.org/fetchtex/theme-hierarchy-tree/v)](//packagist.org/packages/fetchtex/theme-hierarchy-tree) [![Total Downloads](https://poser.pugx.org/fetchtex/theme-hierarchy-tree/downloads)](//packagist.org/packages/fetchtex/theme-hierarchy-tree) [![Latest Unstable Version](https://poser.pugx.org/fetchtex/theme-hierarchy-tree/v/unstable)](//packagist.org/packages/fetchtex/theme-hierarchy-tree) [![License](https://poser.pugx.org/fetchtex/theme-hierarchy-tree/license)](//packagist.org/packages/fetchtex/theme-hierarchy-tree)

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
