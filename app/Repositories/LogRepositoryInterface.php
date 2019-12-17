<?php

namespace App\Repositories;

interface LogRepositoryInterface
{
    /**
     * Add log.
     *
     * @param  array  $data
     * @param  string $status
     * @return object
     */
    public function addLog(array $data, string $status = ''): boolean;

    /**
     * Gets log.
     *
     * @return array
     */
    public function getLogs(): array;
}