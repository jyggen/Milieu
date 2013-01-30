<?php
/**
 * An environment initialization, device detection and app configuration library.
 *
 * @package     Milieu
 * @version     1.0
 * @author      Jonas Stendahl
 * @license     MIT License
 * @copyright   2013 Jonas Stendahl
 * @link        http://github.com/jyggen/Milieu
 */

namespace Milieu;

class Device
{

    protected $headers = array(
        'HTTP_ACCEPT'                  => 'application\/x-obml2d|application\/vnd\.rim\.html|text\/vnd\.wap\.wml|application\/vnd\.wap\.xhtml\+xml',
        'HTTP_X_WAP_PROFILE'           => null,
        'HTTP_X_WAP_CLIENTID'          => null,
        'HTTP_WAP_CONNECTION'          => null,
        'HTTP_PROFILE'                 => null,
        'HTTP_X_OPERAMINI_PHONE_UA'    => null,
        'HTTP_X_NOKIA_IPADDRESS'       => null,
        'HTTP_X_NOKIA_GATEWAY_ID'      => null,
        'HTTP_X_ORANGE_ID'             => null,
        'HTTP_X_VODAFONE_3GPDPCONTEXT' => null,
        'HTTP_X_HUAWEI_USERID'         => null,
        'HTTP_UA_OS'                   => null,
        'HTTP_X_MOBILE_GATEWAY'        => null,
        'HTTP_X_ATT_DEVICEID'          => null,
        'HTTP_UA_CPU'                  => '^ARM$',
    );

    protected $phones = array(
        'iPhone'       => '\biPhone.*Mobile|\biPod|\biTunes',
        'BlackBerry'   => 'BlackBerry|rim[0-9]+',
        'HTC'          => 'HTC|APX515CKT|Qtek9090|APA9292KT|HD_mini|Sensation.*Z710e|PG86100|Z715e|Desire.*(A8181|HD)|ADR6200|ADR6425|001HT|Inspire 4G',
        'Nexus'        => 'Nexus (?:One|S)|Galaxy.*Nexus|Android.*Nexus.*Mobile',
        'Dell'         => 'Dell\b.*(?:Streak|Aero|Venue|Flash|Smoke|Mini 3iX)|XCD28|XCD35|\b001DL\b|\b101DL\b|\bGS01\b',
        'Motorola'     => 'Motorola|\bDroid\b.*Build|DROIDX|Android.*Xoom|HRI39|MOT-|A1260|A1680|A555|A853|A855|A953|A955|A956|i867|i940|\bMB(?:200|300|501|502|508|511|520|525|526|611|612|632|810|855|860|861|865|870)|\bME(?:501|502|511|525|600|632|722|811|860|863|865)|\bMT(?:620|710|716|720|810|870|917)|WX435|WX445|\bXT(?:300|301|311|316|317|319|320|390|502|530|531|532|535|603|610|611|615|681|701|702|711|720|800|806|860|862|875|882|883|894|909|910|912|928)',
        'Samsung'      => 'Samsung|BGT-S5230|\bGT-(?:B(?:2100|2700|2710|3210|3310|3410|3730|3740|5510|5512|5722|6520|7300|7320|7330|7350|7510|7722|7800)|C(?:3010|3011|3060|3200|3212|3212I|3222|3300|3300K|3303|3303K|3310|3322|3330|3350|3500|3510|3530|3630|3780|5010|5212|6620|6625|6712)|E(?:1050|1070|1075|1080|1081|1085|1087|1100|1107|1110|1120|1125|1130|1160|1170|1175|1180|1182|1200|1210|1225|1230|1390|2100|2120|2121|2152|2220|2222|2230|2232|2250|2370|2550|2652|3210|3213)|I(?:5500|5503|5700|5800|5801|6410|6420|7110|7410|7500|8000|8150|8160|8320|8330|8350|8530|8700|8703|8910|9000|9001|9003|9010|9020|9023|9070|9100|9103|9220|9250|9300|9305)|M(?:3510|5650|7500|7600|7603|8800|8910)|N7000|P(?:6810|7100)|S(?:3110|3310|3350|3353|3370|3650|3653|3770|3850|5210|5220|5229|5230|5233|5250|5253|5260|5263|5270|5300|5330|5350|5360|5363|5369|5380|5380D|5560|5570|5600|5603|5610|5620|5660|5670|5690|5750|5780|5830|5839|6102|6500|7070|7200|7220|7230|7233|7250|7500|7530|7550|8000|8003|8500|8530|8600))|\bSCH-(?:A(?:310|530|570|610|630|650|790|795|850|870|890|930|950|970|990)|I(?:100|110|400|405|500|510|515|600|730|760|770|830|909|910|920)|LC11|N150|N300|R100|R300|R351|R400|R410|T300|U310|U320|U350|U360|U365|U370|U380|U410|U430|U450|U460|U470|U490|U540|U550|U620|U640|U650|U660|U700|U740|U750|U810|U820|U900|U940|U960)|SCS-26UC|SGH-(?:A107|A117|A127|A137|A157|A167|A177|A187|A197|A227|A237|A257|A437|A517|A597|A637|A657|A667|A687|A697|A707|A717|A727|A737|A747|A767|A777|A797|A817|A827|A837|A847|A867|A877|A887|A897|A927|B100|B130|B200|B220|C100|C110|C120|C130|C140|C160|C170|C180|C200|C207|C210|C225|C230|C417|C450|D307|D347|D357|D407|D415|D780|D807|D980|E105|E200|E315|E316|E317|E335|E590|E635|E715|E890|F300|F480|I200|I300|I320|I550|I577|I600|I607|I617|I627|I637|I677|I700|I717|I727|I777|I780|I827|I847|I857|I896|I897|I900|I907|I917|I927|I937|I997|J150|J200|L170|L700|M110|M150|M200|N105|N500|N600|N620|N625|N700|N710|P107|P207|P300|P310|P520|P735|P777|Q105|R210|R220|R225|S105|S307|T109|T119|T139|T209|T219|T229|T239|T249|T259|T309|T319|T329|T339|T349|T359|T369|T379|T409|T429|T439|T459|T469|T479|T499|T509|T519|T539|T559|T589|T609|T619|T629|T639|T659|T669|T679|T709|T719|T729|T739|T746|T749|T759|T769|T809|T819|T839|T919|T929|T939|T959|T989|U100|U200|U800|V205|V206|X100|X105|X120|X140|X426|X427|X475|X495|X497|X507|X600|X610|X620|X630|X700|X820|X890|Z130|Z150|Z170|ZX10|ZX20)|SHW-M110|SPH-(?:A120|A400|A420|A460|A500|A560|A600|A620|A660|A700|A740|A760|A790|A800|A820|A840|A880|A900|A940|A960|D600|D700|D710|D720|I300|I325|I330|I350|I500|I600|I700|L700|M100|M220|M240|M300|M305|M320|M330|M350|M360|M370|M380|M510|M540|M550|M560|M570|M580|M610|M620|M630|M800|M810|M850|M900|M910|M920|M930|N100|N200|N240|N300|N400|Z400)|SWC-E100|GT-N7100|GT-N8010',
        'Sony'         => 'sony|LT18i|E10i',
        'Asus'         => 'Asus.*Galaxy',
        'Palm'         => '\bPalm',
        'Vertu'        => 'Vertu',
        'Pantech'      => 'PANTECH|\bIM-A(?:850S|840S|830L|830K|830S|820L|810K|810S|800S|725L|780L|775C|770K|760S|750K|740S|730S|720L|710K|690L|690S|650S|630K|600S)|IM-T100K|VEGA PTL21|ADR910L|CDM8992|TXT8045|ADR8995|IS11PT|IS06|CDM8999|TXT8040|C790|P(?:T(?:00[1-3])|8010|6030|6020|9070|4100|9060|5000|2030|6010|8000|9050|2020|9020|2000|7040|7000)',
        'Fly'          => '\bIQ(?:230|444|450|440|442|441|245|256|236|255|235|245|275|240|285|280|270|260|250)',
        'GenericPhone' => 'PDA;|PPC;|SAGEM|mmp|pocket|psp|symbian|Smartphone|smartfon|treo|up.(?:browser|link)|vodafone|wap|nokia|Series(?:40|60)|S60|SonyEricsson|N900|MAUI.*WAP.*Browser|LG-P500'
    );

    protected $tablets = array(
        'BlackBerryTablet' => 'PlayBook|RIM Tablet',
        'iPad'             => 'iPad',
        'NexusTablet'      => '^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$',
        'Kindle'           => 'Kindle|Silk.*Accelerated',
        'SamsungTablet'    => 'SAMSUNG.*Tablet|Galaxy.*Tab|GT-P1000|GT-P1010|GT-P6210|GT-P6800|GT-P6810|GT-P7100|GT-P7300|GT-P7310|GT-P7500|GT-P7510|SCH-I800|SCH-I815|SCH-I905|SGH-I957|SGH-I987|SGH-T849|SGH-T859|SGH-T869|SPH-P100|GT-P3100|GT-P3110|GT-P5100|GT-P5110|GT-P6200|GT-P7320|GT-P7511|GT-N8000|GT-P8510|SGH-I497|SPH-P500|SGH-T779|SCH-I705|SCH-I915|GT-N8013|GT-P3113|GT-P5113|GT-P8110|GT-N8010|GT-N8005|GT-N8020|GT-P1013|GT-P6201|GT-P6810|GT-P7501',
        'HTCtablet'        => 'HTC Flyer|HTC Jetstream|HTC-P715a|HTC EVO View 4G|PG41200',
        'MotorolaTablet'   => 'xoom|sholest|MZ615|MZ605|MZ505|MZ601|MZ602|MZ603|MZ604|MZ606|MZ607|MZ608|MZ609|MZ615|MZ616|MZ617',
        'AsusTablet'       => 'Transformer|TF101',
        'NookTablet'       => 'Android.*Nook|NookColor|nook browser|BNTV250A|LogicPD Zoom2',
        'AcerTablet'       => 'Android.*\b(A100|A101|A200|A500|A501|A510|A700|A701|W500|W500P|W501|W501P|G100|G100W)\b',
        'ToshibaTablet'    => 'Android.*AT(?:100|105|200|205|270|275|300|305|1S5|500|570|700|830)',
        'YarvikTablet'     => 'Android.*TAB(?:210|211|224|250|260|264|310|360|364|410|411|420|424|450|460|461|464|465|467|468)',
        'MedionTablet'     => 'Android.*\bOYO\b|LIFE.*(P9212|P9514|P9516|S9512)|LIFETAB',
        'ArnovaTablet'     => 'AN10G2|AN7bG3|AN7fG3|AN8G3|AN8cG3|AN7G3|AN9G3|AN7dG3|AN7dG3ST|AN7dG3ChildPad|AN10bG3|AN10bG3DT',
        'ArchosTablet'     => 'Android.*ARCHOS|101G9|80G9',
        'AinolTablet'      => 'Novo7',
        'SonyTablet'       => 'Sony Tablet',
        'CubeTablet'       => 'Android.*(K8GT|U9GT|U10GT|U16GT|U17GT|U18GT|U19GT|U20GT|U23GT|U30GT)',
        'CobyTablet'       => 'MID(?:1042|1045|1125|1126|7012|7014|7034|7035|7036|7042|7048|7127|8042|8048|8127|9042|9740|9742|7022|7010)',
        'SMiTTablet'       => 'Android.*(\bMID\b|MID-560|MTV-T1200|MTV-PND531|MTV-P1101|MTV-PND530)',
        'RockChipTablet'   => 'Android.*RK(?:2818|2918|3066)|RK2738|RK2808A',
        'TelstraTablet'    => 'T-Hub2',
        'FlyTablet'        => 'IQ310|Fly Vision',
        'bqTablet'         => '\bbq\b.*(Elcano|Curie|Edison|Maxwell|Kepler|Pascal|Tesla|Hypatia|Platon|Newton|Livingstone|Cervantes|Avant)',
        'HuaweiTablet'     => 'MediaPad|IDEOS S7|S7-201c|S7-202u|S7-101|S7-103|S7-104|S7-105|S7-106|S7-201|S7-Slim',
        'GenericTablet'    => 'Android.*\b97D\b|Tablet(?!.*PC)|ViewPad7|LG-V909|MID7015|BNTV250A|LogicPD Zoom2|\bA7EB\b|CatNova8|A1_07|CT704|CT1002|\bM721\b|hp-tablet',
    );

    protected $userAgent;

    public function __construct()
    {

    }

    public function getUserAgent()
    {

        if ($this->userAgent === null) {

            if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {

                $this->userAgent = $_SERVER['HTTP_USER_AGENT'];

            } elseif (array_key_exists('HTTP_X_DEVICE_USER_AGENT', $_SERVER)) {

                $this->userAgent = $_SERVER['HTTP_X_DEVICE_USER_AGENT'];

            }

            if (array_key_exists('HTTP_X_OPERAMINI_PHONE_UA', $_SERVER)) {

                $this->userAgent .= ' '.$_SERVER['HTTP_X_OPERAMINI_PHONE_UA'];

            }

        }

        return $this->userAgent;

    }

    public function isMobile()
    {

        return ($this->isPhone() or $this->isTablet()) ? true : false;

    }

    public function isPhone()
    {

        if ($this->testHeaders()) {

            return true;

        }

        foreach ($this->phones as $regex) {

            if ($this->testDevice($regex)) {

                return true;

            }

        }

        return false;

    }

    public function isTablet()
    {

        foreach ($this->tablets as $regex) {

            if ($this->testDevice($regex)) {

                return true;

            }

        }

        return false;

    }

    protected function testDevice($regex)
    {

        return (preg_match('/'.str_replace('/', '\/', $regex).'/is', $this->getUserAgent())) ? true : false;

    }

    protected function testHeaders()
    {

        foreach ($this->headers as $header => $regex) {

            if (array_key_exists($header, $_SERVER)) {

                if ($regex === null) {

                    return true;

                } elseif (preg_match('/'.$regex.'/', $_SERVER[$header])) {

                    return true;

                }

            }

        }

        return false;

    }

}