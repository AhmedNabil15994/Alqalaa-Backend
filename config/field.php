<?php
return [

    'default_theme' => env('FIELD_DEFAULT_THEME','default'),

    'themes' => [

        'default' => [

            'container' => [
                'active' => true,
                'class' => 'form-group'
            ],

            'label' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-2',
                    'style' => ''
                ],
            ],

            'field_div' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-9',
                    'style' => ''
                ],
            ],

            'field_error' => [
                'active' => true,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],

        'installment_remaining' => [

            'container' => [
                'active' => true,
                'class' => 'form-group'
            ],

            'label' => [
                'active' => false,
                'options' => [
                    'class' => 'col-md-2',
                    'style' => ''
                ],
            ],

            'field_div' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-9',
                    'style' => ''
                ],
            ],

            'field_error' => [
                'active' => true,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],

        'installment_offer' => [

            'container' => [
                'active' => true,
                'class' => 'form-group'
            ],

            'label' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-12',
                    'style' => ''
                ],
            ],

            'field_div' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-12',
                    'style' => ''
                ],
            ],

            'field_error' => [
                'active' => true,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],
        'dashboard_login' => [

            'container' => [
                'active' => true,
                'class' => 'form-group'
            ],

            'label' => [
                'active' => true,
                'options' => [
                    'class' => 'control-label'
                ],
            ],

            'field_div' => [
                'active' => false,
                'options' => [
                    'class' => 'col-md-9',
                    'style' => ''
                ],
            ],

            'field_error' => [
                'active' => true,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],
        'readonly' => [

            'container' => [
                'active' => true,
                'class' => 'form-group'
            ],

            'label' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-12',
                ],
            ],

            'field_div' => [
                'active' => true,
                'options' => [
                    'class' => 'col-md-12',
                ],
            ],

            'field_error' => [
                'active' => true,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],
        'search' => [

            'container' => [
                'active' => false,
                'class' => 'col-md-4'
            ],

            'label' => [
                'active' => false,
                'options' => [
                    'style' => ''
                ],
            ],

            'field_div' => [
                'active' => true,
                'options' => [
                    'style' => ''
                ],
            ],

            'field_error' => [
                'active' => false,
                'options' => [
                    'class' => 'help-block',
                    'style' => ''
                ],
            ],
        ],
    ],

    'locales' => [
        'ace' => ['name' => 'Achinese', 'script' => 'Latn', 'native' => 'Aceh'],
        'af' => ['name' => 'Afrikaans', 'script' => 'Latn', 'native' => 'Afrikaans'],
        'agq' => ['name' => 'Aghem', 'script' => 'Latn', 'native' => 'Aghem'],
        'ak' => ['name' => 'Akan', 'script' => 'Latn', 'native' => 'Akan'],
        'an' => ['name' => 'Aragonese', 'script' => 'Latn', 'native' => 'aragonés'],
        'cch' => ['name' => 'Atsam', 'script' => 'Latn', 'native' => 'Atsam'],
        'gn' => ['name' => 'Guaraní', 'script' => 'Latn', 'native' => 'Avañe’ẽ'],
        'ae' => ['name' => 'Avestan', 'script' => 'Latn', 'native' => 'avesta'],
        'ay' => ['name' => 'Aymara', 'script' => 'Latn', 'native' => 'aymar aru'],
        'az' => ['name' => 'Azerbaijani (Latin)', 'script' => 'Latn', 'native' => 'azərbaycanca'],
        'id' => ['name' => 'Indonesian', 'script' => 'Latn', 'native' => 'Bahasa Indonesia'],
        'ms' => ['name' => 'Malay', 'script' => 'Latn', 'native' => 'Bahasa Melayu'],
        'bm' => ['name' => 'Bambara', 'script' => 'Latn', 'native' => 'bamanakan'],
        'jv' => ['name' => 'Javanese (Latin)', 'script' => 'Latn', 'native' => 'Basa Jawa'],
        'su' => ['name' => 'Sundanese', 'script' => 'Latn', 'native' => 'Basa Sunda'],
        'bh' => ['name' => 'Bihari', 'script' => 'Latn', 'native' => 'Bihari'],
        'bi' => ['name' => 'Bislama', 'script' => 'Latn', 'native' => 'Bislama'],
        'nb' => ['name' => 'Norwegian Bokmål', 'script' => 'Latn', 'native' => 'Bokmål'],
        'no' => ['name' => 'Norwegian', 'script' => 'Latn', 'native' => 'norsk'],
        'bs' => ['name' => 'Bosnian', 'script' => 'Latn', 'native' => 'bosanski'],
        'br' => ['name' => 'Breton', 'script' => 'Latn', 'native' => 'brezhoneg'],
        'ca' => ['name' => 'Catalan', 'script' => 'Latn', 'native' => 'català'],
        'ch' => ['name' => 'Chamorro', 'script' => 'Latn', 'native' => 'Chamoru'],
        'ny' => ['name' => 'Chewa', 'script' => 'Latn', 'native' => 'chiCheŵa'],
        'kde' => ['name' => 'Makonde', 'script' => 'Latn', 'native' => 'Chimakonde'],
        'sn' => ['name' => 'Shona', 'script' => 'Latn', 'native' => 'chiShona'],
        'co' => ['name' => 'Corsican', 'script' => 'Latn', 'native' => 'corsu'],
        'cy' => ['name' => 'Welsh', 'script' => 'Latn', 'native' => 'Cymraeg'],
        'da' => ['name' => 'Danish', 'script' => 'Latn', 'native' => 'dansk'],
        'se' => ['name' => 'Northern Sami', 'script' => 'Latn', 'native' => 'davvisámegiella'],
        'de' => ['name' => 'German', 'script' => 'Latn', 'native' => 'Deutsch'],
        'luo' => ['name' => 'Luo', 'script' => 'Latn', 'native' => 'Dholuo'],
        'nv' => ['name' => 'Navajo', 'script' => 'Latn', 'native' => 'Diné bizaad'],
        'dua' => ['name' => 'Duala', 'script' => 'Latn', 'native' => 'duálá'],
        'et' => ['name' => 'Estonian', 'script' => 'Latn', 'native' => 'eesti'],
        'na' => ['name' => 'Nauru', 'script' => 'Latn', 'native' => 'Ekakairũ Naoero'],
        'guz' => ['name' => 'Ekegusii', 'script' => 'Latn', 'native' => 'Ekegusii'],
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English'],
        'en-AU' => ['name' => 'Australian English', 'script' => 'Latn', 'native' => 'Australian English'],
        'en-GB' => ['name' => 'British English', 'script' => 'Latn', 'native' => 'British English'],
        'en-US' => ['name' => 'U.S. English', 'script' => 'Latn', 'native' => 'U.S. English'],
        'es' => ['name' => 'Spanish', 'script' => 'Latn', 'native' => 'español'],
        'eo' => ['name' => 'Esperanto', 'script' => 'Latn', 'native' => 'esperanto'],
        'eu' => ['name' => 'Basque', 'script' => 'Latn', 'native' => 'euskara'],
        'ewo' => ['name' => 'Ewondo', 'script' => 'Latn', 'native' => 'ewondo'],
        'ee' => ['name' => 'Ewe', 'script' => 'Latn', 'native' => 'eʋegbe'],
        'fil' => ['name' => 'Filipino', 'script' => 'Latn', 'native' => 'Filipino'],
        'fr' => ['name' => 'French', 'script' => 'Latn', 'native' => 'Français'],
        'fr-CA' => ['name' => 'Canadian French', 'script' => 'Latn', 'native' => 'Français canadien'],
        'fy' => ['name' => 'Western Frisian', 'script' => 'Latn', 'native' => 'frysk'],
        'fur' => ['name' => 'Friulian', 'script' => 'Latn', 'native' => 'furlan'],
        'fo' => ['name' => 'Faroese', 'script' => 'Latn', 'native' => 'føroyskt'],
        'gaa' => ['name' => 'Ga', 'script' => 'Latn', 'native' => 'Ga'],
        'ga' => ['name' => 'Irish', 'script' => 'Latn', 'native' => 'Gaeilge'],
        'gv' => ['name' => 'Manx', 'script' => 'Latn', 'native' => 'Gaelg'],
        'sm' => ['name' => 'Samoan', 'script' => 'Latn', 'native' => 'Gagana fa’a Sāmoa'],
        'gl' => ['name' => 'Galician', 'script' => 'Latn', 'native' => 'galego'],
        'ki' => ['name' => 'Kikuyu', 'script' => 'Latn', 'native' => 'Gikuyu'],
        'gd' => ['name' => 'Scottish Gaelic', 'script' => 'Latn', 'native' => 'Gàidhlig'],
        'ha' => ['name' => 'Hausa', 'script' => 'Latn', 'native' => 'Hausa'],
        'bez' => ['name' => 'Bena', 'script' => 'Latn', 'native' => 'Hibena'],
        'ho' => ['name' => 'Hiri Motu', 'script' => 'Latn', 'native' => 'Hiri Motu'],
        'hr' => ['name' => 'Croatian', 'script' => 'Latn', 'native' => 'hrvatski'],
        'bem' => ['name' => 'Bemba', 'script' => 'Latn', 'native' => 'Ichibemba'],
        'io' => ['name' => 'Ido', 'script' => 'Latn', 'native' => 'Ido'],
        'ig' => ['name' => 'Igbo', 'script' => 'Latn', 'native' => 'Igbo'],
        'rn' => ['name' => 'Rundi', 'script' => 'Latn', 'native' => 'Ikirundi'],
        'ia' => ['name' => 'Interlingua', 'script' => 'Latn', 'native' => 'interlingua'],
        'iu-Latn' => ['name' => 'Inuktitut (Latin)', 'script' => 'Latn', 'native' => 'Inuktitut'],
        'sbp' => ['name' => 'Sileibi', 'script' => 'Latn', 'native' => 'Ishisangu'],
        'nd' => ['name' => 'North Ndebele', 'script' => 'Latn', 'native' => 'isiNdebele'],
        'nr' => ['name' => 'South Ndebele', 'script' => 'Latn', 'native' => 'isiNdebele'],
        'xh' => ['name' => 'Xhosa', 'script' => 'Latn', 'native' => 'isiXhosa'],
        'zu' => ['name' => 'Zulu', 'script' => 'Latn', 'native' => 'isiZulu'],
        'it' => ['name' => 'Italian', 'script' => 'Latn', 'native' => 'italiano'],
        'ik' => ['name' => 'Inupiaq', 'script' => 'Latn', 'native' => 'Iñupiaq'],
        'dyo' => ['name' => 'Jola-Fonyi', 'script' => 'Latn', 'native' => 'joola'],
        'kea' => ['name' => 'Kabuverdianu', 'script' => 'Latn', 'native' => 'kabuverdianu'],
        'kaj' => ['name' => 'Jju', 'script' => 'Latn', 'native' => 'Kaje'],
        'mh' => ['name' => 'Marshallese', 'script' => 'Latn', 'native' => 'Kajin M̧ajeļ'],
        'kl' => ['name' => 'Kalaallisut', 'script' => 'Latn', 'native' => 'kalaallisut'],
        'kln' => ['name' => 'Kalenjin', 'script' => 'Latn', 'native' => 'Kalenjin'],
        'kr' => ['name' => 'Kanuri', 'script' => 'Latn', 'native' => 'Kanuri'],
        'kcg' => ['name' => 'Tyap', 'script' => 'Latn', 'native' => 'Katab'],
        'kw' => ['name' => 'Cornish', 'script' => 'Latn', 'native' => 'kernewek'],
        'naq' => ['name' => 'Nama', 'script' => 'Latn', 'native' => 'Khoekhoegowab'],
        'rof' => ['name' => 'Rombo', 'script' => 'Latn', 'native' => 'Kihorombo'],
        'kam' => ['name' => 'Kamba', 'script' => 'Latn', 'native' => 'Kikamba'],
        'kg' => ['name' => 'Kongo', 'script' => 'Latn', 'native' => 'Kikongo'],
        'jmc' => ['name' => 'Machame', 'script' => 'Latn', 'native' => 'Kimachame'],
        'rw' => ['name' => 'Kinyarwanda', 'script' => 'Latn', 'native' => 'Kinyarwanda'],
        'asa' => ['name' => 'Kipare', 'script' => 'Latn', 'native' => 'Kipare'],
        'rwk' => ['name' => 'Rwa', 'script' => 'Latn', 'native' => 'Kiruwa'],
        'saq' => ['name' => 'Samburu', 'script' => 'Latn', 'native' => 'Kisampur'],
        'ksb' => ['name' => 'Shambala', 'script' => 'Latn', 'native' => 'Kishambaa'],
        'swc' => ['name' => 'Congo Swahili', 'script' => 'Latn', 'native' => 'Kiswahili ya Kongo'],
        'sw' => ['name' => 'Swahili', 'script' => 'Latn', 'native' => 'Kiswahili'],
        'dav' => ['name' => 'Dawida', 'script' => 'Latn', 'native' => 'Kitaita'],
        'teo' => ['name' => 'Teso', 'script' => 'Latn', 'native' => 'Kiteso'],
        'khq' => ['name' => 'Koyra Chiini', 'script' => 'Latn', 'native' => 'Koyra ciini'],
        'ses' => ['name' => 'Songhay', 'script' => 'Latn', 'native' => 'Koyraboro senni'],
        'mfe' => ['name' => 'Morisyen', 'script' => 'Latn', 'native' => 'kreol morisien'],
        'ht' => ['name' => 'Haitian', 'script' => 'Latn', 'native' => 'Kreyòl ayisyen'],
        'kj' => ['name' => 'Kuanyama', 'script' => 'Latn', 'native' => 'Kwanyama'],
        'ksh' => ['name' => 'Kölsch', 'script' => 'Latn', 'native' => 'Kölsch'],
        'ebu' => ['name' => 'Kiembu', 'script' => 'Latn', 'native' => 'Kĩembu'],
        'mer' => ['name' => 'Kimîîru', 'script' => 'Latn', 'native' => 'Kĩmĩrũ'],
        'lag' => ['name' => 'Langi', 'script' => 'Latn', 'native' => 'Kɨlaangi'],
        'lah' => ['name' => 'Lahnda', 'script' => 'Latn', 'native' => 'Lahnda'],
        'la' => ['name' => 'Latin', 'script' => 'Latn', 'native' => 'latine'],
        'lv' => ['name' => 'Latvian', 'script' => 'Latn', 'native' => 'latviešu'],
        'to' => ['name' => 'Tongan', 'script' => 'Latn', 'native' => 'lea fakatonga'],
        'lt' => ['name' => 'Lithuanian', 'script' => 'Latn', 'native' => 'lietuvių'],
        'li' => ['name' => 'Limburgish', 'script' => 'Latn', 'native' => 'Limburgs'],
        'ln' => ['name' => 'Lingala', 'script' => 'Latn', 'native' => 'lingála'],
        'lg' => ['name' => 'Ganda', 'script' => 'Latn', 'native' => 'Luganda'],
        'luy' => ['name' => 'Oluluyia', 'script' => 'Latn', 'native' => 'Luluhia'],
        'lb' => ['name' => 'Luxembourgish', 'script' => 'Latn', 'native' => 'Lëtzebuergesch'],
        'hu' => ['name' => 'Hungarian', 'script' => 'Latn', 'native' => 'magyar'],
        'mgh' => ['name' => 'Makhuwa-Meetto', 'script' => 'Latn', 'native' => 'Makua'],
        'mg' => ['name' => 'Malagasy', 'script' => 'Latn', 'native' => 'Malagasy'],
        'mt' => ['name' => 'Maltese', 'script' => 'Latn', 'native' => 'Malti'],
        'mtr' => ['name' => 'Mewari', 'script' => 'Latn', 'native' => 'Mewari'],
        'mua' => ['name' => 'Mundang', 'script' => 'Latn', 'native' => 'Mundang'],
        'mi' => ['name' => 'Māori', 'script' => 'Latn', 'native' => 'Māori'],
        'nl' => ['name' => 'Dutch', 'script' => 'Latn', 'native' => 'Nederlands'],
        'nmg' => ['name' => 'Kwasio', 'script' => 'Latn', 'native' => 'ngumba'],
        'yav' => ['name' => 'Yangben', 'script' => 'Latn', 'native' => 'nuasue'],
        'nn' => ['name' => 'Norwegian Nynorsk', 'script' => 'Latn', 'native' => 'nynorsk'],
        'oc' => ['name' => 'Occitan', 'script' => 'Latn', 'native' => 'occitan'],
        'ang' => ['name' => 'Old English', 'script' => 'Runr', 'native' => 'Old English'],
        'xog' => ['name' => 'Soga', 'script' => 'Latn', 'native' => 'Olusoga'],
        'om' => ['name' => 'Oromo', 'script' => 'Latn', 'native' => 'Oromoo'],
        'ng' => ['name' => 'Ndonga', 'script' => 'Latn', 'native' => 'OshiNdonga'],
        'hz' => ['name' => 'Herero', 'script' => 'Latn', 'native' => 'Otjiherero'],
        'uz-Latn' => ['name' => 'Uzbek (Latin)', 'script' => 'Latn', 'native' => 'oʼzbekcha'],
        'nds' => ['name' => 'Low German', 'script' => 'Latn', 'native' => 'Plattdüütsch'],
        'pl' => ['name' => 'Polish', 'script' => 'Latn', 'native' => 'polski'],
        'pt' => ['name' => 'Portuguese', 'script' => 'Latn', 'native' => 'português'],
        'pt-BR' => ['name' => 'Brazilian Portuguese', 'script' => 'Latn', 'native' => 'português do Brasil'],
        'ff' => ['name' => 'Fulah', 'script' => 'Latn', 'native' => 'Pulaar'],
        'pi' => ['name' => 'Pahari-Potwari', 'script' => 'Latn', 'native' => 'Pāli'],
        'aa' => ['name' => 'Afar', 'script' => 'Latn', 'native' => 'Qafar'],
        'ty' => ['name' => 'Tahitian', 'script' => 'Latn', 'native' => 'Reo Māohi'],
        'ksf' => ['name' => 'Bafia', 'script' => 'Latn', 'native' => 'rikpa'],
        'ro' => ['name' => 'Romanian', 'script' => 'Latn', 'native' => 'română'],
        'cgg' => ['name' => 'Chiga', 'script' => 'Latn', 'native' => 'Rukiga'],
        'rm' => ['name' => 'Romansh', 'script' => 'Latn', 'native' => 'rumantsch'],
        'qu' => ['name' => 'Quechua', 'script' => 'Latn', 'native' => 'Runa Simi'],
        'nyn' => ['name' => 'Nyankole', 'script' => 'Latn', 'native' => 'Runyankore'],
        'ssy' => ['name' => 'Saho', 'script' => 'Latn', 'native' => 'Saho'],
        'sc' => ['name' => 'Sardinian', 'script' => 'Latn', 'native' => 'sardu'],
        'de-CH' => ['name' => 'Swiss High German', 'script' => 'Latn', 'native' => 'Schweizer Hochdeutsch'],
        'gsw' => ['name' => 'Swiss German', 'script' => 'Latn', 'native' => 'Schwiizertüütsch'],
        'trv' => ['name' => 'Taroko', 'script' => 'Latn', 'native' => 'Seediq'],
        'seh' => ['name' => 'Sena', 'script' => 'Latn', 'native' => 'sena'],
        'nso' => ['name' => 'Northern Sotho', 'script' => 'Latn', 'native' => 'Sesotho sa Leboa'],
        'st' => ['name' => 'Southern Sotho', 'script' => 'Latn', 'native' => 'Sesotho'],
        'tn' => ['name' => 'Tswana', 'script' => 'Latn', 'native' => 'Setswana'],
        'sq' => ['name' => 'Albanian', 'script' => 'Latn', 'native' => 'shqip'],
        'sid' => ['name' => 'Sidamo', 'script' => 'Latn', 'native' => 'Sidaamu Afo'],
        'ss' => ['name' => 'Swati', 'script' => 'Latn', 'native' => 'Siswati'],
        'sk' => ['name' => 'Slovak', 'script' => 'Latn', 'native' => 'slovenčina'],
        'sl' => ['name' => 'Slovene', 'script' => 'Latn', 'native' => 'slovenščina'],
        'so' => ['name' => 'Somali', 'script' => 'Latn', 'native' => 'Soomaali'],
        'sr-Latn' => ['name' => 'Serbian (Latin)', 'script' => 'Latn', 'native' => 'Srpski'],
        'sh' => ['name' => 'Serbo-Croatian', 'script' => 'Latn', 'native' => 'srpskohrvatski'],
        'fi' => ['name' => 'Finnish', 'script' => 'Latn', 'native' => 'suomi'],
        'sv' => ['name' => 'Swedish', 'script' => 'Latn', 'native' => 'svenska'],
        'sg' => ['name' => 'Sango', 'script' => 'Latn', 'native' => 'Sängö'],
        'tl' => ['name' => 'Tagalog', 'script' => 'Latn', 'native' => 'Tagalog'],
        'tzm-Latn' => ['name' => 'Central Atlas Tamazight (Latin)', 'script' => 'Latn', 'native' => 'Tamazight'],
        'kab' => ['name' => 'Kabyle', 'script' => 'Latn', 'native' => 'Taqbaylit'],
        'twq' => ['name' => 'Tasawaq', 'script' => 'Latn', 'native' => 'Tasawaq senni'],
        'shi' => ['name' => 'Tachelhit (Latin)', 'script' => 'Latn', 'native' => 'Tashelhit'],
        'nus' => ['name' => 'Nuer', 'script' => 'Latn', 'native' => 'Thok Nath'],
        'vi' => ['name' => 'Vietnamese', 'script' => 'Latn', 'native' => 'Tiếng Việt'],
        'tg-Latn' => ['name' => 'Tajik (Latin)', 'script' => 'Latn', 'native' => 'tojikī'],
        'lu' => ['name' => 'Luba-Katanga', 'script' => 'Latn', 'native' => 'Tshiluba'],
        've' => ['name' => 'Venda', 'script' => 'Latn', 'native' => 'Tshivenḓa'],
        'tw' => ['name' => 'Twi', 'script' => 'Latn', 'native' => 'Twi'],
        'tr' => ['name' => 'Turkish', 'script' => 'Latn', 'native' => 'Türkçe'],
        'ale' => ['name' => 'Aleut', 'script' => 'Latn', 'native' => 'Unangax tunuu'],
        'ca-valencia' => ['name' => 'Valencian', 'script' => 'Latn', 'native' => 'valencià'],
        'vai-Latn' => ['name' => 'Vai (Latin)', 'script' => 'Latn', 'native' => 'Viyamíĩ'],
        'vo' => ['name' => 'Volapük', 'script' => 'Latn', 'native' => 'Volapük'],
        'fj' => ['name' => 'Fijian', 'script' => 'Latn', 'native' => 'vosa Vakaviti'],
        'wa' => ['name' => 'Walloon', 'script' => 'Latn', 'native' => 'Walon'],
        'wae' => ['name' => 'Walser', 'script' => 'Latn', 'native' => 'Walser'],
        'wen' => ['name' => 'Sorbian', 'script' => 'Latn', 'native' => 'Wendic'],
        'wo' => ['name' => 'Wolof', 'script' => 'Latn', 'native' => 'Wolof'],
        'ts' => ['name' => 'Tsonga', 'script' => 'Latn', 'native' => 'Xitsonga'],
        'dje' => ['name' => 'Zarma', 'script' => 'Latn', 'native' => 'Zarmaciine'],
        'yo' => ['name' => 'Yoruba', 'script' => 'Latn', 'native' => 'Èdè Yorùbá'],
        'de-AT' => ['name' => 'Austrian German', 'script' => 'Latn', 'native' => 'Österreichisches Deutsch'],
        'is' => ['name' => 'Icelandic', 'script' => 'Latn', 'native' => 'íslenska'],
        'cs' => ['name' => 'Czech', 'script' => 'Latn', 'native' => 'čeština'],
        'bas' => ['name' => 'Basa', 'script' => 'Latn', 'native' => 'Ɓàsàa'],
        'mas' => ['name' => 'Masai', 'script' => 'Latn', 'native' => 'ɔl-Maa'],
        'haw' => ['name' => 'Hawaiian', 'script' => 'Latn', 'native' => 'ʻŌlelo Hawaiʻi'],
        'el' => ['name' => 'Greek', 'script' => 'Grek', 'native' => 'Ελληνικά'],
        'uz' => ['name' => 'Uzbek (Cyrillic)', 'script' => 'Cyrl', 'native' => 'Ўзбек'],
        'az-Cyrl' => ['name' => 'Azerbaijani (Cyrillic)', 'script' => 'Cyrl', 'native' => 'Азәрбајҹан'],
        'ab' => ['name' => 'Abkhazian', 'script' => 'Cyrl', 'native' => 'Аҧсуа'],
        'os' => ['name' => 'Ossetic', 'script' => 'Cyrl', 'native' => 'Ирон'],
        'ky' => ['name' => 'Kyrgyz', 'script' => 'Cyrl', 'native' => 'Кыргыз'],
        'sr' => ['name' => 'Serbian (Cyrillic)', 'script' => 'Cyrl', 'native' => 'Српски'],
        'av' => ['name' => 'Avaric', 'script' => 'Cyrl', 'native' => 'авар мацӀ'],
        'ady' => ['name' => 'Adyghe', 'script' => 'Cyrl', 'native' => 'адыгэбзэ'],
        'ba' => ['name' => 'Bashkir', 'script' => 'Cyrl', 'native' => 'башҡорт теле'],
        'be' => ['name' => 'Belarusian', 'script' => 'Cyrl', 'native' => 'беларуская'],
        'bg' => ['name' => 'Bulgarian', 'script' => 'Cyrl', 'native' => 'български'],
        'kv' => ['name' => 'Komi', 'script' => 'Cyrl', 'native' => 'коми кыв'],
        'mk' => ['name' => 'Macedonian', 'script' => 'Cyrl', 'native' => 'македонски'],
        'mn' => ['name' => 'Mongolian (Cyrillic)', 'script' => 'Cyrl', 'native' => 'монгол'],
        'ce' => ['name' => 'Chechen', 'script' => 'Cyrl', 'native' => 'нохчийн мотт'],
        'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'русский'],
        'sah' => ['name' => 'Yakut', 'script' => 'Cyrl', 'native' => 'саха тыла'],
        'tt' => ['name' => 'Tatar', 'script' => 'Cyrl', 'native' => 'татар теле'],
        'tg' => ['name' => 'Tajik (Cyrillic)', 'script' => 'Cyrl', 'native' => 'тоҷикӣ'],
        'tk' => ['name' => 'Turkmen', 'script' => 'Cyrl', 'native' => 'түркменче'],
        'uk' => ['name' => 'Ukrainian', 'script' => 'Cyrl', 'native' => 'українська'],
        'cv' => ['name' => 'Chuvash', 'script' => 'Cyrl', 'native' => 'чӑваш чӗлхи'],
        'cu' => ['name' => 'Church Slavic', 'script' => 'Cyrl', 'native' => 'ѩзыкъ словѣньскъ'],
        'kk' => ['name' => 'Kazakh', 'script' => 'Cyrl', 'native' => 'қазақ тілі'],
        'hy' => ['name' => 'Armenian', 'script' => 'Armn', 'native' => 'Հայերէն'],
        'yi' => ['name' => 'Yiddish', 'script' => 'Hebr', 'native' => 'ייִדיש'],
        'he' => ['name' => 'Hebrew', 'script' => 'Hebr', 'native' => 'עברית'],
        'ug' => ['name' => 'Uyghur', 'script' => 'Arab', 'native' => 'ئۇيغۇرچە'],
        'ur' => ['name' => 'Urdu', 'script' => 'Arab', 'native' => 'اردو'],
        'ar' => ['name' => 'Arabic', 'script' => 'Arab', 'native' => 'العربية'],
        'uz-Arab' => ['name' => 'Uzbek (Arabic)', 'script' => 'Arab', 'native' => 'اۉزبېک'],
        'tg-Arab' => ['name' => 'Tajik (Arabic)', 'script' => 'Arab', 'native' => 'تاجیکی'],
        'sd' => ['name' => 'Sindhi', 'script' => 'Arab', 'native' => 'سنڌي'],
        'fa' => ['name' => 'Persian', 'script' => 'Arab', 'native' => 'فارسی'],
        'pa-Arab' => ['name' => 'Punjabi (Arabic)', 'script' => 'Arab', 'native' => 'پنجاب'],
        'ps' => ['name' => 'Pashto', 'script' => 'Arab', 'native' => 'پښتو'],
        'ks' => ['name' => 'Kashmiri (Arabic)', 'script' => 'Arab', 'native' => 'کأشُر'],
        'ku' => ['name' => 'Kurdish', 'script' => 'Arab', 'native' => 'کوردی'],
        'dv' => ['name' => 'Divehi', 'script' => 'Thaa', 'native' => 'ދިވެހިބަސް'],
        'ks-Deva' => ['name' => 'Kashmiri (Devaganari)', 'script' => 'Deva', 'native' => 'कॉशुर'],
        'kok' => ['name' => 'Konkani', 'script' => 'Deva', 'native' => 'कोंकणी'],
        'doi' => ['name' => 'Dogri', 'script' => 'Deva', 'native' => 'डोगरी'],
        'ne' => ['name' => 'Nepali', 'script' => 'Deva', 'native' => 'नेपाली'],
        'pra' => ['name' => 'Prakrit', 'script' => 'Deva', 'native' => 'प्राकृत'],
        'brx' => ['name' => 'Bodo', 'script' => 'Deva', 'native' => 'बड़ो'],
        'bra' => ['name' => 'Braj', 'script' => 'Deva', 'native' => 'ब्रज भाषा'],
        'mr' => ['name' => 'Marathi', 'script' => 'Deva', 'native' => 'मराठी'],
        'mai' => ['name' => 'Maithili', 'script' => 'Tirh', 'native' => 'मैथिली'],
        'raj' => ['name' => 'Rajasthani', 'script' => 'Deva', 'native' => 'राजस्थानी'],
        'sa' => ['name' => 'Sanskrit', 'script' => 'Deva', 'native' => 'संस्कृतम्'],
        'hi' => ['name' => 'Hindi', 'script' => 'Deva', 'native' => 'हिन्दी'],
        'as' => ['name' => 'Assamese', 'script' => 'Beng', 'native' => 'অসমীয়া'],
        'bn' => ['name' => 'Bengali', 'script' => 'Beng', 'native' => 'বাংলা'],
        'mni' => ['name' => 'Manipuri', 'script' => 'Beng', 'native' => 'মৈতৈ'],
        'pa' => ['name' => 'Punjabi (Gurmukhi)', 'script' => 'Guru', 'native' => 'ਪੰਜਾਬੀ'],
        'gu' => ['name' => 'Gujarati', 'script' => 'Gujr', 'native' => 'ગુજરાતી'],
        'or' => ['name' => 'Oriya', 'script' => 'Orya', 'native' => 'ଓଡ଼ିଆ'],
        'ta' => ['name' => 'Tamil', 'script' => 'Taml', 'native' => 'தமிழ்'],
        'te' => ['name' => 'Telugu', 'script' => 'Telu', 'native' => 'తెలుగు'],
        'kn' => ['name' => 'Kannada', 'script' => 'Knda', 'native' => 'ಕನ್ನಡ'],
        'ml' => ['name' => 'Malayalam', 'script' => 'Mlym', 'native' => 'മലയാളം'],
        'si' => ['name' => 'Sinhala', 'script' => 'Sinh', 'native' => 'සිංහල'],
        'th' => ['name' => 'Thai', 'script' => 'Thai', 'native' => 'ไทย'],
        'lo' => ['name' => 'Lao', 'script' => 'Laoo', 'native' => 'ລາວ'],
        'bo' => ['name' => 'Tibetan', 'script' => 'Tibt', 'native' => 'པོད་སྐད་'],
        'dz' => ['name' => 'Dzongkha', 'script' => 'Tibt', 'native' => 'རྫོང་ཁ'],
        'my' => ['name' => 'Burmese', 'script' => 'Mymr', 'native' => 'မြန်မာဘာသာ'],
        'ka' => ['name' => 'Georgian', 'script' => 'Geor', 'native' => 'ქართული'],
        'byn' => ['name' => 'Blin', 'script' => 'Ethi', 'native' => 'ብሊን'],
        'tig' => ['name' => 'Tigre', 'script' => 'Ethi', 'native' => 'ትግረ'],
        'ti' => ['name' => 'Tigrinya', 'script' => 'Ethi', 'native' => 'ትግርኛ'],
        'am' => ['name' => 'Amharic', 'script' => 'Ethi', 'native' => 'አማርኛ'],
        'wal' => ['name' => 'Wolaytta', 'script' => 'Ethi', 'native' => 'ወላይታቱ'],
        'chr' => ['name' => 'Cherokee', 'script' => 'Cher', 'native' => 'ᏣᎳᎩ'],
        'iu' => ['name' => 'Inuktitut (Canadian Aboriginal Syllabics)', 'script' => 'Cans', 'native' => 'ᐃᓄᒃᑎᑐᑦ'],
        'oj' => ['name' => 'Ojibwa', 'script' => 'Cans', 'native' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ'],
        'cr' => ['name' => 'Cree', 'script' => 'Cans', 'native' => 'ᓀᐦᐃᔭᐍᐏᐣ'],
        'km' => ['name' => 'Khmer', 'script' => 'Khmr', 'native' => 'ភាសាខ្មែរ'],
        'mn-Mong' => ['name' => 'Mongolian (Mongolian)', 'script' => 'Mong', 'native' => 'ᠮᠣᠨᠭᠭᠣᠯ ᠬᠡᠯᠡ'],
        'shi-Tfng' => ['name' => 'Tachelhit (Tifinagh)', 'script' => 'Tfng', 'native' => 'ⵜⴰⵎⴰⵣⵉⵖⵜ'],
        'tzm' => ['name' => 'Central Atlas Tamazight (Tifinagh)', 'script' => 'Tfng', 'native' => 'ⵜⴰⵎⴰⵣⵉⵖⵜ'],
        'yue' => ['name' => 'Yue', 'script' => 'Hant', 'native' => '廣州話'],
        'ja' => ['name' => 'Japanese', 'script' => 'Jpan', 'native' => '日本語'],
        'zh' => ['name' => 'Chinese (Simplified)', 'script' => 'Hans', 'native' => '简体中文'],
        'zh-Hant' => ['name' => 'Chinese (Traditional)', 'script' => 'Hant', 'native' => '繁體中文'],
        'ii' => ['name' => 'Sichuan Yi', 'script' => 'Yiii', 'native' => 'ꆈꌠꉙ'],
        'vai' => ['name' => 'Vai (Vai)', 'script' => 'Vaii', 'native' => 'ꕙꔤ'],
        'jv-Java' => ['name' => 'Javanese (Javanese)', 'script' => 'Java', 'native' => 'ꦧꦱꦗꦮ'],
        'ko' => ['name' => 'Korean', 'script' => 'Hang', 'native' => '한국어'],
    ],
];
