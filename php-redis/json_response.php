<?php

$var = file_get_contents('php://input');

$obj = new \stdClass();

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $obj->method = "GET";
    $obj->data = print_r($_REQUEST, true);
    $obj->more_data = $var;
    $obj->character = "爱";
    $obj->pinyin = "ài";
    $obj->examples[] = [
        "我爱弟弟和妹妹",
        "它爱不爱喝牛奶？",
        "猫和狗都很可爱。",
        "我的孩子爱英语歌。",
        "你爱不爱跳舞？"
    ];

}
else if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $obj->method = "POST";
    $obj->data = print_r($_REQUEST, true);
    $obj->more_data = $var;
    $obj->character = "八";
    $obj->pinyin = "bā";
    $obj->examples[] = [
        "他的电话号码是八七六五吗？",
        "他们星期六会八点吃晚饭。",
        "我有八毛钱。"
    ];

}
else if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $obj->method = "PUT";
    $obj->data = print_r($_REQUEST, true);
    $obj->more_data = $var;
    $obj->character = "爸爸";
    $obj->pinyin = "bàba";
    $obj->examples[] = [
        "他是我爸爸。",
        "我是爸爸。",
        "我们都爱爸爸。"
    ];
}
else if($_SERVER['REQUEST_METHOD'] == 'PATCH')
{
    $obj->method = "PATCH";
    $obj->data = print_r($_REQUEST, true);
    $obj->more_data = $var;
    $obj->character = "杯子";
    $obj->pinyin = "bēizi";
    $obj->examples[] = [
        "请给我们五个杯子。",
        "杯子里没有水。",
        "这个女孩没有三角形的杯子。"
    ];
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $obj->method = "DELETE";
    $obj->data = print_r($_REQUEST, true);
    $obj->more_data = $var;
    $obj->character = "茶";
    $obj->pinyin = "chá";
    $obj->examples[] = [
        "我也喝茶。",
        "你喝茶吗？",
        "我喜欢喝茶和可乐。"
    ];
}

echo json_encode($obj);