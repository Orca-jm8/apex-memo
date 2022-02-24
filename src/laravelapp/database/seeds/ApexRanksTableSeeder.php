<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApexRanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'rank' => 'ブロンズⅣ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 2,
            'rank' => 'ブロンズⅢ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 3,
            'rank' => 'ブロンズⅡ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 4,
            'rank' => 'ブロンズⅠ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 5,
            'rank' => 'シルバーⅣ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 6,
            'rank' => 'シルバーⅢ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 7,
            'rank' => 'シルバーⅡ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 8,
            'rank' => 'シルバーⅠ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 9,
            'rank' => 'ゴールドⅣ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 10,
            'rank' => 'ゴールドⅢ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 11,
            'rank' => 'ゴールドⅡ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 12,
            'rank' => 'ゴールドⅠ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 13,
            'rank' => 'プラチナⅣ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 14,
            'rank' => 'プラチナⅢ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 15,
            'rank' => 'プラチナⅡ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 16,
            'rank' => 'プラチナⅠ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 17,
            'rank' => 'ダイアモンドⅣ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 18,
            'rank' => 'ダイアモンドⅢ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 19,
            'rank' => 'ダイアモンドⅡ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 20,
            'rank' => 'ダイアモンドⅠ',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 21,
            'rank' => 'マスター',
        ];
        DB::table('apex_ranks')->insert($param);

        $param = [
            'id' => 22,
            'rank' => 'プレデター',
        ];
        DB::table('apex_ranks')->insert($param);
    }
}
