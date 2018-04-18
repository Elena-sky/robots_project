<?php

namespace App\Robot;

class RobotForUrl extends aRobotForUrl
{
    protected $rules = ['statusCode' => 200, 'length' => 32000];
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
        ],
        'robot' => [
            'ok' => ['state' => 'Файл robots.txt присутствует', 'recommendation' => 'Доработки не требуются'],
            'error' => ['state' => 'Файл robots.txt отсутствует',
                'recommendation' => 'Программист: Создать файл robots.txt и разместить его на сайте'],
        ],
        'length' => [
            'ok' => ['state' => 'Размер файла robots.txt составляет __, что находится в пределах допустимой нормы',
                'recommendation' => 'Доработки не требуются'],
            'error' => ['state' => 'Размера файла robots.txt составляет __, что превышает допустимую норму',
                'recommendation' => 'Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. 
                Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб'],
        ]
    ];
    protected $tests = [
        1 => 'Проверка наличия файла robots.txt',
        10 => 'Проверка размера файла robots.txt',
        12 => 'Проверка кода ответа сервера для файла robots.txt'
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

    protected function checkLength($header, $content)
    {
        $length = $this->getSize($header, $content);
        if ($length <= $this->rules['length']) {
            $this->result['length'] = ['ok' => $this->availableResults['length']['ok']];
            $this->result['length']['ok']['state'] =
                str_replace('__', round($length / 1000, 1) . ' кб', $this->result['length']['ok']['state']);
        } else {
            $this->result['length'] = ['error' => $this->availableResults['length']['error']];
            $this->result['length']['error']['state'] =
                str_replace('__', round($length / 1000, 1) . ' кб', $this->result['length']['error']['state']);
        }
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
        if (array_key_exists('length', $this->result)) {
            $result[10] = ['test' => $this->tests[10]];
            $result[10] =
                array_key_exists('ok', $this->result['length']) ?
                    array_merge($result[10],
                        ['status' => 'Оk', 'state' => $this->result['length']['ok']['state'],
                            'recommendation' => $this->result['length']['ok']['recommendation']]
                    )
                    :
                    array_merge($result[10],
                        ['status' => 'Ошибка', 'state' => $this->result['length']['error']['state'],
                            'recommendation' => $this->result['length']['error']['recommendation']]
                    );
        }

        return $result;
    }

}