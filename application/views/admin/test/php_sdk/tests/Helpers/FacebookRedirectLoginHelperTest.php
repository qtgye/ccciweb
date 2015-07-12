<?php
/**
 * Copyright 2014 Facebook, Inc.
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * As with any software that integrates with the Facebook platform, your use
 * of this software is subject to the Facebook Developer Principles and
 * Policies [http://developers.facebook.com/policy/]. This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */
namespace Facebook\Tests\Helpers;

use Mockery as m;
use Facebook\Facebook;
use \Facebook\FacebookApp;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\PersistentData\FacebookMemoryPersistentDataHandler;
use Facebook\PseudoRandomString\PseudoRandomStringGeneratorInterface;

class FooPseudoRandomStringGenerator implements PseudoRandomStringGeneratorInterface
{
  public function getPseudoRandomString($length) {
    return 'csprs123';
  }
}

class FacebookRedirectLoginHelperTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @var FacebookMemoryPersistentDataHandler
   */
  protected $persistentDataHandler;

  const REDIRECT_URL = 'http://invalid.zzz';

  public function setUp()
  {
    $this->persistentDataHandler = new FacebookMemoryPersistentDataHandler();
  }

  public function testLoginURL()
  {
    $app = new FacebookApp('123', 'foo_app_secret');
    $helper = new FacebookRedirectLoginHelper($app, $this->persistentDataHandler);

    $scope = ['foo','bar'];
    $loginUrl = $helper->getLoginUrl(self::REDIRECT_URL, $scope, true, 'v1337');

    $expectedUrl = 'https://www.facebook.com/v1337/dialog/oauth?';
    $this->assertTrue(strpos($loginUrl, $expectedUrl) === 0, 'Unexpected base login URL returned from getLoginUrl().');

    $params = [
      'client_id' => '123',
      'redirect_uri' => self::REDIRECT_URL,
      'state' => $this->persistentDataHandler->get('state'),
      'sdk' => 'php-sdk-' . Facebook::VERSION,
      'scope' => implode(',', $scope),
    ];
    foreach ($params as $key => $value) {
      $this->assertContains($key . '=' . urlencode($value), $loginUrl);
    }
  }

  public function testLogoutURL()
  {
    $app = new FacebookApp('123', 'foo_app_secret');
    $helper = new FacebookRedirectLoginHelper($app, $this->persistentDataHandler);

    $logoutUrl = $helper->getLogoutUrl('foo_token', self::REDIRECT_URL);
    $expectedUrl = 'https://www.facebook.com/logout.php?';
    $this->assertTrue(strpos($logoutUrl, $expectedUrl) === 0, 'Unexpected base logout URL returned from getLogoutUrl().');

    $params = [
      'next' => self::REDIRECT_URL,
      'access_token' => 'foo_token',
    ];
    foreach ($params as $key => $value) {
      $this->assertTrue(
        strpos($logoutUrl, $key . '=' . urlencode($value)) !== false
      );
    }
  }

  public function testAnAccessTokenCanBeObtainedFromRedirect()
  {
    $this->persistentDataHandler->set('state', 'foo_state');
    $_GET['state'] = 'foo_state';
    $_GET['code'] = 'foo_code';

    $response = m::mock('Facebook\FacebookResponse');
    $response
      ->shouldReceive('getDecodedBody')
      ->once()
      ->andReturn([
          'access_token' => 'access_token_from_code',
          'expires' => 555,
        ]);
    $client = m::mock('Facebook\FacebookClient');
    $client
      ->shouldReceive('sendRequest')
      ->with(m::type('Facebook\FacebookRequest'))
      ->once()
      ->andReturn($response);

    $app = new FacebookApp('123', 'foo_app_secret');
    $helper = new FacebookRedirectLoginHelper($app, $this->persistentDataHandler);

    $accessToken = $helper->getAccessToken($client, self::REDIRECT_URL);

    $this->assertInstanceOf('Facebook\AccessToken', $accessToken);
    $this->assertEquals('access_token_from_code', (string) $accessToken);
  }
  
  public function testACustomCsprsgCanBeInjected()
  {
    $app = new FacebookApp('123', 'foo_app_secret');
    $fooPrsg = new FooPseudoRandomStringGenerator();
    $helper = new FacebookRedirectLoginHelper($app, $this->persistentDataHandler, null, $fooPrsg);

    $loginUrl = $helper->getLoginUrl(self::REDIRECT_URL);

    $this->assertContains('state=csprs123', $loginUrl);
  }

  public function testThePseudoRandomStringGeneratorWillAutoDetectCsprsg()
  {
    $app = new FacebookApp('123', 'foo_app_secret');
    $helper = new FacebookRedirectLoginHelper($app, $this->persistentDataHandler);
    $this->assertInstanceOf(
      'Facebook\PseudoRandomString\PseudoRandomStringGeneratorInterface',
      $helper->getPseudoRandomStringGenerator()
    );
  }

}
