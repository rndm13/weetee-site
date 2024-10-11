<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Category;

class HelpersTest extends TestCase
{
    public function test_diff_attach_detach(): void
    {
        $cur = [0, 1, 5, 3];
        $new = [0, 2, 5, 4];
        $expected = [[2, 4], [1, 3]];
        $got = diff_attach_detach($cur, $new);

        $this->assertEquals($got, $expected);
    }
}
