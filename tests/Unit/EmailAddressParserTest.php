<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\EmailAddressParser;

class EmailAddressParserTest extends TestCase
{
  /**
   * @test
   */
  public function it_returns_an_email_address_from_an_rfc822_string()
  {
    $addressString = 'Bob <bob@test.com>';

    $result = EmailAddressParser::parse($addressString);

    $this->assertEquals('bob@test.com', $result);
  }
}
