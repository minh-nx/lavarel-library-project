<?php

namespace App\Custom\FakerProviders;

use \Faker\Provider\Base;

class BookProvider extends Base
{
    public function bookTitle($nbWords = 5)
    {
      $sentence = $this->generator->sentence($nbWords);
      return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function ISBN()
    {
      return $this->generator->ean13();
    }
}