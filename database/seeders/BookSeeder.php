<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Booktype;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booktypes = Booktype::get();
        $weightedValues = [
            1 => 30,
            2 => 40,
            3 => 25,
            4 => 5,
        ];

        $bookCount = 100;
        for($i = 0; $i < $bookCount; $i++) {
            Book::factory()
                ->hasAttached(factory: $booktypes->random($this->getRandomWeightedElement($weightedValues)),
                              relationship: 'booktypes')
                ->create();
        }
    }

    /**
     * getRandomWeightedElement()
     * Utility function for getting random values with weighting.
     * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
     * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
     * The return value is the array key, A, B, or C in this case.  Note that the values assigned
     * do not have to be percentages.  The values are simply relative to each other.  If one value
     * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
     * chance of being selected.  Also note that weights should be integers.
     * 
     * @param array $weightedValues
     */
    private function getRandomWeightedElement(array $weightedValues) {
        static $x = 0;
        mt_srand($x++);
        
        $rand = mt_rand(1, (int) array_sum($weightedValues));

        foreach($weightedValues as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }
}
