<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = $_REQUEST;
$subdomain = 'new592c74f1e488b';
$errors = [];
$success = [];



if (!empty($_REQUEST)) {
    $auth = auth();
    if ($auth->response->auth) {
        $errors[] = 'Ошибка авторизации';
    }
    $contactResult = contactCreate($data['name'], $data['phone'], $data['email'], $data['comment']);
    $leadResult = leadCreate();
    $taskResult = taskCreate($leadResult->response->leads->add[0]->id);
    var_dump($taskResult);
}


require 'template.php';

function leadCreate()
{
    global $subdomain;
    $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/leads/set';
    $leads['request']['leads']['add']=array(

        array(
            'name'=>'Deal for sailing a horse',
            'status_id'=>2747196,
            'price'=>123,

        )
    );

    $out = curlPostRequest($link, $leads);

    return handlerResponse($out);
}

function contactCreate($name, $phone, $email, $comment)
{
    global $subdomain;
    $link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
    $contacts['request']['contacts']['add']=array(
        array(
            'name'=>$name,
            'phone' => $phone,
            'custom_fields'=>array(
                array(
                    #Телефоны
                    'id'=>1, #Уникальный индентификатор заполняемого дополнительного поля
                    'values'=>array(
                        array(
                            'value'=>$phone,
                            'enum'=>'MOB' #Мобильный
                        ),
                    )
                ),
                array(
                    #E-mails
                    'id'=>2,
                    'values'=>array(
                        array(
                            'value'=>$email,
                            'enum'=>'WORK', #Рабочий
                        ),
                    )
                ),
                array(
                    'id'=>3,
                    'values'=>array(
                        array(
                            'value'=>$comment,
                            'enum'=>'COMMENT', #Рабочий
                        ),
                    )
                ),
            )
        )
    );

    $out = curlPostRequest($link, $contacts);

    return handlerResponse($out);
}

function taskCreate($elementId)
{
    global $subdomain;
    $link = 'https://' . $subdomain . '.amocrm.ru/private/api/v2/json/tasks/set';
    $tasks['request']['tasks']['add'] = array(
        #Привязываем к сделке
        array(
            'element_id' => $elementId, #ID сделки
            'element_type' => 2, #Показываем, что это - сделка, а не контакт
            'task_type' => 1, #Звонок
            'text' => 'My First Task',
            'responsible_user_id' => 109999,
            'complete_till' => 1375285346
        ),
    );

    $out = curlPostRequest($link, $tasks);

    return handlerResponse($out);
}

function auth()
{
    global $subdomain;
    $link = 'https://' . $subdomain . '.amocrm.ru/private/api/auth.php?type=json';
    $user = array(
        'USER_LOGIN' => 'test123123@gmail.com', #Ваш логин (электронная почта)
        'USER_HASH' => 'c7c6bee13f3e6a78d62e15d396124abc' #Хэш для доступа к API (смотрите в профиле пользователя)
    );
    $out = curlPostRequest($link, $user);
    return handlerResponse($out);
}

function handlerResponse($data)
{
    return json_decode($data);
}

function curlPostRequest($url, $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

    $out = curl_exec($curl);
//    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    return $out;
}
