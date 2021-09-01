<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'fullname'=>'山田一郎',
            'gender'=>'1',
            'email'=>'ichirou@gmail.com',
            'postcode'=>'123-4567',
            'address'=>'東京都渋谷区千駄ヶ谷1-2-3',
            'building_name'=>'千駄ヶ谷マンション101',
            'opinion'=>'いつもお世話になっております。先日、貴社製品を購入させていただきました。この度、不具合が生じ、説明書に沿って操作を進めていましたが上手く行きませんでした。どのように直せば良いかご教授いただきたいです。',
        ];
        DB::table('contacts')->insert($param);

        $param=[
            'fullname'=>'山田二郎',
            'gender'=>'2',
            'email'=>'jirou@gmail.com',
            'postcode'=>'123-4567',
            'address'=>'東京都渋谷区千駄ヶ谷1-2-3',
            'building_name'=>'千駄ヶ谷マンション102',
            'opinion'=>'いつもお世話になっております。先日、貴社製品を購入させていただきました。この度、不具合が生じ、説明書に沿って操作を進めていましたが上手く行きませんでした。どのように直せば良いかご教授いただきたいです。',
        ];
        DB::table('contacts')->insert($param);

        $param=[
            'fullname'=>'山田三郎',
            'gender'=>'1',
            'email'=>'saburou@gmail.com',
            'postcode'=>'123-4567',
            'address'=>'東京都渋谷区千駄ヶ谷1-2-3',
            'building_name'=>'千駄ヶ谷マンション103',
            'opinion'=>'いつもお世話になっております。先日、貴社製品を購入させていただきました。この度、不具合が生じ、説明書に沿って操作を進めていましたが上手く行きませんでした。どのように直せば良いかご教授いただきたいです。',
        ];
        DB::table('contacts')->insert($param);

        Contact::factory()->count(32)->create();
    }
}
