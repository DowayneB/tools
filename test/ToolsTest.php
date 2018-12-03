<?php

namespace GodsDev\Tools\Test;

use GodsDev\Tools\Tools;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-06-25 at 18:53:30.
 */
class ToolsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Backyard
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testAll() {
        // h
        $this->assertSame('a&amp;b&quot;c&apos;d&lt;e&gt;f', Tools::h('a&b"c\'d<e>f'));
        // set
        $this->assertSame(false, Tools::set($a));
        $a = 0;
        $this->assertSame(false, Tools::set($a));
        $a = 5;
        $this->assertSame(5, Tools::set($a));
        unset($a);
        $this->assertSame(5, Tools::set($a, 5)); // $a = 5
        $this->assertSame(5, $a);
        $a = 0;
        $this->assertSame(5, Tools::set($a, 5)); // $a = 5
        $this->assertSame(5, $a);
        $this->assertSame(5, Tools::set($a, 6)); // $a = 5
        $this->assertSame(5, $a);
        // ifempty
        $a = 5;
        $this->assertSame(5, Tools::ifempty($a, 6));
        $a = 0;
        $this->assertSame(5, Tools::ifempty($a, 5));
        // ifnull
        $this->assertSame(0, Tools::ifnull($a));
        $a = 5;
        $this->assertSame(5, Tools::ifnull($a));
        $a = null;
        $this->assertSame(null, Tools::ifnull($a));
        // equal
        unset($a);
        $this->assertSame(false, Tools::equal($a, 5));
        $this->assertSame(false, Tools::equal($a, 0));
        $this->assertSame(false, Tools::equal($a, false));
        $this->assertSame(false, Tools::equal($a, null));
        $a = 0;
        $this->assertSame(false, Tools::equal($a, '0'));
        $this->assertSame(false, Tools::equal($a, 0.0));
        $this->assertSame(true, Tools::equal($a, 0));
        // nonempty
        // nonzero
        // ifset
        // setifnotset
        // setifnull
        // setifempty
        // setscalar
        unset($a);
        $this->assertSame(false, Tools::setscalar($a));
        $a = true;
        $this->assertSame(true, Tools::setscalar($a));
        $a = array();
        $this->assertSame(false, Tools::setscalar($a));
        // setarray
        unset($a);
        $this->assertSame(false, Tools::setarray($a));
        $a = true;
        $this->assertSame(false, Tools::setarray($a));
        $a = array();
        $this->assertSame(true, Tools::setarray($a));
        // wrap
        $this->assertSame('<b>Hello</b>', Tools::wrap('Hello', '<b>', '</b>'));
        $this->assertSame('N/A', Tools::wrap('', '<b>', '</b>', 'N/A'));
        // among
        $a = 0;
        $this->assertSame(false, Tools::among($a, '0'));
        $a = false;
        $this->assertSame(false, Tools::among($a, 0));
        $a = null;
        $this->assertSame(false, Tools::among($a, 0, false, true));
        $this->assertSame(true, Tools::among($a, null));
        // anyset
        $this->assertSame(false, Tools::anyset($_GET['a'], $_POST['abc'][1], $a));
        $a = 1;
        $this->assertSame(true, Tools::anyset($_GET['a'], $_POST['abc'][1], $a));
        $a = null;
        $this->assertSame(false, Tools::anyset($_GET['a'], $a));
        $this->assertSame(false, Tools::anyset($_GET['a'][2], $b, $a));
        // begins
        $palindrom = 'Příliš žluťoučký kůň úpěl ďábelské ódy!';
        $this->assertSame(true, Tools::begins($palindrom, 'Příliš'));
        $this->assertSame(true, Tools::begins($palindrom, 'pŘÍLIŠ', false));
        // ends
        $this->assertSame(true, Tools::ends($palindrom, 'ódy!'));
        $this->assertSame(true, Tools::ends($palindrom, 'ÓDY!', false));
        // addMessage
        $_SESSION['messages'] = array();
        Tools::addMessage('info', 'One');
        Tools::addMessage('error', 'Two');
        Tools::addMessage(true, 'Three');
        Tools::addMessage(false, 'Four');
        $this->assertSame($_SESSION['messages'], array(
            array('info', 'One'),
            array('danger', 'Two'),
            array('success', 'Three'),
            array('warning', 'Four'),
        ));
        // showMessages
        Tools::showMessages();
        $this->assertSame($_SESSION['messages'], array());
        // htmlOption
        $this->assertSame('<option value="1">Android</option>' . PHP_EOL, Tools::htmlOption(1, 'Android'));
        // htmlSelect
        $platforms = ['Android', 'iOS'];
        $this->assertSame('<select name="platform">' . PHP_EOL
            . '<option value="0">Android</option>' . PHP_EOL
            . '<option value="1" selected="selected">iOS</option>' . PHP_EOL
            . '</select>' . PHP_EOL, 
            Tools::htmlSelect('platform', $platforms, 1, [])
        );
        // htmlRadio
        $this->assertSame('<label><input type="radio" name="platform" value="0"/> Android</label>'
            . '<label><input type="radio" name="platform" value="1"/> iOS</label>', //should not be checked <==> strict comparison between 1 and '1'
            Tools::htmlRadio('platform', $platforms, '1', [])
        );
        $this->assertSame('<label class="ml-1"><input type="radio" name="platform" value="0" class="mr-1"/>…Android</label>,'
            . '<label class="ml-1"><input type="radio" name="platform" value="1" checked="checked" class="mr-1"/>…iOS</label>', 
            Tools::htmlRadio('platform', $platforms, 1, ['label-class' => 'ml-1', 'radio-class' => 'mr-1', 'separator' => ',', 'between' => '…'])
        );
        $this->assertSame('<input type="radio" name="platform" value=""/>', 
            Tools::htmlRadio('platform', '', 1)
        );
        // htmlTextarea
        $this->assertSame('<textarea cols="60" rows="5" name="info">abc</textarea>', 
            Tools::htmlTextarea('info', 'abc')
        );
        $this->assertSame('<textarea class="my-3" cols="61" rows="6" name="info">a&apos;b&quot;c</textarea>', 
            Tools::htmlTextarea('info', 'a\'b"c', 61, 6, ['class'=>'my-3'])
        );
        // htmlInput
        $this->assertSame('<input type="text" name="info" value="a&apos;b&quot;c"/>', 
            Tools::htmlInput('info', '', 'a\'b"c')
        );
        $this->assertSame('<label for="input-info">info:</label>'
            . '<input id="input-info" type="text" name="info" value="a&apos;b&quot;c"/>', 
            Tools::htmlInput('info', 'info:', 'a\'b"c')
        );
        $this->assertSame('<input class="text-right" id="info1" type="text" name="info" value="a&apos;b&quot;c"/>' . "\n"
            . '<label for="info1" class="ml-1">info:</label>',
            Tools::htmlInput('info', 'info:', 'a\'b"c', ['class' => 'text-right', 'label-class'=>'ml-1', 'id'=>'info1', 'label-after' => true, 'between' => "\n"])
        );
        // webalize
        // shortify
        $this->assertSame('Příli…', Tools::shortify($palindrom, 5));
        // escapeSQL
        $this->assertSame("<a href=\\\"#\\\" class=\'btn\'>#</a>", Tools::escapeSQL('<a href="#" class=\'btn\'>#</a>'));
        // escapeDbIdentifier
        $this->assertSame('`na``me`', Tools::escapeDbIdentifier('na`me'));
        // escapeIn
        $this->assertSame('0,1.5,"",0,1,NULL,"a\"b"', Tools::escapeIn([0, 1.5, '', false, true, null, 'a"b']));
        // escapeJS
        // redir
        // arrayListed($array, $flags = 0, $glue = ',', $before = '', $after = '')
        $fruits = ['<b>Apple</b>', 'Levi\'s', 'H&M'];
        $this->assertSame("<b>Apple</b>,Levi's,H&M", Tools::arrayListed($fruits));
        $this->assertSame("&lt;b&gt;Apple&lt;/b&gt;,Levi&#039;s,H&amp;M", Tools::arrayListed($fruits, Tools::ARRL_HTML));
        $this->assertSame("<b>Apple</b>,Levi\\'s,H&M", Tools::arrayListed($fruits, Tools::ARRL_ESC));
        $this->assertSame("A,B,C", Tools::arrayListed(['A', 'B', 0, '', false, null, 'C'], Tools::ARRL_EMPTY));
        $this->assertSame('<a href="/en/about" title="about">about</a> | <a href="/en/links" title="links">links</a>', Tools::arrayListed(['about', 'links'], Tools::ARRL_PATTERN, ' | ', '<a href="/en/#" title="#">#</a>', '#'));
        // arrayConfineKeys
        $employees = [['name'=>'John', 'age'=>43], ['name'=>'Lucy', 'age'=>28]];
        $this->assertSame([['age'=>43], ['age'=>28]], Tools::arrayConfineKeys($employees, 'age'));
        // exploded
        $this->assertSame('30', Tools::exploded('-', '1996-07-30', 2));
        // cutTill
        $text = 'Mary had a little lamb with wool as white as snow.';
        Tools::cutTill($text, 'with');
        $this->assertSame('Mary had a little lamb ', $text);
        // curlCall
        // urlChange
        unset($_SERVER['QUERY_STRING']);
        $this->assertSame('a=1&b=text', Tools::urlChange(['a' => 1,'b' => 'text']));
        // relativeTime
        // localeDate
        // localeTime
        // plural
        $this->assertSame('child', Tools::plural(1, 'child', false, 'children'));
        $this->assertSame('Jahre', Tools::plural(2, 'Jahr', 'Jahre', 'Jahren'));
        $this->assertSame('child', Tools::plural(7601, 'child', false, 'children'));
        // resolve
        // arrayReindex
        $a = [
            ['id'=>5, 'name'=>'John', 'surname'=>'Doe'], 
            ['id'=>6, 'name'=>'Jane', 'surname'=>'Dean']
        ];
        $b = [
            ['id'=>5, 'name'=>'John'], 
            ['id'=>6, 'name'=>'Jane']
        ];
        $this->assertSame(
            [
                5=>['name'=>'John', 'surname'=>'Doe'], 
                6=>['name'=>'Jane', 'surname'=>'Dean']
            ],
            Tools::arrayReindex($a, 'id')
        ); 
        $this->assertSame(
            [
                5=>'John', 
                6=>'Jane'
            ],
            Tools::arrayReindex($b, 'id')
        );
        // arrayRemoveItems
        $fruits = ['Apple', 'Pear', 'Kiwi'];
        $this->assertSame([2=>'Kiwi'], Tools::arrayRemoveItems($fruits, ['Apple', 'Pear']));
        $this->assertSame([2=>'Kiwi'], Tools::arrayRemoveItems($fruits, 'Apple', 'Pear', 'Orange'));
        $this->assertSame([], Tools::arrayRemoveItems($fruits, 'Apple', 'Pear', 'Kiwi', 'Orange'));
        // arrayKeyAsValues
        $this->assertSame(['Apple'=>'Apple', 'Pear'=>'Pear', 'Kiwi'=>'Kiwi'], Tools::arrayKeyAsValues($fruits));
        // randomPassword
        // dump
        // stripAttributes
        // GoogleAuthenticatorCode
        // str_putcsv
        $fields = [2, null, false, true, 'ab;c', 'žluťoučký kůň', 'say "Hello"'];
        $this->assertSame('2;;;1;"ab;c";"žluťoučký kůň";"say ""Hello"""'."\n", Tools::str_putcsv($fields, ';'));
        // str_before
        $this->assertSame('Příliš žluťoučký kůň', Tools::str_before($palindrom, ' úpěl ďábelské ódy!'));
        $this->assertSame(false, Tools::str_before($palindrom, ' ÚPĚL ĎÁBELSKÉ ÓDY!'));
        $this->assertSame('Příliš žluťoučký kůň', Tools::str_before($palindrom, ' ÚPĚL ĎÁBELSKÉ ÓDY!', true));
        // str_after
        $this->assertSame(' úpěl ďábelské ódy!', Tools::str_after($palindrom, 'Příliš žluťoučký kůň'));
        $this->assertSame(false, Tools::str_after($palindrom, 'PŘÍLIŠ ŽLUŤOUČKÝ KŮŇ'));
        $this->assertSame(' úpěl ďábelské ódy!', Tools::str_after($palindrom, 'PŘÍLIŠ ŽLUŤOUČKÝ KŮŇ', true));
        // mb_ucfirst
        $this->assertSame('Ďábelské ódy!', Tools::mb_ucfirst('ďábelské ódy!'));
        // array_search_i
        $fruits = [0 => 'Banana', 1 => 'Orange', 2 => 'Kiwi', 3 => 'ŠÍPEK', 'STRAWBERRY'];
        $this->assertSame(2, Tools::array_search_i('kiwi', $fruits));
        $this->assertSame(3, Tools::array_search_i('šípek', $fruits));
        // in_array_i
        $this->assertSame(false, Tools::in_array_i('kiwi2', $fruits));
        $this->assertSame(true, Tools::in_array_i('šípek', $fruits));
        // whitelist
        $os = 'Windows';
        Tools::whitelist($os, ['Windows', 'Unix'], 'unsupported');
        $this->assertSame('Windows', $os);
        $os = 'Solaris';
        Tools::whitelist($os, ['Windows', 'Unix'], 'unsupported');
        $this->assertSame('unsupported', $os);
        // blacklist
        $word = 'vitamins';
        Tools::blacklist($word, ['violence', 'sex'], '');
        $this->assertSame('vitamins', $word);
        $word = 'violence';
        Tools::blacklist($word, ['violence', 'sex'], '');
        $this->assertSame('', $word);
        // httpResponse
        $response = "content-type: text/html; charset=utf-8\r\npragma: no cache\r\n\r\n<p>Hello, world!</p>\n";
        $this->assertSame([
            'headers' => [
                'content-type' => 'text/html; charset=utf-8',
                'pragma' => 'no cache'
            ],
            'body' => "<p>Hello, world!</p>\n"
        ], Tools::httpResponse($response));
        $response = "pragma: no cache\r\n\r\n" . '["abc", 2, true, false, null, {"d": "e"}]';
        $this->assertSame([
            'headers' => ['pragma' => 'no cache'],
            'body' => ["abc", 2, true, false, null, ["d" => "e"]]
        ], Tools::httpResponse($response, ['JSON'=>true]));
        // columnName
        $this->assertSame('', Tools::columnName(-1));
        $this->assertSame('A', Tools::columnName(0));
        $this->assertSame('B', Tools::columnName(1));
        $this->assertSame('Z', Tools::columnName(25));
        $this->assertSame('AA', Tools::columnName(26));
        $this->assertSame('AB', Tools::columnName(27));
        $this->assertSame('ZZ', Tools::columnName(701));
        $this->assertSame('AAA', Tools::columnName(702));
    }

}
