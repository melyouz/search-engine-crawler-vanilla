<?php


namespace App\Infrastructure\Persistence\Mysql\Repository;


use App\Domain\Dto\DomainHitCount;
use App\Domain\Model\Hit;
use App\Domain\Model\Hit\HitId;
use App\Domain\Model\Hit\SearchEngineName;
use App\Domain\Repository\HitRepositoryInterface;
use App\Infrastructure\Persistence\Mysql\Connection;
use Symfony\Component\Uid\Uuid;

class MysqlHitRepository implements HitRepositoryInterface
{
    private Connection $mysqlConnection;

    public function __construct(Connection $mysqlConnection)
    {
        $this->mysqlConnection = $mysqlConnection;
    }

    public function allGroupedByDomain(SearchEngineName $searchEngineName): array
    {
        $query = 'SELECT domain, count(id) AS count FROM hit WHERE search_engine=? GROUP BY domain ORDER BY count DESC';
        $result = $this->mysqlConnection->query($query, [$searchEngineName->value()]);

        return array_map(function ($item) {
            return DomainHitCount::fromArray($item);
        }, $result);
    }

    public function save(Hit $hit): void
    {
        $query = 'INSERT INTO hit(id, search_engine, searched_term, `domain`, created_at) VALUES (?, ?, ?, ?, ?)';
        $this->mysqlConnection->insert($query, [$hit->getId(), $hit->getSearchEngine(), $hit->getSearchedTerm(), $hit->getDomain(), $hit->getCreatedAt()->format('Y-m-d H:i:s')]);
    }

    public function nextIdentity(): HitId
    {
        return HitId::fromString((string)Uuid::v4());
    }
}