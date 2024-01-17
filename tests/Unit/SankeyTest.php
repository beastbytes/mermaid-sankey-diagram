<?php

use BeastBytes\Mermaid\SankeyDiagram\SankeyDiagram;

test('Sankey test', function () {
    $sankey = (new SankeyDiagram())
        ->withDataset(
            ['Electricity grid', 'Over generation / exports', 104.453],
            ['Electricity grid', 'Heating and cooling, "homes"', 113.726],
        )
        ->addDataset(
            ['Electricity grid', 'Heating and cooling, "commercial"', 70.672],
            ['Electricity grid', 'H2 conversion', 27.14],
        )
    ;

    expect($sankey->render())
        ->toBe("<pre class=\"mermaid\">\n"
            . "sankey-beta\n"
            . "  Electricity grid,Over generation / exports,104.453\n"
            . "  Electricity grid,&quot;Heating and cooling, &quot;&quot;homes&quot;&quot;&quot;,113.726\n"
            . "  Electricity grid,&quot;Heating and cooling, &quot;&quot;commercial&quot;&quot;&quot;,70.672\n"
            . "  Electricity grid,H2 conversion,27.14\n"
            . '</pre>'
    );
});
