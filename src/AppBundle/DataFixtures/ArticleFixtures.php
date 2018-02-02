<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $categoriesName = ["Sport", "Sciences", "Divers"];
        $categoriesColor = ["primary", "success", "info"];
        $categories = [];

        foreach (array_combine($categoriesName, $categoriesColor) as $categoryName => $categoryColor) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setColor($categoryColor);
            $categories[] = $category;
            $manager->persist($category);
        }

        for ($i = 0; $i < 10; $i++)
        {
            $article = new Article();
            $article->setTitle($faker->sentence($nbWords = 6));
            $article->setDate($faker->dateTime($max = 'now', $timezone = 'Europe/Paris'));
            $article->setDescription($faker->paragraph($nbSentences = 3));
            $article->setActive(true);
            $rand = rand(0, count($categories) - 1);
            $article->addCategory($categories[$rand]);
            $article->addCategory($categories[($rand + 1) % count($categories)]);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
