<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST,OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");

if ('OPTIONS' === $_SERVER['REQUEST_METHOD']) {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: *');
  header('Access-Control-Allow-Headers: *');
  header('Access-Control-Max-Age: 1728000');
  die();
}

include 'functions.php';
$password = "123";
$dbFolder = "db";
$dbExtension = 'sqlite';

$request = json_decode(trim(file_get_contents("php://input")), true);


$response = [
  'API' => false,
  'message' => '',
  'database' => '',
  'table' => '',
  'rows' => '',
  'key' => '',
  'value' => '',
];

/////////////// ROUTES ////////////////
/////////////// ROUTES ////////////////
/////////////// ROUTES ////////////////


if (!isset($request['password'])) {
  if (!empty($_GET)) {
    $response = [
      'request' => $request,
      'message' => 'no password',
    ];
    echo json_encode($response);
    exit;
  }
}

if (isset($_GET['login'])) {
  if ($password === $request['password']) {
    $response = [
      'API' => true,
      'data' => [
        'login' => true,
        'password' => $password,
      ],
    ];
  } else {
    $response = [
      'API' => true,
      'data' => [
        'login' => false,
      ],
    ];
  }
}


if (isset($_GET['getDatabases'])) {
  $response = [
    'API' => true,
    'databases' => getDatabases(),
  ];
}

if (isset($_GET['getTables'])) {
  $response = [
    'API' => true,
    'tables' => getTables(),
  ];
}


if (isset($_GET['getRows'])) {
  $response = [
    'API' => true,
    'rows' => getRows(),
  ];
}

if (isset($_GET['updateValue'])) {
  $response = [
    'API' => true,
    'message' => updateValue(),
  ];
}



if (isset($_GET['deleteRow'])) {
  $response = [
    'API' => true,
    'message' => deleteRow(),
  ];
}


if (isset($_GET['saveNewRow'])) {
  // pprint($request);
  $response = [
    'API' => true,
    'message' => saveNewRow(),
  ];
}


if (isset($_GET['saveNewDatabase'])) {
  // pprint($request);
  $response = [
    'API' => true,
    'message' => saveNewDatabase(),
  ];
}


if (isset($_GET['getTableInfo'])) {
  // pprint($request);
  $response = [
    'API' => true,
    'data' => getTableInfo(),
  ];
}

if (isset($_GET['saveNewTable'])) {
  // pprint($request);
  $response = [
    'API' => true,
    'message' => saveNewTable(),
  ];
}



//
// OUTPUT
//

// pprint($response, 'response');
// exit;
if ($response['API'] === true) {
  unset($response['API']);

  echo json_encode($response);
  exit;
}








/////////////////////////////////    PHP    FUNCTIONS    ///////////////////////////
/////////////////////////////////    PHP    FUNCTIONS    ///////////////////////////
/////////////////////////////////    PHP    FUNCTIONS    ///////////////////////////

function saveNewTable() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $data = $request['data'];
  $rows = $request['data']['rows'];
  $tableName = $request['data']['tableName'];

  $db = new SQLite3($dbFolder . "/" . $database);
  $db->exec("CREATE TABLE IF NOT EXISTS $tableName (id INTEGER PRIMARY KEY AUTOINCREMENT)");
  $db->exec("ALTER TABLE $tableName ADD COLUMN date DATETIME DEFAULT CURRENT_TIMESTAMP");

  // create a columns
  foreach ($rows as $row) {
    $name = $row['name'];
    $type = $row['type'];
    $null = $row['null'];
    $defa = $row['defa'];
    $db->exec("ALTER TABLE $tableName ADD COLUMN $name $type ");
  }
  return true;
}

function getTableInfo() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $table = $request['table'];
  $db = new SQLite3($dbFolder . "/" . $database);

  $stmt = $db->prepare("PRAGMA table_info($table);");
  $result = $stmt->execute();

  $array = array();
  $array['tableCount'] = '';
  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $array['tableInfo'][] = $row;
  }

  $stmt = $db->prepare("SELECT COUNT(*) as count FROM $table");
  $result = $stmt->execute();
  // pprint($result->fetchArray(SQLITE3_ASSOC));
  $array['tableCount'] = $result->fetchArray(SQLITE3_ASSOC)['count'];
  if ($array) {
    return $array;
  } else {
    return 'database error';
  }
}

function saveNewDatabase() {
  global $request, $dbFolder;
  // pprint($request); 
  $database = $request['data'];
  if (!is_file($dbFolder . "/" . $database . ".sqlite")) {
    $db = new SQLite3($dbFolder . "/" . $database . ".sqlite");
    return true;
  } else {
    return 'file exists';
  }
}


function saveNewRow() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $table = $request['table'];
  $data = $request['data'];

  if (isset($data['date']) && $data['date'] === '') {
    $data['date'] = date("Y-m-d H:i:s");
  }

  // make strings from array
  $columns = '(' . implode(',', array_keys($data)) . ')';
  $values = "('" . implode("','", $data) . "')";

  $db = new SQLite3($dbFolder . "/" . $database);
  // insert into DB
  $stmt = $db->prepare("INSERT INTO $table" . $columns . " VALUES" . $values);

  $result = $stmt->execute();
  if ($result) {
    return true;
  } else {
    return 'database error';
  }
}


function deleteRow() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $table = $request['table'];
  $row = $request['row'];
  $db = new SQLite3($dbFolder . "/" . $database);
  $stmt = $db->prepare("DELETE FROM $table WHERE id=$row  ");
  $result = $stmt->execute();
  if ($result) {
    return true;
  } else {
    return 'database error';
  }
}



function updateValue() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $table = $request['table'];
  $id = $request['id'];
  $row = $request['row'];
  $value = $request['value'];

  $db = new SQLite3($dbFolder . "/" . $database);
  $stmt = $db->prepare("UPDATE $table SET $row='$value' WHERE id=$id  ");
  $result = $stmt->execute();
  if ($result) {
    return true;
  } else {
    return 'database error';
  }
}

/**
 *
 * LOGIN
 *
 */
function login() {
  global $request, $password;
  if (isset($_GET['login'])) {
    if ($password !== $request['password']) {
      return false;
    } else {
      return getDatabases();
    }
  }
}





/**
 *
 * TABLE CONTENT
 *
 */
function getRows() {
  global $request, $dbFolder, $response;
  // pprint($request);
  $database = $request['database'];
  $table = $request['table'];

  $db = new SQLite3($dbFolder . "/" . $database);
  $stmt = $db->prepare("SELECT * FROM $table");
  $results = $stmt->execute();
  $array = array();
  while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $array[] = $row;
  }
  return $array;
}


function getTables() {
  global $request, $dbFolder;
  // pprint($request);
  $database = $request['database'];
  $db = new SQLite3($dbFolder . "/" . $database);

  $stmt = $db->prepare("SELECT * FROM sqlite_master WHERE type='table';");
  $results = $stmt->execute();
  $array = array();
  while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $array[] = [
      'name' => $row['name'],
      'database' => $database,
      'full' => $row,
    ];
  }
  return $array;
}



function getDatabases() {
  global $dbFolder, $dbExtension;
  $files = glob($dbFolder . "/*." . $dbExtension);
  $array = array();
  foreach ($files as $file) {
    $file = str_replace($dbFolder . '/', '', $file);
    $name = str_replace('.' . $dbExtension, '', $file);
    $array[] = [
      'name' => $name,
      'file' => $file
    ];
  }
  return $array;
}


?>

 