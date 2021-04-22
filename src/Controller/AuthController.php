<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController
{
    /**
     * @Route("/generate")
     */
    public function test(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $plainPassword = $request->get('pass', '');

        echo $plainPassword . "\n";
        echo $encoder->encodePassword($user, $plainPassword);

        die();
    }
}
