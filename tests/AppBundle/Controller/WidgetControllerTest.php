<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class WidgetControllerTest
 * @package Tests\AppBundle\Controller
 */
class WidgetControllerTest extends WebTestCase
{
    public function testScript()
    {
        $client = static::createClient();
        $uuid = '001442e5-dd05-11e3-93c8-d43d7eecedd2';

        $url = $client->getContainer()->get('router')->generate('script_action', [
            'uuid' => $uuid
        ]);
        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($this->strtoHex($uuid, ['-']), $client->getResponse()->getContent());
    }
    
    public function testIframe()
    {
        $client = static::createClient();
        $uuid = '001442e5-dd05-11e3-93c8-d43d7eecedd2';

        $url = $client->getContainer()->get('router')->generate('iframe_action', [
            'uuid' => $uuid
        ]);
        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('No ratings found.', $client->getResponse()->getContent());
    }

    /**
     * @param string $string
     * @param array  $replacements
     *
     * @return string
     */
    private function strtoHex(string $string, array $replacements): string
    {
        $string = str_split($string);
        foreach($string as &$char) {

            if (in_array($char, $replacements)) {
                $char = sprintf('\x%s', strtoupper(dechex(ord($char))));
            }
        }

        return implode('', $string);
    }
}