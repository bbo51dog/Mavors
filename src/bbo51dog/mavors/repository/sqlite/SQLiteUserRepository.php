<?php

namespace bbo51dog\mavors\repository\sqlite;

use bbo51dog\mavors\entity\User;
use bbo51dog\mavors\MavorsCore;
use bbo51dog\mavors\repository\RepositoryException;
use bbo51dog\mavors\repository\UserRepository;
use Exception;
use SQLite3;
use function array_key_exists;
use function strtolower;

class SQLiteUserRepository implements UserRepository{

    /** @var SQLite3 */
    private $db;

    /** @var User[] */
    private $users = [];

    public function __construct(MavorsCore $core){
        $this->db = new SQLite3($core->getPlugin()->getDataFolder() . MavorsCore::SQLITE_FILE_NAME);
        $this->createTable();
        $this->prepareUserData();
    }

    public function close(): void{
        foreach($this->users as $user){
            $this->update($user);
        }
        $this->db->close();
    }

    public function exists(string $name): bool{
        return array_key_exists(strtolower($name), $this->users);
    }

    public function update(User $user): void{
        try{
            $stmt = $this->db->prepare(
                <<<SQL
                UPDATE users
                SET money = :money
                WHERE name = :name
                SQL
            );
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':money', $user->getMoney());
            $stmt->execute();
            $stmt->close();
        }catch(Exception $exception){
            throw new RepositoryException($exception);
        }
    }

    public function findByName(string $name): ?User{
        return $this->users[strtolower($name)];
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array{
        return $this->users;
    }

    public function register(User $user): void{
        try{
            $stmt = $this->db->prepare(
                <<<SQL
                INSERT INTO users (name, money) VALUES(:name, :money)
                SQL
            );
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':money', $user->getMoney());
            $stmt->execute();
            $stmt->close();
        }catch(Exception $exception){
            throw new RepositoryException($exception);
        }
        $this->users[strtolower($user->getName())] = $user;
    }

    public function fetch(string $name): void{
        $user = $this->users[strtolower($name)];
        try{
            $stmt = $this->db->prepare(
                <<<SQL
                SELECT * FROM users WHERE name = :name
                SQL
            );
            $stmt->bindValue(':name', $user->getName());
            $result = $stmt->execute();
            $data = $result->fetchArray();
            $stmt->close();
        }catch(Exception $exception){
            throw new RepositoryException($exception);
        }
        $user->setMoney($data['money']);
    }

    private function prepareUserData(): void{
        try{
            $result = $this->db->query(
                <<<SQL
                SELECT * FROM users
                SQL
            );
            while($data = $result->fetchArray()){
                $user = new User($data['name']);
                $user->setMoney($data['money']);
                $this->users[$user->getName()] = $user;
            }
        }catch(Exception $exception){
            throw new RepositoryException($exception);
        }
    }

    private function createTable(): void{
        try{
            $this->db->exec(
                <<<SQL
				CREATE TABLE IF NOT EXISTS users(
				    name TEXT NOT NULL PRIMARY KEY,
				    money INT NOT NULL,
				)
				SQL);
        }catch(Exception $exception){
            throw new RepositoryException($exception);
        }
    }
}