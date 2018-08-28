<?php
declare(strict_types=1);

namespace Domain\Contracts\File;

interface ParsableContract
{
    /**
     * @param \SplFileObject $file
     */
    public function parse(\SplFileObject $file);
}
