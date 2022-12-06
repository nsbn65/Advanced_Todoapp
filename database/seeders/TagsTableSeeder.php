<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = [
        'name' => '家事',
    ];
    Tag::create($tags);
    $tags = [
      'name' => '勉強',
    ];
    Tag::create($tags);
    $tags = [
      'name' => '運動',
    ];
    Tag::create($tags);
    $tags = [
      'name' => '食事',
    ];
    Tag::create($tags);
    $tags = [
      'name' => '移動',
    ];
    Tag::create($tags);
    }
}
