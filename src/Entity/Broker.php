<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Entity;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Broker extends AbstractBasic
{

    private ?string $brokernumber = null;

    /**
     * @return string|null
     */
    public function getBrokernumber(): ?string
    {
        return $this->brokernumber;
    }

    /**
     * @param string|null $brokernumber
     */
    public function setBrokernumber(?string $brokernumber): void
    {
        $this->brokernumber = $brokernumber;
    }
}