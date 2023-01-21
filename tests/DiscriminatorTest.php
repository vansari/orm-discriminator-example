<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Tests;

use PHPUnit\Framework\TestCase;
use Vansari\OrmDiscriminatorExample\Entity\AbstractBasic;
use Vansari\OrmDiscriminatorExample\Entity\Broker;
use Vansari\OrmDiscriminatorExample\Entity\Customer;

class DiscriminatorTest extends TestCase
{

    public function testInsertMariaDbCustomer(): void
    {
        $customer = new Customer();
        $customer->setFirstname('Max');
        $customer->setSurname('Mustermann');
        $customer->setStatus(4);

        $em = \getMariaDbEntityManager();
        $em->beginTransaction();

        $em->persist($customer);
        $em->flush();
        $this->assertNotEmpty($customer->getId());
        $this->assertSame(0, $customer->getIsBroker());

        $em->rollback();
    }

    public function testInsertMariaDbBroker(): void
    {
        $broker = new Broker();
        $broker->setFirstname('Max');
        $broker->setSurname('Mustermann');
        $broker->setStatus(1);

        $em = \getMariaDbEntityManager();
        $em->beginTransaction();

        $em->persist($broker);
        $em->flush();
        $this->assertNotEmpty($broker->getId());
        $this->assertSame(0, $broker->getIsBroker());

        $em->rollback();
    }

    public function testInsertPostgresCustomer(): void
    {
        $customer = new Customer();
        $customer->setFirstname('Max');
        $customer->setSurname('Mustermann');
        $customer->setStatus(3);

        $em = \getPostgresEntityManager();
        $em->beginTransaction();

        $em->persist($customer);
        $em->flush();
        $this->assertNotEmpty($customer->getId());
        $this->assertSame(0, $customer->getIsBroker());

        $em->rollback();
    }

    public function testInsertPostgresBroker(): void
    {
        $broker = new Broker();
        $broker->setFirstname('Max');
        $broker->setSurname('Mustermann');
        $broker->setStatus(2);

        $em = \getPostgresEntityManager();
        $em->beginTransaction();

        $em->persist($broker);
        $em->flush();
        $this->assertNotEmpty($broker->getId());
        $this->assertSame(0, $broker->getIsBroker());

        $em->rollback();
    }

    public function testFetchPostgresCustomer(): void
    {
        $em = \getPostgresEntityManager();
        $conn = $em->getConnection();
        $conn->beginTransaction();
        $result = $conn->insert('public.main', ['status' => 3]);
        $this->assertSame(1, $result);
        $one = $conn->executeQuery('SELECT * FROM public.main')->fetchOne();
        $this->assertNotEmpty($one);

        $entity = $em->find(Broker::class, $one);
        $this->assertNull($entity);

        $entity = $em->find(Customer::class, $one);
        $this->assertInstanceOf(AbstractBasic::class, $entity);
        $this->assertInstanceOf(Customer::class, $entity);

        $conn->rollBack();
    }

    public function testFetchPostgresBroker(): void
    {
        $em = \getPostgresEntityManager();
        $conn = $em->getConnection();
        $conn->beginTransaction();

        $result = $conn->insert('public.main', ['status' => 2]);
        $this->assertSame(1, $result);
        $one = $conn->executeQuery('SELECT * FROM public.main')->fetchOne();
        $this->assertNotEmpty($one);

        $entity = $em->find(Customer::class, $one);
        $this->assertNull($entity);

        $entity = $em->find(Broker::class, $one);
        $this->assertInstanceOf(Broker::class, $entity);

        $conn->rollBack();
    }

    public function testFetchMariaDbCustomer(): void
    {
        $em = \getMariaDbEntityManager();
        $conn = $em->getConnection();
        $conn->beginTransaction();
        $result = $conn->insert('public.main', ['status' => 4]);
        $this->assertSame(1, $result);
        $one = $conn->executeQuery('SELECT * FROM public.main')->fetchOne();
        $this->assertNotEmpty($one);

        $entity = $em->find(Broker::class, $one);
        $this->assertNull($entity);

        $entity = $em->find(Customer::class, $one);
        $this->assertInstanceOf(AbstractBasic::class, $entity);
        $this->assertInstanceOf(Customer::class, $entity);

        $conn->rollBack();
    }

    public function testFetchMariaDbBroker(): void
    {
        $em = \getMariaDbEntityManager();
        $conn = $em->getConnection();
        $conn->beginTransaction();

        $result = $conn->insert('public.main', ['status' => 2]);
        $this->assertSame(1, $result);
        $one = $conn->executeQuery('SELECT * FROM public.main')->fetchOne();
        $this->assertNotEmpty($one);

        $entity = $em->find(Customer::class, $one);
        $this->assertNull($entity);

        $entity = $em->find(Broker::class, $one);
        $this->assertInstanceOf(Broker::class, $entity);

        $conn->rollBack();
    }
}