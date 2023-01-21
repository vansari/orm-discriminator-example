<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Tests;

use PHPUnit\Framework\TestCase;
use Vansari\OrmDiscriminatorExample\Entity\Customer;

class DiscriminatorTest extends TestCase
{

    public function testInsertMariaDb(): void
    {
        $cust = new Customer();
        $cust->setFirstname('Max');
        $cust->setSurname('Mustermann');
        $cust->setStatus('Ex-Customer');

        $em = \getMariaDbEntityManager();
        $em->persist($cust);
        $em->flush();

        $this->assertNotEmpty($cust->getId());
    }

    public function testInsertPostgres(): void
    {
        $cust = new Customer();
        $cust->setFirstname('Max');
        $cust->setSurname('Mustermann');
        $cust->setStatus('Ex-Customer');

        $em = \getPostgresEntityManager();
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