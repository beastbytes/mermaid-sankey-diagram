<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\SankeyDiagram;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;

class SankeyDiagram
{
    use CommentTrait;

    private const TYPE = 'sankey-beta';

    /** @psalm-param list<array{string, string, float}> $datasets */
    private array $datasets = [];

    /**
     * @psalm-param array{string, string, float} ...$dataset
     * @param array ...$dataset
     * @return $this
     */
    public function addDataset(array ...$dataset): self
    {
        $new = clone $this;
        $new->datasets = array_merge($new->datasets, $dataset);
        return $new;
    }

    /**
     * @psalm-param array{string, string, float} ...$dataset
     * @param array ...$dataset
     * @return $this
     */
    public function withDataset(array ...$dataset): self
    {
        $new = clone $this;
        $new->datasets = $dataset;
        return $new;
    }

    public function render(): string
    {
        $output = [];

        $this->renderComment('', $output);
        $output[] = self::TYPE;

        foreach ($this->datasets as $datatset) {
            $source = str_replace('"','""', $datatset[0]);
            $target = str_replace('"','""', $datatset[1]);

            $output[] = Mermaid::INDENTATION
                . (str_contains($source, ',') ? '"' . $source . '"' : $source) . ','
                . (str_contains($target, ',') ? '"' . $target . '"' : $target) . ','
                . (string)$datatset[2]
            ;
        }

        return Mermaid::render($output);
    }
}
