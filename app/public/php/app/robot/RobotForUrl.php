<?php

namespace App\Robot;

class RobotForUrl extends aRobotForUrl
{
    protected $rules = ['statusCode' => 200];
    protected $headerStatus;
    protected $result = [];
    protected $availableResults = [
        'statusCode' => [
            'ok' => ['state' => 'Файл robots.txt отдаёт код ответа сервера 200',
                'recommendation' => 'Доработки не требуются'],
            'error' => ['state' => 'При обращении к файлу robots.txt сервер возвращает код ответа: ',
                'recommendation' => 'Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет 
                обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер 
                возвращает код ответа 200'],
        ]
    ];
    protected $tests = [
        1 => 'Проверка наличия файла robots.txt',
    ];


    public function __construct($url)
    {
        parent::__construct($url);
        $this->run();
    }

    protected function run()
    {
        if($this->makeRequest()){
            $this->headerStatus = $this->getHeaderWithStatus();
            $status = $this->getStatusCode($this->headerStatus);
            if ($status < 300 && $this->getRobot()) {
                $this->result['robot'] = ['ok' => $this->availableResults['robot']['ok']];
                return $this;
            }
            $this->result['robot'] = ['error' => $this->availableResults['robot']['error']];
        }
        return $this;
    }


    protected function checkStatusCode($header)
    {
        $code = $this->getStatusCode($header);
        if ($code == $this->rules['statusCode']) {
            $this->result['statusCode'] = ['ok' => $this->availableResults['statusCode']['ok']];
        } else {
            $this->result['statusCode'] = ['error' => $this->availableResults['statusCode']['error']];
            $this->result['statusCode']['error']['state'] .= $code;
        }
        return $this;
    }

    protected function formatResult()
    {
        $result = [];
        if (array_key_exists('statusCode', $this->result)) {
            $result[12] = ['test' => $this->tests[12]];
            $result[12] =
                array_key_exists('ok', $this->result['statusCode']) ?
                    array_merge($result[12],
                        ['status' => 'Оk', 'state' => $this->result['statusCode']['ok']['state'],
                            'recommendation' => $this->result['statusCode']['ok']['recommendation']]
                    )
                    :
                    array_merge($result[12],
                        ['status' => 'Ошибка', 'state' => $this->result['statusCode']['error']['state'],
                            'recommendation' => $this->result['statusCode']['error']['recommendation']]
                    );
        }
        if (array_key_exists('robot', $this->result)) {
            $result[1] = ['test' => $this->tests[1]];
            $result[1] =
                array_key_exists('ok', $this->result['robot']) ?
                    array_merge($result[1],
                        ['status' => 'Оk', 'state' => $this->result['robot']['ok']['state'],
                            'recommendation' => $this->result['robot']['ok']['recommendation']]
                    )
                    :
                    array_merge($result[1],
                        ['status' => 'Ошибка', 'state' => $this->result['robot']['error']['state'],
                            'recommendation' => $this->result['robot']['error']['recommendation']]
                    );
        } else {
            return $result;
        }

        return $result;
    }

}