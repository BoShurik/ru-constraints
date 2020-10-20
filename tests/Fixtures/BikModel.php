<?php
/**
 * User: boshurik
 * Date: 2019-03-28
 * Time: 16:41
 */

namespace BoShurik\Constraints\Ru\Tests\Fixtures;

class BikModel
{
    public $bik;

    public function __construct($bik = null)
    {
        $this->bik = $bik;
    }
}