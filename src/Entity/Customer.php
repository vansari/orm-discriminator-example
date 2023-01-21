<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Entity;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Customer extends AbstractBasic
{

    private ?string $phonenumber = null;

    /**
     * @return string|null
     */
    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    /**
     * @param string|null $phonenumber
     */
    public function setPhonenumber(?string $phonenumber): void
    {
        $this->phonenumber = $phonenumber;
    }
}