<?//данный файл для подключения к базам данных

// переменные для подключения:
$dbName = "diplom";//имя базы данных
$dbUsername = "root";//имя пользователя для входа в базу данных
$dbPassword = "root";//пароль для базы данных
$dbHost = "localhost";//указываем комп. на котором находится наша база данных. 
//в данном случае локалхост значит, что на том же комп. где весь код!
// $db=new mysqli("localhost","root","root","diplom");

$db = new PDO("mysql:dbhost=localhost;dbname=diplom","root","root");