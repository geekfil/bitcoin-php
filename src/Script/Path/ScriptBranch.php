<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Script\Path;

use BitWasp\Bitcoin\Script\ScriptInterface;

class ScriptBranch
{
    /**
     * @var ScriptInterface
     */
    private $fullScript;

    /**
     * @var array|\array[]
     */
    private $scriptSections;

    /**
     * @var array|\bool[]
     */
    private $branch;

    /**
     * ScriptBranch constructor.
     * @param ScriptInterface $fullScript
     * @param array $logicalPath
     * @param array $scriptSections
     */
    public function __construct(ScriptInterface $fullScript, array $logicalPath, array $scriptSections)
    {
        $this->fullScript = $fullScript;
        $this->branch = $logicalPath;
        $this->scriptSections = $scriptSections;
    }

    /**
     * @return array|\bool[]
     */
    public function getPath(): array
    {
        return $this->branch;
    }

    /**
     * @return array|\array[]
     */
    public function getScriptSections(): array
    {
        return $this->scriptSections;
    }

    /**
     * @return array
     */
    public function getOps(): array
    {
        $sequence = [];
        foreach ($this->getScriptSections() as $segment) {
            $sequence = array_merge($sequence, $segment);
        }
        return $sequence;
    }
}
