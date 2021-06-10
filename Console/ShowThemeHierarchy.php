<?php

declare(strict_types=1);

namespace Fetchtex\ThemeHierarchyTree\Console;

use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;
use Magento\Theme\Model\ResourceModel\Theme\CollectionFactory as ThemeCollectionFactory;
use Magento\Theme\Model\Theme;
use PBergman\Console\Helper\TreeHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowThemeHierarchy extends Command
{

    /**
     * @var ThemeCollection
     */
    private $collectionFactory;

    public function __construct(ThemeCollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('List all themes in hierarchy tree')
            ->setName('theme:tree');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var ThemeCollection $parentThemes
         */
        $parentThemes = $this->collectionFactory->create();
        $items = $parentThemes->getItemsByColumnValue('paren_id', null);

        $tree = new TreeHelper();

        /**
         * @var Theme $item
         */
        foreach ($items as $item) {
            $this->addNode($item, $tree);
        }

        $tree->end();
        $tree->printTree($output);
    }

    /**
     * @param Theme $item
     * @param TreeHelper $tree
     */
    private function addNode($item, &$tree)
    {
        $node = new TreeHelper();

        if ($tree->findNode($item->getCode())) {
            return;
        }

        if ($item->getParentTheme()) {
            $node->setTitle($item->getCode());
            $tree->findNode($item->getParentTheme()->getCode())[0]->addNode($node)->end();
        } else {
            $node->setTitle($item->getCode());
            $tree->addNode($node)->end();
        }

        /**
         * @var ThemeCollection $childThemes
         */
        $childThemes = $this->collectionFactory->create();
        $items = $childThemes->getItemsByColumnValue('parent_id', $item->getId());

        foreach ($items as $item) {
            $this->addNode($item, $tree);
        }
    }
}
