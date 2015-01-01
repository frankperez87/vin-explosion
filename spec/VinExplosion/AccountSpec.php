<?php

namespace spec\VinExplosion;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('username', 'password');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('VinExplosion\Account');
    }

    function it_should_have_a_username()
    {
        $this->getUsername()->shouldReturn('username');
    }

    function it_should_have_a_password()
    {
        $this->getPassword()->shouldReturn('password');
    }

    function it_should_have_an_authentication_string()
    {
        $this->getAuthenticationString()->shouldReturn('username:password');
    }
}
