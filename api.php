<?php
// URI = /project/apiName/resourceNae/operation<create,read,update,delete>/?id=<id>
$request = $_SERVER['REQUEST_URI'];
list($root, $proj, $apiRoot, $resource, $operation) = explode("/", $request);

switch ($resource) {
    case 'character' :
        require __DIR__ . '/character.php';
        switch ($operation) {
            case 'readCharacters' :
                $idx = htmlspecialchars($_GET["idx"]);
                $cnt = htmlspecialchars($_GET["cnt"]);
                $data = readCharacters($idx, $cnt);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Character not found");
                }
                break;
            case 'create' :
                $pname = htmlspecialchars($_POST["pname"]);
                $race = htmlspecialchars($_POST["race"]);
                $guild = htmlspecialchars($_POST["guild"]);
                $id = htmlspecialchars($_POST["id"]);
                                    
                $data = insert($pname, $race, $guild, $id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Character not created");
                }
                break;
            case 'update' :
                $pname = htmlspecialchars($_POST["pname"]);
                $race = htmlspecialchars($_POST["race"]);
                $guild = htmlspecialchars($_POST["guild"]);
                $id = htmlspecialchars($_POST["id"]);

                $data = update($pname, $race, $guild, $id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Character not updated");
                }
                break;
            case 'delete' :
                $id = htmlspecialchars($_GET["id"]);
                $data = deleteCharacter($id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Character not Deleted");
                }
                break;
            case 'search' :
                $idx = htmlspecialchars($_GET["idx"]);
                $cnt = htmlspecialchars($_GET["cnt"]);
                $pstr = htmlspecialchars($_GET["pstr"]);
                $data = searchCharacters($idx, $cnt, $pstr);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Searched not performed");
                }
                break;
            case 'read' :
                $id = htmlspecialchars($_GET["id"]);
                $data = read($id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("read not performed");
                }

                break;
                case 'sortCharDown' :
                    $idx = htmlspecialchars($_GET["idx"]);
                    $cnt = htmlspecialchars($_GET["cnt"]);
                    $data = readCharactersDown($idx, $cnt);
                    if($data){
                        sendResponseData($data);
                    } else {
                        sendErrorResponse("Character not found");
                    }
                    break;
                case 'sortRaceDown' :
                    $idx = htmlspecialchars($_GET["idx"]);
                    $cnt = htmlspecialchars($_GET["cnt"]);
                    $data = readRaceDown($idx, $cnt);
                    if($data){
                        sendResponseData($data);
                    } else {
                        sendErrorResponse("Character not found");
                    }
                    break;
                case 'sortRaceUp' :
                    $idx = htmlspecialchars($_GET["idx"]);
                    $cnt = htmlspecialchars($_GET["cnt"]);
                    $data = readRace($idx, $cnt);
                    if($data){
                        sendResponseData($data);
                    } else {
                        sendErrorResponse("Character not found");
                    }
                    break;
                case 'sortClassDown' :
                    $idx = htmlspecialchars($_GET["idx"]);
                    $cnt = htmlspecialchars($_GET["cnt"]);
                    $data = readClassDown($idx, $cnt);
                    if($data){
                        sendResponseData($data);
                    } else {
                        sendErrorResponse("Character not found");
                    }
                    break;
                case 'sortClassUp' :
                    $idx = htmlspecialchars($_GET["idx"]);
                    $cnt = htmlspecialchars($_GET["cnt"]);
                    $data = readClass($idx, $cnt);
                    if($data){
                        sendResponseData($data);
                    } else {
                        sendErrorResponse("Character not found");
                    }
                    break;
                default:
                    send404Response("Operation not found");
                    break;
        }        
        break;
    case 'item' :
     require __DIR__ . '/item.php';
        switch ($operation){
            case 'readItems' :
                $data = readItems();
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Items not found");
                }
                break;
            case 'create':
                $iname = htmlspecialchars($_GET["iname"]);
                $id = htmlspecialchars($_GET["id"]);
                $data = insert($iname, $id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Item not updated");
                }
                break;
            case 'update':
                $iname = htmlspecialchars($_GET["iname"]);
                $id = htmlspecialchars($_GET["id"]);
                $data = update($iname, $id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Item not updated");
                }
                break;
            case 'delete' :
                $id = htmlspecialchars($_GET["id"]);
                $data = deleteItem($id);
                if($data){
                    sendResponseData($data);
                } else {
                    sendErrorResponse("Item not Deleted");
                }
                break;
        }
        break;
    default:
        send404Response("API not found");
        break;
}

function sendResponseData($data){
    echo json_encode($data);
}
function send404Response($msg){
    http_response_code(404);
    echo $msg;
}
function sendErrorResponse($msg){
    http_response_code(500);
    echo $msg;
}
?>