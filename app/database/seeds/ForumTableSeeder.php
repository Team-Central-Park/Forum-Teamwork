<?php

class ForumTableSeeder extends Seeder
{
    public function run()
    {
        ForumGroup::create(array(
            'title' => 'General Discussion',
            'author_id' => 1
        ));

        ForumCategory::create(array(
            'title' => 'First Test Category',
            'group_id' => 1,
            'author_id' => 1
        ));

        ForumCategory::create(array(
            'title' => 'Second Test Category',
            'group_id' => 1,
            'author_id' => 1
        ));
    }
}