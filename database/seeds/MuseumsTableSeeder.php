<?php

use Illuminate\Database\Seeder;
use App\Entities\Museum;

class MuseumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $museum = new Museum();
        $museum->name = 'The Metropolitan Museum of Art';
        $museum->description = 'A grand setting for one of the world\'s greatest collections of art, from ancient to contemporary.';
        $museum->image = '/img/museums/museum-1.jpg';
        $museum->thumbnail = '/img/museums/museum-1.jpg';
        $museum->address = '1000 5th Ave, New York, NY 10028, USA';
        $museum->phone ='+1 212-535-7710';
        $museum->hours ='Monday-Sunday 10AM–5:30PM';
        $museum->rating = null;
        $museum->user_id = null;
        $museum->save();

        $museum = new Museum();
        $museum->name = 'The Louvre';
        $museum->description = 'The Louvre or the Louvre Museum is the world\'s largest museum and a historic monument in Paris, France. A central landmark of the city, it is located on the Right Bank of the Seine in the city\'s 1st arrondissement.';
        $museum->image = '/img/museums/museum-2-lg.jpg';
        $museum->thumbnail = '/img/museums/museum-2.jpg';
        $museum->address = 'Rue de Rivoli, 75001 Paris, France';
        $museum->phone ='+33 1 40 20 50 50';
        $museum->hours ='Wednesday 9AM - 10PM';
        $museum->rating = 4.80;
        $museum->user_id = null;
        $museum->save();
    }
}
