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
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setRole('admin');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));
        $admin->setDescription('Admin of the application');
        $admin->setJob('Gamer');
        $manager->persist($admin);

        $artist = new User();
        $artist->setArtistName('Fire Burner');
        $artist->setEmail('elneris@gmail.com');
        $artist->setRoles(['ROLE_ARTIST']);
        $artist->setRole('artist');
        $artist->setUrlAvatar('pyromaniac.png');
        $artist->setPassword($this->passwordEncoder->encodePassword(
            $artist,
            'user'
        ));
        $artist->setDescription('L\'artiste de cirque peut être un clown, un jongleur, un acrobate, un trapéziste... Il donne des représentations de ses numéros face à un public qu\'il doit émouvoir, émerveiller, impressionner, faire rire ou trembler. Il s\'entraîne quotidiennement pour parfaire sa technique et mettre au point de nouveaux numéros.
                              Auteur et interprète de ses numéros, l\'artiste de cirque traditionnel fait partie d\'une troupe comme spécialiste d\'une discipline : l\'équilibre, la jonglerie, l\'acrobatie, la magie, etc. Il dispose de nombreux accessoires : costumes et ballons, masses de jonglage, cordes ou fils durs.
                              Généralement sans animaux, le nouveau cirque intègre pour la durée d\'un spectacle des artistes polyvalents, associant aux techniques du cirque traditionnel celles du théâtre ou de la danse. Ces intermittents très qualifiés deviennent parfois membres permanents d\'une compagnie.');
        $artist->setJob('pyromaniac');
        $manager->persist($artist);

        $artist = new User();
        $artist->setArtistName('Magic Blood');
        $artist->setEmail('pascal@gmail.com');
        $artist->setRoles(['ROLE_ARTIST']);
        $artist->setRole('artist');
        $artist->setUrlAvatar('magician.png');
        $artist->setPassword($this->passwordEncoder->encodePassword(
            $artist,
            'user'
        ));
        $artist->setDescription('L\'artiste de cirque peut être un clown, un jongleur, un acrobate, un trapéziste... Il donne des représentations de ses numéros face à un public qu\'il doit émouvoir, émerveiller, impressionner, faire rire ou trembler. Il s\'entraîne quotidiennement pour parfaire sa technique et mettre au point de nouveaux numéros.
                              Généralement sans animaux, le nouveau cirque intègre pour la durée d\'un spectacle des artistes polyvalents, associant aux techniques du cirque traditionnel celles du théâtre ou de la danse. Ces intermittents très qualifiés deviennent parfois membres permanents d\'une compagnie.');
        $artist->setJob('pyromaniac');
        $manager->persist($artist);



        $manager->flush();
    }
}
