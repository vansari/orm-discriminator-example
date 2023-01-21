<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Tests;

use PHPUnit\Framework\TestCase;
use Vansari\OrmDiscriminatorExample\Entity\Customer;

class DiscriminatorTest extends TestCase
{

    public function testInsert(): void
    {
        $cust = new Customer();
        $cust->setFirstname('Max');
        $cust->setSurname('Mustermann');
        $cust->setStatus('Ex-Customer');

        $em = \getEntityManager();
        $em->persist($cust);
        $em->flush();

        $this->assertNotEmpty($cust->getId());
    }

    public function testUpdate(): void
    {

    }

    public function testFetch(): void
    {

    }
}