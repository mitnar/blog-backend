<?php

namespace App\Contracts;

interface PostContract
{
    public function blockPost(int $id, string $comment);
}
