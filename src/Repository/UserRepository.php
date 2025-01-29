<?php
namespace App\Repository;

use App\Entity\User;
use App\Utils\EntityMapper;
use Mns\Buggy\Core\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * Find all users.
     * @return array
     */
    public function findAll()
    {
        $users = $this->getConnection()->query("SELECT * FROM mns_user");
        return EntityMapper::mapCollection(User::class, $users->fetchAll());
    }

    /**
     * Find all users.
     * @param int $id
     * @return object
     */
    public function find(int $id)
    {
        $sql = "SELECT * FROM mns_user WHERE id = :id";

        $query = $this->getConnection()->prepare($sql);
        $query->execute(['id' => $id]);
        $user = $query->fetch();
        return $user ? EntityMapper::map(User::class, $user) : null;
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM mns_user WHERE email = :email";
        
        $query = $this->getConnection()->prepare($sql);
        $result = $query->fetch();
        // Retourne un objet User ou null si l'utilisateur n'existe pas
        return $result ? EntityMapper::map(User::class, $result) : null;
    }

    public function insert(array $data = array())
    {
        $sql = "INSERT INTO mns_user (lastname, firstname, email, password, isadmin) VALUES (:lastname, :firstname, :email, :password, :isadmin)";
        $query = $this->getConnection()->prepare($sql);
        $query->execute($data);
        return $this->getConnection()->lastInsertId();
    }
}