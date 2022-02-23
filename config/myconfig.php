<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    |
    | This is Category values
    |
    */

    'category_price' => [
        '0'=> [
            'name' => 'EC（商品情報）',
            'price' => 8,
        ],
        '1'=> [
            'name' => 'EC（利用規約）',
            'price' => 12,
        ],
        '2' => [
            'name' => '旅行',
            'price' => 8,
        ],
        '3' => [
            'name' => 'ビジネス（易しい）',
            'price' => 14,
        ],
        '4' => [
            'name' => 'ビジネス（プレゼンテーション）',
            'price' => 16,
        ],
        '5' => [
            'name' => 'ビジネス（専門的文書）',
            'price' => 22,
        ],
        '6' => [
            'name' => 'ビジネス（メール）',
            'price' => 6,
        ],
        '7' => [
            'name' => 'IT（専門的文書）',
            'price' => 24,
        ],
        '8' => [
            'name' => 'Webサイト',
            'price' => 16,
        ],
        '9' => [
            'name' => 'その他',
            'price' => 8,
        ]
    ],
    'category' => [
        '0'   =>    'EC（商品情報）',
        '1'   =>    'EC（利用規約）',
        '2'   =>    '旅行',
        '3'   =>    'ビジネス（易しい）',
        '4'   =>    'ビジネス（プレゼンテーション）',
        '5'   =>    'ビジネス（専門的文書）',
        '6'   =>    'ビジネス（メール）',
        '7'   =>    'IT（専門的文書）',
        '8'   =>    'Webサイト',
        '9'  =>    'その他'
    ],
    'language' => [
        '0'   =>    '英語',
        '1'   =>    '中国語',
        '2'    =>    '韓国語',
        '3'    =>    'フランス語',
        '4'    =>    'ドイツ語',
        '5'   =>    'スペイン語',
        '6'   =>    'イタリア語'
    ],
    'test' => [
        'EC_Product_Information'=> [
            'name' => 'EC（商品情報）',
            'price' => 8,
        ],
    ],
    'user_type' => [
        '0' => '依頼者',
        '1' => '翻訳者',
        '2' => '会話者',
        '3' => '通訳者'
    ],
    'job_status' => [
        'client'=> [
            '0' => '',
            '1' => '翻訳中',
            '2' => '納品済み'
        ],
        'worker' => [
            '0' => '',
            '1' => '連絡あり',
            '2' => ''
        ]
    ],
    'worker_status' => [
        '1' => '対応可能',
        '2' => '要アポイント'
    ],
    'appointment_type' => [
        '1' => '連絡あり',
        '2' => 'アポイント連絡'
    ],
    'sex' => [
        '1' => '男性',
        '2' => '女性'
    ],
    'prefecture' => [
        array(
            "id"     => 1,
            "name"   => '北海道',
            "region" => '北海道',
            "roman"  => 'Hokkaido'
        ),
        array(
            "id"     => 2,
            "name"   => '青森県',
            "region" => '東北',
            "roman"  => 'Aomori'
        ),
        array(
            "id"     => 3,
            "name"   => '岩手県',
            "region" => '東北',
            "roman"  => 'Iwate'
        ),
        array(
            "id"     => 4,
            "name"   => '宮城県',
            "region" => '東北',
            "roman"  => 'Miyagi'
        ),
        array(
            "id"     => 5,
            "name"   => '秋田県',
            "region" => '東北',
            "roman"  => 'Akita'
        ),
        array(
            "id"     => 6,
            "name"   => '山形県',
            "region" => '東北',
            "roman"  => 'Yamagata'
        ),
        array(
            "id"     => 7,
            "name"   => '福島県',
            "region" => '東北',
            "roman"  => 'Fukushima'
        ),
        array(
            "id"     => 8,
            "name"   => '茨城県',
            "region" => '関東',
            "roman"  => 'Ibaraki'
        ),
        array(
            "id"     => 9,
            "name"   => '栃木県',
            "region" => '関東',
            "roman"  => 'Tochigi'
        ),
        array(
            "id"     => 10,
            "name"   => '群馬県',
            "region" => '関東',
            "roman"  => 'Gunma'
        ),
        array(
            "id"     => 11,
            "name"   => '埼玉県',
            "region" => '関東',
            "roman"  => 'Saitama'
        ),
        array("id"     => 12,
                "name"   => '千葉県',
                "region" => '関東',
                "roman"  => 'Chiba'
        ),
        array(
            "id"     => 13,
            "name"   => '東京都',
            "region" => '関東',
            "roman"  => 'Tokyo'
        ),
        array(
            "id"     => 14,
            "name"   => '神奈川県',
            "region" => '関東',
            "roman"  => 'Kanagawa'
        ),
        array(
            "id"     => 15,
            "name"   => '新潟県',
            "region" => '信越',
            "roman"  => 'Niigata'
        ),
        array(
            "id"     => 16,
            "name"   => '富山県',
            "region" => '北陸',
            "roman"  => 'Toyama'
        ),
        array(
            "id"     => 17,
            "name"   => '石川県',
            "region" => '北陸',
            "roman"  => 'Ishikawa'
        ),
        array(
            "id"     => 18,
            "name"   => '福井県',
            "region" => '北陸',
            "roman"  => 'Fukui'
        ),
        array(
            "id"     => 19,
            "name"   => '山梨県',
            "region" => '関東',
            "roman"  => 'Yamanashi'
        ),
        array(
            "id"     => 20,
            "name"   => '長野県',
            "region" => '信越',
            "roman"  => 'Nagano'
        ),
        array(
            "id"     => 21,
            "name"   => '岐阜県',
            "region" => '東海',
            "roman"  => 'Gifu'
        ),
        array(
            "id"     => 22,
            "name"   => '静岡県',
            "region" => '東海',
            "roman"  => 'Shizuoka'
        ),
        array(
            "id"     => 23,
            "name"   => '愛知県',
            "region" => '東海',
            "roman"  => 'Aichi'
        ),
        array(
            "id"     => 24,
            "name"   => '三重県',
            "region" => '東海',
            "roman"  => 'Mie'),
        array(
            "id"     => 25,
            "name"   => '滋賀県',
            "region" => '近畿',
            "roman"  => 'Shiga'
        ),
        array(
            "id"     => 26,
            "name"   => '京都府',
            "region" => '近畿',
            "roman"  => 'Kyoto'
        ),
        array(
            "id"     => 27,
            "name"   => '大阪府',
            "region" => '近畿',
            "roman"  => 'Osaka'
        ),
        array(
            "id"     => 28,
            "name"   => '兵庫県',
            "region" => '近畿',
            "roman"  => 'Hyōgo'
        ),
        array(
            "id"     => 29,
            "name"   => '奈良県',
            "region" => '近畿',
            "roman"  => 'Nara'
        ),
        array(
            "id"     => 30,
            "name"   => '和歌山県',
            "region" => '近畿',
            "roman"  => 'Wakayama'
        ),
        array(
            "id"     => 31,
            "name"   => '鳥取県',
            "region" => '中国',
            "roman"  => 'Tottori'
        ),
        array(
            "id"     => 32,
            "name"   => '島根県',
            "region" => '中国',
            "roman"  => 'Shimane'
        ),
        array(
            "id"     => 33,
            "name"   => '岡山県',
            "region" => '中国',
            "roman"  => 'Okayama'
        ),
        array(
            "id"     => 34,
            "name"   => '広島県',
            "region" => '中国',
            "roman"  => 'Hiroshima'
        ),
        array(
            "id"     => 35,
            "name"   => '山口県',
            "region" => '中国',
            "roman"  => 'Yamaguchi'
        ),
        array(
            "id"     => 36,
            "name"   => '徳島県',
            "region" => '四国',
            "roman"  => 'Tokushima'
        ),
        array(
            "id"     => 37,
            "name"   => '香川県',
            "region" => '四国',
            "roman"  => 'Kagawa'
        ),
        array(
            "id"     => 38,
            "name"   => '愛媛県',
            "region" => '四国',
            "roman"  => 'Ehime'
        ),
        array(
            "id"     => 39,
            "name"   => '高知県',
            "region" => '四国',
            "roman"  => 'Kōchi'
        ),
        array(
            "id"     => 40,
            "name"   => '福岡県',
            "region" => '九州',
            "roman"  => 'Fukuoka'
        ),
        array(
            "id"     => 41,
            "name"   => '佐賀県',
            "region" => '九州',
            "roman"  => 'Saga'
        ),
        array(
            "id"     => 42,
            "name"   => '長崎県',
            "region" => '九州',
            "roman"  => 'Nagasaki'
        ),
        array(
            "id"     => 43,
            "name"   => '熊本県',
            "region" => '九州',
            "roman"  => 'Kumamoto'
        ),
        array(
            "id"     => 44,
            "name"   => '大分県',
            "region" => '九州',
            "roman"  => 'Ōita'
        ),
        array(
            "id"     => 45,
            "name"   => '宮崎県',
            "region" => '九州',
            "roman"  => 'Miyazaki'
        ),
        array(
            "id"     => 46,
            "name"   => '鹿児島県',
            "region" => '九州',
            "roman"  => 'Kagoshima'
        ),
        array(
            "id"     => 47,
            "name"   => '沖縄県',
            "region" => '沖縄',
            "roman"  => 'Okinawa'
        )
    ]
];
