<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Borrower;
use App\Entity\CopyBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');


        /* Authors */
        for ($i = 0; $i < 5; $i++) {
            $author = new Author();
            $author->setLastname($faker->lastName);
            $author->setFirstname($faker->firstName);
            $author->setAge($faker->numberBetween(18, 80));
            $manager->persist($author);

            $this->addReference('author' . $i, $author);
        }

        /* Books */
        for ($i = 0; $i < 5; $i++) {
            $author = $this->getReference('author' . $faker->numberBetween(0, 4));

            $book = new Book();
            $book->setReference($faker->randomNumber(6));
            $book->setName($faker->sentence(3));
            $book->setDescription($faker->paragraph(3));
            $book->setPublicationDate($faker->dateTime);
            $book->setAuthorId($author);
            $manager->persist($book);

            $this->addReference('book' . $i, $book);
        }

        /* CopyBooks */
        for ($i = 0; $i < 5; $i++) {
            $book = $this->getReference('book' . $faker->numberBetween(0, 4));

            $copybook = new CopyBook();
            $copybook->setCopybookNumber($faker->randomNumber(2));
            $copybook->setBookId($book);
            $manager->persist($copybook);

            $this->addReference('copybook' . $i, $copybook);
        }

        /* Borrowers */
        for ($i = 0; $i < 5; $i++) {
            $borrower = new Borrower();
            $borrower->setFirstname($faker->firstName);
            $borrower->setLastname($faker->lastName);
            $borrower->setEmail($faker->email);
            $borrower->setPhone($faker->phoneNumber);
            $borrower->setAddress($faker->address);
            $manager->persist($borrower);

            $this->addReference('borrower' . $i, $borrower);
        }

        /* Borrows */
        for ($i = 0; $i < 5; $i++) {
            $borrower = $this->getReference('borrower' . $faker->numberBetween(0, 4));
            $copybook = $this->getReference('copybook' . $faker->numberBetween(0, 4));

            $borrow = new Borrow();
            $borrow->setBorrowingDate($faker->dateTime());
            $borrow->setReturnDate($faker->dateTime());
            $borrow->setState($faker->boolean);
            $borrow->setBorrowerId($borrower);
            $borrow->setCopybookId($copybook);
            $manager->persist($borrow);
        }

        $manager->flush();
    }
}
