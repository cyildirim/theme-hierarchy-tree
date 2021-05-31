<?php

declare(strict_types=1);

namespace Fetchtex\ThemeHierarchyTree\Console;

use PBergman\Console\Helper\TreeHelper;
use Magento\Theme\Model\ResourceModel\Theme\Collection as ThemeCollection;
use Magento\Theme\Model\Theme;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowThemeHierarchy extends Command
{

    /**
     * @var ThemeCollection
     */
    private $collection;

    public function __construct(ThemeCollection $collection)
    {
        $this->collection = $collection;
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
        $items = $this->collection->getItems();
        $tree = new TreeHelper();

        /**
         * @var Theme $item
         */
        foreach ($items as $item) {
            $node = new TreeHelper();
            if ($item->getParentId()) {
                $node->setTitle($item->getCode());

                $tree->findNode($item->getParentTheme()->getCode())[0]
                    ->addNode($node)
                    ->end();
            } else {
                $node->setTitle($item->getCode());
                $tree->addNode($node)->end();
            }
        }

        $tree->end();
        $tree->printTree($output);
    }
}
