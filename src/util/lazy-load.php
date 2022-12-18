<?php


function topic_lazy_load($offset, $length) : string {

    require_once __DIR__."/../Model/TopicModel.php";

    $topics = TopicRepository::getTopics($offset, $length);


    ob_start();
    foreach ($topics as $topic) {
        require __DIR__."/../View/Template/topic/preview.php";
    }
    return ob_get_clean();

}

function user_topic_lazy_load($offset, $length, $userId) : string {

    require_once __DIR__."/../Model/TopicModel.php";

    $topics = TopicRepository::getTopicsByOwnerId(intval($userId), $offset, $length);


    ob_start();
    foreach ($topics as $topic) {
        require __DIR__."/../View/Template/topic/preview.php";
    }
    return ob_get_clean();

}

if ( isset($_GET['func']) && isset($_GET['offset']) && isset($_GET['length']) ) {
    $lazy_func = $_GET['func'];
    $lazy_offset = $_GET['offset'];
    $lazy_length = $_GET['length'];
    $lazy_id = $_GET['id'] ?? null;

    switch ( $lazy_func ) {
        case 'topic':
            echo topic_lazy_load($lazy_offset, $lazy_length);
            break;
        case 'user-topic':
            if ( $lazy_id == null ) {
                return;
            }
            echo user_topic_lazy_load($lazy_offset, $lazy_length, $lazy_id);
            break;
        default:
            echo "Error";
    }
}

?>
