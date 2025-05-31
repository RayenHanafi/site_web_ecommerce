<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 5 book entities
        $books = [
            [
                'title' => 'a Thousand Splendid Suns',
                'author' => 'khaled hosseini',
                'price' => '9.990',
                'img' => 'Uploadimage/athousand.jpg'
            ],
            [
                'title' => 'Brida',
                'author' => 'Paulo coelho',
                'price' => '8.500',
                'img' => 'Uploadimage/Brida.jpg'
            ],
            [
                'title' => 'limetless',
                'author' => 'jim kwik',
                'price' => '7.250',
                'img' => 'Uploadimage/limitless.jpg'
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'price' => '6.750',
                'img' => 'Uploadimage/prideprejudice.jpg'
            ],
            [
                'title' => 'the silent patient',
                'author' => 'alex michaelides',
                'price' => '10.000',
                'img' => 'Uploadimage/silent-patient.jpg'
            ],
            [
                'title' => 'normal people',
                'author' => 'sally rooney',
                'price' => '10.000',
                'img' => 'Uploadimage/normalpeople.jpg'
            ],
            [
                'title' => 'atomic habits',
                'author' => 'james clear',
                'price' => '10.000',
                'img' => 'Uploadimage/atomichabits.jpg'
            ],
            [
                'title' => 'madame bovary',
                'author' => 'gustave flaubert',
                'price' => '10.000',
                'img' => 'Uploadimage/MadameBovary.jpg'
            ],
        ];

        foreach ($books as $bookData) {
            $book = new Books();
            $book->setTitle($bookData['title']);
            $book->setAuthor($bookData['author']);
            $book->setPrice($bookData['price']);
            $book->setImg($bookData['img']);
            $manager->persist($book);
        }

        // Save all books to the database
        $manager->flush();
    }
}