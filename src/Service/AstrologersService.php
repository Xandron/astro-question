<?php


namespace App\Service;

use App\Repository\AstrologersRepository;

class AstrologersService
{
    /**
     * @var AstrologersRepository
     */
    private AstrologersRepository $astrologersRepository;

    /**
     * AstrologersServiceService constructor.
     *
     * @param AstrologersRepository $astrologersRepository
     */
    public function __construct(AstrologersRepository $astrologersRepository)
    {
        $this->astrologersRepository = $astrologersRepository;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->mapAstrologersForList($this->astrologersRepository->findAllWithFilter());
    }


    /**
     * @param int $id
     * @return array
     */
    public function getDetail(int $id): array
    {
        return $this->astrologersRepository->findByIdWithFilter($id);
    }

    /**
     * @param array $astrologers
     * @return array
     */
    private function mapAstrologersForList(array $astrologers): array
    {
        $list = [];
        $name = '';
        $i = 0;

        foreach ($astrologers as $item) {
            if ($item['name'] != $name) {
                $i++;
                $name = $item['name'];
                $list [$i] = [
                    'name' => $item['name'],
                    'photo' => $item['photo'],
                    'services' => [
                        $item['service_name']
                    ]
                ];
            }

            $list[$i]['services'][] = $item['service_name'];
        }

        return $list;
    }

}