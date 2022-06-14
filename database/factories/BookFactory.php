<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Custom\FakerProviders\BookProvider;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker_vn = \Faker\Factory::create('vi_VN');
        $faker_vn->addProvider(new BookProvider($faker_vn));

        $title = $faker_vn->bookTitle();
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'author' => $this->truncateNameTitle($faker_vn->name()),
            'publication_year' => $faker_vn->year(),
            'cover_image' => url('assets/img/' . 'book.png'),
            'description' => $faker_vn->paragraph(3),
            'quantity' => $faker_vn->numberBetween(1, 10),
        ];
    }

    /**
     * Truncate a title of a given person's name
     *
     * @param string $name: the name to truncate
     * @return string
     */
    private function truncateNameTitle(string $name) : string
    {
        $offset = mb_strpos($name, '.');
        if($offset !== false) {
            $name = mb_substr($name, $offset + 1);
        }

        return $name;
    }
}
