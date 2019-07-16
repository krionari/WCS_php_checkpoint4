<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setArtistName('Krionari');
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN, ROLE_ARTIST, ROLE_USER']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));
        $admin->setDescription('Admin of the application');
        $admin->setJob('Gamer');
        $manager->persist($admin);

        $manager->flush();

        $user = new User();
        $user->setArtistName('Fire Burner');
        $user->setEmail('elneris@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $user->setDescription('L\'artiste de cirque peut être un clown, un jongleur, un acrobate, un trapéziste... Il donne des représentations de ses numéros face à un public qu\'il doit émouvoir, émerveiller, impressionner, faire rire ou trembler. Il s\'entraîne quotidiennement pour parfaire sa technique et mettre au point de nouveaux numéros.
                              Auteur et interprète de ses numéros, l\'artiste de cirque traditionnel fait partie d\'une troupe comme spécialiste d\'une discipline : l\'équilibre, la jonglerie, l\'acrobatie, la magie, etc. Il dispose de nombreux accessoires : costumes et ballons, masses de jonglage, cordes ou fils durs.
                              Généralement sans animaux, le nouveau cirque intègre pour la durée d\'un spectacle des artistes polyvalents, associant aux techniques du cirque traditionnel celles du théâtre ou de la danse. Ces intermittents très qualifiés deviennent parfois membres permanents d\'une compagnie.');
        $user->setJob('pyromaniac');
        $manager->persist($user);

        $manager->flush();
    }
}
