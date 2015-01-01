<?php

namespace spec\VinExplosion;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use VinExplosion\Account;

class LookupSpec extends ObjectBehavior
{
    function let(Account $account)
    {
        $this->beConstructedWith($account);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('VinExplosion\Lookup');
    }

    function it_should_by_default_return_the_response_in_json_format()
    {
        $this->getResponseType()->shouldReturn('application/json');
    }

    function it_should_allow_you_to_set_the_response_format_in_json()
    {
        $this->setResponseType('application/json');
        $this->getResponseType()->shouldReturn('application/json');
    }

    function it_should_allow_you_to_set_the_response_format_in_xml()
    {
        $this->setResponseType('application/xml');
        $this->getResponseType()->shouldReturn('application/xml');
    }

    function it_should_only_allow_json_and_xml_type_formats()
    {
        $this->shouldThrow(new \InvalidArgumentException('Invalid response type of application/zip provided.'))->duringSetResponseType('application/zip');
    }

    function it_auto_corrects_common_vin_entry_mistakes_by_users_by_default()
    {
        $this->getAutoCorrectionStatus()->shouldReturn("true");
    }

    function it_allows_you_to_turn_off_auto_correction_on_vins()
    {
        $this->setAutoCorrectionStatus(false);
        $this->getAutoCorrectionStatus()->shouldReturn('false');
    }

}
